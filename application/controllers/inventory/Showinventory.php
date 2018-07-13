<?php

class Showinventory extends CI_controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['products'] = Showinventory::getAllProductDetails();     //-------show all materials
        $this->load->view('includes/header');
        $this->load->view('pages/inventory/show_inventory',$data);
        $this->load->view('includes/footer');
    }

//------------ get all material details ----------------------------------//
    public function getAllMaterialDetails() {
        $path = base_url();
        $url = $path . 'api/Material_api/getAllMaterialDetails';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);
    }

//------------ get all material details ends----------------------------------//
    //------------ get all material details ----------------------------------//
    public function getAllProductDetails() {
        $path = base_url();
        $url = $path . 'api/Material_api/getAllProductDetails';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//------------ get all material details ends----------------------------------//
}
