<?php

class Allmaterial extends CI_controller {

    public function __construct() {
        parent::__construct();
        //start session     
        $admin_name = $this->session->userdata('admin_name');

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
        $data['details'] = Allmaterial::getAllMaterialDetails();     //-------show all materials
        $data['material_type'] = Allmaterial::getAllMaterialCategories();     //-------show all materials
        $this->load->view('includes/header');
        $this->load->view('pages/material/all_material', $data);
        $this->load->view('includes/footer');
    }

    //------------fun for get the all material categories -----------------------//
    public function getAllMaterialCategories() {
//echo "string"; die();
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
        //print_r($response_json);die();
        return $response;
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
        return $response;
    }

//------------ get all material details ends----------------------------------//
//=-----------fun for update material details----------------------------//
    public function updateMaterialDetails() {
        extract($_POST);
        $data = $_POST;
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Material_api/updateMaterialDetails';
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

//=-----------fun for update material details ends----------------------------//    
//--------------fun for delete material------------------------------//
    public function deleteMaterialDetails() {
        extract($_POST);
//        echo $material_id;
//        die();
        $path = base_url();
        $url = $path . 'api/Material_api/deleteMaterialDetails?material_id=' . $material_id;
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

//--------------fun for delete material ends------------------------------//
    public function getMaterialdetails() {
        extract($_POST);
        $path = base_url();
        $url = $path . 'api/Material_api/getMaterialdetails?mat_cat_id=' . $mat_cat_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        //print_r($details);
        if ($response['status'] == 200) {
            $i = 1;
            foreach ($response['status_message'] as $val) {
                //print_r($val);

                echo'<tr id="rowCount">
                    <td class="w3-center">' . $i . '</td>
                    <td class="w3-center">' . $val['material_type'] . '</td>
                    <td class="w3-center">' . $val['material_grade'] . '</td>
                    <td class="w3-center">' . $val['material_rate'] . '</td>
                    <td class="w3-center">' . $val['material_weight'] . '</td>
                    <td class="w3-center">
                        <a class="btn w3-padding-small" data-toggle="modal" data-target="#updateMaterialModal_' . $val['material_id'] . '" title="Update Material Details">
                            <i class="w3-text-green w3-large fa fa-edit"></i>
                        </a>                   
                        <a class="btn w3-padding-small" onclick="deleteMaterialDetails(' . $val['material_id'] . ')" title="Delete Material">
                            <i class="w3-text-red w3-large fa fa-trash"></i>
                        </a>
                    </td>
                    <!-- Modal -->
                <div id="updateMaterialModal_' . $val['material_id'] . '" class="modal" role="dialog">
                    <form id="updateMaterialForm_' . $val['material_id'] . '" name="updateMaterialForm_' . $val['material_id'] . '">
                        <div class="modal-dialog modal-lg">
                            <!----------------------------------- Modal content------------------------------------>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update Material Details</h4>
                                </div>
                                <!----------------------------------- Modal Body------------------------------------>                                        
                                <div class="modal-body">
                                    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
                                        <fieldset>
                                            <div class="row" style=" margin-top: 5px;">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-10">
                                                    <div class="" id="App">
                                                        <div class="w3-col l12"></div>
                                                        <div class="w3-col l12 w3-margin-bottom">
                                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialCategoryDiv">
                                                                <label>Material Type <b class="w3-text-red w3-medium">*</b></label>
                                                                <input type="text" name="mat_category" id="mat_category"  class="form-control" placeholder="Material Type" disabled value="' . $val['material_type'] . '" required>
                                                                <input type="hidden" name="mat_cat_id" id="mat_cat_id" value="' . $val['mat_cat_id'] . '" required>
                                                                <input type="hidden" name="material_id" id="material_id" value="' . $val['material_id'] . '" required>
                                                            </div>
                                                        </div>
                                                        <div class="w3-col l12 w3-margin-bottom">
                                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialGrade">
                                                                <label>Material Grade <b class="w3-text-red w3-medium">*</b></label>
                                                                <input type="text" name="material_grade" disabled id="material_grade"  class="form-control" placeholder="Material Grade" value="' . $val['material_grade'] . '" required>
                                                            </div>
                                                        </div>
                                                        <div class="w3-col l12 w3-margin-bottom">
                                                            <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">										
                                                                <label>Material Rate <b class="w3-text-red w3-medium">*</b></label>
                                                                <input type="number" name="material_rate" value="' . $val['material_rate'] . '" id="material_rate" min="0" step="0.01" class="form-control" placeholder="Material Rate" required>
                                                            </div>
                                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                                                <label>Material Weight <b class="w3-text-red w3-medium">*</b></label>
                                                                <input type="number" name="material_weight" value="' . $val['material_weight'] . '" id="material_weight" min="0" step="0.01" class="form-control" placeholder="Material Weight" required>
                                                            </div>											                           
                                                        </div>
                                                        <div class="w3-col l12 w3-margin-bottom">
                                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                                <label>Remark</label>
                                                                <textarea  class="form-control" name="remark" id="remark" placeholder="Remark" rows="5" cols="50" style="resize: none;">' . $val['remark'] . '</textarea>
                                                            </div>
                                                        </div>';
                switch ($val['mat_cat_id']) {
                    case '1':
                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                            <label>Thickness <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="thickness" value="' . $val['thickness'] . '" min="0" step="0.01" id="thickness" class="form-control" placeholder="Material Thickness" required>
                                                                        </div>
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                            <label>Sheet Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="quantity" value="' . $val['quantity'] . '" min="0" step="0.01" id="quantity" class="form-control" placeholder="Sheet Quantity" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                    case '2':
                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                            <label>Diameter <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="diameter" value="' . $val['diameter'] . '" id="diameter" min="0" step="0.01" class="form-control" placeholder="Material Diameter" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                    case '3':

                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Thickness <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="thickness" value="' . $val['thickness'] . '" id="thickness" min="0" step="0.01" class="form-control" placeholder="Material Thickness" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Circle Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="quantity" value="' . $val['quantity'] . '" min="0" step="0.01" id="quantity" class="form-control" placeholder="Quantity" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Drawing No <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="Diagram_no" value="' . $val['diagram_no'] . '" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Drawing No" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                    case '4':

                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>ID <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="id" value="' . $val['id'] . '" id="id" class="form-control" min="0" step="0.01" placeholder="ID" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>OD <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="od" id="od" value="' . $val['od'] . '" class="form-control" min="0" step="0.01" placeholder="OD" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Length <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="length" value="' . $val['length'] . '" id="length" min="0" step="0.01" class="form-control" placeholder="Length" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                    case '5':
                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                            <label>OD <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="od" value="' . $val['od'] . '" id="od" min="0" step="0.01" class="form-control" placeholder="OD" required>
                                                                        </div>
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                            <label>Length <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="length" value="' . $val['length'] . '" id="length" min="0" step="0.01" class="form-control" placeholder="Length" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                    case '6':
                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>ID <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="id" value="' . $val['id'] . '" id="id" class="form-control" min="0" step="0.01" placeholder="ID" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Pitch <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="pitching" value="' . $val['pitching'] . '" id="pitching" min="0" step="0.01" class="form-control" placeholder="Pitch" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="quantity" value="' . $val['quantity'] . '" id="quantity" min="0" step="0.01" class="form-control" placeholder="Quantity" required>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12 w3-margin-top">
                                                                            <label>Drawing No <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="Diagram_no" value="' . $val['diagram_no'] . '" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Drawing No" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                    case '7':
                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>OD <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="od" value="' . $val['od'] . '" id="od" class="form-control" min="0" step="0.01" placeholder="OD" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Pitch <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="pitching" value="' . $val['pitching'] . '" id="pitching" min="0" step="0.01" class="form-control" placeholder="Pitch" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="quantity" value="' . $val['quantity'] . '" id="quantity" min="0" step="0.01" class="form-control" placeholder="Quantity" required>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12 w3-margin-top">
                                                                            <label>Drawing No <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="Diagram_no" value="' . $val['diagram_no'] . '" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Drawing No" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                    case '8':

                        echo'<div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                    <div class="w3-col l12">
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>ID <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="id" value="' . $val['id'] . '" id="id" class="form-control" min="0" step="0.01" placeholder="ID" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Pitch <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="pitching" value="' . $val['pitching'] . '" id="pitching" min="0" step="0.01" class="form-control" placeholder="Pitch" required>
                                                                        </div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                            <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="quantity" value="' . $val['quantity'] . '" id="quantity" min="0" step="0.01" class="form-control" placeholder="Quantity" required>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="col-lg-4 col-xs-12 col-sm-12 w3-margin-top">
                                                                            <label>Drawing No <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="Diagram_no" value="' . $val['diagram_no'] . '" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Drawing No" required>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                        break;
                }

                echo'<div class=" w3-center w3-col l12" style="">
                                                                    <button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Update Material</button>
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
                        </div>
                        <!-------script for update material-->
                        <script type="text/javascript">
                            $(function () {
                                $("#updateMaterialForm_' . $val['material_id'] . '").submit(function (e) {
                                    e.preventDefault();
                                    dataString = $("#updateMaterialForm_' . $val['material_id'] . '").serialize();
                                    $.ajax({
                                        type: "POST",
                                        url: "' . base_url() . 'materials/allmaterial/updateMaterialDetails",
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
</script>
<!-------script for update material-->
<!-- Modal Ends Here-->
</tr>';
                $i++;
            }
        } else {
            echo '<tr> <td colspan="6" class="w3-center">No Records Found..!</td></tr>';
        }
    }

}
