<?php
//igen home page controller
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends ClientsController {


    public function index(){

        $this->load->view('website/index');

    }

    public function about(){

        $this->load->view('website/about');
    }

    public function cost(){
        
        $this->load->view('website/cost');
    }

    public function campaigns(){
        
        $this->load->view('website/campaigns');
    }


}



