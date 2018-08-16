<?php

class Addmachine extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('machine_model/Machine_model');

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
        $data['details'] = Addmachine::getAllMachineDetails();     //-------show all machine

        $this->load->view('includes/header');
        $this->load->view('pages/admin/machine/addmachine', $data);
        $this->load->view('includes/footer');
    }

    public function addMachine_data() {
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


    public function getAllMachineDetails() {
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

    public function getAllMachines() {
        extract($_POST);
        $path = base_url();
        $url = $path . 'api/Machine_api/getAllMachines?machine_name=' . $machine_name;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);

        //print_r($response_json);        die();
        if ($response['status'] == 200) {
            $i = 1;
            foreach ($response['status_message'] as $val) {
                //print_r($val);
                echo'<tr id="rowCount">
                                    <td class="w3-center">' . $i . '</td>
                                    <td class="w3-center">' . $val['machine_name'] . '</td>
                                    <td class="w3-center">' . $val['machine_type'] . '</td>
                                    <td class="w3-center">' . $val['machine_capacity'] . '</td>
                                    <td class="">
                                    <div class="w3-center">
                                        <a class="btn w3-padding-small" data-toggle="modal" data-target="#upMachineModal_' . $val['machine_id'] . '" title="Update Machine Details">
                                            <i class="w3-text-green w3-large fa fa-edit"></i>
                                        </a>                   
                                        <a class="btn w3-padding-small" onclick="deleteMachineDetails(' . $val['machine_id'] . ')" title="Delete Machine">
                                            <i class="w3-text-red w3-large fa fa-trash"></i>
                                        </a>
                                    <div>
                                    <!-- Modal -->
                            <div id="upMachineModal_' . $val['machine_id'] . '" class="modal" role="dialog">
                                <form id="upMachineForm_' . $val['machine_id'] . '" name="upMachineForm_' . $val['machine_id'] . '">
                                    <div class="modal-dialog modal-lg">
                                        <!----------------------------------- Modal content------------------------------------>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Machine Details</h4>
                                            </div>
                                            <!----------------------------------- Modal Body------------------------------------>                                        
                                            <div class="modal-body">
                                                <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
                                                    <fieldset>
                                                        <div class="row" style=" margin-top: 5px;">
                                                            <div class="col-lg-1"></div>
                                                            <div class="col-lg-10">
                                                                <div class="" id="App" style="padding:12px 36px 12px 36px">
                                                                    <div class="w3-col l12"></div>
                                                                    <div class="w3-col l12 w3-margin-bottom">
                                                                        <div id="machinename" class="col-lg-6 col-xs-12 col-sm-12">
                                                                            <label class="w3-left">Machine name </label>
                                                                            <input type="text" name="machine_name" value="' . $val['machine_name'] . '" id="machine_name" class="form-control" placeholder="Machine Name" required>
                                                                            <input type="hidden" name="machine_id" value="' . $val['machine_id'] . '" id="machine_id" class="form-control" placeholder="Machine Name">
                                                                        </div>
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12" id="machinecapacity">
                                                                            <label class="w3-left">Machine Capacity</label>
                                                                            <input type="number" name="machine_capacity" value="' . $val['machine_capacity'] . '" id="machine_capacity" min="0" step="0.01" class="form-control" placeholder="Machine Capacity" required>
                                                                        </div>  
                                                                        <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv"></div>
                                                                        <div class="w3-col l12 w3-margin-bottom">
                                                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="machinetype">
                                                                                <label class="w3-left">Machine Type </label>
                                                                                <input type="text" name="machine_type" value="' . $val['machine_type'] . '" id="machine_type"  class="form-control" placeholder="Machine Type" required>
                                                                            </div>  
                                                                        </div>                                                                   
                                                                    </div>
                                                                    <div class=" w3-center w3-col l12" style="">
                                                                        <button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Update Machine</button>
                                                                    </div>
                                                                </div>
                                                                <!-- REGISTER DIV ENDS -->   
                                                            </div>
                                                            <div class="col-lg-1"></div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <!----------------------------------- Modal Body------------------------------------>                                                                               
                                        </div>
                                        <!----------------------------------- Modal content------------------------------------->
                                    </div>
                                </form>
                            </div>';
                echo'<script type="text/javascript">
                                $(function () {
                                    $("#upMachineForm_' . $val['machine_id'] . '").submit(function (e) {
                                        e.preventDefault();
                                        dataString = $("#upMachineForm_' . $val['machine_id'] . '").serialize();
                                        $.ajax({
                                            type: "POST",
                                            url: "' . base_url() . 'admin/machine/addmachine/updateMachineDetails",
                                            data: dataString,
                                            return: false, //stop the actual form post !important!
                                            success: function (data)
                                            {
                                                $.alert(data);
                                            }
                                        });
                                        return false;  //stop the actual form post !important!
                                    });
                                });
                            </script>';

//                echo '<script type="text/javascript">
//                                function deleteMachineDetails(machine_id) {
//                                    $.confirm({
//                                        title: "<h4 class="w3-text-red"><i class="fa fa-warning"></i> Are you sure you want to Delete Machine?</h4>",
//                                        content: "",
//                                        type: "red",
//                                        buttons: {
//                                            confirm: function () {
//                                                $.ajax({
//                                                    url: "' . base_url() . 'admin/machine/addmachine/deleteMachineDetails",
//                                                    type: "POST",
//                                                    data: {
//                                                        machine_id: machine_id
//                                                    },
//                                                    cache: false,
//                                                    success: function (data) {
//                                                        $.alert(data);
//                                                    }
//                                                });
//                                            },
//                                            cancel: function () {
//                                            }
//                                        }
//                                    });
//                                }
//                            </script>';
                echo'</td></tr>';
                $i++;
            }
        } else {
            echo'<tr>
                 <td colspan="5" class="w3-center">No Records Found..!</td>
                 </tr>';
        }
    }

    public function getQuantityPerHr() {
        extract($_GET);
        $result = $this->Machine_model->getQuantityPerHr($machine_id);
        print_r($result[0]['quantity_per_hr']);
    }

}
