<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	// Dashboard controller
	public function __construct(){
		parent::__construct();
	}

	// main index function
	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('pages/admin/dash');
		$this->load->view('includes/footer');
	}
}
