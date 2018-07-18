<?php

class Machine_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ----------------------Fun For Add Material Details-------------------------------------//
    public function addMachineInfo($data) {
        extract($data);
        // print_r($data);die();
       $sql = "INSERT INTO machine_master(machine_name,machine_type,machine_capacity) VALUES ('$machine_name','$machine_type','$machine_capacity')";
  
        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'Machine  Added Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... Machine Not Added Successfully.!!!'
            );
        }
        return $response;
    }

        //---------------------------------fun for get machine details-------------------------------//
    public function getAllMachineDetails() {
        $sql = "SELECT * FROM machine_master";
        //echo $sql; die();
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

    public function updateMachineDetails($data) {
        extract($data);
        //print_r($data);die();
        $sql = "UPDATE machine_master SET machine_name = '$machine_name',"
                . "machine_type='$machine_type',machine_capacity='$machine_capacity' WHERE machine_id = '$machine_id'";
                
        //echo $sql;die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'Machine details updated Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... Machine Not Updated Successfully.!!!'
            );
        }
        return $response;
    }


    //---------------------------------fun for delete material details-------------------------------//
    public function deleteMachineDetails($machine_id) {
        $sql = "DELETE FROM machine_master WHERE machine_id = '$machine_id'";
        //echo $sql; die();
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
