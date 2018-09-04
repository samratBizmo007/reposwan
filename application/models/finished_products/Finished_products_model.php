<?php

class Finished_products_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getPoProductDetails($product_code, $po_id) {
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m JOIN product_tab as t on(p.prod_id = m.prod_id) AND (t.part_code = p.product_code) WHERE p.po_id = '$po_id' AND p.product_code='$product_code'";
        //echo $sql; die();
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getSharedInprocessPoDetails() {
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m JOIN product_tab as t on(p.prod_id = m.prod_id) AND (t.part_code = p.product_code) WHERE p.shared = '1' AND in_progress = '1'";
        $result = $this->db->query($sql);
        //echo $sql;die();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function getPos($from_date, $to_date) {
        $frm_date = date_create($from_date);
        $t_date = date_create($to_date);
        $fdate = date_format($frm_date, "Y/m/d");
        $tdate = date_format($t_date, "Y/m/d");
        $sql = "SELECT * FROM purchase_orders as p JOIN product_master as m JOIN product_tab as t on(p.prod_id = m.prod_id) AND (t.part_code = p.product_code) WHERE p.shared = '1' AND in_progress = '1' AND p.po_duedate between '$fdate' and '$tdate'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function updateFinishedProductDetails($data) {
        extract($data);
        //print_r($data);die();

        $billdetails = array();
        $billInfo = array();
        $sql = "SELECT * FROM purchase_orders WHERE po_id = '$po_id'";
        $result = $this->db->query($sql);
        $billno_dispatched_qty = '';
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            foreach ($result->result_array() as $row) {
                $billno_dispatched_qty = $row['billno_dispatched_qty'];
            }
        }
        $billArry[] = array(
            'dispatched_qty' => $dispatched_qty,
            'bill_no' => $bill_no,
            'dispatched_date' => $dispatched_date
        );
        $subStockQty = 0;


        if ($billno_dispatched_qty == '') {
            if ($dispatched_qty <= $po_quantity) {
                if ($dispatched_qty <= $stock_quantity) {

                    $billInfo[] = json_encode($billArry);
                    //print_r($dispatched_qty); die();
                    $bills = json_encode($billArry);


                    $subProductDetails = Finished_products_model::getSubProductDetail($part_drwing_no, $product_code);
                    $subProducts = json_decode($subProductDetails, TRUE);
                    extract($subProducts[0]);

                    $stock_quantity = $stock_quantity - $dispatched_qty;
                    $balanced = $po_quantity - $dispatched_qty;

                    //-------------------update the po details for produced qty and dispatched qty-------------------------- 
                    //$subProductDetails = '';
                    $update = "UPDATE purchase_orders SET produced_qty='$stock_quantity',balanced='$balanced',"
                            . "dispatched_qty='$dispatched_qty',billno_dispatched_qty='$bills',modified_date= NOW(),modified_time= NOW() WHERE po_id = '$po_id'";
                    //echo $update; die();
                    $this->db->query($update);
                    //-------------------update the po details for produced qty and dispatched qty--------------------------//

                    if ($this->db->affected_rows() > 0) {
                        return 200;
                    } else {
                        return 500;
                    }
                } else {
                    return 700;
                }
            } else {
                return 700;
            }
        } else {
//            print_r($billArry);
//            die();
            $newdispatched = 0;
            for ($i = 0; $i < count($billArry); $i++) {
                $newdispatched = $billArry[$i]['dispatched_qty'] + $newdispatched;
                //print_r($billdetails[$i]['dispatched_qty']);die();
            }

            if ($newdispatched <= $stock_quantity) {

                $billdetails = array_merge(json_decode($billno_dispatched_qty, true), $billArry);
                $billInfo[] = json_encode($billdetails);
                $bills = json_encode($billdetails);
                
                $totaldispatched = 0;
                for ($i = 0; $i < count($billdetails); $i++) {
                    $totaldispatched = $billdetails[$i]['dispatched_qty'] + $totaldispatched;
                }
//                echo 'totdis'.$totaldispatched.'<br>';
//                echo 'poqnt'.$po_quantity.'<br>';
//                echo 'disqty'.$dispatched_qty.'<br>';
//                die();
                
                if ($totaldispatched <= $po_quantity) {
//                if ($totaldispatched < $stock_quantity) {
                    $stock_quantity = $stock_quantity - $dispatched_qty;
                    $balanced = $po_quantity - $totaldispatched;

                    $update = "UPDATE purchase_orders SET produced_qty='$stock_quantity',balanced='$balanced',"
                            . "dispatched_qty='$totaldispatched',billno_dispatched_qty='$bills',modified_date= NOW(),modified_time= NOW() WHERE po_id = '$po_id'";
                    //echo $update; die();
                    $this->db->query($update);

                    if ($this->db->affected_rows() > 0) {
                        return 200;
                    } else {
                        return 500;
                    }

//                } else {
//                    return 1000;
//                }
                } else {
                    return 800;
                }
            } else {
                return 900;
            }
        }
    }

    public function getSubProductDetail($part_drwing_no, $product_code) {
        $sql = "SELECT * FROM product_tab WHERE drawing_no='$part_drwing_no' AND part_code='$product_code'";
        $result = $this->db->query($sql);
        $subStockQty = '';
        $sub_dispatched_qty = '';
        $subTotal_qty = '';
        $productDetail = '';
        $arr = array();
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            foreach ($result->result_array() as $row) {

                $subStockQty = $row['subproduct_quantity'];
                $sub_dispatched_qty = $row['sub_dispatched_qty'];
                $subTotal_qty = $row['total_qty'];

                $productDetail = array(
                    'subStockQty' => $subStockQty,
                    'sub_dispatched_qty' => $sub_dispatched_qty,
                    'subTotal_qty' => $subTotal_qty
                );

                $arr[] = $productDetail;
            }
        }
        return json_encode($arr);
    }

    public function getPODetail($po_id) {
        $sqlselect = "SELECT * FROM purchase_orders WHERE po_id = '$po_id'";
        $resultselect = $this->db->query($sqlselect);
        $poData = '';
        $po_produced_qty = '';
        $po_total_quantity = '';
        $po_dispatched_qty = '';
        $Arr = array();
        if ($resultselect->num_rows() <= 0) {
            return false;
        } else {
            foreach ($resultselect->result_array() as $row) {
                $po_produced_qty = $row['produced_qty'];
                $po_total_quantity = $row['total_quantity'];
                $po_dispatched_qty = $row['dispatched_qty'];

                $poData = array(
                    'po_produced_qty' => $po_produced_qty,
                    'po_total_quantity' => $po_total_quantity,
                    'po_dispatched_qty' => $po_dispatched_qty
                );

                $Arr[] = $poData;
            }
        }
        return json_encode($Arr);
    }

}
