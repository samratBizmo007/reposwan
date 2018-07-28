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

    public function getAllCustomerNames() {
        $sql = "SELECT * from product_master Group By (customer_name)";
        //echo $sql; die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getProducts($data) {
        extract($data);
        //print_r($data);die();
        if ($customerName == 'all' && $prod_type == 'all') {
            $sql = "SELECT * FROM product_master";
        } elseif ($prod_type != 'all' && $customerName != 'all') {
            $sql = "SELECT * FROM product_master WHERE prod_type = '$prod_type' AND customer_name = '$customerName'";
        } elseif ($prod_type == 'all' && $customerName != 'all') {
            $sql = "SELECT * FROM product_master WHERE customer_name = '$customerName'";
        } elseif ($prod_type != 'all' && $customerName == 'all') {
            $sql = "SELECT * FROM product_master WHERE prod_type = '$prod_type'";
        } else {
            $sql = "SELECT * FROM product_master";
        }
        // echo $sql;
        //die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function updateMaterialDetails($request) {
        extract($request);
        $sql = "UPDATE material_tab SET material_weight='$weight',"
                . "id='$id',od='$od',length='$length',pitching='$pitching',quantity='$quantity',"
                . "diagram_no='$diagram_no',thickness='$thickness',"
                . "diameter='$diameter',remark='$remark',"
                . "modified_date= NOW(),modified_time= NOW(),status='1' WHERE material_id = '$material_id'";
        //echo $sql;die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateProductDetails($product_quantity, $prod_id) {
        $sql = "UPDATE product_master SET product_quantity='$product_quantity',"
                . "modified_date= NOW(),modified_time= NOW(),status='1' WHERE prod_id = '$prod_id'";
        //echo $sql;die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
