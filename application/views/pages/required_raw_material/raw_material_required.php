<!-- page content -->
<div class="right_col" role="main"><!-- main div starts here-->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;" ng-app="requiredMaterialApp" ng-controller="requiredMaterialController">
        <div id="err_message"></div>
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-list"></i> Purchase Orders</h3>
            </div>
        </div>
        <div class="row x_title" style=" margin-top: 5px;">
            <div class="w3-padding-small">
                <h4>Filter P.O</h4>                
            </div>
            <div class="w3-col l12 w3-margin-bottom">
                <div class="col-lg-5 col-xs-12 col-sm-12" id="materialWeight">
                    <label>From Date <b class="w3-text-red w3-medium">*</b></label>
                    <input type="date" name="from_date" ng-model="from_date" id="from_date" value="" class="form-control" placeholder="From Date" required>
                </div>
                <div class="col-lg-5 col-xs-12 col-sm-12" id="materialWeight">
                    <label>To Date <b class="w3-text-red w3-medium">*</b></label>
                    <input type="date" name="to_date" ng-model="to_date" id="to_date" value="" class="form-control" placeholder="To Date" required>
                </div>
                <div class="col-lg-2 col-xs-12 col-sm-12" id="materialWeight" style="padding-top: 23px;">
                    <button  type="submit" title="filter Po by date" id="btnsubmit" ng-click="getPoDetails();getAllPurchaseOrdersByDate()" class="w3-medium w3-button theme_bg">Search P.O</button>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                    <label for="rm_grade">Purchase Orders<b class="w3-text-red w3-medium">*</b> :</label>
                    <select name="po_orders" class="form-control w3-small" ng-model="po_ordersSelected" onchange="getPoProductDetails()" id="po_orders">
                        <option value="0" selected>Select Purchase Orders</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="w3-col l12" id="requiredMaterial">

        </div>
        <!-- table div starts here-->
        <div class="row clearfix" style=" margin-top: 5px;">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <table class="table table-responsive" id="tab_logic">
                    <thead>
                        <tr class="theme_bg w3-small">
                            <th width="7%" class="text-center">
                                Sr No
                            </th>
                            <th class="text-center">
                                P.O Number
                            </th>
                            <th class="text-center">
                                P.O&nbsp;Date
                            </th>
                            <th class="text-center">
                                Line No
                            </th>
                            <th class="text-center">
                                Drawing No / Sr.No
                            </th>
                            <th class="text-center">
                                Rate
                            </th>
                            <th class="text-center">
                                Quantity
                            </th>
                            <th class="text-center">
                                Due&nbsp;Date
                            </th>
                            <th class="text-center">
                                Remark
                            </th>
<!--                            <th class="text-center">
                                Action
                            </th>-->
                        </tr>
                    </thead>
                    <tbody id='addedRows'>                       
                        <tr id="rowCount" class="w3-small" ng-if="po != ''" ng-repeat="p in po">
                            <td class="w3-center">{{$index + 1}}</td>
                            <td class="w3-center">{{p.order_no}}</td>
                            <td class="w3-center">{{p.added_date}}</td>
                            <td class="w3-center">{{p.line_no}}</td>
                            <td class="w3-center">{{p.product_code + "/" + p.sr_no}}</td>
                            <td class="w3-center">{{p.unit_rate}}</td>                            
                            <td class="w3-center">{{p.quantity}}</td>                            
                            <td class="w3-center">{{p.po_duedate}}</td>
                            <td class="w3-center w3-text-green" ng-if="p.remark_type != 1">
                                {{p.remark}}                               
                            </td>
                            <td class="w3-center w3-text-red" ng-if="p.remark_type == 1">
                                {{p.remark}}                               
                            </td>
