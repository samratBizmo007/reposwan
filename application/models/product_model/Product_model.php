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

}