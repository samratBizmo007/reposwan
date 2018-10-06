<?php

class Pending_orders extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session    

        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('reports_model/Pendingorders_model');
        $this->load->model('po_model/Allpo_model');

        $this->load->helper('file');
        $this->load->helper('url');
        $this->load->helper('download');

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
        $this->load->view('pages/reports/pending_order_list');
        $this->load->view('includes/footer');
    }

    public function getPODetails() {
        extract($_GET);
        $result = $this->Pendingorders_model->getPODetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getPoByDate() {
        extract($_GET);
        $result = $this->Pendingorders_model->getPoByDate($from_date, $to_date);
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

    public function updatePoDetails() {
        extract($_GET);
        //print_r($_GET);
        //die();
        $result = $this->Pendingorders_model->updatePoDetails($balance, $remark, $po_id);
        if ($result) {
            echo '200';
        } else {
            echo '500';
        }
    }

    public function downloadPendingOrders() {
        extract($_GET);
        $result = $this->Pendingorders_model->downloadPendingOrders($from_date, $to_date);
        //print_r(json_encode($result));
        $filename = 'Pending_Orders_' . date('Y-m-d') . '.csv';
        header("Content-Type: application/csv; ");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
// get data 
        $usersData = $result;
// file creation 
        $file = fopen('php://output', 'w');
        $header = array("P.O Number", "P.O Date", "Line No", "Item Drg No/ Sr.No", "Rate", "Quantity", "Balanced", "Due Date", "Remark");
        fputcsv($file, $header);
        if ($result) {
            foreach ($usersData as $key => $line) {
                fputcsv($file, $line);
            }
        } else {
            fputcsv($file, array('------------No data available-----------'));
        }
        fclose($file);
        //force_download($file);
        exit;
    }

}