<!--                            <td class="">
                                <div class="w3-center">
                                    <a class="btn w3-padding-small w3-text-green w3-center" data class="btn" data-toggle="modal" data-target="#updateMaterialModal_{{p.po_id}}" title="Update Po Details">
                                        Material Required
                                    </a>
                                </div>  
                                <div id="updateMaterialModal_{{p.po_id}}" class="modal" role="dialog">
                                    <form id="updateMaterialForm" name="updateMaterialForm">
                                        <div class="modal-dialog modal-lg">
                                            --------------------------------- Modal content----------------------------------
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Show Po Details</h4>
                                                </div>
                                                --------------------------------- Modal Body----------------------------------                                        
                                                <div class="modal-body">
                                                    <div class="container" style="margin-top: 0px;margin-bottom: 0px;">
                                                        <fieldset>
                                                            <div class="row w3-padding" style="margin-top: 5px;">
                                                                <div class="col-lg-12">
                                                                    <div class=" w3-col l12 w3-padding-bottom">
                                                                        Customer Name: <b class="w3-text-black">{{p.customer_name}}</b>
                                                                    </div>
                                                                    <div class="w3-col l12">
                                                                        <div class=" w3-col l4">
                                                                            Drawing no : <b class="w3-text-black">{{p.part_drwing_no}}</b> 
                                                                        </div>
                                                                        <div class=" w3-col l4">
                                                                            Revision No : <b class="w3-text-black">{{p.revision_no}}</b> 
                                                                        </div>
                                                                        <div class=" w3-col l4">
                                                                            Product Quantity : <b class="w3-text-black">{{p.quantity}}</b> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12" ng-repeat="r in p.rawMaterialRequired">
                                                                        <hr>
                                                                        <div class="w3-col l2">
                                                                            <div class="w3-center" ng-if="r.rm_type == 1">
                                                                                <label> Type </label><br>
                                                                                <span class="w3-center"><b class="w3-text-black">SHEET</b></span>
                                                                            </div>
                                                                            <div class="w3-center" ng-if="r.rm_type == 2">
                                                                                <label> Type </label><br>
                                                                                <span class="w3-center"><b class="w3-text-black">WIRE</b></span>
                                                                            </div>
                                                                            <div class="w3-center" ng-if="r.rm_type == 3">
                                                                                <label> Type </label><br>
                                                                                <span class="w3-center"><b class="w3-text-black">CIRCLE</b></span>
                                                                            </div>
                                                                            <div class="w3-center" ng-if="r.rm_type == 4">
                                                                                <label> Type </label><br>
                                                                                <span class="w3-center"><b class="w3-text-black">TUBE</b></span>
                                                                            </div>
                                                                            <div class="w3-center" ng-if="r.rm_type == 5">
                                                                                <label> Type </label><br>
                                                                                <span><b class="w3-text-black">BAR</b></span>
                                                                            </div>
                                                                            <div class="w3-center" ng-if="r.rm_type == 6">
                                                                                <label> Type </label><br>
                                                                                <span class="w3-center"><b class="w3-text-black">NUT</b></span>
                                                                            </div>
                                                                            <div class="w3-center" ng-if="r.rm_type == 7">
                                                                                <label> Type </label>
                                                                                <span class="w3-center"><b class="w3-text-black">BOLT</b></span>
                                                                            </div>
                                                                            <div class="w3-center" ng-if="r.rm_type == 8">
                                                                                <label> Type </label><br>
                                                                                <span class="w3-center"><b class="w3-text-black">BUSH</b></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>Grade</label><br> 
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmgradeSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>Thickness</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmthickSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>Diameter</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmdiaSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">                                                                                                                                                        
                                                                            <label>ID</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmIDSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>OD</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmODSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>Pitch</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmPitchSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>Weight</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmweightSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>Length</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmlenSelected}}</b></span>
                                                                        </div>
                                                                        <div class="w3-col l1 w3-center">
                                                                            <label>Quantity</label><br>
                                                                            <span class="w3-center"><b class="w3-text-black">{{r.rmqtySelected}}</b></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-xs-12 col-sm-12 w3-padding-top">
                                                                    <label>Remark</label>
                                                                    <textarea class="form-control" name="remark" id="remark" ng-model="remark" placeholder="Remark" rows="5" cols="50" style="resize: none;"></textarea>
                                                                </div>
                                                                <div class="col-lg-12 col-xs-12 col-sm-12 w3-center" id="materialWeight" style="padding-top: 23px;">
                                                                    <button type="button" title="filter Po by date" id="btnsubmit" class="w3-medium w3-button theme_bg">Change Status</button>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 w3-padding">
                                                                    <div class="w3-right w3-margin-right">
                                                                        <label class="">Total Net Amount:<span class=""> {{p.po_total}}</span></label>
                                                                    </div>
                                                                </div>
                                                                REGISTER DIV ENDS    
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                --------------------------------- Modal Body----------------------------------                                                                               
                                            </div>
                                            --------------------------------- Modal content-----------------------------------
                                        </div>
                                    </form>
                                </div>
                            </td>                                                   -->
                        </tr>
                        <tr ng-if=" po == []">
                            <td colspan="11" class="w3-center">No Records Found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="message" ng-bind-html="message"></div>
    </div><!-- container ends here-->
</div><!-- main div ends here-->
<script src="<?php echo base_url(); ?>assets/js/module/raw_material_required/raw_material_required.js"></script>
