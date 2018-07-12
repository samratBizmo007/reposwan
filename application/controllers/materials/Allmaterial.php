<?php

class Allmaterial extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name=$this->session->userdata('admin_name');
        
        if($admin_name==''){ redirect('login'); }
        else {
            $sessionArr=explode('|', $admin_name);
        //check session variable set or not, otherwise logout
            if(($sessionArr[0]!='SWANROCKSPlates')){
                redirect('login');
            }
        }
    }

    public function index() {
        $data['details'] = Allmaterial::getAllMaterialDetails();     //-------show all materials
        $this->load->view('includes/header');
        $this->load->view('pages/material/all_material', $data);
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
        return $response;
    }

//------------ get all material details ends----------------------------------//
//=-----------fun for update material details----------------------------//
    public function updateMaterialDetails() {
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

//=-----------fun for update material details ends----------------------------//    
//--------------fun for delete material------------------------------//
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

//--------------fun for delete material ends------------------------------//
}
