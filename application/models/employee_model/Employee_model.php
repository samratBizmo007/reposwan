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



        //---------------------------------fun for get employee details-------------------------------//
    public function getAllEmployeeDetails() {
        $sql = "SELECT * FROM employee_master";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500,
                'status_message' => 'No data found.');
        } else {
            $response = array(
                'status' => 200,
                'status_message' => $result->result_array());
        }
        return $response;
    }

     // ----------------------Fun For update Material Details-------------------------------------//

    public function updateEmployeeDetails($data) {
        extract($data);
       
        $sql = "UPDATE employee_master SET employee_name = '$employee_name',employee_punch_id='$employee_punch_id',employee_skills='$employee_skills'";
                
        //echo $sql;die();
       $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 200,
                'status_message' => 'Employee Update Successfully..');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Employee Not updated Successfully..');
        }
        return $response;
    }


    //---------------------------------fun for delete material details-------------------------------//
    public function deleteEmployeeDetails($emp_id) {
        $sql = "DELETE FROM employee_master WHERE emp_id = '$emp_id'";
     $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 200,
                'status_message' => 'Machine Deleted Successfully..');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Machine Not Deleted Successfully..');
        }
        return $response;

}
}
