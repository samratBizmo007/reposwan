<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-cubes"></i> All Material</h3>
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
                        <tr id='rowCount' ng-if="materials['status'] == 200" ng-repeat="d in materials['status_message']">
                            <td class="w3-center">{{d.material_id}}</td>
                            <td class="w3-center">{{d.material_type}}</td>
                            <td class="w3-center">{{d.material_grade}}</td>
                            <td class="w3-center">{{d.material_rate}}</td>
                            <td class="w3-center">{{d.material_weight}}</td>
                            <td class="w3-center">{{d.remark}}</td>
                            <td class="w3-center">
                                <a class="btn w3-padding-small" ng-href="" onclick="" title="Update Material Details">
                                    <i class="w3-text-green w3-large fa fa-check-circle"></i>
                                </a>                   
                                <a class="btn w3-padding-small" ng-href="" onclick="" title="Delete Material">
                                    <i class="w3-text-red w3-large fa fa-times-circle"></i>
                                </a>
                            </td>
                        </tr>
                        <tr ng-if="!(materials['status'] == 200)">
                            <td colspan="8" class="w3-center">{{materials['status_message']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- page content ends-->
<script src="<?php echo base_url(); ?>assets/js/module/material/all_material.js"></script>
