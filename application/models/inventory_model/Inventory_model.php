<?php

class Inventory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//-----------fun for get all product details ------------------//
    public function getAllProductDetails() {
        $sql = "SELECT * FROM product_master";
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

//-----------fun for get all product details ------------------//
}
