<?php

class Showinventory extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');
        $this->load->model('inventory_model/Inventory_model');

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
        $data['products'] = Showinventory::getAllProductDetails();     //-------show all materials
        $data['customers'] = Showinventory::getAllCustomerNames();     //-------show all materials
        $this->load->view('includes/header');
        $this->load->view('pages/inventory/show_inventory', $data);
        $this->load->view('includes/footer');
    }

//------------ get all material details ----------------------------------//
    public function getAllMaterialDetails() {
        $path = base_url();
        $url = $path . 'api/Material_api/getAllMaterialDetails';
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

//------------ get all material details ends----------------------------------//
    //------------ get all material details ----------------------------------//
    public function getAllProductDetails() {
        $path = base_url();
        $url = $path . 'api/Material_api/getAllProductDetails';
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

//------------ get all material details ends----------------------------------//
    public function getMaterialCategory() {
        $path = base_url();
        $url = $path . 'api/Material_api/getAllMaterialCategories';
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

    public function getMaterialDetailsByType() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/Material_api/getMaterialDetailsByType?mat_cat_id=' . $mat_cat_id;
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

    public function getAllCustomerNames() {
        $result = $this->Inventory_model->getAllCustomerNames();
        return $result;
    }

    public function updateMaterialDetails() {
//        extract($_POST);
//        $data = $_POST;
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, TRUE);
        //$request = $data;
        //print_r($request);
        //die();
        $result = $this->Inventory_model->updateMaterialDetails($request);
        if ($result) {
            echo '200';
        } else {
            echo '500';
        }
    }

    public function getProducts() {
        extract($_POST);
        $data = $_POST;
        $result = $this->Inventory_model->getProducts($data);
        //return $result;

        if ($result) {
            foreach ($result as $val) {
                $type = 'REGULAR';
                if ($val['prod_type'] == '1') {
                    $type = 'EX-STOCK';
                }
                echo'<tr id="rowCount">
                    <td class="w3-center">' . $val['customer_name'] . '</td>
                    <td class="w3-center">' . $val['product_name'] . '</td>
                    <td class="w3-center">';
                echo $type;
                if ($val['prod_type'] != '0') {
                    echo '<br>(' . $val['stock_plant'] . ')';
                }
                echo'</td>';

                echo'<td class="w3-center">';
                foreach (json_decode($val['sr_item_code'], true) as $key) {
                    echo '<div class="w3-center">' . $key['item_code'] . '</div>';
                }
                echo'<td class="w3-center">' . $val['drawing_no'] . '</td>
                                                <td class="w3-center">
                                                    <input type="number" class="form-control w3-center" id="product_quantity_' . $val['prod_id'] . '" value="' . $val['product_quantity'] . '">
                                                </td>
                                                <td class="w3-center">' . $val['added_date'] . '</td>
                                                <td class="w3-center">
                                                    <a class="btn w3-block w3-text-green w3-padding-small" onclick="updateProductDetails(' . $val['prod_id'] . ');" title="Update Product Details">
                                                        Update
                                                    </a>
                                                </td>
                </tr>';
            }
        } else {
            echo'<tr>
                <td class="w3-center" colspan="6">No Records Found..!</td>
            </tr>';
        }
    }

    public function updateProductDetails() {
        extract($_POST);
        $result = $this->Inventory_model->updateProductDetails($product_quantity, $prod_id);
        if ($result) {
            echo '200';
        } else {
            echo '500';
        }
    }

}
