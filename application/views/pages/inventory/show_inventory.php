<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-list"></i> Inventory</h3>
            </div>
        </div>
        <div class="row clearfix" style=" margin-top: 5px;">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a id="mat" class="btn" onclick="changecolor(1)" href="#rawMaterials" data-toggle="tab"><i class="fa fa-cubes"></i>  Raw Materials</a></li>
                    <li ><a class="btn" id="prod" href="#finishedProducts" onclick="changecolor(2)" data-toggle="tab"><i class="fa fa-cube"></i> Products</a></li>
                </ul>
            </div>
            <div class="tab-content clearfix" ><br><!-- tab containt starts -->

                <div class="tab-pane active" id="rawMaterials" ng-app="showInventoryApp" ng-controller="showInventoryController">  
                    <div class="row x_title" style=" margin-top: 15px;">
                        <div class="w3-padding-small w3-margin-top">
                            <h4>Find Material By Material Type </h4>                
                        </div>
                        <div class="w3-col l12 w3-margin-bottom">
                            <div class="col-lg-4 col-xs-12 col-sm-12" id="">
                                <label>Material Name/ Grade :</label>
                                <input type="text" name="material_grade" ng-model="material_grade" id="material_grade" ng-keyup="getMaterialInfoByName();" class="form-control" placeholder="Material Name/ Grade" >
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12" id="materialWeight">
                                <label>Material Thickness (in mm) :</label>
                                <input type="text" name="material_thickness" ng-model="material_thickness" id="material_thickness" ng-keyup="getMaterialInfoByThickness();" class="form-control" placeholder="Thickness (mm)" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <table class="table table-responsive" id="tab_logic">
                                <thead>
                                    <tr class="theme_bg w3-small">
                                        <th class="text-center">
                                            Sr.no
                                        </th>
                                        <th class="text-center">
                                            Type
                                        </th>
                                        <th class="text-center">
                                            Grade
                                        </th>
                                        <th class="text-center">
                                            Rate
                                        </th>
                                        <th class="text-center">
                                            Weight
                                        </th>                           
                                        <th class="text-center">
                                            Quantity
                                        </th>
                                        <th class="text-center">
                                            Length
                                        </th>
                                        <th class="text-center">
                                            I.D
                                        </th>
                                        <th class="text-center">
                                            O.D
                                        </th>
                                        <th class="text-center">
                                            Pitch
                                        </th>
                                        <th class="text-center">
                                            Dig.no
                                        </th>
                                        <th class="text-center">
                                            Thickness
                                        </th>
                                        <th class="text-center">
                                            Diameter
                                        </th>
                                        <th class="text-center">
                                            Remaining Weight
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id='addedRows'>
                                    <tr class="w3-small" id="rowCount" ng-if="materials['status'] == 200" ng-repeat=" m in materials['status_message']">
                                        <td class="w3-center" width="4%">{{$index + 1}}</td>
                                        <td class="w3-center" width="7%">{{ m.material_type}}</td>
                                        <td class="w3-center" width="7%">{{ m.material_grade}}</td>
                                        <td class="w3-center"width="7%">{{ m.material_rate}}</td>
                                        <td class="w3-center" width="10%">
                                            <input type="number" min="0" id="weight_{{m.material_id}}" class="form-control w3-center" value="{{ m.material_weight}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="quantity_{{m.material_id}}" class="form-control w3-center" value="{{ m.quantity}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="length_{{m.material_id}}" class="form-control w3-center" value="{{ m.length}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="id_{{m.material_id}}" class="form-control w3-center" value="{{ m.id}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="od_{{m.material_id}}" class="form-control w3-center" value="{{ m.od}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="pitching_{{m.material_id}}" class="form-control w3-center" value="{{ m.pitching}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="diagram_no_{{m.material_id}}" class="form-control w3-center" value="{{ m.diagram_no}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="thickness_{{m.material_id}}" class="form-control w3-center" value="{{ m.thickness}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="number" min="0" id="diameter_{{m.material_id}}" class="form-control w3-center" value="{{ m.diameter}}">
                                        </td>
                                        <td class="w3-center" width="15%">
                                            <input type="number" min="0" id="remark_{{m.material_id}}" class="form-control w3-center" value="{{ m.remaining_weight}}">
                                        </td>
<!--                                        <td class="w3-center">{{ m.added_date}}</td>
    <td class="w3-center">{{ m.modified_date}}</td>-->
    <td class="w3-center">
        <a class="btn w3-block w3-text-green w3-padding-small" ng-click="updateMaterialDetails(m.material_id)" title="Update Material Details">
            Update
        </a>
    </td>
</tr>
<tr ng-if="materials['status'] == 500">
    <td class="w3-center" colspan="15">No Records Found..!</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="" ng-bind-html="message"></div>

</div>
<div class="tab-pane" id="finishedProducts"><!-- tab 2 starts here -->
    <div class="row x_title" style=" margin-top: 15px;">
        <div class="w3-padding-small w3-margin-top">
            <h4>Find Products</h4>                
        </div>
        <div class="w3-col l12 w3-margin-bottom">
            <div class="col-lg-5 col-xs-12 col-sm-12" id="materialWeight">
                <label>Customer Names <b class="w3-text-red w3-medium">*</b></label>
                <select class="form-control" id="customerName" name="customerName" onchange="getProducts();" required>
                    <option value="all">All</option>
                    <?php foreach ($customers as $key) { ?>
                        <option value="<?php echo $key['customer_name']; ?>"><?php echo $key['customer_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-lg-5 col-xs-12 col-sm-12" id="materialWeight">
                <label>Product Type <b class="w3-text-red w3-medium">*</b></label>
                <select name="prod_type" class="form-control" onchange="getProducts();" id="prod_type">
                    <option value="all" class="w3-text-grey" selected>All</option>
                    <option value="0" class="w3-text-grey">REGULAR</option>
                    <option value="1" class="w3-text-grey">EX-STOCK</option>
                </select>
            </div>
                            <!--                            <div class="col-lg-2 col-xs-12 col-sm-12" id="materialWeight" style="padding-top: 23px;">
                                                            <button  type="submit" title="filter by cusomer name and product type" id="btnsubmit" class="w3-medium w3-button theme_bg">Search Products</button>
                                                        </div>-->
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                                        <table class="table table-responsive">
                                                            <thead>
                                                                <tr class="theme_bg">
                                                                    <th class="text-center">
                                                                        Customer name
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Product Name
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Product Type
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Drawing no
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Production Quantity
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Dispatched Quantity
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Total Quantity
                                                                    </th>
                                                                    <th class="text-center">
                                                                        modified date
                                                                    </th>
                                                                    <th class="text-center">
                                                                        See SubProducts
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Action
                                                                    </th>                                          
                                                                </tr>
                                                            </thead>
                                                            <tbody id='productaddedRows'>
                                                                <?php
                                    // print_r($products);
                                    //die();
                                                                if ($products['status'] == 200) {
                                                                    for ($i = 0; $i < count($products['status_message']); $i++) {
                                                                        $this->load->model('inventory_model/Inventory_model');
                                                                        $result = $this->Inventory_model->SubProductDetails($products['status_message'][$i]['sub_products']);
                                            //print_r($result);
                                                                        $type = 'REGULAR';
                                                                        if ($products['status_message'][$i]['prod_type'] == '1') {
                                                                            $type = 'EX-STOCK';
                                                                        }
                                                                        ?>
                                                                        <tr id="rowCount">
                                                                            <td class="w3-center"><?php echo $products['status_message'][$i]['customer_name']; ?></td>
                                                                            <td class="w3-center"><?php echo $products['status_message'][$i]['product_name']; ?></td>
                                                                            <td class="w3-center"><?php
                                                                            echo $type;
                                                                            if ($products['status_message'][$i]['prod_type'] != '0') {
                                                                                echo '<br>(' . $products['status_message'][$i]['stock_plant'] . ')';
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td class="w3-center"><?php echo $products['status_message'][$i]['drawing_no']; ?></td>
                                                                        <td class="w3-center">
                                                                            <input type="number" min="0" class="form-control w3-center" id="production_quantity_<?php echo $products['status_message'][$i]['prod_id'] ?>" onkeyup="getTotalQuantity(<?php echo $products['status_message'][$i]['prod_id'] ?>);" value="<?php echo $products['status_message'][$i]['production_quantity'] ?>">
                                                                        </td>
                                                                        <td class="w3-center">
                                                                            <input type="number" min="0" class="form-control w3-center" id="dispatched_quantity_<?php echo $products['status_message'][$i]['prod_id'] ?>" onkeyup="getTotalQuantity(<?php echo $products['status_message'][$i]['prod_id'] ?>);" value="<?php echo $products['status_message'][$i]['dispatched'] ?>">
                                                                        </td>
                                                                        <td class="w3-center">
                                                                            <input type="number" min="0" class="form-control w3-center" readonly id="total_quantity_<?php echo $products['status_message'][$i]['prod_id'] ?>" value="<?php echo $products['status_message'][$i]['total_quantity'] ?>">
                                                                        </td>
                                                                        <td class="w3-center"><?php echo $products['status_message'][$i]['modified_date']; ?></td>
                                                                        <td class="w3-center">
                                                                            <button type="button" class="btn sub" onclick="showSubproducts(<?php echo $products['status_message'][$i]['prod_id']; ?>);">Sub-Products<span class=" fa fa-chevron-down"></span></button>
                                                                        </td>
                                                                        <td class="w3-center">
                                                                            <a class="btn w3-block w3-text-green w3-padding-small" onclick="updateProductDetails(<?php echo $products['status_message'][$i]['prod_id']; ?>);" title="Update Product Details">
                                                                                Update
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr id="collapseme_<?php echo $products['status_message'][$i]['prod_id']; ?>" class="collapse out">
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
                                                                                                SubProduct Prod'n Quantity
                                                                                            </th>
                                                                                            <th class="text-center">
                                                                                                Dispatched Quantity
                                                                                            </th>
                                                                                            <th class="text-center">
                                                                                                Total Quantity
                                                                                            </th>

                                                                                            <th class="text-center">
                                                                                                Action
                                                                                            </th>                                          
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php for ($j = 0; $j < count($result); $j++) { ?>
                                                                                            <tr>
                                                                                                <td class="w3-center"><?php echo $products['status_message'][$i]['drawing_no']; ?></td>
                                                                                                <td class="w3-center"><?php echo $result[$j][0]['sr_no']; ?></td>
                                                                                                <td class="w3-center"><?php echo $result[$j][0]['part_code']; ?></td>
                                                                                                <td class="w3-center"><?php echo $result[$j][0]['packing_qty_per_tray']; ?></td>
                                                                                                <td class="w3-center"><?php echo $result[$j][0]['finished_weight']; ?></td>
                                                                                                <td class="w3-center">
                                                                                                    <input type="number" min="0" class="form-control w3-center" id="subProduct_Qty_<?php echo $result[$j][0]['p_id']; ?>" onkeyup="getTotalSubproductQuantity(<?php echo $result[$j][0]['p_id']; ?>);" value="<?php echo $result[$j][0]['subproduct_quantity']; ?>">
                                                                                                </td>
                                                                                                <td class="w3-center">
                                                                                                    <input type="number" min="0" class="form-control w3-center" id="subProduct_DispatchQty_<?php echo $result[$j][0]['p_id']; ?>" onkeyup="getTotalSubproductQuantity(<?php echo $result[$j][0]['p_id']; ?>);" value="<?php echo $result[$j][0]['sub_dispatched_qty']; ?>">
                                                                                                </td>
                                                                                                <td class="w3-center">
                                                                                                    <input type="number" min="0" class="form-control w3-center" readonly id="totalSub_Product_<?php echo $result[$j][0]['p_id']; ?>" value="<?php echo $result[$j][0]['total_qty']; ?>">
                                                                                                </td>
                                                                                                <td class="w3-center">
                                                                                                    <a class="btn w3-block w3-text-green w3-padding-small" onclick="updateSubProductDetails(<?php echo $result[$j][0]['p_id']; ?>);" title="Update Product Details">
                                                                                                        Update
                                                                                                    </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td class="w3-center" colspan="10">No Records Found..!</td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="w3-col l12" id="messageDiv"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function showSubproducts(prod_id) {
        //alert(prod_id);
        if ($("#collapseme_" + prod_id).hasClass("out")) {
            $("#collapseme_" + prod_id).addClass("in");
            $("#collapseme_" + prod_id).removeClass("out");
        } else {
            $("#collapseme_" + prod_id).addClass("out");
            $("#collapseme_" + prod_id).removeClass("in");
        }
    }

    function changecolor(btn) {
        if (btn == 1) {
            $("#prod").css("background-color", "#fff");
            $("#prod").css("color", "black");
            $("#mat").css("color", "#ECF0F1");
            $("#mat").css("background-color", "#2A3F54");
        }
        if (btn == 2) {
            $("#mat").css("background-color", "#fff");
            $("#mat").css("color", "black");
            $("#prod").css("color", "#ECF0F1");
            $("#prod").css("background-color", "#2A3F54");
        }
    }

    function getTotalQuantity(prod_id) {
        var production_quantity = $('#production_quantity_' + prod_id).val();
        var dispatched_quantity = $('#dispatched_quantity_' + prod_id).val();
        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/showinventory/getTotalQuantity",
            data: {
                production_quantity: production_quantity,
                dispatched_quantity: dispatched_quantity,
                prod_id: prod_id
            },
            return: false, //stop the actual form post !important!
            success: function (data) {
                //$.alert(data);
                console.log(data);
                $('#total_quantity_' + prod_id).val(data);

            }
        });
    }
</script>
<script src="<?php echo base_url(); ?>assets/js/module/inventory/inventory.js"></script>
