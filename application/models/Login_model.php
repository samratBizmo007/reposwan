<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // login function to authenticate user
    public function authenticate($username, $password) {

        //print_r($username);die();
        // get admin username
        $admin_username = Login_model::getAdminDetails('username');
        // check passed key valid or not
        if (!$admin_username) {
            echo '<p class="w3-red w3-padding-small">Invalid Key passed for username!</p>';
        }

        // get admin password
        $admin_password = Login_model::getAdminDetails('password');
        // check passed key valid or not
        if (!$admin_password) {
            echo '<p class="w3-red w3-padding-small">Invalid Key passed for password!</p>';
        }

        // check post values with db values
        if ($admin_username == $username && $admin_password == $password) {
            return true;
        } else {
            return false;
        }
    }

    // login function ends here
    // -----------------------GET ADMIN DETAILS----------------------//
    //-------------------------------------------------------------//
    public function getAdminDetails($name) {

        $query = "SELECT * FROM admin_details WHERE name='$name'";
        //echo $query;die();
        $result = $this->db->query($query);

        // handle db error
        if (!$result) {
            // Has keys 'code' and 'message'
            $error = $this->db->error();
            return $error;
            die();
        }

        // if no db errors
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            $value = '';
            foreach ($result->result_array() as $key) {
                $value = $key['value'];
            }
            return $value;
        }
    }

    //---------GET ADMIN DETAILS ENDS------------------//

    public function getAdminEmail() {
        $query = "SELECT * FROM admin_details WHERE name = 'email'";
        //echo $query;die();
        $result = $this->db->query($query);

        // if no db errors
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            $value = '';
            foreach ($result->result_array() as $key) {
                $value = $key['value'];
            }
            return $value;
        }
    }

    public function getAdminPassword() {
        $query = "SELECT * FROM admin_details WHERE name = 'password'";
        //echo $query;die();
        $result = $this->db->query($query);

        // if no db errors
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            $value = '';
            foreach ($result->result_array() as $key) {
                $value = $key['value'];
            }
            return $value;
        }
    }

}
