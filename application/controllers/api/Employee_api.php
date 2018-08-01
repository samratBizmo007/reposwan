<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Employee_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee_model/Employee_model');
    }

//----------------fun for get machine details----------------------//
    public function getAllEmployeeDetails_get() {
        $result = $this->Employee_model->getAllEmployeeDetails();
        return $this->response($result);
    }

    //----------fun for update Employee Details------------------------//
    public function updateEmployeeDetails_post() {
        $data = ($_POST);
        extract($data);
        $result = $this->Employee_model->updateEmployeeDetails($data);
        return $this->response($result);
    }

    //----------------fun for delete Employee details----------------------//
    public function deleteEmployeeDetails_get() {
        extract($_GET);
        $result = $this->Employee_model->deleteEmployeeDetails($emp_id);
        return $this->response($result);
    }

}
