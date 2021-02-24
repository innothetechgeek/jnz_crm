<?php

class Migration_Version_281 extends CI_Migration
{
    public function up()
    {

          
            $this->dbforge->add_field(array(

                  'id' => array(
                        'type' => 'INT',
                        'constraint' => 10,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                  ),
                  'signup_reason' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),

            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('lead_signup_reasons');

            $signup_reasons = [
               
                    'Vehicle tracking system',
                    'Mtorplan',
                    'Extended Vehicle warranty-refer vehicle owner',
                    'Funeral Cover-lead only',
                    'School Online Tutor System',
                    'Refer a funeral policy client',
                    'Refer a credit card client',
                    'Refer a credit card client',
                    'Refer a client for Loyality Program',
                    'Refer a client looking for insurance',
                    'Medical Aid or Gap Covers',
                    'refer a client that needs an ADT alarm system',
                    'Mefer a client for cellphone contract',
                    'Mefer a client that wants to buy a house'
                
            ];

            foreach($signup_reasons as $key => $reason){
               
                $this->db->insert('lead_signup_reasons', ['signup_reason'=>$reason]);
                $this->db->insert_id();

            } 

      }

   public function down(){

   }


}