
<?php

class SharedPO_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSharedPO($from_date, $to_date) {
        $frm_date = date_create($from_date);
        $t_date = date_create($to_date);
        $fdate = date_format($frm_date, "Y/m/d");
        $tdate = date_format($t_date, "Y/m/d");
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.remark_type='1' AND p.po_duedate between '$fdate' and '$tdate' ";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getPurchaseOrdersDetails() {
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.remark_type = '1'";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getSharedPoDetails($from_date, $to_date) {
        $frm_date = date_create($from_date);
        $t_date = date_create($to_date);
        $fdate = date_format($frm_date, "Y/m/d");
        $tdate = date_format($t_date, "Y/m/d");
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.remark_type='1' AND p.po_duedate between '$fdate' and '$tdate'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function updateSharedQuantity($sharedQuantity, $po_id) {
        $updateSql = "UPDATE purchase_orders SET shared_product_quantity = '$sharedQuantity',"
                . "modified_date= NOW(),modified_time= NOW() WHERE po_id = '$po_id'";
        $this->db->query($updateSql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
