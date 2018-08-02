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

}
