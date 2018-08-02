<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;" ng-app="pendingPOApp" ng-controller="pendingPOAppController">
        <div id="err_message"></div>
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-clipboard"></i> Pending P.O Orders</h3>
            </div>
        </div>

        <!--div for filter-->
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
                    <button  type="submit" title="filter Po by date" id="btnsubmit" ng-click="getPoByDate()" class="w3-medium w3-button theme_bg">Search P.O</button>
                </div>
            </div>
            <div class="col-lg-12 col-xs-12 col-sm-12" id="materialWeight" style="padding-top:0px; padding-bottom: 10px;">
                <button  type="button" title="Download Pending Order List" id="btnsubmit" ng-click="downloadPendingOrders()" class="w3-medium w3-button theme_bg">Download Pending Order List</button>
            </div>
        </div>
        <!--div for filter-->

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
                                Balance
                            </th>
                            <th class="text-center">
                                Due&nbsp;Date
                            </th>
                            <th class="text-center">
                                Remark
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
                            <td class="w3-center">{{p.line_no}}</td>
                            <td class="w3-center">{{p.product_code + "/" + p.sr_no}}</td>
                            <td class="w3-center">{{p.unit_rate}}</td>                            
                            <td class="w3-center">{{p.quantity}}</td>                            
                            <td class="w3-center" width="10%">
                                <input type="number" class="form-control w3-center" id="balance_{{p.po_id}}" onkeyup="" value="{{p.balanced}}">
                            </td>                            
                            <td class="w3-center">{{p.po_duedate}}</td>
                            <td class="w3-center">
                                <input type="text" class="form-control w3-center" id="remark_{{p.po_id}}" onkeyup="" value="{{p.remark}}">                                
                            </td>
                            <td class="">
                                <div class="w3-center">
                                    <a class="btn w3-padding-small w3-text-green w3-center" ng-click="updatePoDetails(p.po_id)" title="Update Po Details">
                                        Update
                                    </a>
                                </div>                              
                            </td>                            
                        </tr>
                        <tr ng-if=" po == ''">
                            <td colspan="11" class="w3-center"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="message" ng-bind-html="message"></div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/reports/pendingOrders.js"></script>
