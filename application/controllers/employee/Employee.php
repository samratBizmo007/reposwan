<?php

class Employee extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('employee_model/Employee_model');
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
        $data['details'] = Employee::getAllEmployeeDetails();
        // print_r($data);die();
        $this->load->view('includes/header');
        $this->load->view('pages/employee/add_employee', $data);
        $this->load->view('includes/footer');
    }

    public function addEmployeeDetails() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        extract($request);
        //print_r($request);die();
        if (!isset($skillAdded_field)) {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please add at least one Operation for employee Details.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
            die();
        }

        if ($skillAdded_field == '' || $skillAdded_field == '[]') {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please add at least one Operation for employee Details.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
            die();
        }
        $result = $this->Employee_model->addEmployeeDetails($request);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Employee Details Added successfully.
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
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Employee Details Not Added Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
        }
    }

    //------------ get employee skills ----------------------------------//
    public function getEmployeeSkills() {
        extract($_GET);
        //print_r($_GET);die();
        //echo json_encode($_GET);
        $result = $this->Employee_model->getEmployeeSkills($emp_id);
        print_r($result[0]['employee_skills']); // json_encode($result);
    }

    //------------ get employee skills ends ----------------------------------//
    //------------ get all employee details ----------------------------------//
    public function getAllEmployeeDetails() {
        $path = base_url();
        $url = $path . 'api/Employee_api/getAllEmployeeDetails';
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

//------------fun for delete Employee skill---------------------------//
    //------------ get all employee details ----------------------------------//
    public function getAllEmployeeDetailsnew() {
        $path = base_url();
        $url = $path . 'api/Employee_api/getAllEmployeeDetails';
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

//------------fun for delete Employee skill---------------------------//
    public function deleteSkill() {
        extract($_GET);
        //print_r($_GET);die();
        //echo json_encode($_GET);
        $result = $this->Employee_model->deleteSkill($emp_id, $skill);
        print_r(json_decode($result, TRUE));
    }

    //=-----------fun for update employee details----------------------------//
    public function updateEmployeeDetails() {
        extract($_POST);
        $data = $_POST;
        $addedSkills = array();
        $dbSkills = array();
        $updatedSkills = array();
        $addedSkills = json_decode($skill_field, TRUE);
        $dbSkills = json_decode($fromDbSkills, TRUE);
        //print_r($_POST);die();
        if ($addedSkills == '' && $dbSkills == []) {
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i>Please Choose Atlest one skill for employee. </h4>';
            die();
        }
        if ($addedSkills == '') {
            $data['updatedSkills'] = $fromDbSkills;
        }
        if ($addedSkills != '' && $dbSkills != '') {
            $updatedSkills = array_merge($addedSkills, $dbSkills);
            $data['updatedSkills'] = json_encode($updatedSkills);
        }
        //print_r($data);die();
        $path = base_url();
        $url = $path . 'api/Employee_api/updateEmployeeDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response);
        //die();
        if ($response == 1) {
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

    //--------------fun for delete Employee------------------------------//
    public function deleteEmployeeDetails() {
        extract($_POST);
//        echo $material_id;
//        die();
        $path = base_url();
        $url = $path . 'api/Employee_api/deleteEmployeeDetails?emp_id=' . $emp_id;
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
