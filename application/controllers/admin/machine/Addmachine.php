<?php

class Addmachine extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name=$this->session->userdata('admin_name');
        
        if($admin_name==''){ redirect('login'); }
        else {
            $sessionArr=explode('|', $admin_name);
        //check session variable set or not, otherwise logout
            if(($sessionArr[0]!='SWANROCKSPlates')){
                redirect('login');
            }
        }
    }

    public function index() {
        $this->load->view('includes/header');
        $this->load->view('pages/admin/machine/addmachine');
        $this->load->view('includes/footer');
    }


    public function addMachine_data()
    {
        
    }
}


