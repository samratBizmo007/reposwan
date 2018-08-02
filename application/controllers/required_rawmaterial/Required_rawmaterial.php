<?php

class Required_rawmaterial extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        //$this->load->model('employee_model/Employee_model');
        $this->load->model('required_rawmaterial_model/Rawmaterial_required_model');
        if ($admin_name == '') {
            redirect('login');
        } else {
            $sessionArr = explode('|', $admin_name);
            //check session variable set or not, otherwise logout
            if (($sessionArr[0] != 'SWANROCKSPlates')) {
                redirect('login');
            }
        }
    }

    public function index() {
        $this->load->view('includes/header');
        $this->load->view('pages/required_raw_material/raw_material_required');
        $this->load->view('includes/footer');
    }

    public function getPurchaseOrdersDetails() {
        extract($_GET);
        $result = $this->Rawmaterial_required_model->getPurchaseOrdersDetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

}
