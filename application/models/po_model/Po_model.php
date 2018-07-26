<?php

class Po_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ----------------------get all customer name-------------------------------------//
    public function getAllCustomerName() {
        $sql = "SELECT * from product_master Group By (customer_name)";
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
    // ----------------------get all products part no and drawing no by customer name-------------------------------------//
    public function getCustomerProducts($customer_name) {
        $sql = "SELECT drawing_no FROM product_master WHERE customer_name = '$customer_name'";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // ----------------------get all products by customer name-------------------------------------//

    public function getProductInfo($part_no) {
        $sql = "SELECT product_name,prod_id FROM product_master WHERE drawing_no= '$part_no'";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    //------------------get all product details by part no and rev no-----------------------------//
    public function getDetailedProductInfo($part_no, $rev_no) {
        $sql = "SELECT * FROM product_master WHERE drawing_no= '$part_no' AND revision_no='$rev_no'";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

//----------------------add po details to db------------------------------------------//
    public function addPurchaseOrder($data) {
        extract($data);
        $sql = "INSERT INTO purchase_orders(customer_name,po_total,po_duedate,order_no,product_details,added_date,added_time,modified_date,modified_time,status)"
                . "VALUES ('$customer_name','$total','$po_duedate','$order_no','$product_details',now(),now(),now(),now(),'1')";
        //echo $sql;die();
        //$this->db->query($sql)
        if ($this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
