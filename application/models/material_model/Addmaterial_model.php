<?php
error_reporting(E_ERROR | E_PARSE);
class Addmaterial_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }

    
    // ----------------------get material categories-------------------------------------//
    public function getAllMaterialCategories() {
    	$sql = "SELECT * FROM material_category";
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
        // ----------------------get material categories-------------------------------------//

}