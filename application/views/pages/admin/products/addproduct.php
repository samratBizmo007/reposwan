<title>Swan Industries | Dashboard</title>
<style type="text/css">
#addProduct fieldset{
  /*display: none;*/
  margin-bottom: 16px
}
</style>
<!-- page content -->
<div class="right_col" role="main">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="page_title">

        <div class="row x_title">
          <div class="col-md-6">
            <h3><i class="fa fa-plus"></i> Add New Product </h3>
          </div>
        </div>
        <!-- <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div> -->
        <form id="addProduct">
          <fieldset>
            <h2>General Details</h2>
            <div class="w3-col l12">
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="customer_name">Customer Name<b class="w3-text-red w3-medium">*</b> :</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="prod_type">Product Type<b class="w3-text-red w3-medium">*</b> :</label>
                  <select name="prod_type" class="form-control w3-small" id="prod_type">
                    <option value="0" class="w3-text-grey" selected>REGULAR</option>
                    <option value="1" class="w3-text-grey">EX-STOCK</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="stock_plant">Ex-stock Plant<b class="w3-text-red w3-medium">*</b> :</label>
                  <select name="stock_plant" class="form-control w3-small" id="stock_plant">
                    <option value="0" class="w3-text-grey w3-light-grey " selected>Please choose any one plant</option>
                    <option value="ALD" class="w3-text-grey">ALANDI</option>
                    <option value="SNW" class="w3-text-grey">SANASWADI</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="w3-col l12">
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="product_name">Product Name/ Part Name<b class="w3-text-red w3-medium">*</b> :</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="divrawing_no">Drawing Number/ Part Number :</label>
                  <input type="text" class="form-control" id="drawing_no" name="drawing_no" placeholder="Enter drawing number">
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="revision_no">Revision Number :</label>
                  <input type="text" class="form-control" id="revision_no" name="revision_no" placeholder="Enter revision number">
                </div>
              </div>
            </div>

            <div class="w3-col l12">
              <div class="w3-col l8" style="border:1px dashed">
                <div class="w3-col l12 w3-padding-top">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="sr_no">Serial Number 1 :</label>
                      <input type="text" class="form-control" id="sr_no1" name="sr_no[]" placeholder="Enter serial number">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="part_no">Item Code 1 :</label>
                      <input type="text" class="form-control" id="part_no1" name="part_no[]" placeholder="Enter Item Code">
                    </div>
                  </div>
                </div>
                <!-- extra added row div -->
                <div class="w3-col l12" id="addedmore_DivGeneral"></div>
                <a class="btn w3-text-red w3-right" style="padding:0" id="addMoreBtnGeneral" name="addMoreBtnGeneral"><i class="fa fa-plus"></i> Add more</a> 
              </div>
            </div>

          </fieldset>


          <fieldset>
            <h2>Machinery Details</h2>            
            <div class="w3-col l12">
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <label for="operations">Operations Performed<b class="w3-text-red w3-medium">*</b> :</label>
                <div ng-app="allSkillList" ng-cloak ng-controller="SkillCtrl" class="w3-card" >

                  <ul class="w3-ul">
                    <li ng-repeat="x in products">{{x}}<span ng-click="removeSkill($index)" style="cursor:pointer;" class="w3-right w3-margin-right">×</span></li>
                  </ul>
                  <div class="w3-container w3-light-grey">
                    <div class="w3-row w3-margin-top">
                      <div class="w3-col l10 s10">

                        <select name="operations" ng-model="addSkillbtn" ng-trim="false" class="form-control w3-small" id="operations">
                          <option value="{{skill.skill_name}}" ng-repeat='skill in skills' class="w3-text-grey">{{skill.skill_name}}</option>
                        </select>
                      </div>
                      <div class="w3-col l2 s2">
                        <button class="w3-button theme_bg" type="button" ng-click="addSkill()" title="add operation"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <p class="w3-text-red w3-center">{{errortext}}</p>
                  </div>
                </div>
              </div>
              <div class="w3-col l8" style="border:1px dashed">
                <div class="w3-col l12 w3-padding-top">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="machine">Machine used(in tonnes) 1:</label>
                      <input type="number" min="0" class="form-control" id="machine1" name="machine[]" placeholder="eg. 20, 30, 40 ton">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="qtyhr">Quantity per hour 1:</label>
                      <input type="number" class="form-control" id="qtyhr1" name="qtyhr[]" placeholder="eg.1, 2, 3, etc.">
                    </div>
                  </div>
                </div>
                <!-- extra added row div -->
                <div class="w3-col l12" id="addedmore_DivMachine"></div>
                <a class="btn w3-text-red w3-right" style="padding:0" id="addMoreBtnMachine" name="addMoreBtnMachine"><i class="fa fa-plus"></i> Add more</a> 
              </div>
            </div>

          </fieldset>


          <fieldset>
            <h2>Raw Material Details</h2>
            <div class="form-group">
              <label for="mob">Mobile Number</label>
              <input type="text" class="form-control" id="mob" placeholder="Mobile Number">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <textarea  class="form-control" name="address" placeholder="Communication Address"></textarea>
            </div>
            <button type="button" name="previous2" class="previous btn btn-default w3-margin-top"><i class="fa fa-chevron-left"></i> Previous Section</button>
            <button type="submit" name="submitForm" class="submit btn btn-success w3-margin-top"> Submit  <i class="fa fa-chevron-right"></i> </button>
          </fieldset>

        </form>
        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <br />

</div>
<!-- /page content -->

<!-- js file for product module -->
<script src="<?php echo base_url(); ?>assets/js/module/products.js"></script>
<script>
  var app = angular.module("allSkillList", []); 
  app.controller("SkillCtrl", function($scope,$http) {
    $scope.products = [];

    // add skill to temp 
    $scope.addSkill = function () {
      $scope.errortext = "";
      if (!$scope.addSkillbtn) {return;}
      if ($scope.products.indexOf($scope.addSkillbtn) == -1) {
        $scope.products.push($scope.addSkillbtn);
        //$scope.errortext=JSON.stringify($scope.products);
      } else {
        $scope.errortext = "This operation is already listed.";
      }
    }

    // remove skill from temp
    $scope.removeSkill = function (x) {
      $scope.errortext = "";    
      $scope.products.splice(x, 1);
    }

    // get all skills in select box
    $scope.getUsers = function(){
      $http({
       method: 'get',
       url: '<?php base_url(); ?>addproduct/getAllSkills'
     }).then(function successCallback(response) {
      // Assign response to skills object
      $scope.skills = response.data;
    }); 
   }
   $scope.getUsers()
 });
</script>
     <!--  </div>
    </div>
  
  </body>
  </html> -->
