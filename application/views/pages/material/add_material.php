<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="container" style="margin-top: 71px;margin-bottom: 71px;">		
        <div class="row">
            <div class="col-lg-2 w3-border"></div>
            <div class="col-lg-8 w3-border">
                <div class="container" id="App" ng-app="materialApp" ng-controller="materialController"  style="padding:12px 36px 12px 36px">
                    <form id="add_MaterialForm" method="post" role="form" ng-submit="submitMaterialData()">
                        <div class="w3-col l12 " id="material_err">{{material_err}}</div>
                        <div id="w3-col l12">
                            <div class="w3-col l12 w3-margin-bottom">
                                <div class="col-lg-6 col-xs-12 col-sm-12" id="materialCategoryDiv">
                                    <label>Material Type</label>
                                    <select class="w3-input w3-border w3-light-grey" id="mat_cat_id" name="mat_cat_id" ng-model="mat_cat_idSelected" ng-change="getMaterialSpecifications()">
                                        <option ng-repeat="z in category['status_message']" ng-selected="materialData.mat_cat_id == z.mat_cat_id" value="{{z.mat_cat_id}}">{{z.material_type}}</option>
                                    </select>                               
                                </div>
                            </div>
                            <div class="w3-col l12 w3-margin-bottom">
                                <div class="col-lg-6 col-xs-12 col-sm-12" id="materialGrade">
                                    <label>Material Grade</label>
                                    <input type="text" name="material_grade" ng-model="materialData.material_grade" id="material_grade"  class="w3-input w3-border w3-light-grey " placeholder="Material Grade" value="" required>
                                </div>
                            </div>
                            <div class="w3-col l12 w3-margin-bottom">
                                <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">										
                                    <label>Material Rate</label>
                                    <input type="number" name="material_rate" ng-model="materialData.material_rate" id="material_rate" class="w3-input w3-border w3-light-grey" placeholder="Material Rate" required>
                                </div>
                                <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                    <label>Material Weight</label>
                                    <input type="number" name="material_weight" ng-model="materialData.material_weight" id="material_weight" class="w3-input w3-border w3-light-grey" placeholder="Material Weight" required>
                                </div>											                           
                            </div>									
                        </div>
                        <div class="w3-col l12 w3-margin-bottom" ng-bind-html="getMaterialSpecificationsDiv">
                        </div>
                        <div class=" w3-center w3-col l12" style="">
                            <button  type="submit" title="add Material" class="w3-medium w3-button w3-orange">Add Material</button>
                        </div>
                    </form>
                </div>
                <!-- REGISTER DIV ENDS -->   
            </div>
            <div class="col-lg-2 w3-border"></div>
        </div>
    </div>
    <!-- /top tiles -->
</div>
<!-- /page content -->

