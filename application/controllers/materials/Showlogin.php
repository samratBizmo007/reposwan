<?php

error_reporting(E_ERROR | E_PARSE);

class Showlogin extends CI_controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function index() {

//        if (isset($_COOKIE['jumla_uname']) && isset($_COOKIE['jumla_uname']) != '') {
//            Login::loginCustomer();
//        }

        //start session     
//        $user_id = $this->session->userdata('user_id');
//        $user_name = $this->session->userdata('user_name');
//        $user_role = $this->session->userdata('user_role');
//        $cat_id = $this->session->userdata('cat_id');
//        if (($user_id != '') || ($user_name != '') || ($user_role != '') || ($cat_id != '')) {
//            redirect('user/feeds');
//        }

        // get all categories from db
//        $data['categories'] = Registration::getAllCategories();
//        $data['authURL'] = $this->facebook->login_url();
        $this->load->view('includes/header');
        $this->load->view('pages/material/index');
        $this->load->view('includes/footer');

    }

 
// --------------register user fucntion starts----------------------//
    public function registerCustomer() {
        extract($_POST);
        print_r($_POST);die();
        if($user_role==0){
             echo '<div class="alert alert-danger" style="margin-bottom:5px">
            <strong>Please select appropriate role!</strong> 
            </div>';
            die();
        }
        if ($user_role == 2 && $cat_id == 0) {
            echo '<div class="alert alert-danger" style="margin-bottom:5px">
            <strong>Please select appropriate Business Type!</strong> 
            </div>';
            die();
        }
        //die();
        if ($user_role == 1) {
            if ($register_password == '') {
                echo '<div class="alert alert-danger" style="margin-bottom:5px">
                <strong>Please enter your password</strong> 
                </div>';
                die();
            }
            //Connection establishment, processing of data and response from REST API   
            //$username = $register_username;
            //$password = $register_password;   
            $data = array(
                'user_role' => $user_role,
                'register_username' => $register_username,
                'register_password' => $register_password,
                'register_email' => $register_email,
                'register_countryCode' => $mobile_code,
                'register_mobile_no' => $register_number,
            );
            //print_r($data);die();
            //create a new cURL resource 
            //--------api for register customer--using api key-------------------------//
            $path = base_url();
            $url = $path . 'api/Login_api/registerCustomer';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response_json, true);
            //print_r($response_json);die();
            //------------api ends here-----------------------------------------------//
        } else {
            // extract($_POST);
            // print_r($_POST);die();
            //Connection establishment, processing of data and response from REST API       
            $data = array(
                'cat_id' => $cat_id,
                'user_role' => $user_role,
                'register_username' => $register_username,
                // 'register_password' => $register_password,
                'register_email' => $register_email,
                'register_countryCode' => $mobile_code,
                'register_mobile_no' => $register_number,
                    // 'register_address' => $address
            );
            //print_r($data);die();
            //------------api for register seller -------------------------------------//
            $path = base_url();
            $url = $path . 'api/Login_api/registerSeller';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response_json, true);
//-------------------------api ends here---------------------------------------------//
        }
         //print_r($response_json);die();
        // echo $this->curl->error_code;
        // die();

        if ($response['status'] == 500) {
            echo '<div class="alert alert-danger ">
            <strong>' . $response['status_message'] . '</strong> 
            </div>          
            ';
        } else {

            echo '<div class="alert alert-success" style="margin-bottom:5px">
            <strong>' . $response['status_message'] . '</strong> 
            </div>';
        }
        //echo $response_json;
    }
}