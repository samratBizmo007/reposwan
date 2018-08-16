<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    // Dashboard controller
    public function __construct() {
        parent::__construct();

        $this->load->model('dash_model');
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
        $data['adminDetails']=Settings::getAdminDetails();
         // print_r($data);
        $this->load->view('includes/header');
        $this->load->view('pages/settings/settings',$data);
        $this->load->view('includes/footer');
    }
 //---function for add skill
    public function AddSkills() {
        // get data passed through ANGULAR AJAX
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        // print_r($request['skillname']);
        // call to model function to add skills from db
        $result = $this->dash_model->addSkill($request['skillname']);

        echo json_encode($result);
    }

    //---function for show all skill
    public function showskill() {
        // call to model function to get all skills from db
        $result = $this->dash_model->showskill();

        echo json_encode($result);
    }

    //---function for del skill
    public function delskill() {
        extract($_GET);
        //print_r($_GET);die();
        // call to model function to del  skills from db
        $result = $this->dash_model->delskill($skillid);

        echo json_encode($result);
    }

    //---function for add category
    public function AddCategory() {
        // get data passed through ANGULAR AJAX
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        print_r($request['material_type']);
        // call to model function to add skills from db
        $result = $this->dash_model->addcategory($request['material_type']);

        echo json_encode($result);
    }

    //---function for show all category
    public function showcategory() {
        // call to model function to get all category from db
        $result = $this->dash_model->showcategory();

        echo json_encode($result);
    }

    //---function for del category
    public function delcategory() {
        extract($_GET);
        //print_r($_GET);die();
        // call to model function to del  category from db
        $result = $this->dash_model->delcategory($mat_cat_id);

        echo json_encode($result);
    }

    public function addPlant() {
        // get data passed through ANGULAR AJAX
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        //print_r($request['plant_location']);
        // call to model function to add skills from db
        $result = $this->dash_model->addPlant($request['plant_location']);
        //echo json_encode($result);

        if ($result) {
            echo '200';
        } else {
            echo '500';
//            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
//          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//          <strong>Failure!</strong> Plant addition failed.
//          </div>
//          <script>
//          window.setTimeout(function() {
//          $(".alert").fadeTo(500, 0).slideUp(500, function(){
//          $(this).remove(); 
//          });
//          }, 5000);
//          </script>';
        }
    }

    //---function for show all category
    public function showPlants() {
        // call to model function to get all category from db
        $result = $this->dash_model->showPlants();

        echo json_encode($result);
    }

    public function delPlant() {
        extract($_GET);
        //print_r($_GET);die();
        // call to model function to del  category from db
        $result = $this->dash_model->delPlant($plant_id);

        echo json_encode($result);
    }

      //----------this function to update admin email-----------------------------//
 public function updateEmail() { 
  extract($_POST);
 
  $data=$_POST;
  $path = base_url();
  $url = $path.'api/Setting_api/updateEmail';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  if ($response['status'] != 200) {
    echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> '.$response['status_message'].'</h4>
    ';
  } else {
    echo '<h4 class="w3-text-black w3-margin"><i class="fa fa-check"></i> '.$response['status_message'].'</h4>
    <script>
    window.setTimeout(function() {
     location.reload();
   }, 1000);
   </script>';
 }
}
//----------------this fun to update admin email end---------------//

     
//----------this function to get admin details-----------------------------
 public function getAdminDetails() {

  $path = base_url();
  $url = $path . 'api/Setting_api/getAdminDetails';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  // print_r($response_json);die();
  return $response;
}

}