<?php

class Po_order extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        //$this->load->model('employee_model/Employee_model');

        $this->load->model('po_model/Po_model');
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
        $this->load->view('pages/po_order/po_order');
        $this->load->view('includes/footer');
    }

    //------------fun for get the all customer name -----------------------//
    public function getAllCustomerName() {
//echo "string"; die();
        $path = base_url();
        $url = $path . 'api/Po_api/getAllCustomerName';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        print_r($response_json);
    }

    public function getCustomerProducts() {
        //print_r(json_encode($_GET));
        extract($_GET);

        if ($customer_name == '? undefined:undefined ?') {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please select Customer name first.
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

        $result = $this->Po_model->getCustomerProducts($customer_name);
        echo json_encode($result);
    }

//---------------get product name by part no-----------------------------------------------------------// 
    public function getProductInfo() {
        extract($_GET);

        if ($part_no == '? undefined:undefined ?') {
            echo '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Warning!</strong> Please select part or Diagram No first.
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
        $result = $this->Po_model->getProductInfo($part_no);
        print_r(json_encode($result[0]));
    }

//---------------get product name by part no ends-----------------------------------------------------------// 
//---------------get product name by part no and rev no---------------------------------------------------------// 

    public function getDetailedProductInfo() {
        extract($_GET);
        $result = $this->Po_model->getDetailedProductInfo($part_no, $rev_no);
        if (!$result) {
            echo '500';
        } else {
            print_r(json_encode($result[0]));
        }
    }

    public function getNetAmount() {
        extract($_GET);
        $net_amount = '';
        //echo $unit_rate;
        //echo $quantity;
        if ($quantity == '0') {
            $net_amount = $unit_rate;
        } else {
            $net_amount = $unit_rate * $quantity;
        }
        echo $net_amount;
    }

//---------------get product name by part no and rev no---------------------------------------------------------// 
    public function addPurchaseOrder() {
        extract($_POST);
//        print_r($_POST);
//        die();
        //$material_Arr = array();
        $product_arr = array();
        $total = 0;
        for ($i = 0; $i < count($part_drwing_no); $i++) {
            $product_arr[] = array(
                'prod_id' => $prod_id[$i],
                'line_no' => $line_no[$i],
                'part_drwing_no' => $part_drwing_no[$i],
                'product_name' => $product_name[$i],
                'revision_no' => $revision_no[$i],
                'sr_no' => $sr_no[$i],
                'product_code' => $product_code[$i],
                'unit_rate' => $unit_rate[$i],
                'quantity' => $quantity[$i],
                'netAmount' => $netAmount[$i],
                'due_date' => $due_date[$i]
            );
            $total = $netAmount[$i] + $total;
        }
        //$prods_arr = json_encode($product_arr);
        $data['product_details'] = json_encode($product_arr);
        $data['customer_name'] = $customer_name;
        $data['order_no'] = $order_no;
        $data['po_duedate'] = $po_duedate;
        $data['total'] = $total;
        //print_r($data);
        //die();
        $result = $this->Po_model->addPurchaseOrder($data);
        if ($result) {
            echo '200';
        } else {
            echo '500';
        }
    }

}
