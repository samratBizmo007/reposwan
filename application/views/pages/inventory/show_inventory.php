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
                            <h4>Find Material By Material Category </h4>                
                        </div>
                        <div class="w3-col l12 w3-margin-bottom">
                            <div class="col-lg-5 col-xs-12 col-sm-12" id="materialWeight">
                                <label>Material Category <b class="w3-text-red w3-medium">*</b></label>
                                <select class="form-control" id="mat_cat_id" ng-model="mat_cat_id" name="mat_cat_id" ng-change="getMaterialDetailsByType();" required>
                                    <option value="0">All Material</option>
                                    <option ng-repeat="z in materialCategory['status_message']" value="{{z.mat_cat_id}}">{{z.material_type}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <table class="table table-responsive" id="tab_logic">
                                <thead>
                                    <tr class="theme_bg">
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
                                            Dia.no
                                        </th>
                                        <th class="text-center">
                                            Thickness
                                        </th>
                                        <th class="text-center">
                                            Diameter
                                        </th>
                                        <th class="text-center">
                                            Remark
                                        </th>
<!--                                        <th class="text-center">
                                            added date
                                        </th>
                                        <th class="text-center">
                                            modified date
                                        </th>-->
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id='addedRows'>
                                    <tr id="rowCount" ng-if="materials['status'] == 200" ng-repeat=" m in materials['status_message']">
                                        <td class="w3-center" width="4%">{{$index + 1}}</td>
                                        <td class="w3-center" width="7%">{{ m.material_type}}</td>
                                        <td class="w3-center" width="7%">{{ m.material_grade}}</td>
                                        <td class="w3-center"width="7%">{{ m.material_rate}}</td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="weight_{{m.material_id}}" class="form-control w3-center" value="{{ m.material_weight}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="quantity_{{m.material_id}}" class="form-control w3-center" value="{{ m.quantity}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="length_{{m.material_id}}" class="form-control w3-center" value="{{ m.length}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="id_{{m.material_id}}" class="form-control w3-center" value="{{ m.id}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="od_{{m.material_id}}" class="form-control w3-center" value="{{ m.od}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="pitching_{{m.material_id}}" class="form-control w3-center" value="{{ m.pitching}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="diagram_no_{{m.material_id}}" class="form-control w3-center" value="{{ m.diagram_no}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="thickness_{{m.material_id}}" class="form-control w3-center" value="{{ m.thickness}}">
                                        </td>
                                        <td class="w3-center" width="7%">
                                            <input type="text" id="diameter_{{m.material_id}}" class="form-control w3-center" value="{{ m.diameter}}">
                                        </td>
                                        <td class="w3-center" width="15%">
                                            <input type="text" id="remark_{{m.material_id}}" class="form-control w3-center" value="{{ m.remark}}">
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
                                        <td class="w3-center" colspan="8">No Records Found..!</td>
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
<!--                                        <th class="text-center">
                                            Sr.no
                                        </th>
                                        <th class="text-center">
                                            Rev.no
                                        </th>-->
                                        <th class="text-center">
                                            Item Code
                                        </th>
                                        <th class="text-center">
                                            Drawing no
                                        </th>
                                        <th class="text-center">
                                            Product Quantity
                                        </th>
                                        <th class="text-center">
                                            Added date
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>                                          
                                    </tr>
                                </thead>
                                <tbody id='productaddedRows'>
                                    <?php
                                    //print_r($products['status_message'][0]);
                                    if ($products['status'] == 200) {
                                        foreach ($products['status_message'] as $val) {
                                            $type = 'REGULAR';
                                            if ($val['prod_type'] == '1') {
                                                $type = 'EX-STOCK';
                                            }
                                            ?>
                                            <tr id="rowCount">
                                                <td class="w3-center"><?php echo $val['customer_name']; ?></td>
                                                <td class="w3-center"><?php echo $val['product_name']; ?></td>
                                                <td class="w3-center"><?php
                                                    echo $type;
                                                    if ($val['prod_type'] != '0') {
                                                        echo '<br>(' . $val['stock_plant'] . ')';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="w3-center">
                                                    <?php
                                                    foreach (json_decode($val['sr_item_code'], true) as $key) {
                                                        echo '<div class="w3-center">' . $key['item_code'] . '</div>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="w3-center"><?php echo $val['drawing_no']; ?></td>
                                                <td class="w3-center">
                                                    <input type="number" class="form-control w3-center" id="product_quantity_<?php echo $val['prod_id'] ?>" value="<?php echo $val['product_quantity'] ?>">
                                                </td>
                                                <td class="w3-center"><?php echo $val['added_date']; ?></td>
                                                <td class="w3-center">
                                                    <a class="btn w3-block w3-text-green w3-padding-small" onclick="updateProductDetails(<?php echo $val['prod_id']; ?>);" title="Update Product Details">
                                                        Update
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="w3-center" colspan="7">No Records Found..!</td>
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
</script>
<script src="<?php echo base_url(); ?>assets/js/module/inventory/inventory.js"></script>
