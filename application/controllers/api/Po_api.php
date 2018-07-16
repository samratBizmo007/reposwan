<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Po_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('po_model/Po_model');
        // $this->load->model('inventory_model/Inventory_model');
    }

    //--------fun for get all categories from category tab-----------------------//
    public function getAllCustomerName_get() {
        extract($_GET);
        $result = $this->Po_model->getAllCustomerName();
        return $this->response($result);
    }
}