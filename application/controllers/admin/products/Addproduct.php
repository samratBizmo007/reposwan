<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addproduct extends CI_Controller {

	// Addproduct controller
	public function __construct(){
		parent::__construct();
		// load common model
		$this->load->model('product_model/product_model');
	}

	// main index function
	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('pages/admin/products/addproduct');
		$this->load->view('includes/footer');
	}

	// get all skills fucntion
	public function getAllSkills(){
		// call to model function to get all skills from db
		$result = $this->product_model->getSkills();

		echo json_encode($result);
	}
}