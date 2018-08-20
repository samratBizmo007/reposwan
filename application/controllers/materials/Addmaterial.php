<?php

class Addmaterial extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('material_model/Material_model');

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

    public function index() {
        $this->load->view('includes/header');
        $this->load->view('pages/material/add_material');
        $this->load->view('includes/footer');
    }

    //------------fun for get the all material categories -----------------------//
    public function getAllMaterialCategories() {
//echo "string"; die();
        $path = base_url();
        $url = $path . 'api/Material_api/getAllMaterialCategories';
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
//        print_r($_POST);
//        die();
        $data = $_POST;
        extract($data);
        if ($mat_cat_id == 0) {
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i>Please Select material type first.</h4>';
            die();
        }
        $path = base_url();
        $url = $path . 'api/Material_api/addMaterialInfo';
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
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong>'.$response['status_message'].'.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>';
        } else {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong>'.$response['status_message'].'.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 1000);
			</script>';
        }
    }

    public function getMaterialDetailsByCategory() {
        extract($_GET);
        $result = $this->Material_model->getMaterialDetailsByCategory($material_category);
        //echo $result;
        for ($i = 0; $i < count($result); $i++) {
            //print_r($result[$i]['material_grade']);
            echo '<option value="' . $result[$i]['material_grade'] . '">' . $result[$i]['material_grade'] . '</option>';
        }
    }

    public function getMaterialDetailsByGrade() {
        extract($_GET);
        $result = $this->Material_model->getMaterialDetailsByGrade($mat_grade);
        print_r($result);
    }

}
