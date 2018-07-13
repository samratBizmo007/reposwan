<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allproduct extends CI_Controller {

	// Allproducts controller
	public function __construct(){
		parent::__construct();
		// load common model
		$this->load->model('product_model/product_model');

		//start session		
		$admin_name=$this->session->userdata('admin_name');
		
		if($admin_name==''){ redirect('login'); }
        else {
            $sessionArr=explode('|', $admin_name);
        //check session variable set or not, otherwise logout
            if(($sessionArr[0]!='SWANROCKSPlates')){
                redirect('login');
            }
        }
	}

	// main index function
	public function index()
	{	
		// call to model function to get all products from db
		$data['allProducts'] = $this->product_model->getAllProducts();
//print_r($data);die();
		$this->load->view('includes/header');
		$this->load->view('pages/admin/products/allproducts',$data);
		$this->load->view('includes/footer');
	}

	// get all products fucntion
	public function getAllProducts(){
		// call to model function to get all products from db
		$result = $this->product_model->getAllProducts();
		echo json_encode($result);
	}

	// delete products fucntion
	public function delProduct(){
		extract($_GET);
		// call to model function to get all products from db
		$result = $this->product_model->delProduct($prod_id);

		if($result){
			echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Product deleted successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
		}
		else{
			echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Product deletion failed.
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
	
}
