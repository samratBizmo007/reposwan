<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Setting_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('setting_model/Setting_model');
    }

    // -----------------------UPDATE EMAIL API----------------------//
	//-------------------------------------------------------------//
	public function updateEmail_post(){
		extract($_POST);
		$result = $this->Setting_model->updateEmail($admin_email);
		return $this->response($result);			
	}
	
	public function getAdminDetails_get(){
		// extract($_GET);
		$result = $this->Setting_model->getAdminDetails();
		return $this->response($result);			
	}
  }