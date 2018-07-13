<?php

class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addEmployeeDetails($request) {
        extract($request);
        $sql = "INSERT INTO employee_master(employee_name,employee_punch_id,employee_skills,status)"
                . "VALUES ('$emp_name','$emp_punch_id','$skillAdded_field','1')";
//        echo $sql;die();
        //$this->db->query($sql)
        if ($this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
