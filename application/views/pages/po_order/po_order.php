<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title"><div class="w3-padding"><h3><i class="fa fa-plus"></i> Add Purchase Order</h3></div></div>
        <fieldset>
            <div class="row" style=" margin-top: 5px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="" id="App" ng-app="PoApp" ng-controller="PoController">
                        <form id="add_PurchaseForm" method="post" role="form">
                            <div class="w3-col l12" ng-model="po_err"></div>
                            <div class="w3-col l12 w3-margin-bottom">
                                <div class="col-lg-6 col-xs-12 col-sm-12" id="materialCategoryDiv">
                                    <label>Customer Name <b class="w3-text-red w3-medium">*</b></label>
                                    <select class="form-control" id="customer_name" ng-model="customer_name" name="customer_name" ng-change="getCustomerProducts()" required>
                                        <option ng-repeat="z in customer['status_message']" value="{{z.customer_name}}">{{z.customer_name}}</option>
                                    </select>                               
                                </div>
                            </div>
                            <div id="PoDiv" style=" display: none;">
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="ProductDiv">
                                        <label>Product Name <b class="w3-text-red w3-medium">*</b></label>
                                        <select class="form-control" id="product_name" name="product_name" required>
                                            <option value="0">Select Product Name</option>
                                            <option ng-repeat="z in product['status_message']" value="{{z.product_name}}">{{z.product_name}}</option>
                                        </select>                               
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialGrade">
                                        <label>Product Code <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="text" name="product_code" ng-model="productData.product_code" id="product_code"  class="form-control" placeholder="Product Code" value="" required>
                                    </div>
                                </div>
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">										
                                        <label>Part No/Drawing No <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="number" name="part_drwing_no" ng-model="productData.part_drwing_no" id="part_drwing_no" min="0" step="0.01" class="form-control" placeholder="Part No/Drawing No" required>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                        <label>Revision No <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="number" name="revision_no" ng-model="productData.revision_no" id="revision_no" min="0" step="0.01" class="form-control" placeholder="Revision No" required>
                                    </div>											                           
                                </div>
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">                                        
                                        <label>Sr. No <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="number" name="sr_no" ng-model="productData.sr_no" id="sr_no" min="0" step="0.01" class="form-control" placeholder="Sr. No" required>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                        <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="number" name="quantity" ng-model="productData.quantity" id="quantity" min="0" step="0.01" class="form-control" placeholder="Quantity" required>
                                    </div>                                                                     
                                </div>
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">                                        
                                        <label>Unit Rate <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="number" name="unit_rate" ng-model="productData.unit_rate" id="unit_rate" min="0" step="0.01" class="form-control" placeholder="Unit Rate" required>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                        <label>Old Rate <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="number" name="old_rate" ng-model="productData.old_rate" id="old_rate" min="0" step="0.01" class="form-control" placeholder="Old Rate" required>
                                    </div>                                                                     
                                </div>
                                <div class="w3-col l12 w3-margin-bottom" id="poSpecificationDiv"></div>
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                        <label>Due Date <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="text" name="due_date" ng-model="productData.due_date" id="due_date" class="form-control" placeholder="Due Date" required>
                                    </div>
                                </div>
                            </div>
                            <div class=" w3-center w3-col l12" style="">
                                <button  type="submit" title="add purchase order" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Purchase Order</button>
                            </div>
                        </form>
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
<script>
    $(document).ready(function () {
        $(function () {
            var date = new Date();
            date.setDate(date.getDate() + 1);

            var myCalendar = new dhtmlXCalendarObject("due_date");
            myCalendar.hideTime();
            myCalendar.setDateFormat("%d-%m-%Y");
            myCalendar.setInsensitiveRange(date, null);

        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/js/module/po/po.js"></script>
