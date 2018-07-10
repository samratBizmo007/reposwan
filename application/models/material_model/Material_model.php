<?php

class Material_model extends CI_Model {

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
    // ----------------------Fun For Add Material Details-------------------------------------//
    public function addMaterialInfo($data) {
        extract($data);
        if ($mat_cat_id == '' && $mat_cat_id == NULL) {
            $mat_cat_id = 0;
        }
        if ($material_rate == '' && $material_rate == NULL) {
            $material_rate = 0;
        }
        if ($material_weight == '' && $material_weight == NULL) {
            $material_weight = 0;
        }
        if (!isset($id)) {
            $id = 0;
        }
        if (!isset($od)) {
            $od = 0;
        }
        if (!isset($length)) {
            $length = 0;
        }
        if (!isset($pitching)) {
            $pitching = 0;
        }
        if (!isset($quantity)) {
            $quantity = 0;
        }
        if (!isset($Diagram_no)) {
            $Diagram_no = 0;
        }
        if (!isset($thickness)) {
            $thickness = 0;
        }
        if (!isset($sheet_quantity)) {
            $sheet_quantity = 0;
        }
        if (!isset($diameter)) {
            $diameter = 0;
        }
        if (!isset($circle_quantity)) {
            $circle_quantity = 0;
        }
        $sql = "INSERT INTO material_tab(mat_cat_id,material_grade,material_rate,material_weight,id,od,length,pitching,quantity,diagram_no,thickness,sheet_quantity,"
                . "diameter,circle_quantity,remark,added_date,added_time,modified_date,modified_time,status)"
                . "VALUES ('$mat_cat_id','$material_grade','$material_rate','$material_weight',"
                . "'$id','$od','$length','$pitching','$quantity','$Diagram_no','$thickness','$sheet_quantity',"
                . "'$diameter','$circle_quantity','$remark',now(),now(),now(),now(),'1')";
//        echo $sql;die();
        //$this->db->query($sql)
        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'Material Added Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... Material Not Added Successfully.!!!'
            );
        }
        return $response;
    }

    // ----------------------Fun For Add Material Details End-------------------------------------//
    //---------------------------------fun for get material details-------------------------------//
    public function getAllMaterialDetails() {
         $sql = "SELECT * FROM material_tab";
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

    //---------------------------------fun for get material details-------------------------------//
}
