  
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Machine_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('machine_model/Machine_model');
    }


  //----------fun for add material Details------------------------//
    public function addMachineInfo_post() {
        $data = ($_POST);
        extract($data);
        $result = $this->Machine_model->addMachineInfo($data);
        return $this->response($result);
    }
 //----------------fun for get machine details----------------------//
    public function getAllMachineDetails_get() {
        $result = $this->Machine_model->getAllMachineDetails();
        return $this->response($result);
    }

      //----------fun for update machine Details------------------------//
    public function updateMachineDetails_post() {
        $data = ($_POST);
        extract($data);
        $result = $this->Machine_model->updateMachineDetails($data);
        return $this->response($result);
    }

      //----------------fun for delete machine details----------------------//
    public function deleteMachineDetails_get() {
        extract($_GET);
        $result = $this->Machine_model->deleteMachineDetails($machine_id);
        return $this->response($result);
    }
   }