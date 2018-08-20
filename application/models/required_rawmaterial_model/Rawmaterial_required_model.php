<?php

class Rawmaterial_required_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getPurchaseOrdersDetails() {
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id)";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getAllPurchaseOrdersByDate($from_date, $to_date) {
        $frm_date = date_create($from_date);
        $t_date = date_create($to_date);
        $fdate = date_format($frm_date, "Y/m/d");
        $tdate = date_format($t_date, "Y/m/d");
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.po_duedate between '$fdate' and '$tdate'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getPoProductDetails($p_code, $p_id) {
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m JOIN product_tab as t on(p.prod_id = m.prod_id) AND (t.part_code = p.product_code) WHERE p.po_id = '$p_id' AND p.product_code='$p_code'";
        //echo $sql; die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getMaterialTotalWeight($grade) {
        $sql = "SELECT * FROM material_tab WHERE material_grade= '$grade'";
        $result = $this->db->query($sql);
        $total = 0;
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            foreach ($result->result_array() as $row) {
                $materialWeight = $row['material_weight'];
                $total = $materialWeight + $total;
            }
            return $total;
        }
    }

    public function updateGradeDetails($grade, $Remainingweight) {
        $updateSql = "UPDATE material_tab SET remaining_weight = '$Remainingweight',"
                . "modified_date= NOW(),modified_time= NOW() WHERE material_grade = '$grade'";
        $this->db->query($updateSql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function submitStatus($po_id, $remark, $remarkType){
        if($remarkType == 'Positive'){
            $status = 1;
        }else{
            $status = 0;
        }
        $updateSql = "UPDATE purchase_orders SET remark = '$remark',remark_type = '$status',"
                . "modified_date= NOW(),modified_time= NOW() WHERE po_id = '$po_id'";
        $this->db->query($updateSql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
}
