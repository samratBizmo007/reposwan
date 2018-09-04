<?php

class Required_rawmaterial extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        //$this->load->model('employee_model/Employee_model');
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
        $this->load->view('includes/header');
        $this->load->view('pages/required_raw_material/raw_material_required');
        $this->load->view('includes/footer');
    }

    public function getPurchaseOrdersDetails() {
        extract($_GET);
        $result = $this->Rawmaterial_required_model->getPurchaseOrdersDetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getAllPurchaseOrdersByDate() {
        extract($_GET);
        $result = $this->Rawmaterial_required_model->getAllPurchaseOrdersByDate($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getPoDetails() {
        extract($_GET);
        $result = $this->Rawmaterial_required_model->getAllPurchaseOrdersByDate($from_date, $to_date);
        print_r(json_encode($result));
    }

    public function getPoProductDetails() {
        extract($_GET);
//        $p_code = '';
//        $p_id = '';
        $podetails = explode('/', $po_orders);
        $p_code = $podetails[0];
        $p_id = $podetails[1];
        //print_r($podetails);
        $result = $this->Rawmaterial_required_model->getPoProductDetails($p_code, $p_id);
        //print_r($result);
        $stock = $this->Rawmaterial_required_model->getSubProductDetails($p_code, $p_id);
        $this->load->model('material_model/Material_model');

        $materialCategories = $this->Material_model->getAllMaterialCategories();
        $total = 0;
        $material_quantity = 0;
        $Po_ProductQuantity = 0;
        $stockQuantity = 0;
        //print_r($result);
        for ($i = 0; $i < count($result); $i++) {
            //print_r($result[$i]['material_details']);

            echo '<fieldset>
            <div class="row w3-padding" style="margin-top: 5px; margin-bottom: 5px;">';
           // print_r($stock[0]['subproduct_quantity']);
            echo'<div class=" w3-col l12 w3-padding-bottom">
            Customer Name: <b class="w3-text-black">' . $result[$i]['customer_name'] . '</b>
            </div>';
            if ($stock[0]['subproduct_quantity'] == 0) {
                $Po_ProductQuantity = $result[$i]['quantity'];
            } else {
                //---------if sub product stock quantity is grater than po quantity 
                if ($stock[0]['subproduct_quantity'] >= $result[$i]['quantity']) {
                    $Po_ProductQuantity = $result[$i]['quantity'];
                    $stockQuantity = $stock[0]['subproduct_quantity'] - $result[$i]['quantity'];
                } else {
                    $Po_ProductQuantity = $result[$i]['quantity'] - $stock[0]['subproduct_quantity'];
                    $stockQuantity = $result[$i]['quantity'] - $stock[0]['subproduct_quantity'];
                }
            }
            //echo '';
            echo'<div class="w3-col l12">
                <div class=" w3-col l3">
                    Drawing no : <b class="w3-text-black">' . $result[$i]['part_drwing_no'] . '</b> 
                </div>
                <div class=" w3-col l3">
                    Revision No : <b class="w3-text-black">' . $result[$i]['revision_no'] . '</b> 
                </div>
                <div class=" w3-col l3">
                   P.O Product Quantity : <b class="w3-text-black">' . $result[$i]['quantity'] . '</b> 
                </div>
                <div class=" w3-col l3">
                    Stock Quantity : <b class="w3-text-black">' . $stock[0]['subproduct_quantity'] . '</b> 
                </div>
            </div>';
            $materialDetails = json_decode($result[$i]['material_details'], true);

            echo'<div class="col-lg-12">
                 <hr>';
            for ($j = 0; $j < count($materialDetails); $j++) {
                //print_r($materialDetails[$j]);die();
                foreach ($materialCategories['status_message'] as $mat_type) {
                    //print_r($mat_type);
                    if ($materialDetails[$j]['rm_type'] == $mat_type['mat_cat_id']) {
                        $materialCat = $mat_type['material_type'];
                    }
                }
                
                switch ($materialDetails[$j]['rm_type']) {
                    case '1':
                        $material_quantity = $materialDetails[$j]['rmqtySelected'];
                        break;
                    case '2':
                        $material_quantity = 1;
                        break;
                    case '3':
                        $material_quantity = $materialDetails[$j]['rmqtySelected'];
                        break;
                    case '4':
                        $material_quantity = $materialDetails[$j]['rmlenSelected'];
                        break;
                    case '5':
                        $material_quantity = $materialDetails[$j]['rmlenSelected'];
                        break;
                    case '6':
                        $material_quantity = $materialDetails[$j]['rmqtySelected'];
                        break;
                    case '7':
                        $material_quantity = $materialDetails[$j]['rmqtySelected'];
                        break;
                    case '8':
                        $material_quantity = $materialDetails[$j]['rmqtySelected'];
                        break;
                }
                $actualWeigth = $this->Rawmaterial_required_model->getMaterialTotalWeight($materialDetails[$j]['rmgradeSelected'],$materialDetails[$j]['rm_type']);

//--------------------material specification div----------------------------------------------//
                $total = $materialDetails[$j]['rmweightSelected'] * $material_quantity * $Po_ProductQuantity;

                echo'<div class="w3-col l12 w3-padding-bottom">'
                . '<div class="w3-col l1" style="padding-right: 2px;">'
                . '<lable>Category</lable>'
                . '<input type="text" disabled class="form-control" value="' . $materialCat . '">'
                . '</div>'
                . '<div class="w3-col l1" style="padding-right: 2px;">'
                . '<lable>Grade</lable>'
                . '<input type="text" id="selected_grade_' . $j . '" disabled class="form-control" value="' . $materialDetails[$j]['rmgradeSelected'] . '">'
                . '</div>'
                . '<div class="w3-col l1" style="padding-right: 2px;">'
                . '<lable>Weight</lable>'
                . '<input type="number" min="0" disabled class="form-control" value="' . $materialDetails[$j]['rmweightSelected'] . '">'
                . '</div>'
                . '<div class="w3-col l1" style="padding-right: 2px;">'
                . '<lable>Prod.Qty</lable>'
                . '<input type="number" min="0" disabled class="form-control" value="' . $Po_ProductQuantity . '">'
                . '</div>'
                . '<div class="w3-col l2" style="padding-right: 2px;">'
                . '<lable>R.M. Required</lable>'
                . '<input type="number" min="0" id="total_weight_' . $j . '" disabled class="form-control" value="' . $total . '">'
                . '</div>'
                . '<div class="w3-col l2" style="padding-right: 2px;">'
                . '<lable>Actual Tot.Weight</lable>'
                . '<input type="number" min="0" id="actual_weight_' . $j . '" disabled class="form-control" value="' . $actualWeigth . '">'
                . '</div>'
                . '<div class="w3-col l2 w3-center" style="padding-right: 2px;">'
                . '<br>'
                . '<button href="" class="w3-text-white theme_bg w3-small s3-text-center" onclick="updateGradeDetails(' . $j . ');">Update Material Inventory</button>'
                . '</div>'
                . '<div class="w3-col l2" style="padding-right: 2px;">'
                . '<lable>Remaining Weight</lable>'
                . '<input type="number" min="0" id="remaining_weight_' . $j . '" disabled class="form-control" value="">'
                . '</div>'
                . '<span class="w3-text-red" id="messg_' . $j . '"></span>'
                . '</div>';
            }
            echo'</div>';
            echo '<div class="w3-lg-12">'
            . '<lable><b>Remark Type</b></lable><br>'
            . '<input type="radio" name="remarktype" id="remarkTy_' . $i . '" value="Positive"> Positive &nbsp;&nbsp;'
            . '<input type="radio" name="remarktype" id="remarkType_' . $i . '" value="Negative"> Negative'
            . '</div>';
            echo'<div class="col-lg-12 col-xs-12 col-sm-12 w3-padding-top">
                <label>Remark</label>
                <textarea class="form-control" name="remark" id="remark" ng-model="remark" placeholder="Remark" rows="5" cols="50" style="resize: none;"></textarea>
                </div>';
            echo '<input type="hidden" id="po_id_' . $i . '" class="form-control" value="' . $result[$i]['po_id'] . '">';

            echo'<div class="col-lg-12 col-xs-12 col-sm-12 w3-center" id="materialWeight" style="padding-top: 23px;">
                    <button type="button" title="filter Po by date" id="btnsubmit" onclick="submitStatus(' . $i . ');" class="w3-medium w3-button theme_bg">Change Status</button>
                </div>';
            echo'</div>
                </fieldset>';
        }
    }

    public function updateGradeDetails() {
        extract($_GET);
        $result = $this->Rawmaterial_required_model->updateGradeDetails($selected_grade, $remaining_weight);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Material Inventory Updated successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Material Inventory Not Updated successfully.
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

    public function submitStatus() {
        extract($_GET);
        $result = $this->Rawmaterial_required_model->submitStatus($po_id, $remark, $remarkType);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Remark Added TO This Purchase Order Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Remark Not Added TO This Purchase Order successfully.
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
