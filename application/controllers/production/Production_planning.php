<?php

class Production_planning extends CI_controller {

    public function __construct() {
        parent::__construct();
//start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('production_model/Production_planning_model');
        $this->load->model('sharedpo_model/SharedPO_model');
        $this->load->model('material_model/Material_model');
        $this->load->model('product_model/product_model');
        $this->load->model('required_rawmaterial_model/Rawmaterial_required_model');

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
//$data['sharedPo'] = $this->Material_model->getAllMaterialCategories();
        $this->load->view('includes/header');
        $this->load->view('pages/production/production_planning');
        $this->load->view('includes/footer');
    }

    public function getSharedPoDetails() {
        extract($_GET);
        $result = $this->Production_planning_model->getSharedPoDetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function show_Po_Orderinfo() {
        extract($_GET);
//print_r($_GET);die();
        $result = $this->Rawmaterial_required_model->getPoProductDetails($product_code, $po_id);
//print_r($result);
        $stock = $this->Rawmaterial_required_model->getSubProductDetails($product_code, $po_id);
        $skill_data = $this->product_model->getSkills();
        $machine_data = $this->product_model->getMachines();
        $employeeData = $this->Production_planning_model->getAllEmployees();
        $materialCategories = $this->Material_model->getAllMaterialCategories();
        $total = 0;
        $material_quantity = 0;
        $Po_ProductQuantity = 0;
        $stockQuantity = 0;
//print_r($result);die();
        for ($i = 0; $i < count($result); $i++) {

            echo '<div class="w3-margin-bottom "><fieldset>
            <div class="row w3-padding" style="margin-top: 5px; margin-bottom: 5px;">
            <form name="po_form_' . $result[$i]['po_id'] . '" id="po_form_' . $result[$i]['po_id'] . '" method="POST">';
// print_r($stock[0]['subproduct_quantity']);
            echo'<div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom"><hr>';
            echo'<div class="w3-col l4 col-xs-12 col-sm-12">
            Customer Name: <b class="w3-text-black">' . $result[$i]['customer_name'] . '</b>
            </div>';
            echo'<div class="w3-col l4 col-xs-12 col-sm-12">
            Order No: <b class="w3-text-black">' . $result[$i]['order_no'] . '</b>
            </div>';
            echo'<div class="w3-col l4 col-xs-12 col-sm-12">
            Part Code/ Sr.No: <b class="w3-text-black">' . $result[$i]['product_code'] . '/' . $result[$i]['sr_no'] . '</b>
            </div>';
            echo'</div>';
//echo '';
            echo'<div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom"><hr>
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                    Drawing no : <b class="w3-text-black">' . $result[$i]['part_drwing_no'] . '</b> 
                </div>
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                    Revision No : <b class="w3-text-black">' . $result[$i]['revision_no'] . '</b> 
                </div>
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                   P.O Prod Qty : <b class="w3-text-black">' . $result[$i]['quantity'] . '</b> 
                </div>
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                    Stock Quantity : <b class="w3-text-black">' . $stock[0]['subproduct_quantity'] . '</b> 
                </div>            
            </div>';

            echo '<div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom"><hr>'
            . '<div class="w3-col l4 col-xs-12 col-sm-12">'
            . 'Shared Qty : <b class="w3-text-black">' . $result[$i]['shared_product_quantity'] . '</b>'
            . '</div>'
            . '</div>';

            $materialDetails = json_decode($result[$i]['material_details'], true);
            $machineDetails = json_decode($result[$i]['machine_info'], true);
//print_r($result[$i]['machine_info']);
            for ($j = 0; $j < count($machineDetails); $j++) {
//print_r($machineDetails[$j]['']);
                foreach ($skill_data as $skil) {
                    if ($skil['skill_id'] == $machineDetails[$j]['operations']) {
                        $skill_name = $skil['skill_name'];
                    }
                }
                foreach ($machine_data as $mach) {
                    if ($mach['machine_id'] == $machineDetails[$j]['machine']) {
                        $machineData = $mach['machine_name'] . '/' . $mach['machine_capacity'];
                    }
                }
                $time = $result[$i]['quantity'] / $machineDetails[$j]['qtyhr'];
                echo'<div class="col-lg-12 col-xs-12 col-sm-12 w3-padding-bottom"><hr>'
                . '<div class="col-lg-2 col-xs-12 col-sm-12">'
                . '<label>Operations</label>'
                . '<input type="text" class="form-control" value="' . $skill_name . '">'
                . '<input type="hidden" id="operations" name="operations[]" class="form-control" value="' . $machineDetails[$j]['operations'] . '">'
                . '</div>'
                . '<div class="col-lg-2 col-xs-12 col-sm-12">'
                . '<label>machines</label>'
                . '<input type="text" class="form-control" value="' . $machineData . '">'
                . '<input type="hidden" id="machines" name="machines[]" class="form-control" value="' . $machineDetails[$j]['machine'] . '">'
                . '</div>'
                . '<div class="col-lg-2 col-xs-12 col-sm-12">'
                . '<label>Qty Per Hr</label>'
                . '<input type="number" min="0" class="form-control" value="' . $machineDetails[$j]['qtyhr'] . '">'
                . '<input type="hidden" id="Qtyhr" name="Qtyhr[]" class="form-control" value="' . $machineDetails[$j]['qtyhr'] . '">'
                . '</div>'
                . '<div class="col-lg-2 col-xs-12 col-sm-12">'
                . '<label>Product Qty</label>'
                . '<input type="number" min="0" class="form-control" value="' . $result[$i]['quantity'] . '">'
                . '<input type="hidden" name="poProductQty[]" class="form-control" value="' . $result[$i]['quantity'] . '">'
                . '</div>'
                . '<div class="col-lg-4 col-xs-12 col-sm-12">'
                . '<label>Time(Hr)</label>'
                . '<input type="text" class="form-control" value="' . $time . '">'
                . '<input type="hidden" id="time" name="time[]" class="form-control" value="' . $time . '">'
                . '<input type="hidden" id="po_id" name="po_id" class="form-control" value="' . $result[$i]['po_id'] . '">'
                . '</div>'
                . ' <div class="col-lg-4 col-xs-12 col-sm-12">
                    <label for="rm_grade">Employee Name</label>
                    <select name="employee[]" class="form-control w3-small" id="employee">';
                foreach ($employeeData as $key) {
                    echo'<option value="' . $key['emp_id'] . '" selected>' . $key['employee_name'] . '</option>';
                }
                echo'</select>
                </div>'
                . '</div>';
            }
            echo '<div class="col-lg-12 col-xs-12 col-sm-12"><hr>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<button  type="button" style="margin-top: 22px;" title="filter Po by date" id="btnsubmit" onclick="startDateTime();" class="w3-medium w3-button theme_bg">Start</button>'
            . '</div>'
            . '<div class="col-lg-4 col-xs-12 col-sm-12">'
            . '<label>Start Date And Time</label>'
            . '<input type="text" id="startDate" name="startDate" class="form-control" value="'.$result[$i]['start_datetime'].'">'
            . '</div>'
//            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
//            . '<button type="button" style="margin-top: 22px;" title="filter Po by date" id="btnsubmit" onclick="endDateTime();" class="w3-medium w3-button theme_bg">End</button>'
//            . '</div>'
//            . '<div class="col-lg-4 col-xs-12 col-sm-12">'
//            . '<label>End Date And Time</label>'
//            . '<input type="text" id="endDate" name="endDate" class="form-control" value="">'
//            . '</div>'
            . '</div>';

            echo '<div class="col-lg-12 col-xs-12 col-sm-12 w3-center"><hr>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<button  type="submit" style="margin-top: 22px;" title="filter Po by date" id="btnsubmit" class="w3-medium w3-button theme_bg">Update Po</button>'
            . '</div>'
            . '</div>';

            echo'</form>'
            . '</div>'
            . '</fieldset>'
            . '</div>'
            . '<script>'
            . '$("#po_form_' . $result[$i]['po_id'] . '").submit(function (e) {
                                        e.preventDefault();
                                        dataString = $("#po_form_' . $result[$i]['po_id'] . '").serialize();
                                        $.ajax({
                                            type: "POST",
                                            url: "' . base_url() . 'production/production_planning/updatePoDetails",
                                            data: dataString,
                                            return: false, //stop the actual form post !important!
                                            success: function (data)
                                            {
                                                $("#message").html(data);
                                            }
                                        });
                                        return false;  //stop the actual form post !important!
                                    });
                                    </script>';
        }
    }

    public function getAllSharedPoDetailsBydate() {
        extract($_GET);
        $result = $this->Production_planning_model->getAllSharedPoDetailsBydate($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function startDateTime() {
        $date = date('Y-m-d H:i:s');
        echo $date;
    }

    public function updatePoDetails() {
        extract($_POST);
        //print_r($_POST);die();
        $podetails = '';
        $arr = array();
        for ($i = 0; $i < count($operations); $i++) {
            $podetails = array(
                'operations' => $operations[$i],
                'machines' => $machines[$i],
                'Qtyhr' => $Qtyhr[$i],
                'poProductQty' => $poProductQty[$i],
                'time' => $time[$i],
                'employee' => $employee[$i]
            );

            $arr[] = $podetails;
        }

        if ($startDate != '') {
            $this->Production_planning_model->updateMachine(json_encode($machines));
        }
//        if ($endDate != '') {
//            $this->Production_planning_model->updateMachineData(json_encode($machines));
//        }

        //print_r(json_encode($arr));
        $data['po_machine_detail'] = json_encode($arr);
        $data['po_id'] = $po_id;
        $data['start'] = $startDate;
        //$data['end'] = $endDate;
        $result = $this->Production_planning_model->updatePoDetails($data);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> PO Updated successfully added.
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
			<strong>Failure!</strong> PO Updation Failed .
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

}
