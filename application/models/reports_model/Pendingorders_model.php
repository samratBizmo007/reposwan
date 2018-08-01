<?php

class Pendingorders_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getPODetails() {
        $sql = "SELECT * FROM purchase_orders";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getPoByDate($from_date, $to_date) {
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

    public function updatePoDetails($balance,$remark,$po_id) {
        //extract($request);
        $sql = "UPDATE purchase_orders SET balanced='$balance',"
                . "remark='$remark',"
                . "modified_date= NOW(),modified_time= NOW(),status='1' WHERE po_id = '$po_id'";
        //echo $sql;die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
