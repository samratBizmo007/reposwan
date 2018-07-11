<?php

class Allmaterial extends CI_controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['details'] = Allmaterial::getAllMaterialDetails();     //-------show all materials
        $this->load->view('includes/header');
        $this->load->view('pages/material/all_material', $data);
        $this->load->view('includes/footer');
    }

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
        return $response;
    }

    public function updateMaterialDetails() {
        // get data passed through ANGULAR AJAX
        extract($_POST);
        $data = $_POST;
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Material_api/updateMaterialDetails';
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
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> ' . $response['status_message'] . '</h4>';
        } else {
            echo '<h4 class="w3-text-black w3-margin"><i class="fa fa-cube"></i> ' . $response['status_message'] . '</h4>
            <script>
            window.setTimeout(function() {
               location.reload();
               }, 1000);
               </script>';
        }
    }

    public function deleteMaterialDetails() {
        extract($_POST);
//        echo $material_id;
//        die();
        $path = base_url();
        $url = $path . 'api/Material_api/deleteMaterialDetails?material_id=' . $material_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);
                //print_r($response_json);die();

        if ($response['status'] != 200) {
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> ' . $response['status_message'] . '</h4>';
        } else {
            echo '<h4 class="w3-text-black w3-margin"><i class="fa fa-cube"></i> ' . $response['status_message'] . '</h4>
            <script>
            window.setTimeout(function() {
               location.reload();
               }, 1000);
               </script>';
        }
    }

}
