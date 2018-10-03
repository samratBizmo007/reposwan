<!-- page content -->
<style>
    .active{
        background-color: #2A3F54;
        color: #ECF0F1;
    }
</style>
<div class="right_col" role="main"><!-- main div starts here-->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;" ng-app="productionApp" ng-controller="productionController">
        <div id="err_message"></div>
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-list"></i> Production</h3>
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
                <div class="col-lg-2 col-xs-12 col-sm-12" id="materialWeight" style="padding-top: 23px;">
                    <button  type="button" title="filter Po by date" id="btnsubmit" ng-click="getAllSharedInprogressPoDetailsBydate()" class="w3-medium w3-button theme_bg">Search P.O</button>
                </div>
            </div>
            <div ng-if="po == 500">
                <fieldset>
                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-medium w3-center">
                        <span class="w3-center w3-text-black"><b> NO Records Are Available..! </b></span>
                    </div>
                </fieldset>
            </div>
            <div ng-if="po != 500">
                <fieldset>
                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-small">
                        <div id="sharedPoDiv" class="col-lg-3 w3-small col-xs-12 col-sm-12 w3-border-right">
                            <div class="w3-col l12 w3-small" ng-repeat="p in po">
                                <div class="test w3-bar-item w3-button w3-border-bottom" style="margin-bottom: 5px; width: 250px;">
                                    <a class="btn w3-small w3-text-black" ng-click="show_ProductionPo_Orderinfo(p.po_id, p.product_code)"><b>PO #O-{{p.order_no}} - {{p.product_code + "/" + p.sr_no}}</b></a>
                                </div>
                            </div>
                        </div>
                        <div id="sharedPoDetailsDiv" class="col-lg-9 col-xs-12 col-sm-12">

                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div id="message" ng-bind-html="message"></div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/module/production/production.js"></script>
