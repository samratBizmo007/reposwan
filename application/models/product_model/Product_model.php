<?php
class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }

    // get all skills from db-------------------------------------
    public function getSkills(){
        $query = "SELECT * FROM skill_master";

        $result = $this->db->query($query);
        // handle db error
        if (!$result)
        {
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

    // add new product to master table--------------------------
    public function addNewProduct($data)
    {
        extract($data);
        if(!empty($data)){
            $insertData = array(
                'customer_name' =>  $customer_name,
                'prod_type' =>  $prod_type,
                'stock_plant'   =>  $stock_plant,
                'product_name'  =>  $product_name,
                'drawing_no'    =>  $drawing_no,
                'revision_no'   =>  $revision_no,
                'sr_item_code'  =>  $sr_item_code,
                'operations'    =>  $operations ,
                'machine_qtyhr' =>  $machine_qtyhr,
                'rm_required'   =>  $rm_required,
                'old_rate'  =>  $old_rate,
                'new_rate'  =>  $new_rate,
                'added_date'  =>  date('Y-m-d'),
                'added_time'  =>  date('H:i:s'),
                'modified_date'  =>  date('Y-m-d'),
                'modified_time'  =>  date('H:i:s')
            );
// $sql = $this->db->set($insertData)->get_compiled_insert('product_master');
// echo $sql;
            $this->db->insert('product_master', $insertData);

            if ($this->db->affected_rows() > 0 ) {
                return true;
            }else{
                return false;
            }
        }
    }
    // add new product function ends here----------------------

    // get all products from db-------------------------------------
    public function getAllProducts(){
        $query = "SELECT * FROM product_master";

        $result = $this->db->query($query);
        // handle db error
        if (!$result)
        {
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
    public function getProductDetails($prod_id){
        $query = "SELECT * FROM product_master WHERE prod_id='$prod_id'";

        $result = $this->db->query($query);
        // handle db error
        if (!$result)
        {
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
    // get particular product details from db-------------------------------------

    // delete particular product from db-------------------------------------
    public function delProduct($prod_id){
        $query = "DELETE FROM product_master WHERE prod_id='$prod_id'";

        $this->db->query($query);
        // handle db error
        if ($this->db->affected_rows() > 0 ) {
                return true;
            }else{
                return false;
            }       
    }
    //  delete particular product from db-------------------------------------

}