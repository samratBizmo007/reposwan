<?php

class Allpo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ----------------------get all PO-------------------------------------//
    public function getAllPODetails() {
        $sql = "SELECT * FROM purchase_orders";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // ----------------------get all PO ends -------------------------------------//
    // ----------------------fun for delete po-------------------------------------//

    public function deletePODetails($po_id) {
        $sql = "DELETE FROM purchase_orders WHERE po_id = '$po_id'";
        //echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // ----------------------ends delete po-------------------------------------//
//---------------------fun for get all po by date-----------------------------------//
    public function getAllPoByDate($from_date, $to_date) {
        $frm_date = date_create($from_date);
        $t_date = date_create($to_date);
        $fdate = date_format($frm_date, "Y/m/d");
        $tdate = date_format($t_date, "Y/m/d");
        $sql = "SELECT * FROM purchase_orders WHERE po_duedate between '$fdate' and '$tdate'";
        $result = $this->db->query($sql);
        //echo $sql;
        //die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

//---------------------fun for get all po by date ends-----------------------------------//
//-------------fun for get the po by po number-------------------------------------------//
    public function getPoByPo_number($po_number) {
        if ($po_number == 'undefined') {
            $sql = "SELECT * FROM purchase_orders";
        } else {
            $sql = "SELECT * FROM purchase_orders WHERE order_no like '%$po_number%'";
        }
        $result = $this->db->query($sql);
        //echo $sql;
        //die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

//---------------------------------fun ends here.----------------------------------------//    
}
