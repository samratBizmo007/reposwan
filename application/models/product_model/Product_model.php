<?php

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // get all skills from db-------------------------------------
    public function getSkills() {
        $query = "SELECT * FROM skill_master";
        $result = $this->db->query($query);
        // handle db error
        if (!$result) {
            // Has keys 'code' and 'message'
            $error = $this->db->error();
            return $error;
            die();
        }
        // if no db errors
        if ($result->num_rows() <= 0) {
            return false;
        } else {

            return $result->result_array();
        }
    }

    // get all skills from db-------------------------------------
    //---get all machine details
    public function getMachines() {
        $query = "SELECT * FROM machine_master";
        $result = $this->db->query($query);
        // handle db error
        if (!$result) {
            // Has keys 'code' and 'message'
            $error = $this->db->error();
            return $error;
            die();
        }
        // if no db errors
        if ($result->num_rows() <= 0) {
            return false;
        } else {

            return $result->result_array();
        }
    }

    // add new product to master table--------------------------
    public function addNewProduct($data) {
        extract($data);
        //print_r($data);die();
        $sub_products = json_decode($product_info, TRUE);
        //print_r($sub_products);
        //die();
        $product_id = array();
        $products = array();
        $parent_id = '';
        $serial_no = '';
        $part_code = '';
        $machine_info = '';
        $packing_qty_per_tray = '';
        $finished_weight = '';
        for ($i = 0; $i < count($sub_products); $i++) {
            //print_r($sub_products[$i]);die();
            $sql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME ='product_tab' AND TABLE_SCHEMA='swan_db'";
            //---this sql query for get auto increment value of product table
            //---the parent_id is used to get autoincrement id of product table-------------------------------------------------//        
            $serial_no = $sub_products[$i]['serial_no'];
            $part_code = $sub_products[$i]['item_code'];
            $machine_info = json_encode($sub_products[$i]['machine_details']);
            $requiredMaterial = json_encode($sub_products[$i]['requiredMaterial']);
            $packing_qty_per_tray = $sub_products[$i]['packingquantity_per_tray'];
            $finished_weight = $sub_products[$i]['net_finished_weight'];

            $result = $this->db->query($sql);
            foreach ($result->result_array() as $row) {
                $parent_id = $row['AUTO_INCREMENT'];
            }
            $product_id[] = $parent_id;
            $sqlInsert = "INSERT INTO product_tab (drawing_no,sr_no,part_code,machine_info,material_details,packing_qty_per_tray,finished_weight) "
                    . "values ('$drawing_no','$serial_no','$part_code','$machine_info','$requiredMaterial','$packing_qty_per_tray','$finished_weight')";
            $InsertResult = $this->db->query($sqlInsert);
        }

        // $sqlInsertMasterProduct = "INSERT INTO product_master () values ()";


        if (!empty($data)) {
            $insertData = array(
                'customer_name' => $customer_name,
                'prod_type' => $prod_type,
                'sub_products' => json_encode($product_id),
                'stock_plant' => $stock_plant,
                'ex_stock_quantity' => $exstock_quantity,
                'product_name' => $product_name,
                'drawing_no' => $drawing_no,
                'revision_no' => $revision_no,
                'old_rate' => $old_rate,
                'new_rate' => $new_rate,
                'added_date' => date('Y-m-d'),
                'added_time' => date('H:i:s'),
                'modified_date' => date('Y-m-d'),
                'modified_time' => date('H:i:s')
            );
// $sql = $this->db->set($insertData)->get_compiled_insert('product_master');
// echo $sql;
            $this->db->insert('product_master', $insertData);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    // add new product function ends here----------------------
    // get all products from db-------------------------------------
    public function getAllProducts() {
        $query = "SELECT * FROM product_master";

        $result = $this->db->query($query);
        // handle db error
        if (!$result) {
            // Has keys 'code' and 'message'
            $error = $this->db->error();
            return $error;
            die();
        }

        // if no db errors
        if ($result->num_rows() <= 0) {
            return false;
        } else {

            return $result->result_array();
        }
    }

    // get all products from db-------------------------------------
    // get particular product details from db-------------------------------------
    public function getProductDetails($prod_id) {
        $query = "SELECT * FROM product_master WHERE prod_id='$prod_id'";
        $result = $this->db->query($query);
        $allData['product_detail'] = $result->result_array();
        //$allData
        // handle db error
        if (!$result) {
            // Has keys 'code' and 'message'
            $error = $this->db->error();
            return $error;
            die();
        }
        $sub_products = '';
        // if no db errors
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            foreach ($result->result_array() as $row) {
                $sub_products = $row['sub_products'];
            }
            $arr = json_decode($sub_products);
            $allSubProducts = [];
            // get subproductsb details
            foreach ($arr as $key) {
                $sub_query = "SELECT * FROM product_tab WHERE p_id='$key'";
                $sub_result = $this->db->query($sub_query);
                $allSubProducts[] = $sub_result->result_array();
            }
            $allData['subProduct_detail'] = $allSubProducts;
            return $allData;
        }
    }

    // get particular product details from db-------------------------------------
    // delete particular product from db-------------------------------------
    public function delProduct($prod_id) {
        $query = "DELETE FROM product_master WHERE prod_id='$prod_id'";

        $this->db->query($query);
        // handle db error
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //  delete particular product from db-------------------------------------
}
