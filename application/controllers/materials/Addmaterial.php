<?php

error_reporting(E_ERROR | E_PARSE);

class Addmaterial extends CI_controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('includes/header');
        $this->load->view('pages/material/add_material');
        $this->load->view('includes/footer');
    }

    //------------fun for get the all material categories -----------------------//
    public function getAllMaterialCategories() {
//echo "string"; die();
        $path = base_url();
        $url = $path . 'api/Addmaterial_api/getAllMaterialCategories';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("user_id: " . $user_id));
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        print_r($response_json);
    }

    //------------fun for get the all material categories -----------------------//
    // public function addMaterialInfo(){
    // }
}
