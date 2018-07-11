<?php
class Dash_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }

    //-----------function for add skill in db-----------//

    public function addskill($skillname)
    {
    	 $sql = "INSERT INTO skill_master(skill_name) VALUES ('$skillname')";
  
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

    public function showskill()
    {
    	  $sql =  "SELECT * FROM skill_master";
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

    public function delskill($skillid)
    {
    	$sql="DELETE FROM skill_master WHERE skill_id='$skillid' ";

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

   }