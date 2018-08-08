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
        //echo $sql;
        //die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

}
