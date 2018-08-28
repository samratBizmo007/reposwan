<?php

class Production extends CI_controller {

    public function __construct() {
        parent::__construct();
//start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('production_model/Production_planning_model');
        $this->load->model('production_model/Production_model');
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
        $this->load->view('pages/production/production');
        $this->load->view('includes/footer');
    }

    public function getSharedInprocessPoDetails() {
        extract($_GET);
        $result = $this->Production_model->getSharedInprocessPoDetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getAllSharedInprogressPoDetailsBydate() {
        extract($_GET);
        $result = $this->Production_model->getAllSharedInprogressPoDetailsBydate($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function show_ProductionPo_Orderinfo() {
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
            //print_r($result[$i]['po_machinedetails']);
            echo '<div class="w3-margin-bottom "><fieldset>
            <div class="row w3-padding" style="margin-top: 5px; margin-bottom: 5px;">
            <form name="poProduction_form_' . $result[$i]['po_id'] . '" id="poProduction_form_' . $result[$i]['po_id'] . '" method="POST">';
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

            echo'<div class="col-lg-12 col-xs-12 col-sm-12 w3-padding-bottom"><hr>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<label>PO Prod Qty</label>'
            . '<input type="text" id="po_prod_qty" name="po_prod_qty" class="form-control" value="' . $result[$i]['quantity'] . '">'
            . '</div>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<label>Shared Qty</label>'
            . '<input type="text" id="po_shared_qty" name="po_shared_qty" class="form-control" value="' . $result[$i]['shared_product_quantity'] . '">'
            . '</div>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<label>Produced Qty</label>'
            . '<input type="text" id="produced_qty" name="produced_qty" onkeyup="getProductionCalculation();" class="form-control" value="">'
            . '</div>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<label>Rejected Qty</label>'
            . '<input type="text" id="rejected_qty" name="rejected_qty" onkeyup="getRejectedCalculation();" class="form-control" value="">'
            . '</div>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<label>Inprocess Qty</label>'
            . '<input type="text" id="inprocess_qty" name="inprocess_qty" readonly class="form-control" value="">'
            . '<input type="hidden" id="po_id" name="po_id" readonly class="form-control" value="' . $result[$i]['po_id'] . '">'
            . '<input type="hidden" id="machineDetails" name="machineDetails" class="form-control" value="' . $result[$i]['po_machinedetails'] . '">'
            . '</div>'
            . '<div class="col-lg-4 col-xs-12 col-sm-12" style="padding-top: 5px;">'
            . '<label for="rm_grade">Status</label>'
            . '<select name="status" class="form-control w3-small" id="status">'
            . '<option value="" >Select status</option>'
            . '<option value="0" class="w3-text-red">Rejected</option>'
            . '<option value="1" class="w3-text-green">Completed</option>'
            . '<option value="2" class="w3-text-yellow">Inprocess</option>'
            . '</select>'
            . '</div>'
            . '</div>';

            echo '<div class="col-lg-12 col-xs-12 col-sm-12"><hr>'
            . '<div class="col-lg-2 col-xs-12 col-sm-12">'
            . '<button type="button" style="margin-top: 22px;" title="filter Po by date" id="btnsubmit" onclick="endDateTime();" class="w3-medium w3-button theme_bg">End</button>'
            . '</div>'
            . '<div class="col-lg-4 col-xs-12 col-sm-12">'
            . '<label>End Date And Time</label>'
            . '<input type="text" id="endDate" name="endDate" class="form-control" value="">'
            . '</div>'
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
            . '$("#poProduction_form_' . $result[$i]['po_id'] . '").submit(function (e) {
                                        e.preventDefault();
                                        dataString = $("#poProduction_form_' . $result[$i]['po_id'] . '").serialize();
                                        $.ajax({
                                            type: "POST",
                                            url: "' . base_url() . 'production/production/updatePoDetails",
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

    public function endDateTime() {
        $date = date('Y-m-d H:i:s');
        echo $date;
    }

    public function updatePoDetails() {
        extract($_POST);
        //print_r($_POST);die();
        
        //$data['po_machine_detail']= $machineDetails;
        $data['po_id'] = $po_id;
        $data['end'] = $endDate;
        $data['po_shared_qty'] = $po_shared_qty;
        $data['produced_qty'] = $produced_qty;
        $data['rejected_qty'] = $rejected_qty;
        $data['inprocess_qty'] = $inprocess_qty;
        $data['po_status'] = $status;
        $result = $this->Production_model->updatePoDetails($data);
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
