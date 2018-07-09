<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Addmaterial_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('material_model/Addmaterial_model');
    }

    //--------fun for get all categories from category tab-----------------------//
    public function getAllMaterialCategories_get() {
        extract($_GET);
        $result = $this->Addmaterial_model->getAllMaterialCategories();
        return $this->response($result);
    }

    //----------fun for change password------------------------//
    public function addMaterialInfo_post() {
        $data = ($_POST);
        extract($data);
        $result = $this->Addmaterial_model->addMaterialInfo($data);
        return $this->response($result);
    }

    //--------------fun ends here-----------------------------//
}
