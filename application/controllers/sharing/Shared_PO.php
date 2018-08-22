<?php

class Shared_PO extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('sharedpo_model/SharedPO_model');

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
        //$data['products'] = Showinventory::getAllProductDetails();     //-------show all materials
        //$data['customers'] = Showinventory::getAllCustomerNames();     //-------show all materials
        $this->load->view('includes/header');
        $this->load->view('pages/sharing/shared');
        $this->load->view('includes/footer');
    }

    public function getSharedPo() {
        extract($_GET);
        $result = $this->SharedPO_model->getSharedPo($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getPurchaseOrdersDetails() {
        extract($_GET);
        $result = $this->SharedPO_model->getPurchaseOrdersDetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

}
