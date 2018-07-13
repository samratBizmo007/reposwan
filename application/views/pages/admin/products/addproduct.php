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
        <form id="addProduct" ng-app="addProductForm" ng-cloak ng-controller="ProdCtrl">
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
                  <select name="prod_type" class="form-control w3-small" id="prod_type" ng-change="prodType()" ng-model="typeSelected">
                    <option value="0" class="w3-text-grey" selected>REGULAR</option>
                    <option value="1" class="w3-text-grey">EX-STOCK</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom" ng-show='plantDiv'>
                <div class="form-group">
                  <label for="stock_plant">Ex-stock Plant<b class="w3-text-red w3-medium">*</b> :</label>
                  <select name="stock_plant" class="form-control w3-small" id="stock_plant">
                    <option value="0" class="w3-text-grey w3-light-grey " selected>Please choose any one plant</option>
                    <option value="ALANDI" class="w3-text-grey">ALANDI</option>
                    <option value="SANASWADI" class="w3-text-grey">SANASWADI</option>
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
                      <input type="number" min="0" class="form-control" id="sr_no1" value="0" name="sr_no[]" placeholder="Enter serial number">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="part_no">Item Code 1 :</label>
                      <input type="text" class="form-control" id="item_code1" name="item_code[]" placeholder="Enter Item Code">
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
                <div class="w3-card" >

                  <ul class="w3-ul">
                    <li ng-repeat="x in products">{{x | uppercase}}<span ng-click="removeSkill($index)" style="cursor:pointer;" class="w3-right w3-margin-right">×</span></li>
                  </ul>
                  <div class="w3-container w3-light-grey">
                    <div class="w3-row w3-margin-top">
                      <div class="w3-col l10 s10">
                        <!-- fetch skills from db -->
                        <select name="operations" ng-model="addSkillbtn" ng-trim="false" class="form-control w3-small" id="operations">
                          <option value="{{skill.skill_name}}" ng-repeat='skill in skills' class="w3-text-grey">{{skill.skill_name | uppercase}}</option>
                        </select>
                      </div>
                      <div class="w3-col l2 s2">
                        <button class="w3-button theme_bg" type="button" ng-click="addSkill()" title="add operation">Add</button>
                      </div>
                    </div>
                    <input type="hidden" name="skillAdded_field" id="skillAdded_field" value="{{skilJSON}}">
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
                      <input type="number" min="0" class="form-control" id="qtyhr1" name="qtyhr[]" placeholder="eg.1, 2, 3, etc.">
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
            <div class="w3-col l12">
              <div class="w3-col l12 w3-padding-top" >              
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_type">Raw Material Type<b class="w3-text-red w3-medium">*</b> :</label>
                  <select name="rm_type" class="form-control w3-small" id="rm_type" ng-change="RmType()" ng-model="rmtypeSelected">
                    <?php foreach ($materialType['status_message'] as $key) { ?>
                      <option value="<?php echo $key['mat_cat_id'] ?>" class="w3-text-grey"><?php echo $key['material_type'] ?></option>
                   <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_grade">Raw Material Grade<b class="w3-text-red w3-medium">*</b> :</label>
                  <input type="text" ng-model="rmgradeSelected" class="form-control" id="rm_grade" name="rm_grade[]" placeholder="Enter Material Grade eg.CR, etc.">
                </div>
              </div>                          
            </div>
            <div class="w3-col l12" ng-show="rmSpecimen">
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_thick">Thickness :</label>
                  <input type="number" ng-model="rmthickSelected" min="0" ng-disabled="!enableThickness" class="form-control" id="rm_thick" name="rm_thick[]" placeholder="Material Thickness">
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_dia">Diameter :</label>
                  <input type="number" ng-model="rmdiaSelected" min="0" ng-disabled="!enableDiameter" class="form-control" id="rm_dia" name="rm_dia[]" placeholder="Material Diameter">
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_id">ID :</label>
                  <input type="number" ng-model="rmIDSelected" min="0" ng-disabled="!enableID" class="form-control" id="rm_id" name="rm_id[]" placeholder="Material ID">
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_od">OD :</label>
                  <input type="number" min="0" ng-model="rmODSelected" ng-disabled="!enableOD" class="form-control" id="rm_od" name="rm_od[]" placeholder="Material OD">
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_pitch">Pitch :</label>
                  <input type="number" min="0" ng-model="rmPitchSelected" ng-disabled="!enablePitch" class="form-control" id="rm_pitch" name="rm_pitch[]" placeholder="Material Pitch">
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_weight">Weight (in KGs) <b class="w3-text-red w3-medium">*</b> :</label>
                  <input type="number" min="0" ng-model="rmweightSelected" class="form-control" id="rm_weight" name="rm_weight[]" placeholder="Material Weight">
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_length">Length :</label>
                  <input type="number" min="0" ng-model="rmlenSelected" class="form-control" ng-disabled="!enableLength" id="rm_length" name="rm_length[]" placeholder="Material Length">
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="rm_quantity">Quantity :</label>
                  <input type="number" min="0" ng-model="rmqtySelected" class="form-control" ng-disabled="!enableQuantity" id="rm_quantity" name="rm_quantity[]" placeholder="Material Quantity">
                </div>
              </div>
              <div class="col-md-2 col-sm-12 col-xs-12 w3-margin-bottom">
                <div class="form-group w3-padding-top">
                  <button class="w3-button w3-margin-top theme_bg" type="button" ng-click="addRM()"><i class="fa fa-plus"></i> Add Material</button>
                </div>
              </div>
            </div>
            <p class="w3-padding-small w3-text-red w3-medium" ng-bind-html="errorRM"></p>
            <input type="hidden" class="form-control" name="addedRM_field" id="addedRM_field" value="{{addedRM}}">
            <!-- <pre>{{addedRM}}</pre> -->
            </div>
            
            <div class="w3-col l12 " ng-show='rm_table'>
              <table class="table table-responsive table-bordered w3-margin-top">
                <thead>
                  <tr class="theme_bg w3-center">
                    <th>Material Grade</th>
                    <th>Material Thickness</th>
                    <th>Material Diameter</th>
                    <th>Material ID</th>
                    <th>Material OD</th>
                    <th>Material Pitch</th>
                    <th>Material Weight</th>
                    <th>Material Length</th>
                    <th>Material Quantity</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody ng-repeat="mat in rmArr">
                  <tr class="w3-center">
                    <td>{{mat.rmgradeSelected}}</td>
                    <td>{{mat.rmthickSelected}}</td>
                    <td>{{mat.rmdiaSelected}}</td>
                    <td>{{mat.rmIDSelected}}</td>
                    <td>{{mat.rmODSelected}}</td>
                    <td>{{mat.rmPitchSelected}}</td>
                    <td>{{mat.rmweightSelected}} KG</td>
                    <td>{{mat.rmlenSelected}}</td>
                    <td>{{mat.rmqtySelected}}</td>
                    <td><a class="fa fa-remove w3-text-red" ng-click="removeMaterial($index)" title="remove material"></td>
                  </tr>
                </tbody>
              </table>
            </div>            
          </fieldset>

          <fieldset>
            <h2>Pricing Details</h2>            
            <div class="w3-col l12">
              <div class="col-md-4 col-sm-6 col-xs-6 w3-margin-bottom">
                
                <div class="form-group">
                  <label for="old_rate">Old Rate<b class="w3-text-red w3-medium">*</b> :</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                    <input type="number" class="form-control" step="0.01" min="0" id="old_rate" name="old_rate" placeholder="Enter Old Rate" required>
                  </div>
                  
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-xs-6 w3-margin-bottom">
                <div class="form-group">
                  <label for="new_rate">New Rate<b class="w3-text-red w3-medium">*</b> :</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                    <input type="number"cstep="0.01" min="0" class="form-control" id="new_rate" name="new_rate" placeholder="Enter New Rate" required>
                  </div>
                  
                </div>
              </div>
            </div>
          </fieldset>

          <div class="w3-col l12 w3-center">
            <button type="submit" name="submitForm" id="submitForm" class="w3-center w3-hover-text-white btn theme_bg w3-margin-top"> <i class="fa fa-save"></i> Save and Add New Product </button>
          </div>            

        </form>
        <div class="clearfix"></div>
        <div id="formOutput"></div>
      </div>
    </div>

  </div>
  <br />

</div>
<!-- /page content -->

<!-- js file for product module -->
<script src="<?php echo base_url(); ?>assets/js/module/products.js"></script>

     <!--  </div>
    </div>
  
  </body>
  </html> -->
