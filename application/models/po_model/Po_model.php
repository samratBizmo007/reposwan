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
        $product_detail = array();
        $i = 0;
        $product_detail = json_decode($product_details, TRUE);
        extract($product_detail);
        if ($product_detail != '') {
            for ($i = 0; $i < count($product_detail); $i++) {
                //echo count($product_detail);die();
                //print_r($product_detail[$i]['line_no']);die();
                $line_no = $product_detail[$i]['line_no'];
                $prod_id = $product_detail[$i]['prod_id'];
                $part_drwing_no = $product_detail[$i]['part_drwing_no'];
                $product_name = $product_detail[$i]['product_name'];
                $revision_no = $product_detail[$i]['revision_no'];
                $sr_no = $product_detail[$i]['sr_no'];
                $product_code = $product_detail[$i]['product_code'];
                $unit_rate = $product_detail[$i]['unit_rate'];
                $quantity = $product_detail[$i]['quantity'];
                $netAmount = $product_detail[$i]['netAmount'];
                $due_date =  $product_detail[$i]['due_date'];
                $sql = "INSERT INTO purchase_orders(customer_name,po_total,"
                        . "po_duedate,order_no,prod_id,"
                        . "line_no,part_drwing_no,product_name,"
                        . "revision_no,sr_no,product_code,"
                        . "unit_rate,quantity,net_amount,"
                        . "product_details,added_date,"
                        . "added_time,modified_date,"
                        . "modified_time,status)"
                        . "VALUES ('$customer_name','$total','$due_date',"
                        . "'$order_no','$prod_id','$line_no',"
                        . "'$part_drwing_no','$product_name',"
                        . "'$revision_no','$sr_no','$product_code',"
                        . "'$unit_rate','$quantity','$netAmount',"
                        . "'$product_details',now(),now(),now(),now(),'1')";
                //echo $sql;die();
                $this->db->query($sql);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
