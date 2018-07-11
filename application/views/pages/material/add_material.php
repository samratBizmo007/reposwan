<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title"><div class="w3-padding"><h3><i class="fa fa-plus"></i> Add Material</h3></div></div>
        <fieldset>
            <div class="row" style=" margin-top: 5px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="" id="App" ng-app="materialApp" ng-controller="materialController"  style="padding:12px 36px 12px 36px">
                        <form id="add_MaterialForm" method="post" role="form">
                            <div class="w3-col l12" ng-model="material_err"></div>
                            <div class="w3-col l12 w3-margin-bottom">
                                <div class="col-lg-6 col-xs-12 col-sm-12" id="materialCategoryDiv">
                                    <label>Material Type</label>
                                    <select class="form-control" id="mat_cat_id" name="mat_cat_id" onchange="getMaterialSpecifications()" required>
                                        <option value="0">Select Material Type</option>
                                        <option ng-repeat="z in category['status_message']" value="{{z.mat_cat_id}}">{{z.material_type}}</option>
                                    </select>                               
                                </div>
                            </div>
                            <div id="materialDiv" style=" display: none;">
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialGrade">
                                        <label>Material Grade</label>
                                        <input type="text" name="material_grade" ng-model="materialData.material_grade" id="material_grade"  class="form-control" placeholder="Material Grade" value="" required>
                                    </div>
                                </div>
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">										
                                        <label>Material Rate</label>
                                        <input type="number" name="material_rate" ng-model="materialData.material_rate" id="material_rate" min="0" step="0.01" class="form-control" placeholder="Material Rate" required>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                        <label>Material Weight</label>
                                        <input type="number" name="material_weight" ng-model="materialData.material_weight" id="material_weight" min="0" step="0.01" class="form-control" placeholder="Material Weight" required>
                                    </div>											                           
                                </div>
                                <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv"></div>
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">
                                        <label>Remark</label>
                                        <textarea  class="form-control" name="remark" id="remark" ng-model="materialData.remark" placeholder="Remark" rows="5" cols="50" style="resize: none;" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class=" w3-center w3-col l12" style="">
                                <button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Material</button>
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

<script src="<?php echo base_url(); ?>assets/js/module/material/material.js"></script>
