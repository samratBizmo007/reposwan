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

    public function addMaterialInfo($data) {
        extract($data);

        $InsertData = array(
            'mat_cat_id' => $mat_cat_id,
            'material_grade' => $material_grade,
            'material_rate' => $material_rate,
            'material_weight' => $material_weight,
            'od' => $od,
            'id' => $id,
            'length' => $length,
            'pitching' => $pitching,
            'quantity' => $quantity,
            'Diagram_no' => $Diagram_no,
            'thickness' => $thickness,
            'sheet_quantity' => $sheet_quantity,
            'diameter' => $diameter,
            'circle_quantity' => $circle_quantity,
        );
        if ($this->db->insert('material_tab', $data)) {
            $response = array(
                'status' => 200, //---------insert db success code
                'status_message' => 'Material Added Successfully..'
            );
        } else {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something went wrong... Material Not Added Successfully.!!!'
            );
        }
    }

}
