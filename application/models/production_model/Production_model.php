<?php

class Production_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSharedInprocessPoDetails() {
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.shared = '1' AND in_progress = '1'";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getAllSharedInprogressPoDetailsBydate($from_date, $to_date) {
        $frm_date = date_create($from_date);
        $t_date = date_create($to_date);
        $fdate = date_format($frm_date, "Y/m/d");
        $tdate = date_format($t_date, "Y/m/d");
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m on(p.prod_id = m.prod_id) WHERE p.shared = '1' AND in_progress = '1' AND p.po_duedate between '$fdate' and '$tdate'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function updateMachineData($machines) {
        foreach (json_decode($machines, TRUE) as $key) {
            $update = "UPDATE machine_master SET availability = '0' WHERE machine_id='$key'";
            $this->db->query($update);
        }
    }

    public function updatePoDetails($data) {
        extract($data);
        //print_r($data);die();
        $machinedetails = Production_model::getPoMachineDetails($po_id);
        $machine = '';
        if ($end != '') {
            $updateSql = "UPDATE purchase_orders SET po_machinedetails = '$machinedetails',produced_qty='$produced_qty',rejected_qty='$rejected_qty',"
                    . "inprocess_qty='$inprocess_qty',"
                    . "end_datetime = '$end',"
                    . "modified_date= NOW(),modified_time= NOW(),in_progress='1',shared='1' WHERE po_id = '$po_id'";

            //$machinedetails = Production_model::getPoMachineDetails($po_id);

            foreach (json_decode($machinedetails, TRUE) as $key) {
                $machine = $key['machines'];
                $update = "UPDATE machine_master SET availability = '0' WHERE machine_id='$machine'";
                $this->db->query($update);
            }
        } else if ($end == '') {
            $updateSql = "UPDATE purchase_orders SET po_machinedetails = '$machinedetails',produced_qty='$produced_qty',rejected_qty='$rejected_qty',"
                    . "inprocess_qty='$inprocess_qty',"
                    . "end_datetime = '$end',"
                    . "modified_date= NOW(),modified_time= NOW(),in_progress='1' WHERE po_id = '$po_id'";
        } elseif ($po_status == 1) {
            $updateSql = "UPDATE purchase_orders SET po_machinedetails = '$machinedetails',produced_qty='$produced_qty',rejected_qty='$rejected_qty',"
                    . "inprocess_qty='$inprocess_qty',"
                    . "end_datetime = '$end',"
                    . "modified_date= NOW(),modified_time= NOW(),in_progress='1',shared='1' WHERE po_id = '$po_id'";
        }

        $this->db->query($updateSql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getPoMachineDetails($po_id) {
        $sql = "SELECT * FROM purchase_orders WHERE po_id= '$po_id'";
        $result = $this->db->query($sql);
        $total = 0;
        $machinedetails = '';
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            foreach ($result->result_array() as $row) {
                $machinedetails = $row['po_machinedetails'];
                //$total = $materialWeight + $total;
            }
            return $machinedetails;
        }
    }

}
