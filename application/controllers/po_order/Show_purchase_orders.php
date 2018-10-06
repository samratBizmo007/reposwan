<?php

class Show_purchase_orders extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('po_model/Allpo_model');
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
        $this->load->view('pages/po_order/allpurchase_orders');
        $this->load->view('includes/footer');
    }

    public function getAllPODetails() {
        extract($_GET);
        $result = $this->Allpo_model->getAllPODetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function deletePODetails() {
        extract($_GET);
        //echo json_encode($_GET);
        $result = $this->Allpo_model->deletePODetails($po_id);
        if (!$result) {
            echo '500';
        } else {
            echo '200';
        }
    }

    public function getAllPoByDate() {
        extract($_GET);
        //echo json_encode($_GET);
        $result = $this->Allpo_model->getAllPoByDate($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getPoByPo_number() {
        extract($_GET);
        $result = $this->Allpo_model->getPoByPo_number($po_number);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

}
