<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends ClientsController
{
    public function __construct()
    {
        parent::__construct();
        hooks()->do_action('clients_authentication_constructor', $this);
    }

    public function index()
    {
        $this->login();
    }

    // Added for backward compatibilies
    public function admin()
    {
        redirect(admin_url('authentication'));
    }

    public function login()
    {
        if (is_client_logged_in()) {
            redirect(site_url());
        }

        $this->form_validation->set_rules('password', _l('clients_login_password'), 'required');
        $this->form_validation->set_rules('email', _l('clients_login_email'), 'trim|required|valid_email');

        if (show_recaptcha_in_customers_area()) {
            $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_recaptcha');
        }
        if ($this->form_validation->run() !== false) {
            $this->load->model('Authentication_model');

            $success = $this->Authentication_model->login(
                $this->input->post('email'),
                $this->input->post('password', false),
                $this->input->post('remember'),
                false
            );

            if (is_array($success) && isset($success['memberinactive'])) {
                set_alert('danger', _l('inactive_account'));
                redirect(site_url('authentication/login'));
            } elseif ($success == false) {
                set_alert('danger', _l('client_invalid_username_or_password'));
                redirect(site_url('authentication/login'));
            }

            if ($this->input->post('language') && $this->input->post('language') != '') {
                set_contact_language($this->input->post('language'));
            }

            $this->load->model('announcements_model');
            $this->announcements_model->set_announcements_as_read_except_last_one(get_contact_user_id());

            maybe_redirect_to_previous_url();
            
            redirect(site_url());
        }
        if (get_option('allow_registration') == 1) {
            $data['title'] = _l('clients_login_heading_register');
        } else {
            $data['title'] = _l('clients_login_heading_no_register');
        }
        $data['bodyclass'] = 'customers_login';

        $this->data($data);
        $this->view('login');
        $this->layout();
    }

    public function register()
    {
        if (get_option('allow_registration') != 1 || is_client_logged_in()) {
            redirect(site_url());
        }

        if (get_option('company_is_required') == 1) {
            $this->form_validation->set_rules('company', _l('client_company'), 'required');
        }

        if (is_gdpr() && get_option('gdpr_enable_terms_and_conditions') == 1) {
            $this->form_validation->set_rules(
                'accept_terms_and_conditions',
                _l('terms_and_conditions'),
                'required',
                    ['required' => _l('terms_and_conditions_validation')]
            );
        }

        $this->form_validation->set_rules('firstname', _l('client_firstname'), 'required');
        $this->form_validation->set_rules('lastname', _l('client_lastname'), 'required');
        $this->form_validation->set_rules('email', _l('client_email'), 'trim|required|is_unique[' . db_prefix() . 'contacts.email]|valid_email');
        $this->form_validation->set_rules('password', _l('clients_register_password'), 'required');
        $this->form_validation->set_rules('passwordr', _l('clients_register_password_repeat'), 'required|matches[password]');

        if (show_recaptcha_in_customers_area()) {
            $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_recaptcha');
        }

        $custom_fields = get_custom_fields('customers', [
            'show_on_client_portal' => 1,
            'required'              => 1,
        ]);

        $custom_fields_contacts = get_custom_fields('contacts', [
            'show_on_client_portal' => 1,
            'required'              => 1,
        ]);

        foreach ($custom_fields as $field) {
            $field_name = 'custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']';
            if ($field['type'] == 'checkbox' || $field['type'] == 'multiselect') {
                $field_name .= '[]';
            }
            $this->form_validation->set_rules($field_name, $field['name'], 'required');
        }
        foreach ($custom_fields_contacts as $field) {
            $field_name = 'custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']';
            if ($field['type'] == 'checkbox' || $field['type'] == 'multiselect') {
                $field_name .= '[]';
            }
            $this->form_validation->set_rules($field_name, $field['name'], 'required');
        }
        if ($this->input->post()) {
            if ($this->form_validation->run() !== false) {
                $data = $this->input->post();

                define('CONTACT_REGISTERING', true);

                $clientid = $this->clients_model->add([
                      'billing_street'      => $data['address'],
                      'billing_city'        => $data['city'],
                      'billing_state'       => $data['state'],
                      'billing_zip'         => $data['zip'],
                      'billing_country'     => is_numeric($data['country']) ? $data['country'] : 0,
                      'firstname'           => $data['firstname'],
                      'lastname'            => $data['lastname'],
                      'email'               => $data['email'],
                      'contact_phonenumber' => $data['contact_phonenumber'] ,
                      'website'             => $data['website'],
                      'title'               => $data['title'],
                      'password'            => $data['passwordr'],
                      'company'             => $data['company'],
                      'vat'                 => isset($data['vat']) ? $data['vat'] : '',
                      'phonenumber'         => $data['phonenumber'],
                      'country'             => $data['country'],
                      'city'                => $data['city'],
                      'address'             => $data['address'],
                      'zip'                 => $data['zip'],
                      'state'               => $data['state'],
                      'custom_fields'       => isset($data['custom_fields']) && is_array($data['custom_fields']) ? $data['custom_fields'] : [],
                ], true);

                if ($clientid) {
                    hooks()->do_action('after_client_register', $clientid);

                    if (get_option('customers_register_require_confirmation') == '1') {
                        send_customer_registered_email_to_administrators($clientid);

                        $this->clients_model->require_confirmation($clientid);
                        set_alert('success', _l('customer_register_account_confirmation_approval_notice'));
                        redirect(site_url('authentication/login'));
                    }

                    $this->load->model('authentication_model');

                    $logged_in = $this->authentication_model->login(
                        $this->input->post('email'),
                        $this->input->post('password', false),
                        false,
                        false
                    );

                    $redUrl = site_url();

                    if ($logged_in) {
                        hooks()->do_action('after_client_register_logged_in', $clientid);
                        set_alert('success', _l('clients_successfully_registered'));
                    } else {
                        set_alert('warning', _l('clients_account_created_but_not_logged_in'));
                        $redUrl = site_url('authentication/login');
                    }

                    send_customer_registered_email_to_administrators($clientid);
                    redirect($redUrl);
                }
            }
        }

        $data['title']     = _l('clients_register_heading');
        $data['bodyclass'] = 'register';
        $this->data($data);
        $this->view('register');
        $this->layout();
    }

    public function forgot_password()
    {
        if (is_client_logged_in()) {
            redirect(site_url());
        }

        $this->form_validation->set_rules(
            'email',
            _l('customer_forgot_password_email'),
            'trim|required|valid_email|callback_contact_email_exists'
        );

        if ($this->input->post()) {
            if ($this->form_validation->run() !== false) {
                $this->load->model('Authentication_model');
                $success = $this->Authentication_model->forgot_password($this->input->post('email'));
                if (is_array($success) && isset($success['memberinactive'])) {
                    set_alert('danger', _l('inactive_account'));
                } elseif ($success == true) {
                    set_alert('success', _l('check_email_for_resetting_password'));
                } else {
                    set_alert('danger', _l('error_setting_new_password_key'));
                }
                redirect(site_url('authentication/forgot_password'));
            }
        }
        $data['title'] = _l('customer_forgot_password');
        $this->data($data);
        $this->view('forgot_password');

        $this->layout();
    }

    public function reset_password($staff, $userid, $new_pass_key)
    {
        $this->load->model('Authentication_model');
        if (!$this->Authentication_model->can_reset_password($staff, $userid, $new_pass_key)) {
            set_alert('danger', _l('password_reset_key_expired'));
            redirect(site_url('authentication/login'));
        }

        $this->form_validation->set_rules('password', _l('customer_reset_password'), 'required');
        $this->form_validation->set_rules('passwordr', _l('customer_reset_password_repeat'), 'required|matches[password]');
        if ($this->input->post()) {
            if ($this->form_validation->run() !== false) {
                hooks()->do_action('before_user_reset_password', [
                    'staff'  => $staff,
                    'userid' => $userid,
                ]);
                $success = $this->Authentication_model->reset_password(
                        0,
                        $userid,
                        $new_pass_key,
                        $this->input->post('passwordr', false)
                );
                if (is_array($success) && $success['expired'] == true) {
                    set_alert('danger', _l('password_reset_key_expired'));
                } elseif ($success == true) {
                    hooks()->do_action('after_user_reset_password', [
                        'staff'  => $staff,
                        'userid' => $userid,
                    ]);
                    set_alert('success', _l('password_reset_message'));
                } else {
                    set_alert('danger', _l('password_reset_message_fail'));
                }
                redirect(site_url('authentication/login'));
            }
        }
        $data['title'] = _l('admin_auth_reset_password_heading');
        $this->data($data);
        $this->view('reset_password');
        $this->layout();
    }

    public function logout()
    {
        $this->load->model('authentication_model');
        $this->authentication_model->logout(false);
        hooks()->do_action('after_client_logout');
        redirect(site_url('authentication/login'));
    }

    public function contact_email_exists($email = '')
    {
        $this->db->where('email', $email);
        $total_rows = $this->db->count_all_results(db_prefix() . 'contacts');

        if ($total_rows == 0) {
            $this->form_validation->set_message('contact_email_exists', _l('auth_reset_pass_email_not_found'));

            return false;
        }

        return true;
    }

    public function recaptcha($str = '')
    {
        return do_recaptcha_validation($str);
    }

    public function change_language($lang = '')
    {
        if (is_language_disabled()) {
            redirect(site_url());
        }

        set_contact_language($lang);

        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(site_url());
        }
    }

    public function agent_signup(){

        if ($this->input->post()) {

            $agent_id = $this->create_agent();
            $this->create_agent_next_of_kin($agent_id);
            $this->create_agent_answers($agent_id);
            $this->create_agent_address($agent_id);

            $payment_ref = $this->input->post('agent_name');
            $this->generate_swify_payment_link($this->input->post('agent_cellphone_number'),$payment_ref);
            

            //registration email to admin
            $this->sendAgentRegistrationEmail();
            redirect('authentication/agent_signup_successful');
          
            $this->layout();
        }
    
        $questions = $this->db->get('tblagent_signup_questions')->result();
        $data['questions'] = $questions;
        
        $this->data($data);
        $this->view('agentsignup');
      
        $this->layout();

    }
    public function lead_signup(){

       
        
        if ($this->input->post()) {

            $_POST['client_id'] =  get_contact_user_id();
            $this->db->insert('tblleads', $_POST);
            redirect('authentication/lead_signup_successful');

        }else{

            $data['signup_reasons'] = $this->db->get('tblleads')->result_array();
            $this->data($data);
            $this->view('leads/signup');
            $this->layout();
            
        }
      
    }
    public function agent_signup_successful(){

        $this->view('agentsignup_successful');
      
        $this->layout();
    }

    public function lead_signup_successful(){
       
        $this->view('leads/signup_successful');
        $this->layout();

    }

    public function create_agent(){


        $data = [
            'city' => $this->input->post('add_line1'), 
            'zip' =>  $this->input->post('add_postal_code'),
            'state' => $this->input->post('agent_landline'),
            'address' => $this->input->post('add_line1') ."</br>".$this->input->post('add_city'). "<br/>" .$this->input->post('add_postal_code'),
        ];

        $this->db->insert('tblclients', $data);
        $insert_id = $this->db->insert_id();

        $data = [
            'firstname' => $this->input->post('agent_name'), 
            'lastname' =>  $this->input->post('suname'),
            'phonenumber' => $this->input->post('agent_cellphone_number'),
            'idnumber' => $this->input->post('agent_idnumber'),
            'email' =>  $this->input->post('agent_email'),
            'contact_type' => 'agent',
            'userid' => $insert_id,
            'password' => app_hash_password($this->input->post('password'))
        ];

        $this->db->insert('tblcontacts', $data);


        return  $insert_id;

    }

    public function create_agent_address($agent_id){

      
        $data = [
            'add_line1' => $this->input->post('add_line1'), 
            'add_line2' => $this->input->post('add_line2'),
            'add_city' => $this->input->post('add_city'),
            'add_type' => 1, //postal address
            'add_postal_code' => $this->input->post('add_postal_code'),
            'fk_agent_id' => $agent_id
        ];

        $this->db->insert('tblagent_address', $data);

    }

    public function create_agent_next_of_kin($agent_id){

        $data = [
            'nok_name' => $this->input->post('nok_name'), 
            'nok_surname' => $this->input->post('nok_surname'),
            'nok_cell_number' => $this->input->post('nok_cell_number'),
            'fk_agent_id' => $agent_id
        ];

        $this->db->insert('tblagent_next_of_kin', $data);

    }

    public function create_agent_answers($agent_id){

        $question_answers = $this->input->post('question_anwsers');

        foreach( $question_answers as $question_id => $unswer){

            $data = [
                'answer' => $unswer, 
                'fk_question_id' => $question_id,
                'fk_agent_id' => $agent_id
            ];

            $this->db->insert('tblagent_signup_answers', $data);
        }

    }

    public function generate_swify_payment_link($mobile,$payment_ref){

            $type = 1;
            $amount = 149;
            $whatsapp = '';
            $contact_type = 'sms';
            
            if($type == 1){
                // $contact_type = 'sms';
                // $mobile = '0833968710';
            }elseif($type == 2) {
                // $contact_type = 'email';
                // $email = 'jamie@jnz.co.za';
            }elseif($type == 3){
                // $contact_type = 'whatsapp';
                // $whatsapp = 'whatsapp';
            }else{
                $contact_type = '';
            }
            
            $addvars = array(
                'amount' => $amount,
                'payment_reference' => $payment_ref,
                'own_amount' => '',
                'merchant_id' => '',
                'mobile' => $mobile,
                'email' => $email,
                'success_url' => '',
                'error_url' => '',
                'cancel_url' => '',
                'notify_url' => '',
                'recurring_start_day' => 31,
                'send' => 1,
                'contact_type' => $contact_type,
            );
            
            $auth = base64_encode('jnzapi:jnzapi2020!');
            // echo $auth; exit;
            $request_url_base = "https://pay.swiffy.co.za/api";
            $endpoint = "/v1/swiffy/payment-link";

            $verify_hostname = false;
            $curl = curl_init();
            
            curl_setopt_array($curl,
            array(
                    CURLOPT_URL => $request_url_base.$endpoint,
                    CURLOPT_SSL_VERIFYPEER => $verify_hostname,
                    CURLOPT_SSL_VERIFYHOST => $verify_hostname,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => array("Authorization: Basic $auth",'Accept: application/json'),
                    CURLOPT_POSTFIELDS => $addvars,
                    )
            );

            $reply = curl_exec( $curl );
        
            if(! $reply) {
                    echo curl_error($curl);
                    curl_close($curl);
                    exit;
            }
           
            $response = json_decode($reply, true);
        
        
            curl_close($curl);
    
    }
    
   //for testing puroses:
    public function sendAgentRegistrationEmail(){
            
        $questions = $this->db->get('tblagent_signup_questions')->result();

        $this->load->library('email');
        $fromemail="innosela@gmail.com";
        $toemail = "innothetechgeek@gmail.com";
        $subject = "New Agent Registration";
        // $mesg = $this->load->view('template/email',$data,true);
        // or
        $data = array(
            'agent_name' => 'Ela',
            'agent_landline' => '0833444554',
            'agent_idnumber' => '54545454545',
            'agent_cellphone_number' => '0834455456',
            'agent_landline' => '021334456',
            'add_line1' => '290 watergang',
            'add_line2' => '',
            'add_city' => 'Cape Town',
            'add_postal_code' => '7600',
            'nok_name' => 'Lary',
            'nok_surname' => 'Page',
            'questions' => $questions,
            'question_anwsers' => $this->input->post('question_anwsers')
        );

        $mesg = $this->load->view('email/agentsignup',['data' =>  $data],true);
        
        $config=array(

            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html',
            // Host
            'smtp_host' =>'smtp.mailtrap.io',
            // Port
            'smtp_port' => 2525,
            // User
            'smtp_user' => 'b5016198047a1d',
            // Pass
            'smtp_pass' => 'b08c6fc050f2e5',
            'newline' => "\r\n",

        );
 
        $this->email->initialize($config);
        
        $this->email->to($toemail);
        $this->email->from($fromemail, "Title");
        $this->email->subject($subject);
        $this->email->message($mesg);
        $mail = $this->email->send();
    }
}
