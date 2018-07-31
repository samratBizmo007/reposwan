<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Addproduct extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $this->load->model('product_model/product_model');

        //start session		
        $admin_name = $this->session->userdata('admin_name');

        if ($admin_name == '') {
            redirect('login');
        } else {
            $sessionArr = explode('|', $admin_name);
            //check session variable set or not, otherwise logout
            if (($sessionArr[0] != 'SWANROCKSPlates')) {
                redirect('login');
            }
        }
    }

    // main index function
    public function index() {
        // get material categories from db
        $this->load->model('material_model/material_model');
        $data['materialType'] = $this->material_model->getAllMaterialCategories();

        $this->load->view('includes/header');
        $this->load->view('pages/admin/products/addproduct', $data);
        $this->load->view('includes/footer');
    }

    // get all skills fucntion
    public function getAllSkills() {
        // call to model function to get all skills from db
        $result = $this->product_model->getSkills();
        echo json_encode($result);
    }

    // add new product function
    public function addNewProduct() {
        //print_r($_POST);die();
        extract($_POST);
        //echo $prod_type;
        if ($prod_type == '? undefined:undefined ?') {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please select Product type in General Details.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
            die();
        }
        if ($prod_type == '1' && $stock_plant == '0') {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please select Ex-Stock Plant in General Details.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
            die();
        }
        if ($skillAdded_field == '' || $skillAdded_field == '[]') {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please add at least one Operation in Machinery Details.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
            die();
        }
        if ($addedRM_field == '' || $addedRM_field == '[]') {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please add at least one Raw Material in Raw Material Details.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
            die();
        }
        $SerialItemArr = array();
        $MachineQtyArr = array();

        // json for serial no and respective item code
        for ($i = 0; $i < count($sr_no); $i++) {
            $SerialItemArr[] = array(
                'sr_no' => $sr_no[$i],
                'item_code' => $item_code[$i]
            );
        }

        // json for machine and quantity per hr
        for ($i = 0; $i < count($machine); $i++) {
            $MachineQtyArr[] = array(
                'operations' => $operations[$i],
                'machine' => $machine[$i],
                'qtyhr' => $qtyhr[$i]
            );
        }
        //echo json_encode($MachineQtyArr);die();
        $prodData = array(
            'customer_name' => $customer_name,
            'prod_type' => $prod_type,
            'stock_plant' => $stock_plant,
            'exstock_quantity' => $exstock_quantity,
            'product_name' => $product_name,
            'drawing_no' => $drawing_no,
            'revision_no' => $revision_no,
            'sr_item_code' => json_encode($SerialItemArr),
            //'operations' => $skillAdded_field,
            'machine_qtyhr' => json_encode($MachineQtyArr),
            'rm_required' => $addedRM_field,
            'packingquantity_per_tray' => $packingquantity_per_tray,
            'net_finished_weight' => $net_finished_weight,
            'old_rate' => $old_rate,
            'new_rate' => $new_rate
        );
        // call to model function to save new product in db
        $result = $this->product_model->addNewProduct($prodData);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> New Product successfully added.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>';
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> New Product addition failed.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
        }
        //echo ($result);
    }

}