<!-- script for the add material form  -->
<script type="text/javascript">
    var myApp = angular.module('materialApp', []);
    myApp.controller('materialController', function ($scope,$http, $sce) {

        $scope.submitMaterialData = function () {
            $http({
                method: "POST",
                url: "<?php echo base_url(); ?>materials/addmaterial/addMaterialInfo",
                data: $scope.materialData
            }).then(function (response) {
                //alert(data);
                $scope.material_err = response;
                //$('#material_err').val(data);
                //document.getElementById("material_err").innerHTML = data;
            });
        };

        $http.get("<?php echo base_url(); ?>materials/addmaterial/getAllMaterialCategories").then(function (categoryinfo) {
            console.log(categoryinfo);
            $scope.category = categoryinfo.data;
        });

        var thicknesssheetquantity = $sce.trustAsHtml("<div class='w3-col l12'>\n\
    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Thickness</label>\n\
<input type='number' name='thickness' ng-model='materialData.thickness' id='thickness' class='w3-input w3-border w3-light-grey' placeholder='Material Thickness' required>\n\
</div>\n\
<div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Sheet Quantity</label>\n\
<input type='number' name='sheet_quantity' ng-model='materialData.sheet_quantity' id='sheet_quantity' class='w3-input w3-border w3-light-grey' placeholder='Sheet Quantity' required>\n\
</div>\n\
</div>");

        var diameter = $sce.trustAsHtml("<div class='w3-col l12'>\n\
    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Diameter</label>\n\
<input type='number' name='diameter' ng-model='materialData.diameter' id='diameter' class='w3-input w3-border w3-light-grey' placeholder='Material Diameter' required>\n\
</div>\n\
</div>");

        var thicknesscirclequantity = $sce.trustAsHtml("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Thickness</label>\n\
<input type='number' name='thickness' ng-model='materialData.thickness' id='thickness' class='w3-input w3-border w3-light-grey' placeholder='Material Thickness' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Circle Quantity</label>\n\
<input type='number' name='circle_quantity' ng-model='materialData.circle_quantity' id='circle_quantity' class='w3-input w3-border w3-light-grey' placeholder='Circle Quantity' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Diagram No</label>\n\
<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' class='w3-input w3-border w3-light-grey' placeholder='Diagram No' required>\n\
</div>\n\
</div>");

        var idodlength = $sce.trustAsHtml("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>ID</label>\n\
<input type='number' name='id' ng-model='materialData.id' id='id' class='w3-input w3-border w3-light-grey' placeholder='ID' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>OD</label>\n\
<input type='number' name='od' ng-model='materialData.od' id='od' class='w3-input w3-border w3-light-grey' placeholder='OD' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Length</label>\n\
<input type='number' name='length' ng-model='materialData.length' id='length' class='w3-input w3-border w3-light-grey' placeholder='Length' required>\n\
</div>\n\
</div>");

        var odlength = $sce.trustAsHtml("<div class='w3-col l12'>\n\
    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>OD</label>\n\
<input type='number' name='od' ng-model='materialData.od' id='od' class='w3-input w3-border w3-light-grey' placeholder='OD' required>\n\
</div>\n\
<div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Length</label>\n\
<input type='number' name='length' ng-model='materialData.length' id='length' class='w3-input w3-border w3-light-grey' placeholder='Length' required>\n\
</div>\n\
</div>");

        var id_pitching_quantity_diagno = $sce.trustAsHtml("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>ID</label>\n\
<input type='number' name='id' ng-model='materialData.id' id='id' class='w3-input w3-border w3-light-grey' placeholder='ID' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Pitching</label>\n\
<input type='number' name='pitching' ng-model='materialData.pitching' id='pitching' class='w3-input w3-border w3-light-grey' placeholder='Pitching' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Quantity</label>\n\
<input type='number' name='quantity' ng-model='materialData.quantity' id='quantity' class='w3-input w3-border w3-light-grey' placeholder='Quantity' required>\n\
</div>\n\
</div>\n\
<div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12 w3-margin-top'>\n\
<label>Diagram No</label>\n\
<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' class='w3-input w3-border w3-light-grey' placeholder='Diagram No' required>\n\
</div>\n\
</div>");

        var od_pitching_quantity_diagno = $sce.trustAsHtml("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>OD</label>\n\
<input type='number' name='od' ng-model='materialData.od' id='od' class='w3-input w3-border w3-light-grey' placeholder='OD' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Pitching</label>\n\
<input type='number' name='pitching' ng-model='materialData.pitching' id='pitching' class='w3-input w3-border w3-light-grey' placeholder='Pitching' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Quantity</label>\n\
<input type='number' name='quantity' ng-model='materialData.quantity' id='quantity' class='w3-input w3-border w3-light-grey' placeholder='Quantity' required>\n\
</div>\n\
</div>\n\
<div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12 w3-margin-top'>\n\
<label>Diagram No</label>\n\
<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' class='w3-input w3-border w3-light-grey' placeholder='Diagram No' required>\n\
</div>\n\
</div>");


        $scope.getMaterialSpecifications = function () {
            console.log('mat_cat_idSelected', $scope.mat_cat_idSelected);
            var material_category = $scope.mat_cat_idSelected;
            //alert(material_category);

            switch (material_category) {
                case '1':
                    $scope.getMaterialSpecificationsDiv = thicknesssheetquantity;
                    break;
                case '2':
                    $scope.getMaterialSpecificationsDiv = diameter;
                    break;
                case '3':
                    $scope.getMaterialSpecificationsDiv = thicknesscirclequantity;
                    break;
                case '4':
                    $scope.getMaterialSpecificationsDiv = idodlength;
                    break;
                case '5':
                    $scope.getMaterialSpecificationsDiv = odlength;
                    break;
                case '6':
                    $scope.getMaterialSpecificationsDiv = id_pitching_quantity_diagno;
                    break;
                case '7':
                    $scope.getMaterialSpecificationsDiv = od_pitching_quantity_diagno;
                    break;
                case '8':
                    $scope.getMaterialSpecificationsDiv = id_pitching_quantity_diagno;
                    break;
                default:
            }
        };
    });
    angular.bootstrap(document.getElementById("app"), ['materialApp']);
</script>
<!-- script for the add material form ends here -->
