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

    public function getMaterialInfoByName() {
        extract($_GET);
        $this->load->model('material_model/Material_model');
        $result = $this->Material_model->getMaterialDetailsByName($material_grade);
        print_r(json_encode($result));
    }

    public function getMaterialInfoByThickness() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/Material_api/getMaterialInfoByThickness?material_thickness=' . $material_thickness;
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
        //print_r($result);die();

        if ($result) {
            for ($i = 0; $i < count($result); $i++) {

//$this->load->model('inventory_model/Inventory_model');
                $subProducts = $this->Inventory_model->SubProductDetails($result[$i]['sub_products']);


                $type = 'REGULAR';
                if ($result[$i]['prod_type'] == '1') {
                    $type = 'EX-STOCK';
                }
                echo'<tr id="rowCount">
                    <td class="w3-center">' . $result[$i]['customer_name'] . '</td>
                    <td class="w3-center">' . $result[$i]['product_name'] . '</td>
                    <td class="w3-center">';
                echo $type;
                if ($result[$i]['prod_type'] != '0') {
                    echo '<br>(' . $result[$i]['stock_plant'] . ')';
                }
                echo'</td>';
                echo'<td class="w3-center">' . $result[$i]['drawing_no'] . '</td>
                                                <td class="w3-center">
                                                    <input type="number" class="form-control w3-center" id="production_quantity_' . $result[$i]['prod_id'] . '" onkeyup="getTotalQuantity(' . $result[$i]['prod_id'] . ');" value="' . $result[$i]['production_quantity'] . '">
                                                </td>
                                                <td class="w3-center">
                                                    <input type="number" class="form-control w3-center" id="dispatched_quantity_' . $result[$i]['prod_id'] . '" onkeyup="getTotalQuantity(' . $result[$i]['prod_id'] . ');" value="' . $result[$i]['dispatched'] . '">
                                                </td>
                                                <td class="w3-center">
                                                    <input type="number" class="form-control w3-center" id="total_quantity_' . $result[$i]['prod_id'] . '" value="' . $result[$i]['total_quantity'] . '">
                                                </td>
                                                <td class="w3-center">' . $result[$i]['modified_date'] . '</td>
                                                <td class="w3-center">
                                                    <button type="button" class="btn sub" onclick="showSubproducts(' . $result[$i]['prod_id'] . ')"> Sub-Products <span class=" fa fa-chevron-down"></span></button></td>
                <td class="w3-center">
                    <a class="btn w3-block w3-text-green w3-padding-small" onclick="updateProductDetails(' . $result[$i]['prod_id'] . ');" title="Update Product Details">
        Update
    </a>
</td>
</tr>';
                echo'<tr id="collapseme_' . $result[$i]['prod_id'] . '" class="collapse out">
                                                <td colspan="10">
                                                    <div>
                                                        <table class="table table-responsive">
                                                            <thead>
                                                                <tr class="theme_bg">
                                                                    <th class="text-center">
                                                                        Drawing No
                                                                    </th>
                                                                    <th class="text-center">
                                                                        S.R No
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Product Code
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Packing Qty / Tray
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Net Finished Weight
                                                                    </th>
                                                                    <th class="text-center">
                                                                        SubProduct Prodn Quantity
</th>
<th class = "text-center">
Dispatched Quantity
</th>
<th class = "text-center">
Total Quantity
</th>

<th class = "text-center">
Action
</th>
</tr>
</thead>
<tbody>';
                for ($j = 0; $j < count($subProducts); $j++) {

                    echo'<tr>
                        <td class = "w3-center">' . $result[$i]['drawing_no'] . '</td>
                        <td class="w3-center">' . $subProducts[$j][0]['sr_no'] . '</td>
                        <td class="w3-center">' . $subProducts[$j][0]['part_code'] . '</td>
                        <td class="w3-center">' . $subProducts[$j][0]['packing_qty_per_tray'] . '</td>
                        <td class="w3-center">' . $subProducts[$j][0]['finished_weight'] . '</td>
                        <td class="w3-center">
                            <input type="number" class="form-control w3-center" id="subProduct_Qty_' . $subProducts[$j][0]['p_id'] . '" onkeyup="getTotalSubproductQuantity(' . $subProducts[$j][0]['p_id'] . ');" value="' . $subProducts[$j][0]['subproduct_quantity'] . '">
                        </td>
                        <td class="w3-center">
                            <input type="number" class="form-control w3-center" id="subProduct_DispatchQty_' . $subProducts[$j][0]['p_id'] . '" onkeyup="getTotalSubproductQuantity(' . $subProducts[$j][0]['p_id'] . ');" value="' . $subProducts[$j][0]['sub_dispatched_qty'] . '">
                        </td>
                        <td class="w3-center">
                            <input type="number" class="form-control w3-center" readonly id="totalSub_Product_' . $subProducts[$j][0]['p_id'] . '" value="' . $subProducts[$j][0]['total_qty'] . '">
                        </td>
                        <td class="w3-center">
                            <a class="btn w3-block w3-text-green w3-padding-small" onclick="updateSubProductDetails(' . $subProducts[$j][0]['p_id'] . ');" title="Update Product Details">
            Update
        </a>
    </td>
</tr>';
                }
                echo'</tbody>
                </table>
                </div>
               </td>';
            }
        } else {
            echo'<tr>
    <td class="w3-center" colspan="10">No Records Found..!</td>
</tr>';
        }
    }

    public function updateProductDetails() {
        extract($_POST);
//print_r($_POST);die();
        $result = $this->Inventory_model->updateProductDetails($production_quantity, $dispatched_quantity, $total_quantity, $prod_id);
        if ($result) {
            echo '200';
        } else {
            echo '500';
        }
    }

    public function updateSubProductDetails() {
        extract($_POST);
        $result = $this->Inventory_model->updateSubProductDetails($subProduct_Qty, $subProduct_DispatchQty, $totalSub_Product, $p_id);
        if ($result) {
            echo '200';
        } else {
            echo '500';
        }
    }

    public function getTotalQuantity() {
        extract($_POST);
        $total_quantity = '';
        if ($production_quantity == 0) {
            $total_quantity = $production_quantity;
        } elseif ($production_quantity != 0) {
            $total_quantity = $production_quantity - $dispatched_quantity;
        }
        echo $total_quantity;
    }

    public function getTotalSubproductQuantity() {
        extract($_POST);
        $totalSubProductQuantity = '';
        if ($subProduct_Qty == 0) {
            $totalSubProductQuantity = $subProduct_Qty;
        } elseif ($subProduct_Qty != 0) {
            $totalSubProductQuantity = $subProduct_Qty - $subProduct_DispatchQty;
        }
        echo $totalSubProductQuantity;
    }

}
