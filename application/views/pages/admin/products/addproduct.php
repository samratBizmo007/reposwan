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
                                    <input type="text" class="form-control" id="exstock_quantity" ng-model="exstock_quantity" name="exstock_quantity" placeholder="Ex-stock Quantiry" >
                                </div>
                            </div>
                        </div>

                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="product_name">Product Name/ Part Name<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" class="form-control" id="product_name" ng-model="product_name" name="product_name" placeholder="Enter product name" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="divrawing_no">Drawing Number :</label>
                                    <input type="text" class="form-control" id="drawing_no" ng-model="drawing_no" name="drawing_no" placeholder="Enter drawing number">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="revision_no">Revision Number :</label>
                                    <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3><i class="fa fa-plus"></i> Add Sub product Details </h3>
                        </div>
                    </div>
                    <!---------------------------------------------------////////////////-------------------------------------------------------->
                    <?php // print_r($machines); ?>
                    <div class="w3-col l12" data-ng-repeat="d in Data">
                        <fieldset>
                            <div class="w3-col l12 ">
                                <div class="w3-col l8">
                                    <div class="w3-col l12 w3-padding-top">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sr_no">Serial Number :</label>
                                                <input type="number" min="0" class="form-control" ng-model="sr_no" id="sr_no" value="0" name="sr_no" placeholder="Enter serial number">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="part_no">Item Code :</label>
                                                <input type="text" class="form-control" id="item_code" ng-model="item_code" name="item_code" placeholder="Enter Item Code">
                                            </div>
                                        </div>
                                    </div>                                        
                                </div>
                            </div>
                            <!---------------------------------------------------////////////////-------------------------------------------------------->
                            <h2>Machinery Details</h2>            
                            <div class="w3-col l12 w3-margin-bottom">
                                <div class="w3-col l12 w3-padding-top w3-padding-bottom">
                                    <div class="col-md-3 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group">
                                            <!-- fetch skills from db -->
                                            <label for="operations">Operations Performed<b class="w3-text-red w3-medium">*</b> :</label>
                                            <select name="operations" id="operations" ng-model="operations" ng-trim="false" class="form-control w3-small" id="operations">
                                                <?php foreach ($skills as $key) { ?>
                                                    <option value="<?php echo $key['skill_id'] ?>" class="w3-text-grey"><?php echo $key['skill_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="machine">Machine used:</label>
                                            <select name="machine" id="machine" ng-trim="false" ng-model="machine" class="form-control w3-small" ng-change="getQuantityPerHr()" id="operations">
                                                <?php foreach ($machines as $key) { ?>
                                                    <option value="<?php echo $key['machine_id'] ?>" class="w3-text-grey"><?php echo $key['machine_name'] . '/' . $key['machine_capacity'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="qtyhr">Quantity per hour:</label>
                                            <input type="text" class="form-control" id="qtyhr" ng-model="qtyhr" name="qtyhr" placeholder="Machine Quantity Per Hr">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group w3-right w3-padding-top">
                                            <button class="w3-button w3-margin-top theme_bg" type="button" ng-click="addMachineDetails()"><i class="fa fa-plus"></i> Add Machinery Details</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="w3-padding-small w3-text-red w3-medium" ng-bind-html="errorMachine"></p>
                                <input type="hidden" class="form-control" name="addedMachines_field" id="addedMachines_field" value="{{addedMachines}}">

                                <div class=" w3-margin-bottom" ng-show="machineDiv">
                                    <div class="w3-col l12 w3-center">
                                        <div class="w3-col l3 col-sm-12 col-xs-12 theme_bg"><b>operations</b></div>
                                        <div class="w3-col l3 col-sm-12 col-xs-12 theme_bg"><b>Machine</b></div>
                                        <div class="w3-col l3 col-sm-12 col-xs-12 theme_bg"><b>quantity Per Hr</b></div>
                                        <div class="w3-col l3 col-sm-12 col-xs-12 theme_bg"><b>Remove</b></div>
                                    </div>
                                    <div class="w3-col l12 w3-center" ng-repeat="machine in MachineSelectedArr">
                                        <hr>
                                        <div class="w3-col l3 col-sm-12 col-xs-12">{{machine.operationSelected}}</div>
                                        <div class="w3-col l3 col-sm-12 col-xs-12">{{machine.machineSelected}}</div>
                                        <div class="w3-col l3 col-sm-12 col-xs-12">{{machine.qtyhrAdded}}</div>
                                        <div class="w3-col l3 col-sm-12 col-xs-12"><a class="fa fa-remove w3-text-red" ng-click="removeMachineDetails($index)" title="remove material"></a></div>
                                    </div>
                                </div>
                            </div>
                            <!---------------------------------------------------////////////////-------------------------------------------------------->

                            <h2>Raw Material Details</h2>
                            <div class="w3-col l12">
                                <div class="w3-col l12 w3-padding-top">              
                                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_type">Raw Material Type<b class="w3-text-red w3-medium">*</b> :</label>
                                            <select name="rm_type" class="form-control w3-small" id="rm_type" ng-model="rmtypeSelected" ng-change="RmType($index)">
                                                <?php foreach ($materialType['status_message'] as $key) { ?>
                                                    <option value="<?php echo $key['mat_cat_id'] ?>" class="w3-text-grey"><?php echo $key['material_type'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_grade">Raw Material Grade<b class="w3-text-red w3-medium">*</b> :</label>
                                            <select name="rm_grade" class="form-control w3-small" ng-model="rmgradeSelected" id="rm_grade">
                                            </select>
                                        </div>
                                    </div>                          
                                </div>
                                <div class="w3-col l12" ng-show="rmSpecimen">
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_thick">Thickness :</label>
                                            <input type="number" ng-model="rmthickSelected" min="0" ng-disabled="!enableThickness" class="form-control" id="rm_thick" name="rm_thick[]" placeholder="Material Thickness">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_dia">Diameter :</label>
                                            <input type="number" ng-model="rmdiaSelected" min="0" ng-disabled="!enableDiameter" class="form-control" id="rm_dia" name="rm_dia[]" placeholder="Material Diameter">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_id">ID :</label>
                                            <input type="number" ng-model="rmIDSelected" min="0" ng-disabled="!enableID" class="form-control" id="rm_id" name="rm_id[]" placeholder="Material ID">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_od">OD :</label>
                                            <input type="number" min="0" ng-model="rmODSelected" ng-disabled="!enableOD" class="form-control" id="rm_od" name="rm_od[]" placeholder="Material OD">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_pitch">Pitch :</label>
                                            <input type="number" min="0" ng-model="rmPitchSelected" ng-disabled="!enablePitch" class="form-control" id="rm_pitch" name="rm_pitch[]" placeholder="Material Pitch">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_weight">Weight (KGs) <b class="w3-text-red w3-medium">*</b> :</label>
                                            <input type="number" min="0" ng-model="rmweightSelected" class="form-control" id="rm_weight" name="rm_weight[]" placeholder="Material Weight">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_length">Length :</label>
                                            <input type="number" min="0" ng-model="rmlenSelected" class="form-control" ng-disabled="!enableLength" id="rm_length" name="rm_length[]" placeholder="Material Length">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                                        <div class="form-group">
                                            <label for="rm_quantity">Quantity :</label>
                                            <input type="number" min="0" ng-model="rmqtySelected" class="form-control" ng-disabled="!enableQuantity" id="rm_quantity" name="rm_quantity[]" placeholder="Material Quantity">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xs-12 col-sm-12 w3-margin-bottom">
                                        <label for="rm_drawingNo">Drawing No :</label>
                                        <input type="number" name="Drawing_no" ng-model="rmdrawingSelected" ng-disabled="!enableDrawing" id="Drawing_no" min="0" step="0.01" class="form-control" placeholder="Drawing No">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 w3-margin-bottom">
                                        <div class="form-group w3-padding-top">
                                            <button class="w3-button w3-margin-top theme_bg" type="button" ng-click="addRM()"><i class="fa fa-plus"></i> Add Material</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="w3-padding-small w3-text-red w3-medium" ng-bind-html="errorRM"></p>
                                <input type="hidden" class="form-control" name="addedRM_field" id="addedRM_field" value="{{addedRM}}">
                                <!-- <pre>{{addedRM}}</pre> -->
                            </div>
                            <!---------------------------------------------------////////////////-------------------------------------------------------->

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
                                            <th>Material DrawingNo</th>
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
                                            <td>{{mat.rmdrawingSelected}}</td>
                                            <td><a class="fa fa-remove w3-text-red" ng-click="removeMaterial($index)" title="remove material"></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>            
                            <!---------------------------------------------------////////////////-------------------------------------------------------->
                            <h2>Product Packing Quantity And Finished Weight</h2>
                            <div class="w3-col l12">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group w3-col l12">
                                        <label for="Packing_Quantity_Per_Tray">Packing Quantity Per Tray<b class="w3-text-red w3-medium">*</b> :</label>
                                        <input type="number" class="form-control" id="packingquantity_per_tray" name="packingquantity_per_tray" placeholder="Ex-stock Quantiry">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group w3-col l12">
                                        <label for="Net_Finished_Weight">Net Finished Weight<b class="w3-text-red w3-medium">*</b> :</label>
                                        <input type="number" class="form-control" id="net_finished_weight" name="net_finished_weight" placeholder="Net Finished Weight">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group w3-right w3-padding-top">
                                        <button class="w3-button w3-margin-top theme_bg" type="button" ng-click="submitProduct()"><i class="fa fa-plus"></i> Add This Product</button>
                                    </div>
                                </div>
                            </div>
                            <!---------------------------------------------------////////////////-------------------------------------------------------->
                        </fieldset>
                        <p class="w3-padding-small w3-text-red w3-medium" ng-bind-html="errorForProductDetails"></p>

                        <!--remove button for remove div-->
                        <!--                        <a class="btn remove w3-right w3-text-black" id="remove" ng-show="$last" ng-click="removeProductChoice()"> -remove</a>-->
                        <!--                        <div class="w3-col l12" id="addedmore_DivGeneral"></div>-->
                    </div>
                    <!--                    <div class="w3-col l12">
                                            <a class="btn w3-text-red w3-right" style="padding:0" id="addMore_Btn" name="addMoreBtnGeneral" ng-click="addNewProductSpecificationDiv()"><i class="fa fa-plus"></i> Add more</a>
                                            <a class="btn w3-text-red w3-right" style="padding:0" id="addMoreBtnGeneral" name="addMoreBtnGeneral"><i class="fa fa-plus"></i> Add more</a>
                                        </div>-->
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
                    <input type="hidden" class="form-control" name="addedProducts_field" id="addedProducts_field" value="{{addedProducts}}">
                    <div ng-show="productsDiv">
                        <table class="table table-responsive table-bordered w3-margin-top">
                            <thead>
                                <tr class="theme_bg w3-center">
                                    <th>Sr.No</th>
                                    <th>Item Code</th>
                                    <th>Machine Details</th>
                                    <th>Material Details</th>
                                    <th>Item Qty / Tray</th>
                                    <th>Finished Weight</th>                                
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="w3-center"ng-repeat="prod in AllProduct">
                                    <td>{{prod.serial_no}}</td>
                                    <td>{{prod.item_code}}</td>
                                    <td>
                                        <table class="table table-responsive table-bordered w3-margin-top">
                                            <thead>
                                                <tr class="theme_bg w3-center">
                                                    <th>Operation</th>
                                                    <th>Machine</th>
                                                    <th>Qty per/Hr</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="p in prod.machineSelected_details">
                                                    <td>{{p.operationSelected}}</td>
                                                    <td>{{p.machineSelected}}</td>
                                                    <td>{{p.qtyhrAdded}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-responsive table-bordered w3-margin-top">
                                            <thead>
                                                <tr class="theme_bg w3-center">
                                                    <th>Type</th>
                                                    <th>Grade</th>
                                                    <th>Thick</th>
                                                    <th>Diam</th>
                                                    <th>ID</th>
                                                    <th>OD</th>
                                                    <th>Pitch</th>
                                                    <th>Weight</th>
                                                    <th>Length</th>
                                                    <th>Thick</th>
                                                    <th>DrgNo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="m in prod.requiredMaterial">
                                                    <td >{{m.rm_type}}</td>
                                                    <td >{{m.rmgradeSelected}}</td>
                                                    <td >{{m.rmthickSelected}}</td>
                                                    <td >{{m.rmdiaSelected}}</td>
                                                    <td >{{m.rmIDSelected}}</td>
                                                    <td >{{m.rmODSelected}}</td>
                                                    <td >{{m.rmPitchSelected}}</td>
                                                    <td >{{m.rmweightSelected}}</td>
                                                    <td >{{m.rmlenSelected}}</td>
                                                    <td >{{m.rmqtySelected}}</td>
                                                    <td>{{m.rmdrawingSelected}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>{{prod.packingquantity_per_tray}}</td>
                                    <td>{{prod.net_finished_weight}}</td>                                    
                                    <td><a class="fa fa-remove w3-text-red" ng-click="removeProductDetails($index)" title="remove Product"></a></td>
                                </tr>
                            </tbody>
                        </table>

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
                          
</script>
                                                <script>
                                        // script to add extra div for serial no and item code
                                                var wrapper = '';
                                        function appendDivFun(no) {
//e.preventDefault();
//add_button = '';
                                        var max_fields = 10; var wrapper = $("#addedmore_DivMachine_" + no); // var add_button = $("#addMoreBtnMachine");                                                 var x = '';
                                        x = no; //alert(x);
                                        if (x < max_fields) {                             x++;
                                        $(wrapper).append('<div>\n\
<div class="w3-col l12 w3-padding-top">\n\
<div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">\n\
<div class="form-group">\n\
<!-- fetch skills from db -->\n\
<label for="operations">Operations Performed<b class="w3-text-red w3-medium">*</b> :</label>\n\
<select name="operations_' +                                       x +                                       '[]" id="operations_' +                                       x +                                       '" ng-trim="false" class="form-control w3-small" id="operations">\n\
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
<input type="text" class="form-control" id="qtyhr_' + x + '" name="qtyhr_' + x +'[]" placeholder="Machine Quantity Per Hr">\n\
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