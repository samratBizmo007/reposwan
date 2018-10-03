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
//        if (!isset($sheet_quantity)) {
//            $sheet_quantity = 0;
//        }
        if (!isset($diameter)) {
            $diameter = 0;
        }
//        if (!isset($circle_quantity)) {
//            $circle_quantity = 0;
//        }

        $sqlSelect = "SELECT * FROM material_tab WHERE material_grade ='$material_grade' AND mat_cat_id = '$mat_cat_id'";
        $result = $this->db->query($sqlSelect);
        // print_r(count($result));die();
        if ($result->num_rows() != 0) {
            $response = array(
                'status' => 500, //---------db error code 
                'status_message' => 'Something Went Wrong... Material Not Added Successfully.!!!'
            );
            return $response;
        } else {
            $sql = "INSERT INTO material_tab(mat_cat_id,material_grade,material_rate,material_weight,id,od,length,pitching,quantity,diagram_no,thickness,"
                    . "diameter,remark,added_date,added_time,status)"
                    . "VALUES ('$mat_cat_id','$material_grade','$material_rate','$material_weight',"
                    . "'$id','$od','$length','$pitching','$quantity','$Diagram_no','$thickness',"
                    . "'$diameter','$remark',now(),now(),'1')";

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
    }

    // ----------------------Fun For Add Material Details End-------------------------------------//
    //     // ----------------------Fun For update Material Details-------------------------------------//

    public function updateMaterialDetails($data) {
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
        if (!isset($diameter)) {
            $diameter = 0;
        }
        $sql = "UPDATE material_tab SET material_rate = '$material_rate',material_weight='$material_weight',"
                . "id='$id',od='$od',length='$length',pitching='$pitching',quantity='$quantity',"
                . "diagram_no='$Diagram_no',thickness='$thickness',"
                . "diameter='$diameter',remark='$remark',"
                . "modified_date=NOW(),modified_time=NOW(),status='1' WHERE material_id = '$material_id'";
        //echo $sql;die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 200,
                'status_message' => 'Material Details Updated Successfully..');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Material Details Not Updated Successfully..');
        }
        return $response;
    }

    // ----------------------Fun For update Material Details End-------------------------------------//
    //---------------------------------fun for get material details-------------------------------//
    public function getAllMaterialDetails() {
        $sql = "SELECT * FROM material_tab as m join material_category as c on(c.mat_cat_id = m.mat_cat_id)";
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
    public function deleteMaterialDetails($material_id) {
        $sql = "DELETE FROM material_tab WHERE material_id = '$material_id'";
        //echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 200,
                'status_message' => 'Material Deleted Successfully..');
        } else {
            $response = array(
                'status' => 200,
                'status_message' => 'Material Not Deleted Successfully..');
        }
        return $response;
    }

    public function getMaterialdetails($mat_cat_id) {
        $sql = '';
        if ($mat_cat_id == 0) {
            $sql = 'SELECT * FROM material_tab as m join material_category as c on(c.mat_cat_id = m.mat_cat_id)';
        } else {
            $sql = "SELECT * FROM material_tab as m join material_category as c "
                    . "on(c.mat_cat_id = m.mat_cat_id) "
                    . "WHERE c.mat_cat_id = '$mat_cat_id'";
        }
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

    public function getMaterialDetailsByCategory($material_category) {
        $query = "SELECT * FROM material_tab WHERE mat_cat_id='$material_category' GROUP BY(material_grade)";
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

    public function getMaterialDetailsByGrade($mat_grade) {
        $query = "SELECT * FROM material_tab WHERE material_grade='$mat_grade'";
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

    public function getMaterialInfoByName($material_grade) {
        $query = "SELECT * FROM material_tab as m join material_category as c on(c.mat_cat_id = m.mat_cat_id) WHERE m.material_grade like '%$material_grade%'";
        //echo $query;
        //die();
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

}
