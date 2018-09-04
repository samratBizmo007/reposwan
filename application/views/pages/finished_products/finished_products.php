<!-- page content -->
<?php 
error_reporting(E_ERROR | E_PARSE);
?>
<style>
    .active{
        background-color: #2A3F54;
        color: #ECF0F1;
    }
</style>
<div class="right_col" role="main"><!-- main div starts here-->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;" ng-app="finishedProdApp" ng-controller="finishedProdController">
        <div id="err_message"></div>
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-list"></i> Finished Products</h3>
            </div>
        </div>
        <div class="row x_title" style=" margin-top: 5px;">
            <div class="w3-padding-small">
                <h4>Filter P.O</h4>                
            </div>
            <div class="col-lg-12 w3-small col-xs-12 col-sm-12 w3-margin-bottom">
                <div class="col-lg-5 col-xs-12 col-sm-12" id="materialWeight">
                    <label>From Date <b class="w3-text-red w3-medium">*</b></label>
                    <input type="date" name="from_date" id="from_date" value="" class="form-control" placeholder="From Date" required>
                </div>
                <div class="col-lg-5 col-xs-12 col-sm-12" id="materialWeight">
                    <label>To Date <b class="w3-text-red w3-medium">*</b></label>
                    <input type="date" name="to_date" id="to_date" value="" class="form-control" placeholder="To Date" required>
                </div>
                <div class="col-lg-2 col-xs-12 col-sm-12" id="" style="padding-top: 23px;">
                    <button  type="button" title="filter Po by date" id="btnsubmit" ng-click="getPos()" class="w3-medium w3-button theme_bg">Search P.O</button>
                </div>
            </div>
        </div>
        <fieldset>
            <div class="col-lg-12 col-xs-12 col-sm-12 w3-small">
                <div id="sharedPoDiv" class="col-lg-3 w3-small w3-padding col-xs-12 col-sm-12" style="height: 500px; overflow-y: auto;">
                    <div class="w3-col l12 w3-center w3-small" ng-repeat="p in po">
                        <div class="test w3-bar-item w3-button w3-border-bottom" style="margin-bottom: 5px; width: 240px;">
                            <a class="btn w3-small w3-text-center w3-text-black" ng-click="show_FinishedPoDetails(p.po_id, p.product_code)"><b>PO #O-{{p.order_no}} - {{p.product_code + "/" + p.sr_no}}</b></a>
                        </div>
                    </div>
                </div>
                <div id="finishedProductPo" class="col-lg-9 col-xs-12 col-sm-12" style=" display: none">
                    <div class="w3-margin-bottom ">
                        <fieldset>
                            <div class="row" style="margin-top: 5px; margin-bottom: 5px;" ng-repeat="po in poData">
                                <form name="poProduction_form" id="poProduction_form" method="POST">
                                    <div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom"><hr>
                                        <div class="w3-col l4 col-xs-12 col-sm-12">
                                            Customer Name: <b class="w3-text-black">{{po.customer_name}}</b>
                                        </div>
                                        <div class="w3-col l4 col-xs-12 col-sm-12">
                                            Order No: <b class="w3-text-black">{{po.order_no}}</b>
                                        </div>
                                        <div class="w3-col l4 col-xs-12 col-sm-12">
                                            Part Code/ Sr.No: <b class="w3-text-black">{{po.product_code + "/" + po.sr_no}}</b>
                                        </div>
                                    </div>
                                    <div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom"><hr>
                                        <div class=" w3-col l3 col-xs-12 col-sm-12">
                                            Drawing no : <b class="w3-text-black">{{po.part_drwing_no}}</b>
                                        </div>
                                        <div class=" w3-col l3 col-xs-12 col-sm-12">
                                            Revision No : <b class="w3-text-black">{{po.revision_no}}</b>
                                        </div>
                                        <div class=" w3-col l3 col-xs-12 col-sm-12">
                                            P.O Prod Qty : <b class="w3-text-black">{{po.quantity}}</b>
                                        </div>
                                        <div class=" w3-col l3 col-xs-12 col-sm-12">
                                            Stock Quantity : <b class="w3-text-black">{{po.subproduct_quantity}}</b>
                                        </div>
                                    </div>
                                    <div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom"><hr>
                                        <div class="w3-col l4 col-xs-12 col-sm-12">
                                            Shared Qty : <b class="w3-text-black">{{po.shared_product_quantity}}</b>
                                        </div>
                                    
                                        <div class="w3-col l4 col-xs-12 col-sm-12">
                                            Produced Qty : <b class="w3-text-black">{{po.produced_qty}}</b>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-padding-bottom"><hr>
                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Stock Qty</label>
                                            <input type="number" min="0" class="form-control w3-center" id="stock_quantity_{{po.po_id}}" ng-keyup="getTotalQty(po.po_id)" name="stock_quantity" value="{{po.totalQty}}">
                                            <input type="hidden" min="0" class="form-control w3-center" id="produced_qty_{{po.po_id}}" ng-keyup="getTotalQty(po.po_id)" name="produced_qty" value="{{po.produced_qty}}">
                                        </div>
