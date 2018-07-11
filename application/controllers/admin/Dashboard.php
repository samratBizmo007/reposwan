<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	// Dashboard controller
	public function __construct(){
		parent::__construct();

			$this->load->model('dash_model');
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

	//---function for add skill
	public function AddSkills(){
		// get data passed through ANGULAR AJAX
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata,TRUE);
		// print_r($request['skillname']);
		// call to model function to add skills from db
	    $result = $this->dash_model->addSkill($request['skillname']);

	 echo json_encode($result);
	}

	//---function for show all skill
	public function showskill()
	{
		// call to model function to get all skills from db
		$result = $this->dash_model->showskill();

		echo json_encode($result);
	}

	//---function for del skill
	public function delskill()
	{
		extract($_GET);
		//print_r($_GET);die();
		// call to model function to del  skills from db
		$result = $this->dash_model->delskill($skillid);

		echo json_encode($result);
	}
}
