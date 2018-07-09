<?php

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
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        print_r($response_json);
    }

    //------------fun for get the all material categories -----------------------//
    public function addMaterialInfo() {
        print_r($_POST);
        die();
        $data = $_POST;
        $path = base_url();
        $url = $path . 'api/Addmaterial_api/addMaterialInfo';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //echo $material_rate; die();
        //print_r($response_json);die();
        if ($response['status'] != 200) {
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> ' . $response['status_message'] . '</h4>
            ';
        } else {
            echo '<h4 class="w3-text-green w3-margin"><i class="fa fa-image"></i> ' . $response['status_message'] . '</h4>
            <script>
            window.setTimeout(function() {
               location.reload();
               }, 1000);
               </script>';
        }
    }

}
