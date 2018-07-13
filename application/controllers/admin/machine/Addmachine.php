<?php

class Addmachine extends CI_controller {

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
        $data['details'] = Addmachine::getAllMachineDetails();     //-------show all machine

        $this->load->view('includes/header');
        $this->load->view('pages/admin/machine/addmachine',$data);
        $this->load->view('includes/footer');
    }


    public function addMachine_data()
    {
        //        print_r($_POST);
//        die();
        $data = $_POST;
        extract($data);
       
        $path = base_url();
        $url = $path . 'api/Machine_api/addMachineInfo';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //echo $material_rate; die();
        // print_r($response_json);die();
        if ($response['status'] != 200) {
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> ' . $response['status_message'] . '</h4>
            ';
        } else {
            echo '<h4 class="w3-text-black w3-margin"><i class="fa fa-sliders"></i> ' . $response['status_message'] . '</h4>
            <script>
            window.setTimeout(function() {
               location.reload();
               }, 1000);
               </script>';
        }
        
    }

            //------------ get all machine details ----------------------------------//


    public function getAllMachineDetails()
    {
        $path = base_url();
        $url = $path . 'api/Machine_api/getAllMachineDetails';
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

    //=-----------fun for update machine details----------------------------//
    public function updateMachineDetails() {
        extract($_POST);
        $data = $_POST;
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Machine_api/updateMachineDetails';
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

    //--------------fun for delete machine------------------------------//
    public function deleteMachineDetails() {
        extract($_POST);
//        echo $material_id;
//        die();
        $path = base_url();
        $url = $path . 'api/Machine_api/deleteMachineDetails?machine_id=' . $machine_id;
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
}


