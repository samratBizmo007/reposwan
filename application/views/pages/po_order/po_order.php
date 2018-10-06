<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title"><div class="w3-padding"><h3><i class="fa fa-plus"></i> Add Customer Purchase Order</h3></div></div>
        <fieldset>
            <div class="row" style=" margin-top: 5px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="" id="App" ng-app="PoApp" ng-controller="PoController">
                        <form id="addPurchaseOrderForm" name="addPurchaseOrderForm" role="form" method="post">
                            <fieldset>
                                <div class="w3-col l12 w3-margin-bottom w3-padding-bottom">
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialCategoryDiv">
                                        <label>Customer Name <b class="w3-text-red w3-medium">*</b></label>
                                        <select class="form-control" id="customer_name" ng-model="customer_name" name="customer_name" ng-change="getCustomerProducts()" required>
                                            <option ng-repeat="z in customer['status_message']" value="{{z.customer_name}}">{{z.customer_name}}</option>
                                        </select>                               
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                        <label>Order No <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="text" name="order_no" ng-model="order_no" id="order_no" class="form-control" placeholder="Order_no" required>
                                    </div>                                    
                                </div>
                            </fieldset>
                            <div id="PoDiv" style="display: none;">
                                <div class="w3-padding-bottom" data-ng-repeat="product in productData">
                                    <fieldset>
                                        <div class="w3-col l12 w3-margin-bottom">
                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                                <label>Line No <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="number" name="line_no[]" ng-model="line_no" id="line_no_{{$index}}" class="form-control" placeholder="Line No" required>
                                            </div>
                                        </div>
                                        <div class="w3-col l12 w3-margin-bottom">
                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="ProductDiv">
                                                <label>Part No <b class="w3-text-red w3-medium">*</b></label>
                                                <select class="form-control" id="part_drwing_no_{{$index}}" ng-model="part_drwing_no" name="part_drwing_no[]" ng-change="getProductInfo($index)" required>
                                                    <option ng-repeat="p in partNo" value="{{p.drawing_no}}">{{p.drawing_no}}</option>
                                                </select>                               
                                            </div>
                                            <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">										
                                                <label>Product Name <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="text" name="product_name[]" ng-model="product_name" id="product_name_{{$index}}" class="form-control" placeholder="Product Name" required>
                                                <input type="hidden" name="prod_id[]" ng-model="prod_id" id="prod_id_{{$index}}" value="{{prod_id}}" class="form-control" placeholder="Product Name" required>
                                                <input type="hidden" name="subprod_id[]" ng-model="subprod_id" id="subprod_id_{{$index}}" value="{{subprod_id}}" class="form-control" placeholder="Product Name" required>
                                            </div>
                                        </div>
                                        <div class="w3-col l12 w3-margin-bottom">                                            
                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                                <label>Revision No <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="text" name="revision_no[]" ng-model="revision_no" id="revision_no_{{$index}}" class="form-control" placeholder="Revision No" ng-change="getDetailedProductInfo($index);" required>
                                            </div>
                                        </div>
                                        <div class="w3-col l12 w3-margin-bottom">
                                            <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">                                        
                                                <label>Sr. No <b class="w3-text-red w3-medium">*</b></label>
                                                <select class="form-control" id="sr_no_{{$index}}" ng-model="sr_no" name="sr_no[]" required>
                                                    <option ng-repeat="no in srItemCode" value="{{no.sr_no}}">{{no.sr_no}}</option>
                                                </select> 
                                            </div>
                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialGrade">
                                                <label>Product Code <b class="w3-text-red w3-medium">*</b></label>
                                                <select class="form-control" id="product_code_{{$index}}" ng-model="product_code" name="product_code[]" required>
                                                    <option ng-repeat="no in srItemCode" value="{{no.item_code}}">{{no.item_code}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="w3-col l12 w3-margin-bottom">
                                            <div id="materialRate" class="col-lg-4 col-xs-12 col-sm-12">                                        
                                                <label>Unit Rate <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="number" name="unit_rate[]" ng-model="unit_rate" id="unit_rate_{{$index}}" value="" min="0" class="form-control" readonly placeholder="Unit Rate" required>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-sm-12" id="">
                                                <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="number" name="quantity[]" min="0" ng-model="quantity" id="quantity_{{$index}}" ng-change="getNetAmount($index)" value="" min="0" class="form-control" placeholder="Quantity" required>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-sm-12" id="">
                                                <label>Net Amount <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="number" name="netAmount[]" ng-model="netAmount" id="netAmount_{{$index}}" value="" min="0" class="form-control" placeholder="Net Amount" required>
                                            </div>
                                        </div>

                                        <div class="w3-col l12 w3-margin-bottom">
                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                                <label>Old Rate <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="text" name="old_rate" ng-model="old_rate" id="old_rate_{{$index}}" value="" min="0" class="form-control" disabled placeholder="Old Rate" required>
                                            </div>
                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                                <label>Due Date <b class="w3-text-red w3-medium">*</b></label>
                                                <input type="date" name="due_date[]" ng-model="due_date" id="due_date_{{$index}}" value="" class="form-control" placeholder="Due Date" required>
                                            </div>
                                        </div>
                    <!--                                        <span class="w3-border w3-col l12 w3-margin-bottom"></span>-->
                                        <a class="btn remove w3-right w3-text-black" id="remove" ng-show="$last" ng-click="removeChoice()"> -remove</a>
                                    </fieldset>
                                </div>
                            </div>
                            <a class="btn w3-text-red w3-margin-top w3-right" id="addMore" style="padding:0; display: none;" ng-click="addNewProduct()"><i class="fa fa-plus"></i> Add more</a> 
                            <div class=" w3-center w3-col l12 w3-padding-top" style="">
                                <button  type="submit" title="add purchase order" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Purchase Order</button>
                            </div>
                        </form>
                        <div class="w3-col l12" ng-bind-html="message_info"></div>
                        <div class="w3-col l12" id="err_message"></div>
                    </div>
                    <!-- REGISTER DIV ENDS -->   
                </div>
                <div class="col-lg-1"></div>
            </div>
        </fieldset>
    </div>
    <!-- /top tiles -->
</div>
<!-- /page content -->
<script src="<?php echo base_url(); ?>assets/js/module/po/po.js"></script>
