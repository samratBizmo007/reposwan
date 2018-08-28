<?php

class Production_planning_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSharedPoDetails() {
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.shared = '1'";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getAllSharedPoDetailsBydate($from_date, $to_date) {
        $frm_date = date_create($from_date);
        $t_date = date_create($to_date);
        $fdate = date_format($frm_date, "Y/m/d");
        $tdate = date_format($t_date, "Y/m/d");
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.shared = '1' AND p.po_duedate between '$fdate' and '$tdate'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getAllEmployees() {
        $sql = "SELECT * FROM employee_master";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function updatePoDetails($data) {
        extract($data);

        $updateSql = "UPDATE purchase_orders SET po_machinedetails = '$po_machine_detail',start_datetime = '$start',"
                . "modified_date= NOW(),modified_time= NOW(),in_progress='1' WHERE po_id = '$po_id'";

        $this->db->query($updateSql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateMachine($machines) {
        foreach (json_decode($machines, TRUE) as $key) {
            $update = "UPDATE machine_master SET availability = '1' WHERE machine_id='$key'";
            $this->db->query($update);
        }
    }

    
}
