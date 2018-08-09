<?php

class Dash_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//------add plant -----------------------------------------//
    public function addPlant($plant_location) {
        $sql = "INSERT INTO plant_master(plant_name) VALUES (UPPER('$plant_location'))";

        if ($this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

//-------------------add plant fun ends here------------------------//
    //-----------function for add skill in db-----------//

    public function addskill($skillname) {
        $sql = "INSERT INTO skill_master(skill_name) VALUES (UPPER('$skillname'))";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'Skill  Added Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... Skill Not Added Successfully.!!!'
            );
        }
        return $response;
    }

    public function showPlants() {
        $sql = "SELECT * FROM plant_master";
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

    public function delPlant($plant_id) {
        $sql = "DELETE FROM plant_master WHERE plant_id='$plant_id' ";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'Skill Delete Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... Skill is Not Deleted Successfully.!!!'
            );
        }
        return $response;
    }

//----------function for show skill-------//
    public function showskill() {
        $sql = "SELECT * FROM skill_master";
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

    //--------function for delete skill from db

    public function delskill($skillid) {
        //echo $skillid;die();
        $sql = "DELETE FROM skill_master WHERE skill_id='$skillid' ";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'Skill Delete Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... Skill is Not Deleted Successfully.!!!'
            );
        }
        return $response;
    }

    //-----------function for add category in db-----------//

    public function addcategory($material_type) {
        $sql = "INSERT INTO material_category(material_type) VALUES (UPPER('$material_type'))";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'material Added Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... material Not Added Successfully.!!!'
            );
        }
        return $response;
    }

    //----------function for show category-material type-------//
    public function showcategory() {
        $sql = "SELECT * FROM material_category";
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

    //--------function for delete category from db

    public function delcategory($mat_cat_id) {
        //echo $skillid;die();
        $sql = "DELETE FROM material_category WHERE mat_cat_id='$mat_cat_id' ";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'category Deleted Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... category is Not Deleted Successfully.!!!'
            );
        }
        return $response;
    }

}
