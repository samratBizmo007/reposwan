<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-list"></i> Inventory</h3>
            </div>
        </div>
        <div class="row clearfix" style=" margin-top: 5px;">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#rawMaterials" data-toggle="tab"><i class="fa fa-cubes"></i>  Raw Materials</a></li>
                    <li><a href="#finishedProducts" data-toggle="tab"><i class="fa fa-cube"></i> Products</a></li>
                </ul>
            </div>
            <div class="tab-content clearfix" ng-app="showInventoryApp" ng-controller="showInventoryController"><br><!-- tab containt starts -->
                <div class="tab-pane active" id="rawMaterials">  
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <table class="table table-responsive" id="tab_logic">
                                <thead>
                                    <tr class="theme_bg">
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
                                            Quantity
                                        </th>
                                        <th class="text-center">
                                            Length
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id='addedRows'>
                                    <tr id="rowCount" ng-repeat=" m in materials['status_message']">
                                        <td class="w3-center">{{ m.material_type }}</td>
                                        <td class="w3-center">{{ m.material_grade }}</td>
                                        <td class="w3-center">{{ m.material_rate }}</td>
                                        <td class="w3-center">{{ m.material_weight }}</td>
                                        <td class="w3-center">{{ m.quantity }}</td>
                                        <td class="w3-center">{{ m.length }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="finishedProducts"><!-- tab 2 starts here -->
                    <div>bye</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/inventory/inventory.js"></script>
