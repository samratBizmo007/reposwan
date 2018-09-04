<?php

class Finished_products extends CI_controller {

    public function __construct() {
        parent::__construct();
//start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('production_model/Production_planning_model');
        $this->load->model('production_model/Production_model');
        $this->load->model('sharedpo_model/SharedPO_model');
        $this->load->model('material_model/Material_model');
        $this->load->model('product_model/product_model');
        $this->load->model('finished_products/Finished_products_model');
        $this->load->model('required_rawmaterial_model/Rawmaterial_required_model');

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

    public function index() {
//$data['sharedPo'] = $this->Material_model->getAllMaterialCategories();
        $this->load->view('includes/header');
        $this->load->view('pages/finished_products/finished_products');
        $this->load->view('includes/footer');
    }

    public function updateFinishedProductDetails() {
        //extract($_POST);
        $data = $_POST;
        $result = $this->Finished_products_model->updateFinishedProductDetails($data);
        // print_r($result);
        // die();
        if ($result == 800) {
            echo'<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Total Dispatched Quantity is greater than po quantity.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			//location.reload();
			}, 1000);
			</script>';
        } elseif ($result == 700) {
            echo'<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Dispatched Quantity is greater than po quantity.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			//location.reload();
			}, 1000);
			</script>';
        } elseif ($result == 700) {
            echo'<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Total Dispatched Quantity is greater than Stock quantity.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			//location.reload();
			}, 1000);
			</script>';
        } elseif ($result == 900) {
            echo'<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Stock Quantity is less than po dispatched quantity.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			//location.reload();
			}, 1000);
			</script>';
        } elseif ($result == 200) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> PO Updated successfully added.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			//location.reload();
			}, 1000);
			</script>';
        } elseif ($result == 500) {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> PO Updation Failed .
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
        }
    }

    public function getSharedInprocessPoDetails() {
        extract($_GET);
        $result = $this->Finished_products_model->getSharedInprocessPoDetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getPos() {
        extract($_GET);
        $result = $this->Finished_products_model->getPos($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function show_FinishedPoDetails() {
        extract($_GET);
        //print_r($_GET);die();
        $result = $this->Finished_products_model->getPoProductDetails($product_code, $po_id);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

}
