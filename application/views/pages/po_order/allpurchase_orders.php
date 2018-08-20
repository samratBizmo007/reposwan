<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;" ng-app="allPOApp" ng-controller="allPOAppController">
        <div id="err_message"></div>
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-cubes"></i> All Purchase Orders</h3>
            </div>
        </div>
        <div class="row x_title" style=" margin-top: 5px;">
            <div class="w3-padding-small">
                <h4>Find P.O</h4>                
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
                    <button  type="submit" title="filter Po by date" id="btnsubmit" ng-click="getAllPoByDate()" class="w3-medium w3-button theme_bg">Search P.O</button>
                </div>
            </div>
        </div>
        <div class="row clearfix" style=" margin-top: 5px;">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <table class="table table-responsive" id="tab_logic">
                    <thead>
                        <tr class="theme_bg">
                            <th width="7%" class="text-center">
                                Sr No
                            </th>
                            <th class="text-center">
                                Customer Name
                            </th>
                            <th class="text-center">
                                P.O Number
                            </th>
                            <th class="text-center">
                                Due Date
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id='addedRows'>                       
                        <tr id="rowCount" ng-if="po != ''" ng-repeat="p in po">
                            <td class="w3-center">{{$index + 1}}</td>
                            <td class="w3-center">{{p.customer_name}}</td>
                            <td class="w3-center">{{p.order_no}}</td>
                            <td class="w3-center">{{p.po_duedate}}</td>
                            <td class="">
                                <div class="w3-center">
                                    <a class="btn w3-padding-small w3-center" data-toggle="modal" data-target="#updateMaterialModal_{{p.po_id}}" title="Update Po Details">
                                        <i class="w3-text-green w3-large fa fa-search"></i>
                                    </a>                   
                                    <a class="btn w3-padding-small w3-center" ng-click="deletePODetails(p.po_id)" title="Delete Material">
                                        <i class="w3-text-red w3-large fa fa-trash"></i>
                                    </a>
                                </div>
                                <div id="updateMaterialModal_{{p.po_id}}" class="modal" role="dialog">
                                    <form id="updateMaterialForm" name="updateMaterialForm">
                                        <div class="modal-dialog modal-lg">
                                            <!----------------------------------- Modal content------------------------------------>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Show Po Details</h4>
                                                </div>
                                                <!----------------------------------- Modal Body------------------------------------>                                        
                                                <div class="modal-body">
                                                    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
                                                        <fieldset>
                                                            <div class="row" style="margin-top: 5px;">
                                                                <h4 class="w3-right w3-padding">{{p.customer_name}}</h4>
                                                                <span class="w3-col l12" style="border: solid; margin-top: 10px; margin-bottom: 10px;;"></span>
                                                                <span class="w3-col l12"><h4 class="w3-center">PURCHASE ORDER</h4></span>
                                                                <div class="w3-col l12">
                                                                    <div class="col-lg-6 w3-left">
                                                                        <label>Company Name:<span> {{p.customer_name}}</span></label>
                                                                    </div>
                                                                    <div class="col-lg-6 w3-right">
                                                                        <div class="w3-right">
                                                                            <label>Order No:<span> {{p.order_no}}</span></label><br>                                                                        
                                                                            <label>Added date:<span> {{p.added_date}}</span></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row clearfix" style=" margin-top: 5px;">
                                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                                                            <table class="table table-responsive" id="tab_logic">
                                                                                <thead>
                                                                                    <tr class="theme_bg">
                                                                                        <th width="7%" class="text-center">
                                                                                            line No
                                                                                        </th>
                                                                                        <th class="text-center">
                                                                                            Item Code / Description
                                                                                        </th>
                                                                                        <th class="text-center">
                                                                                            Due Date
                                                                                        </th>
                                                                                        <th class="text-center">
                                                                                            Quantity
                                                                                        </th>
                                                                                        <th class="text-center">
                                                                                            Unit Rate
                                                                                        </th>
                                                                                        <th class="text-center">
                                                                                            Net Amount
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id='addedRowsnew'>                       
                                                                                    <tr id="rowCountnew" ng-repeat="o in p.product_details">
                                                                                        <td class="w3-center">{{o.line_no}}</td>
                                                                                        <td class="w3-center">
                                                                                            <span>{{o.product_code}}</span><br>
                                                                                            <span>{{o.product_name}}</span>
                                                                                        </td>
                                                                                        <td class="w3-center">{{o.due_date}}</td>
                                                                                        <td class="w3-center">{{o.quantity}}</td>
                                                                                        <td class="w3-center">{{o.unit_rate}}</td>
                                                                                        <td class="w3-center">{{o.netAmount}}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                                                    <div class="w3-right w3-margin-right">
                                                                        <label class="">Total Net Amount:<span class=""> {{p.po_total}}</span></label>
                                                                    </div>
                                                                </div>
                                                                <!-- REGISTER DIV ENDS -->   
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
                            </td>                            
                        </tr>
                        <tr ng-if=" po == []">
                            <td colspan="5" class="w3-center">No Records Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div ng-bind-html="messg_info"></div>
    </div>
</div>

<!-- page content ends-->
<script src="<?php echo base_url(); ?>assets/js/module/po/show_po.js"></script>
