<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//error_reporting('E_ALL');
class Viewproduct extends CI_Controller {

    // Viewproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $this->load->model('product_model/product_model');
        $this->load->model('material_model/Material_model');
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
        // get last uri segment passed		
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $prod_id = base64_decode($record_num);
        // call to model function to get all products from db
        $data['prodDetails'] = $this->product_model->getProductDetails($prod_id);
        $data['skill_data'] = $this->product_model->getSkills();
        $data['machine_data'] = $this->product_model->getMachines();
        $data['materialType'] = $this->Material_model->getAllMaterialCategories();

        $this->load->view('includes/header');
        $this->load->view('pages/admin/products/viewproducts', $data);
        $this->load->view('includes/footer');
    }

}
