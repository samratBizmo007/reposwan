<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	// Login controller
	public function __construct(){
		parent::__construct();

		// load common model
		$this->load->model('login_model');

		//start session		
		$admin_name=$this->session->userdata('admin_name');
		$sessionArr=explode('|', $admin_name);
		//check session variable set or not, otherwise logout
		if(($sessionArr[0]=='SWANROCKSPlates')){
			redirect('admin/dashboard');
		}
	}

	// main index function
	public function index()
	{
		//$this->load->view('includes/header');
		$this->load->view('pages/login');
		//$this->load->view('includes/footer');
	}

	// check login authentication
	public function checkLogin(){
		// get data passed through ANGULAR AJAX
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata,TRUE);
		//print_r($request['username']);

		// call to model function to authenticate user
		$result = $this->login_model->authenticate($request['username'],$request['password']);

		// print valid message
		if(!$result){
			// failure scope
			echo '<p class="w3-red w3-padding-small">Sorry, your credentials are incorrect!</p>';
		}
		else{
			// success scope
			//----create session array--------//
			$session_data = array(
				'admin_name' => "SWANROCKSPlates|".$request['username']
			);

            //start session of user if login success
			$this->session->set_userdata($session_data);
      //redirect('admin/dashboard');
			echo '200';
			//echo '<p class="w3-green w3-padding-small">Login successfull! Welcome Admin.</p>';
		}
		//print_r($result);
	}
}
