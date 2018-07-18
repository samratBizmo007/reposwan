<?php

class Po_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ----------------------get all customer name-------------------------------------//
    public function getAllCustomerName() {
        $sql = "SELECT customer_name from product_master Group By customer_name";
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

    // ----------------------get all customer name-------------------------------------//
    // ----------------------get all products by customer name-------------------------------------//
    
    // ----------------------get all products by customer name-------------------------------------//
}
