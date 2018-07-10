<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-cubes"></i> Show Material</h3>
            </div>
        </div>
        <div class="row clearfix" style=" margin-top: 5px;" ng-app="showMaterialApp" ng-controller="showMaterialController">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <table class="table table-bordered table-hover css-serial " id="tab_logic" width:50px;">
                       <thead>
                        <tr class="theme_bg">
                            <th width="7%" class="text-center">
                                Sr No
                            </th>
                            <th class="text-center">
                                Material Type
                            </th>
                            <th class="text-center">
                                Material Name
                            </th>
                            <th class="text-center">
                                Rate
                            </th>
                            <th class="text-center">
                                Weight
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
                        <tr id='rowCount'>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- page content ends-->
