<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();

        // load common model
        $this->load->model('login_model');
    }

    // main index function
    public function index() {
        //start session		
        $admin_name = $this->session->userdata('admin_name');
        if ($admin_name != '') {
            $sessionArr = explode('|', $admin_name);
            //check session variable set or not, otherwise logout
            if (($sessionArr[0] == 'SWANROCKSPlates')) {
                redirect('admin/dashboard');
            }
        }
        //$this->load->view('includes/header');
        $this->load->view('pages/login');
        //$this->load->view('includes/footer');
    }

    // check login authentication-----------------------------------------------------------
    public function checkLogin() {
        // get data passed through ANGULAR AJAX
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        //print_r($request['username']);
        // call to model function to authenticate user
        $result = $this->login_model->authenticate($request['username'], $request['password']);

        // print valid message
        if (!$result) {
            // failure scope
            echo '<p class="w3-red w3-padding-small">Sorry, your credentials are incorrect!</p>';
        } else {
            // success scope
            //----create session array--------//
            $session_data = array(
                'admin_name' => "SWANROCKSPlates|" . $request['username']
            );

            //start session of user if login success
            $this->session->set_userdata($session_data);
            //redirect('admin/dashboard');
            echo '200';
            //echo '<p class="w3-green w3-padding-small">Login successfull! Welcome Admin.</p>';
        }
        //print_r($result);
    }

    // login fucntion ends here----------------------------------------------------------------------
    // logout function starts here----------------------------------------------------
    public function logoutAdmin() {
        //start session		
        $admin_name = $this->session->userdata('admin_name');

        //if logout success then destroy session and unset session variables
        $this->session->unset_userdata(array('admin_name'));
        $this->session->sess_destroy();
        redirect('login');
    }

    // logout function ends here---------------------------------------------------------

    public function forgetPassword() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        //print_r($request);

        $admin_email = $this->login_model->getAdminEmail();
        $admin_password = $this->login_model->getAdminPassword();
        //print_r($result);die();
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mx1.hostinger.in',
            'smtp_port' => '587',
            'smtp_user' => 'support.swan@bizmo-tech-admin.com', // change it to yours
            'smtp_pass' => 'Descartes@1990', // change it to yours
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $config['smtp_crypto'] = 'tls';

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('support.swan@bizmo-tech-admin.com', "Admin Team");
        $this->email->to($admin_email);
        $this->email->subject("SWAN-Forget Password Request");
        $this->email->message('<html>
			<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="' . base_url() . 'assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<script src="' . base_url() . 'assets/js/jquery.min.js"></script>
			<script src="' . base_url() . 'assets/bootstrap/js/bootstrap.min.js"></script>
			</head>
			<body>
			<div class="container col-lg-8" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;margin:10px; font-family:Candara;">
			<h1><i class="fa fa-circle-o w3-orange w3-padding-tiny w3-text-white" style="text-shadow: 2px 2px #ff0000;"></i> Swan Industries</h1>
			<h2 style="color: black; font-size:30px">Forgot Your Password?</h2>
			<h3 style="font-size:15px;">Hello Sir,<br>We have recieved a request from '.$request['email_id'].' to have your password for <b>Swan</b>. </h3>
			<div class="col-lg-12">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
			<h4><b>Password: </b>' . $admin_password . '<br>
			</div>
			<div class="col-lg-4"></div>
			</div>
			<hr>	
			</div>
			</body>
                        </html>');

        if ($this->email->send()) {
            echo 'Email Sent Successfully';
//            $config = Array(
//                'protocol' => 'smtp',
//                'smtp_host' => 'mx1.hostinger.in',
//                'smtp_port' => '587',
//                'smtp_user' => 'support.swan@bizmo-tech-admin.com', // change it to yours
//                'smtp_pass' => 'Descartes@1990', // change it to yours
//                'mailtype' => 'html',
//                'charset' => 'utf-8',
//                'wordwrap' => TRUE
//            );
//            $config['smtp_crypto'] = 'tls';
//
//            $this->load->library('email', $config);
//            $this->email->set_newline("\r\n");
//            $this->email->from('support.swan@bizmo-tech-admin.com', "Admin Team");
//            $this->email->to($request['email_id']);
//            $this->email->subject("SWAN-Forget Password Request");
//            $this->email->message('<html>
//			<head>
//			<meta name="viewport" content="width=device-width, initial-scale=1.0">
//			<link href="' . base_url() . 'assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
//			<script src="' . base_url() . 'assets/js/jquery.min.js"></script>
//			<script src="' . base_url() . 'assets/bootstrap/js/bootstrap.min.js"></script>
//			</head>
//			<body>
//			<div class="container col-lg-8" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;margin:10px; font-family:Candara;">
//			<img class="w3-border" style="width:100px;height:auto; margin-left:auto; margin-right: auto;" src="http://jobmandi.in/images/desktop/logo-main.png">
//			<h2 style="color:#4CAF50; font-size:30px">Forgot Your Password?</h2>
//			<h3 style="font-size:15px;">Hello Sir,<br>We have recieved a request from you for forget password. <b>Swan</b>. </h3>
//			<div class="col-lg-12">
//			<div class="col-lg-4">
//                        </div>
//			<div class="col-lg-4">
//                        <h3 style="font-size:15px;"> Our team will get back to you.</h3>
//			</div>
//			<div class="col-lg-4"></div>
//			</div>
//			<hr>
//			<h4 style="font-size:15px;"><b>Questions?</b></h4>
//			<h4 style="font-size:15px;">Please let us know if there is anything we can help you with by replying this email.<br><br>Thanks, <b>Admin Team</b></h4>
//			</div>
//			</body>
//                        </html>');
//            if ($this->email->send()) {
//                echo '<p class="w3-green w3-padding-small">Email Sent Successfully.</p>';
//            } else {
//                echo '<p class="w3-red w3-padding-small">Email Sending Failed.</p>';
//            }
        } else {
            echo 'Email Sending Failed.';
        }
    }

}
