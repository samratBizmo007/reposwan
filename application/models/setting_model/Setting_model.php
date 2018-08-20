<?php

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
 //-------UPDATE ADMIN EMAIL FUNCTION--------------//
    public function updateEmail($email) {

        $sql = "UPDATE admin_details SET value='$email' WHERE name='email'";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200,
                'status_message' => 'Email Updated Successfully..!');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Email Updation Failed...!');
        }
        return $response;
    }


 //-------UPDATE ADMIN UPDATE FUNCTION--------------//
    public function updatePass($pass) {

        $sql = "UPDATE admin_details SET value='$pass' WHERE name='password'";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200,
                'status_message' => 'Password Updated Successfully..!');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Password Updation Failed...!');
        }
        return $response;
    }

     // -----------------------GET ADMIN EMAIL----------------------//
      public function getAdminDetails() {

        $query = "SELECT * FROM admin_details ";

        $result = $this->db->query($query);

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


 }
