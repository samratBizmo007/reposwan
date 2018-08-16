<title>Swan Industries | Add Product</title>
<style type="text/css">
    #addProduct fieldset{
        /*display: none;*/
        margin-bottom: 16px
    }
</style>
<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="page_title">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-plus"></i> Add New Product </h3>
                    </div>
                </div>
                <!-- <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <form id="addProduct" ng-app="addProductForm" ng-cloak ng-controller="ProdCtrl">
                    <fieldset>
                        <h2>General Details</h2>
                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="customer_name">Customer Name<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="prod_type">Product Type<b class="w3-text-red w3-medium">*</b> :</label>
                                    <select name="prod_type" class="form-control w3-small" id="prod_type" ng-change="prodType()" ng-model="typeSelected">
                                        <option value="0" class="w3-text-grey" selected>REGULAR</option>
                                        <option value="1" class="w3-text-grey">EX-STOCK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom" >
                                <div class="form-group w3-col l12">
                                    <label for="stock_plant">Stock Plant<b class="w3-text-red w3-medium">*</b> :</label>
                                    <select name="stock_plant" class="form-control w3-small" id="stock_plant">
                                        <option value="0" class="w3-text-grey w3-light-grey " selected>Please choose any one plant</option>
                                        <option ng-repeat="x in plants['status_message']" value="{{x.plant_name}}">{{x.plant_name}}</option>
                                        <!--                                        <option value="ALANDI" class="w3-text-grey">ALANDI</option>
                                        <option value="SANASWADI" class="w3-text-grey">SANASWADI</option>-->
                                    </select>
                                </div>
                                <div class="form-group w3-col l12" ng-show='plantDiv'>
                                    <label for="stock_plant">Ex-stock Quantity<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" class="form-control" id="exstock_quantity" name="exstock_quantity" placeholder="Ex-stock Quantiry" >
                                </div>
                            </div>
                        </div>

                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="product_name">Product Name/ Part Name<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="divrawing_no">Drawing Number :</label>
                                    <input type="text" class="form-control" id="drawing_no" name="drawing_no" placeholder="Enter drawing number">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="revision_no">Revision Number :</label>
                                    <input type="text" class="form-control" id="revision_no" name="revision_no" placeholder="Enter revision number">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <?php // print_r($machines); ?>
                    <div class="w3-col l12">
                        <fieldset>
                            <div class="w3-col l12">
                                <div class="w3-col l8">
                                    <div class="w3-col l12 w3-padding-top">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sr_no">Serial Number 1 :</label>
                                                <input type="number" min="0" class="form-control" id="sr_no_0" value="0" name="sr_no_0[]" placeholder="Enter serial number">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="part_no">Item Code 1 :</label>
                                                <input type="text" class="form-control" id="item_code_0" name="item_code_0[]" placeholder="Enter Item Code">
                                            </div>
                                        </div>
                                    </div>                                        
                                </div>
                            </div>

                            <h2>Machinery Details</h2>            
                            <div class="w3-col l12">
                                <div class="w3-col l12 w3-padding-top">
                                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group">
                                            <!-- fetch skills from db -->
                                            <label for="operations">Operations Performed<b class="w3-text-red w3-medium">*</b> :</label>
                                            <select name="operations_0[]" id="operations_0" ng-trim="false" class="form-control w3-small" id="operations">
                                                <?php foreach ($skills as $key) { ?>
                                                    <option value="<?php echo $key['skill_name'] ?>" class="w3-text-grey"><?php echo $key['skill_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="machine">Machine used:</label>
                                            <select name="machine_0[]" id="machine_0" ng-trim="false" class="form-control w3-small" onchange="getQuantityPerHr(0)" id="operations">
                                                <?php foreach ($machines as $key) { ?>
                                                    <option value="<?php echo $key['machine_id'] ?>" class="w3-text-grey"><?php echo $key['machine_name'] . '/' . $key['machine_capacity'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="qtyhr">Quantity per hour:</label>
                                            <input type="text" class="form-control" id="qtyhr_0" name="qtyhr_0[]" placeholder="Machine Quantity Per Hr">
                                        </div>
                                    </div>
                                </div>
                                <div class="w3-col l12" id="addedmore_DivMachine_0"></div>
                                <a class="btn w3-text-red w3-right" style="padding:0" id="addMoreBtnMachine_0" name="addMoreBtnMachine" onclick="appendDivFun(0);"><i class="fa fa-plus"></i> Add more</a>
                            </div>

                            <h2>Raw Material Details</h2>
                            <div class="w3-col l12">
                                <div class="w3-col l12 w3-padding-top">              
                                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_type">Raw Material Type<b class="w3-text-red w3-medium">*</b> :</label>
                                            <select name="rm_type_0[]" class="form-control w3-small" id="rm_type_0" ng-change="RmType(0)" onchange="getMaterialDetails(0)" ng-model="rmtypeSelected">
                                                <?php foreach ($materialType['status_message'] as $key) { ?>
                                                    <option value="<?php echo $key['mat_cat_id'] ?>" class="w3-text-grey"><?php echo $key['material_type'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_grade">Raw Material Grade<b class="w3-text-red w3-medium">*</b> :</label>
                                            <select name="rm_grade_0[]" class="form-control w3-small" id="rm_grade_0" ng-change="RmType(0)" onchange="getMaterialDetails(0)" ng-model="rmtypeSelected">
                                            </select>
                                        </div>
                                    </div>                          
                                </div>
                                <div class="w3-col l12" ng-show="rmSpecimen">
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_thick">Thickness :</label>
                                            <input type="number" ng-model="rmthickSelected" min="0" disabled class="form-control" id="rm_thick_0" name="rm_thick_0[]" placeholder="Material Thickness">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_dia">Diameter :</label>
                                            <input type="number" ng-model="rmdiaSelected" min="0" disabled class="form-control" id="rm_dia_{{$index}}" name="rm_dia[]" placeholder="Material Diameter">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_id">ID :</label>
                                            <input type="number" ng-model="rmIDSelected" min="0" disabled class="form-control" id="rm_id_0" name="rm_id_0[]" placeholder="Material ID">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_od">OD :</label>
                                            <input type="number" min="0" ng-model="rmODSelected" disabled class="form-control" id="rm_od_0" name="rm_od_0[]" placeholder="Material OD">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_pitch">Pitch :</label>
                                            <input type="number" min="0" ng-model="rmPitchSelected" disabled class="form-control" id="rm_pitch_0" name="rm_pitch_0[]" placeholder="Material Pitch">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_weight">Weight (in KGs) <b class="w3-text-red w3-medium">*</b> :</label>
                                            <input type="number" min="0" ng-model="rmweightSelected" class="form-control" id="rm_weight_0" name="rm_weight_0[]" placeholder="Material Weight">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_length">Length :</label>
                                            <input type="number" min="0" ng-model="rmlenSelected" disabled class="form-control" id="rm_length_0" name="rm_length_0[]" placeholder="Material Length">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_quantity">Quantity :</label>
                                            <input type="number" min="0" ng-model="rmqtySelected" disabled class="form-control" ng-disabled="!enableQuantity" id="rm_quantity_0" name="rm_quantity_0[]" placeholder="Material Quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group w3-padding-top">
                                            <button class="w3-button w3-margin-top theme_bg" type="button" ng-click="addRM(0)"><i class="fa fa-plus"></i> Add Material</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="w3-padding-small w3-text-red w3-medium" ng-bind-html="errorRM"></p>
                                <input type="hidden" class="form-control" name="addedRM_field_0[]" id="addedRM_field_0" value="{{addedRM}}">
                                <!-- <pre>{{addedRM}}</pre> -->
                            </div>

                            <div class="w3-col l12 " ng-show="rm_table">
                                <table class="table table-responsive table-bordered w3-margin-top">
                                    <thead>
                                        <tr class="theme_bg w3-center">
                                            <th>Material Grade</th>
                                            <th>Material Thickness</th>
                                            <th>Material Diameter</th>
                                            <th>Material ID</th>
                                            <th>Material OD</th>
                                            <th>Material Pitch</th>
                                            <th>Material Weight</th>
                                            <th>Material Length</th>
                                            <th>Material Quantity</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody ng-repeat="mat in rmArr">
                                        <tr class="w3-center">
                                            <td>{{mat.rmgradeSelected}}</td>
                                            <td>{{mat.rmthickSelected}}</td>
                                            <td>{{mat.rmdiaSelected}}</td>
                                            <td>{{mat.rmIDSelected}}</td>
                                            <td>{{mat.rmODSelected}}</td>
                                            <td>{{mat.rmPitchSelected}}</td>
                                            <td>{{mat.rmweightSelected}} KG</td>
                                            <td>{{mat.rmlenSelected}}</td>
                                            <td>{{mat.rmqtySelected}}</td>
                                            <td><a class="fa fa-remove w3-text-red" ng-click="removeMaterial(0)" title="remove material"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>            

                            <h2>Product Packing Quantity And Finished Weight</h2>
                            <div class="w3-col l12">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group w3-col l12">
                                        <label for="Packing_Quantity_Per_Tray">Packing Quantity Per Tray<b class="w3-text-red w3-medium">*</b> :</label>
                                        <input type="text" class="form-control" id="packingquantity_per_tray_0" name="packingquantity_per_tray_0[]" placeholder="Ex-stock Quantiry" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group w3-col l12">
                                        <label for="Net_Finished_Weight">Net Finished Weight<b class="w3-text-red w3-medium">*</b> :</label>
                                        <input type="text" class="form-control" id="net_finished_weight_0" name="net_finished_weight_0[]" placeholder="Net Finished Weight" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--remove button for remove div-->
                        <!--                            <a class="btn remove w3-right w3-text-black" id="remove" ng-show="$last" ng-click="removeProductChoice()"> -remove</a>-->
                        <div class="w3-col l12" id="addedmore_DivGeneral"></div>
                    </div>
                    <div class="w3-col l12">
                        <a class="btn w3-text-red w3-right" style="padding:0" id="addMoreBtnGeneral" name="addMoreBtnGeneral"><i class="fa fa-plus"></i> Add more</a>
                    </div>
                    <fieldset>
                        <h2>Pricing Details</h2>            
                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-6 col-xs-6 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="old_rate">Old Rate<b class="w3-text-red w3-medium">*</b> :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                        <input type="number" class="form-control" step="0.01" min="0" id="old_rate" name="old_rate" placeholder="Enter Old Rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-6 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="new_rate">New Rate<b class="w3-text-red w3-medium">*</b> :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                        <input type="number"cstep="0.01" min="0" class="form-control" id="new_rate" name="new_rate" placeholder="Enter New Rate" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="w3-col l12 w3-center">
                        <button type="submit" name="submitForm" id="submitForm" class="w3-center w3-hover-text-white btn theme_bg w3-margin-top"> <i class="fa fa-save"></i> Save and Add New Product </button>
                    </div>            

                </form>
                <div class="clearfix"></div>
                <div id="formOutput"></div>
            </div>
        </div>
    </div>
    <br />

</div>
<!-- /page content -->

<script src="<?php echo base_url(); ?>assets/js/module/products.js"></script>
                                                        <script>
                                                $(document).ready(function () {
                                                var max_fields = 5;
                                                var wrapper = $("#addedmore_DivGeneral");
                                                var add_button = $("#addMoreBtnGeneral");
                                                var x = 1;
                                                var srno = 1;
                                                $(add_button).click(function (e) {
                                                e.preventDefault();
                                                if (x < max_fields) {
                                                //alert(x);
                                                $(wrapper).append('<div><fieldset>\n\
                                                                <div class="w3-col l12">\n\
                                <div class="w3-col l8">\n\
                                    <div class="w3-col l12 w3-padding-top">\n\
                                        <div class="col-md-6 col-sm-12 col-xs-12">\n\
                                            <div class="form-group">\n\
                                                <label for="sr_no">Serial Number 1 :</label>\n\
                                                <input type="number" min="0" class="form-control" id="sr_no_'+x+'" value="0" name="sr_no_0[]" placeholder="Enter serial number">\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-md-6 col-sm-12 col-xs-12">\n\
                                            <div class="form-group">\n\
                                                <label for="part_no">Item Code 1 :</label>\n\
                                                <input type="text" class="form-control" id="item_code_'+x+'" name="item_code_0[]" placeholder="Enter Item Code">\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <h2>Machinery Details</h2>\n\
                                        <div class="w3-col l12">\n\
                                <div class="w3-col l12 w3-padding-top">\n\
                                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <!-- fetch skills from db -->\n\
                                            <label for="operations">Operations Performed<b class="w3-text-red w3-medium">*</b> :</label>\n\
                                            <select name="operations_'+x+'[]" id="operations_'+x+'" ng-trim="false" class="form-control w3-small" id="operations">\n\
                                                <?php foreach ($skills as $key) { ?>\n\
                                                \n\<option value="<?php echo $key['skill_name'] ?>" class="w3-text-grey"><?php echo $key['skill_name'] ?></option>\n\
                                                <?php } ?>\n\
                                            </select>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-4 col-sm-12 col-xs-12">\n\
                                        <div class="form-group">\n\
                                            <label for="machine">Machine used:</label>\n\
                                            <select name="machine_'+x+'[]" id="machine_'+x+'" ng-trim="false" class="form-control w3-small" onchange="getQuantityPerHr('+x+')" id="operations">\n\
                                                <?php foreach ($machines as $key) { ?>\n\
\n\                                                <option value="<?php echo $key['machine_id'] ?>" class="w3-text-grey"><?php echo $key['machine_name'] . '/' . $key['machine_capacity'] ?></option>\n\
                                                <?php } ?>\n\
\n\                                         </select>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-4 col-sm-12 col-xs-12">\n\
                                        <div class="form-group">\n\
                                            <label for="qtyhr">Quantity per hour:</label>\n\
                                            <input type="text" class="form-control" id="qtyhr_'+x+'" name="qtyhr_'+x+'[]" placeholder="Machine Quantity Per Hr">\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="w3-col l12" id="addedmore_DivMachine_'+x+'"></div>\n\
                                <a class="btn w3-text-red w3-right" style="padding:0" id="addMoreBtnMachine_'+x+'" name="addMoreBtnMachine" onclick="appendDivFun('+x+');"><i class="fa fa-plus"></i> Add more</a>\n\
                            </div>\n\
                            <h2>Raw Material Details</h2>\n\
                            <div class="w3-col l12">\n\
                                <div class="w3-col l12 w3-padding-top">\n\
                                   <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_type">Raw Material Type<b class="w3-text-red w3-medium">*</b> :</label>\n\
                                            <select name="rm_type_'+x+'[]" class="form-control w3-small" id="rm_type_'+x+'" ng-change="RmType('+x+')" onchange="getMaterialDetails('+x+')" ng-model="rmtypeSelected">\n\
                                                <?php foreach ($materialType['status_message'] as $key) { ?>\n\
\n\                                                    <option value="<?php echo $key['mat_cat_id'] ?>" class="w3-text-grey"><?php echo $key['material_type'] ?></option>\n\
                                                <?php } ?>\n\
\n\                                            </select>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_grade">Raw Material Grade<b class="w3-text-red w3-medium">*</b> :</label>\n\
                                            <select name="rm_grade_'+x+'[]" class="form-control w3-small" id="rm_grade_'+x+'" ng-change="RmType('+x+')" onchange="getMaterialDetails('+x+')" ng-model="rmtypeSelected">\n\
                                            </select>\n\
                                        </div>\n\
                                    </div>\n\
                                    </div>\n\
                                <div class="w3-col l12" ng-show="rmSpecimen">\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_thick">Thickness :</label>\n\
                                            <input type="number" ng-model="rmthickSelected" min="0" disabled class="form-control" id="rm_thick_'+x+'" name="rm_thick_'+x+'[]" placeholder="Material Thickness">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_dia">Diameter :</label>\n\
                                            <input type="number" ng-model="rmdiaSelected" min="0" disabled class="form-control" id="rm_dia_'+x+'" name="rm_dia_'+x+'[]" placeholder="Material Diameter">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_id">ID :</label>\n\
                                            <input type="number" ng-model="rmIDSelected" min="0" disabled class="form-control" id="rm_id_'+x+'" name="rm_id_'+x+'[]" placeholder="Material ID">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_od">OD :</label>\n\
                                            <input type="number" min="0" ng-model="rmODSelected" disabled class="form-control" id="rm_od_'+x+'" name="rm_od_'+x+'[]" placeholder="Material OD">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_pitch">Pitch :</label>\n\
                                            <input type="number" min="0" ng-model="rmPitchSelected" disabled class="form-control" id="rm_pitch_'+x+'" name="rm_pitch_'+x+'[]" placeholder="Material Pitch">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_weight">Weight (in KGs) <b class="w3-text-red w3-medium">*</b> :</label>\n\
                                            <input type="number" min="0" ng-model="rmweightSelected" class="form-control" id="rm_weight_'+x+'" name="rm_weight_'+x+'[]" placeholder="Material Weight">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_length">Length :</label>\n\
                                            <input type="number" min="0" ng-model="rmlenSelected" disabled class="form-control" id="rm_length_'+x+'" name="rm_length_'+x+'[]" placeholder="Material Length">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">\n\
                                        <div class="form-group">\n\
                                            <label for="rm_quantity">Quantity :</label>\n\
                                            <input type="number" min="0" ng-model="rmqtySelected" disabled class="form-control" ng-disabled="!enableQuantity" id="rm_quantity_'+x+'" name="rm_quantity_'+x+'[]" placeholder="Material Quantity">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-2 col-sm-12 col-xs-12 w3-margin-bottom">\n\
                                        <div class="form-group w3-padding-top">\n\
                                            <button class="w3-button w3-margin-top theme_bg" type="button" ng-click="addRM('+x+')"><i class="fa fa-plus"></i> Add Material</button>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <p class="w3-padding-small w3-text-red w3-medium" ng-bind-html="errorRM"></p>\n\
                                <input type="hidden" class="form-control" name="addedRM_field_'+x+'[]" id="addedRM_field_'+x+'" value="{{addedRM}}">\n\
                                <!-- <pre>{{addedRM}}</pre> -->\n\
                            </div>\n\
                            <div class="w3-col l12 " ng-show="rm_table">\n\
                                <table class="table table-responsive table-bordered w3-margin-top">\n\
                                    <thead>\n\
                                        <tr class="theme_bg w3-center">\n\
                                            <th>Material Grade</th>\n\
                                            <th>Material Thickness</th>\n\
                                            <th>Material Diameter</th>\n\
                                            <th>Material ID</th>\n\
                                            <th>Material OD</th>\n\
                                            <th>Material Pitch</th>\n\
                                            <th>Material Weight</th>\n\
                                            <th>Material Length</th>\n\
                                            <th>Material Quantity</th>\n\
                                            <th></th>\n\
                                        </tr>\n\
                                    </thead>\n\
                                    <tbody ng-repeat="mat in rmArr">\n\
                                        <tr class="w3-center">\n\
                                            <td>{{mat.rmgradeSelected}}</td>\n\
                                            <td>{{mat.rmthickSelected}}</td>\n\
                                            <td>{{mat.rmdiaSelected}}</td>\n\
                                            <td>{{mat.rmIDSelected}}</td>\n\
                                            <td>{{mat.rmODSelected}}</td>\n\
                                            <td>{{mat.rmPitchSelected}}</td>\n\
                                            <td>{{mat.rmweightSelected}} KG</td>\n\
                                            <td>{{mat.rmlenSelected}}</td>\n\
                                            <td>{{mat.rmqtySelected}}</td>\n\
                                            <td><a class="fa fa-remove w3-text-red" ng-click="removeMaterial(0)" title="remove material"></td>\n\
                                        </tr>\n\
                                    </tbody>\n\
                                </table>\n\
                            </div>\n\
                            <h2>Product Packing Quantity And Finished Weight</h2>\n\
                            <div class="w3-col l12">\n\
                                <div class="col-md-4 col-sm-12 col-xs-12">\n\
                                    <div class="form-group w3-col l12">\n\
                                        <label for="Packing_Quantity_Per_Tray">Packing Quantity Per Tray<b class="w3-text-red w3-medium">*</b> :</label>\n\
                                        <input type="text" class="form-control" id="packingquantity_per_tray_'+x+'" name="packingquantity_per_tray_'+x+'[]" placeholder="Ex-stock Quantiry" required>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="col-md-4 col-sm-12 col-xs-12">\n\
                                    <div class="form-group w3-col l12">\n\
                                        <label for="Net_Finished_Weight">Net Finished Weight<b class="w3-text-red w3-medium">*</b> :</label>\n\
                                        <input type="text" class="form-control" id="net_finished_weight_'+x+'" name="net_finished_weight_'+x+'[]" placeholder="Net Finished Weight" required>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </fieldset>\n\
                        \n\<a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
                        </div>');
 x++;

    //add input box
    srno++;
} else {
    $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');
    //alert when added more than 10 input fields
}
});
$(wrapper).on("click", ".delete", function (e) {
e.preventDefault();
$(this).parent('div').remove();
x--;
srno--;
});
});
</script>
<script>
            // script to add extra div for serial no and item code
    var wrapper = '';
    function appendDivFun(no) {
    //e.preventDefault();
    //add_button = '';
    var max_fields = 10;
    var wrapper = $("#addedmore_DivMachine_" + no);
    // var add_button = $("#addMoreBtnMachine");
    var x = '';
    x = no;
    //alert(x);
    if (x < max_fields) {
    x++;
    $(wrapper).append('<div>\n\
                       <div class="w3-col l12 w3-padding-top">\n\
                       <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">\n\
                       <div class="form-group">\n\
                           <!-- fetch skills from db -->\n\
                       <label for="operations">Operations Performed<b class="w3-text-red w3-medium">*</b> :</label>\n\
                       <select name="operations_' +  x +  '[]" id="operations_' +  x +  '" ng-trim="false" class="form-control w3-small" id="operations">\n\
<?php foreach ($skills as $key) { ?><option value="<?php echo $key['skill_name'] ?>" class="w3-text-grey"><?php echo $key['skill_name'] ?></option>\n\
<?php } ?></select>\n\
                       </div>\n\
                       </div>\n\
                        \n\
                       <div class="col-md-4 col-sm-12 col-xs-12">\n\
                       <div class="form-group">\n\
                       <label for="machine">Machine used:</label>\n\
                       <select name="machine_' + x + '[]" id="machine_' + x + '" ng-trim="false" class="form-control w3-small" onchange="getQuantityPerHr(' + x + ')" id="operations">\n\
<?php foreach ($machines as $key) { ?><option value="<?php echo $key['machine_id'] ?>" class="w3-text-grey"><?php echo $key['machine_name'] . '/' . $key['machine_capacity'] ?></option>\n\
<?php } ?></select>\n\
                        </div>\n\
                        </div>\n\
                        \n\
                        <div class="col-md-4 col-sm-12 col-xs-12">\n\
                        <div class="form-group">\n\
                        <label for="qtyhr">Quantity per hour:</label>\n\
                        <input type="text" class="form-control" id="qtyhr_' + x + '" name="qtyhr_' + x + '[]" placeholder="Machine Quantity Per Hr">\n\
                        </div>\n\
                        </div>\n\
                        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
                        </a>\n\
                        </div>\n\
                        </div>');
    //add input box
    } else {
    $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');
    //alert when added more than 10 input fields
    }
    }
    ;
    $(wrapper).on("click", ".delete", function (e) {
    //alert(0);
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
    });



</script>