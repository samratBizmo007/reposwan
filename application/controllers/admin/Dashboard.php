<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	// Dashboard controller
	public function __construct(){
		parent::__construct();

		//start session		
		$admin_name=$this->session->userdata('admin_name');
		
		$sessionArr=explode('|', $admin_name);
		//check session variable set or not, otherwise logout
		if(($sessionArr[0]!='SWANROCKSPlates')){
			redirect('login');
		}
	}

	// main index function
	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('pages/admin/dash');
		$this->load->view('includes/footer');
	}
}