<!--                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Produced Qty</label>
                                            <input type="number" min="0" class="form-control w3-center" id="produced_qty_{{po.po_id}}" ng-keyup="getTotalQty(po.po_id)" name="produced_qty" value="{{po.produced_qty}}">
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Total Qty</label>
                                            <input type="number" min="0" class="form-control w3-center" id="total_qty_{{po.po_id}}" readonly name="total_qty" value="{{po.totalQty}}">
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Remaining Qty</label>
                                            <input type="number" min="0" class="form-control w3-center" id="Remaining_{{po.po_id}}" readonly name="Remaining" value="">
                                        </div>-->
                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Balanced</label>
                                            <input type="number" min="0" class="form-control w3-center" readonly id="Balanced_{{po.po_id}}" name="Balanced" value="{{po.balanced}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-padding-bottom w3-padding-top">
                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Dispatched Qty</label>
                                            <input type="number" class="form-control w3-center" min="0" ng-model="dispatched_qty" id="dispatched_qty_{{po.po_id}}" name="dispatched_qty" value="{{po.dispatched}}">
                                            <input type="hidden" id="po_id" name="po_id" readonly class="form-control" value="{{po.po_id}}">
                                            <input type="hidden" id="po_quantity_{{po.po_id}}" name="po_quantity" readonly class="form-control" value="{{po.quantity}}">
                                            <input type="hidden" id="machineDetails" name="machineDetails" class="form-control" value="{{po.po_machinedetails}}">
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Bill No</label>
                                            <input type="text" class="form-control w3-center" ng-model="bill_no" id="bill_no_{{po.po_id}}" name="bill_no" value="">
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                            <label>Date</label>
                                            <input type="date" class="form-control w3-center" ng-model="dispatched_date" id="dispatched_date_{{po.po_id}}" name="dispatched_date" >
                                        </div>
                                    </div>
                                    <div class="w3-col l12 col-xs-12 col-sm-12 w3-margin-bottom" ng-repeat="f in po.finishedpobills"><hr>
                                        <div class=" w3-col l4 col-xs-12 col-sm-12">
                                            <label>Dispatched Qty:</label>
                                            <span class="w3-text-black"><b>{{f.dispatched_qty}}</b></span>
<!--                                            <input type="text" class="form-control w3-center" disabled value="{{f.dispatched_qty}}">-->
                                        </div>
                                        <div class=" w3-col l4 col-xs-12 col-sm-12">
                                            <label>Bill NO: </label>
                                            <span class="w3-text-black"><b>{{f.bill_no}}</b></span>
<!--                                            <input type="text" class="form-control w3-center" disabled value="{{f.bill_no}}">-->
                                        </div>
                                        <div class=" w3-col l4 col-xs-12 col-sm-12">
                                            <label>Dispatched Date: </label>
                                            <span class="w3-text-black"><b>{{f.dispatched_date}}</b></span>
<!--                                            <input type="text" class="form-control w3-center" disabled value="{{f.dispatched_date}}">-->
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-center w3-padding-top" id="" style="padding-top: 20px;">
                                        <button type="button" title="filter Po by date" id="btnsubmit" ng-click="updateFinishedProductDetails(po.po_id, po.product_code, po.part_drwing_no)" class="w3-medium w3-button w3-center theme_bg">Update Po</button>
                                    </div>
                                </form>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </fieldset>
        <!--        <div class="row clearfix" style=" margin-top: 5px;">
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
                                        Drawing No / Sr.No
                                    </th>
                                    <th class="text-center">
                                        Stock Qty
                                    </th>
                                    <th class="text-center">
                                        Produced Qty
                                    </th>
                                    <th class="text-center">
                                        Total Qty
                                    </th>
                                    <th class="text-center">
                                        Po Quantity
                                    </th>
                                    <th class="text-center">
                                        Dispatched Qty
                                    </th>
                                    <th>
                                        Bill No
                                    </th>
                                    <th class="text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id='addedRows'>                       
                                <tr id="rowCount" class="w3-small" ng-if="po != ''" ng-repeat="p in po">
                                    <td class="w3-center">{{$index + 1}}</td>
                                    <td class="w3-center">{{p.order_no}}</td>
                                    <td class="w3-center">{{p.added_date}}</td>
                                    <td class="w3-center">{{p.product_code + "/" + p.sr_no}}</td>
                                    <td class="w3-center">
                                        <input class="form-control w3-center" id="stock_quantity_{{p.po_id}}" ng-keyup="getTotalQty(p.po_id)" name="stock_quantity" value="{{p.subproduct_quantity}}">
                                    </td>
                                    <td class="w3-center"> 
                                        <input class="form-control w3-center" id="produced_qty_{{p.po_id}}" ng-keyup="getTotalQty(p.po_id)" name="produced_qty" value="{{p.produced_qty}}">
                                    </td>
                                    <td class="w3-center"> 
                                        <input class="form-control w3-center" id="total_qty_{{p.po_id}}" readonly name="total_qty" value="{{p.totalQty}}">
                                    </td>                             
                                    <td class="w3-center"> 
                                        <input class="form-control w3-center" id="po_quantity_{{p.po_id}}" name="po_quantity" value="{{p.quantity}}">
                                    </td>                            
                                    <td class="w3-center"> 
                                        <input class="form-control w3-center" id="dispatched_qty_{{p.po_id}}" name="dispatched_qty" value="{{p.dispatched}}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn sub" ng-click="showPoBillNo(p.po_id)">Bill No<span class=" fa fa-chevron-down"></span></button>
                                    </td>
                                    <td class="w3-center">
                                        <a class="btn w3-block w3-text-green w3-padding-small"  ng-click="updateFinishedProductDetails(p.po_id, p.product_code, p.part_drwing_no)" title="Update PO Details">
                                            Update
                                        </a>                               
                                    </td>
                                </tr>
                                <tr id="collapseme_{{p.po_id}}" class="collapse out">
                                    <td colspan="10">
                                        <div>hellos</div>
                                    </td>
                                </tr>
                                <tr ng-if="po == []">
                                    <td colspan="10" class="w3-center">No Records Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>-->
        <div id="message" ng-bind-html="message"></div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/finished_products/finished_products.js"></script>
