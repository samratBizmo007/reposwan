<?php

class Shared_PO extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('sharedpo_model/SharedPO_model');
        $this->load->model('material_model/Material_model');
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
        //$data['products'] = Showinventory::getAllProductDetails();     //-------show all materials
        //$data['customers'] = Showinventory::getAllCustomerNames();     //-------show all materials
        $this->load->view('includes/header');
        $this->load->view('pages/sharing/shared');
        $this->load->view('includes/footer');
    }

    public function getSharedPo() {
        extract($_GET);
        $result = $this->SharedPO_model->getSharedPo($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getPurchaseOrdersDetails() {
        extract($_GET);
        $result = $this->SharedPO_model->getPurchaseOrdersDetails();
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getSharedPoDetails() {
        extract($_GET);
        $result = $this->SharedPO_model->getSharedPoDetails($from_date, $to_date);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result));
        }
    }

    public function getUpdatePoForSharedQuantityDetails() {
        extract($_GET);
//        $p_code = '';
//        $p_id = '';
        $podetails = explode('/', $sharedpo_orders);
        $p_code = $podetails[0];
        $p_id = $podetails[1];
        //print_r($podetails);
        $result = $this->Rawmaterial_required_model->getPoProductDetails($p_code, $p_id);
        //print_r($result);
        $stock = $this->Rawmaterial_required_model->getSubProductDetails($p_code, $p_id);

        $materialCategories = $this->Material_model->getAllMaterialCategories();
        $total = 0;
        $material_quantity = 0;
        $Po_ProductQuantity = 0;
        $stockQuantity = 0;
        //print_r($result);die();
        for ($i = 0; $i < count($result); $i++) {

            echo '<div class="w3-margin-bottom "><fieldset>
            <div class="row w3-padding" style="margin-top: 5px; margin-bottom: 5px;">';
            // print_r($stock[0]['subproduct_quantity']);
            echo'<div class="w3-padding">
            Customer Name: <b class="w3-text-black">' . $result[$i]['customer_name'] . '</b>
            </div><br>';

            //echo '';
            echo'<div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom">
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                    Drawing no : <b class="w3-text-black">' . $result[$i]['part_drwing_no'] . '</b> 
                </div>
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                    Revision No : <b class="w3-text-black">' . $result[$i]['revision_no'] . '</b> 
                </div>
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                   P.O Product Quantity : <b class="w3-text-black">' . $result[$i]['quantity'] . '</b> 
                </div>
                <div class=" w3-col l3 col-xs-12 col-sm-12">
                    Stock Quantity : <b class="w3-text-black">' . $stock[0]['subproduct_quantity'] . '</b> 
                </div>
            </div>';
            $materialDetails = json_decode($result[$i]['material_details'], true);
            echo'<div class="w3-col l12 col-xs-12 col-sm-12">'
            . '<div class="w3-col l4 col-xs-12 col-sm-12">'
            . '<label>Shared Product Quantity</label>'
            . '<input type="number" name="sharedQuantity" ng-model="sharedQuantity" id="sharedQuantity" value="' . $result[$i]['shared_product_quantity'] . '" class="form-control" placeholder="Shared Product Quantity" required>'
            . '</div>'
            . '<div class="w3-col l8 w3-right col-xs-12 col-sm-12" style="padding-top: 23px;">'
            . '<button  type="submit" title="filter Po by date" id="btnsubmit" onclick="updateSharedQuantity(' . $result[$i]['po_id'] . ');" class="w3-medium w3-button theme_bg">Add Shared Product Quantity</button>'
            . '</div>'
            . '</div>';

            echo'</div>'
            . '</fieldset>'
            . '</div>';
        }
    }

    public function updateSharedQuantity() {
        extract($_GET);
        $result = $this->SharedPO_model->updateSharedQuantity($sharedQuantity, $po_id);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Shared Product Quantity Updated successfully.
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
			<strong>Warning!</strong> Shared Product Quantity Not Updated successfully.
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
