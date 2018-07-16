// script to implement multistep form in add product page
// $(document).ready(function(){
//   var current = 1,current_step,next_step,steps;
//   steps = $("fieldset").length;
//   $(".next").click(function(){
//     current_step = $(this).parent();
//     next_step = $(this).parent().next();
//     next_step.show();
//     current_step.hide();
//     setProgressBar(++current);
//   });
//   $(".previous").click(function(){
//     current_step = $(this).parent();
//     next_step = $(this).parent().prev();
//     next_step.show();
//     current_step.hide();
//     setProgressBar(--current);
//   });
//   setProgressBar(current);
//   // Change progress bar action
//   function setProgressBar(curStep){
//     var percent = parseFloat(100 / steps) * curStep;
//     percent = percent.toFixed();
//     $(".progress-bar")
//     .css("width",percent+"%")
//     .html(percent+"%");   
//   }
// });

// script to add extra div for serial no and item code
$(document).ready(function () {
  var max_fields = 10;
  var wrapper = $("#addedmore_DivGeneral");
  var add_button = $("#addMoreBtnGeneral");
  var x = 1;
  var srno=1;
  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      $(wrapper).append('<div><div class="w3-col l12"><hr>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="sr_no">Serial Number '+x+' :</label>\n\
        <input type="number" min="0" class="form-control" id="sr_no'+x+'" value="'+srno+'" name="sr_no[]" placeholder="Enter serial number">\n\
        </div>\n\
        </div>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="part_no">Item Code '+x+' :</label>\n\
        <input type="text" class="form-control" id="item_code'+x+'" name="item_code[]" placeholder="Enter Item Code">\n\
        </div>\n\
        </div>\n\
        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
        </a>\n\
        </div>\n\
        </div>'); 
        //add input box

        srno++;
      } 
      else {
        $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');   
        //alert when added more than 10 input fields
      }
    });
  $(wrapper).on("click", ".delete", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
    srno--;
  })
});

// script to add extra div for serial no and item code
$(document).ready(function () {
  var max_fields = 10;
  var wrapper = $("#addedmore_DivMachine");
  var add_button = $("#addMoreBtnMachine");
  var x = 1;
  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      $(wrapper).append('<div><div class="w3-col l12"><hr>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="machine">Machine used(in tonnes) '+x+' :</label>\n\
        <input type="number" min="0" class="form-control" id="machine'+x+'" name="machine[]" placeholder="eg. 20, 30, 40 ton">\n\
        </div>\n\
        </div>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="qtyhr">Quantity per hour '+x+' :</label>\n\
        <input type="number" min="0" class="form-control" id="qtyhr'+x+'" name="qtyhr[]" placeholder="eg.1, 2, 3, etc.">\n\
        </div>\n\
        </div>\n\
        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
        </a>\n\
        </div>\n\
        </div>'); 
        //add input box
      } 
      else {
        $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');   
        //alert when added more than 10 input fields
      }
    });
  $(wrapper).on("click", ".delete", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  })
});

// Angular script to add required skills in ad product form
var app = angular.module("editProductForm", ['ngSanitize']); 
app.controller("ProdCtrl", function($scope,$http) {
$scope.products = [];
$scope.editProd=false;

// fetch product detials with prodID
    $scope.getProdDetails = function(prod_id){
      $http({
       method: 'GET',
       url: BASE_URL+'admin/products/allproduct/getProdDetails',
       params: {pid: prod_id }
     }).then(function successCallback(response) {
      console.log(response);
      // Assign response to products object
      $scope.demo = response.data;
    }); 
   }
   $scope.getProdDetails()
    // add skill to temp 
    $scope.addSkill = function () {
      $scope.errortext = "";
      if (!$scope.addSkillbtn) {return;}
      if ($scope.products.indexOf($scope.addSkillbtn) == -1) {
        $scope.products.push($scope.addSkillbtn);
        $scope.skilJSON=JSON.stringify($scope.products);
      } else {
        $scope.errortext = "This operation is already listed.";
      }
    }

    // remove skill from temp
    $scope.removeSkill = function (x) {
      $scope.errortext = "";    
      $scope.products.splice(x, 1);
      $scope.skilJSON=JSON.stringify($scope.products);
    }

    // get all skills in select box
    $scope.getSkills = function(){
      $http({
       method: 'get',
       url: BASE_URL+'admin/products/addproduct/getAllSkills'
     }).then(function successCallback(response) {
      // Assign response to skills object
      $scope.skills = response.data;
    }); 
   }
   $scope.getSkills()

   
   // check product type and display plant
   $scope.prodType = function () {
    if ($scope.typeSelected== "1")
      $scope.plantDiv = true;
    else
      $scope.plantDiv = false;
  }

  // check raw material type
  // function to disable all fields
  $scope.InputDisable = function () {
    $scope.enableThickness=false;
    $scope.enableDiameter=false;
    $scope.enableID=false;
    $scope.enableOD=false;
    $scope.enablePitch=false;
    $scope.enableQuantity=false;
    $scope.enableLength=false;
  }
  $scope.RmType = function () {
    //if ($scope.rmtypeSelected== "1")
    $scope.rmgradeSelected='';
    $scope.rmweightSelected='';
    $scope.rmthickSelected='';
    $scope.rmdiaSelected='';
    $scope.rmIDSelected='';
    $scope.rmODSelected='';
    $scope.rmPitchSelected='';
    $scope.rmlenSelected='';
    $scope.rmqtySelected='';
    $scope.rmSpecimen = true;
    // check type selected
    switch($scope.rmtypeSelected){
      case '1':
      $scope.InputDisable()
      $scope.enableThickness=true;
      $scope.enableQuantity=true;
      break;
      case '2':
      $scope.InputDisable()
      $scope.enableDiameter=true;
      break;
      case '3':
      $scope.InputDisable()
      $scope.enableThickness=true;
      $scope.enableOD=true;
      $scope.enableQuantity=true;
      break;
      case '4':
      $scope.InputDisable()
      $scope.enableID=true;
      $scope.enableOD=true;
      $scope.enableLength=true;
      break;
      case '5':
      $scope.InputDisable()
      $scope.enableOD=true;
      $scope.enableLength=true;
      break;
      case '6':
      $scope.InputDisable()
      $scope.enableID=true;
      $scope.enablePitch=true;
      $scope.enableQuantity=true;
      break;
      case '7':
      $scope.InputDisable()
      $scope.enableOD=true;
      $scope.enablePitch=true;
      $scope.enableQuantity=true;
      break;
      case '8':
      $scope.InputDisable()
      $scope.enableID=true;
      $scope.enablePitch=true;
      $scope.enableQuantity=true;
      break;
    }
    //$scope.enableID=true;
  }


    // script to add multiple raw material in div
    $scope.rmArr=[];

    // add skill to temp 
    $scope.addRM = function () {

      if (!$scope.rmtypeSelected) {$scope.errorRM = "<p><i class='fa fa-minus-circle'></i> Please select Raw Material Type!</p>";return;}
      if (!$scope.rmgradeSelected) {$scope.errorRM = "<p><i class='fa fa-minus-circle'></i> Raw Material Grade is required!</p>";return;}
      if (!$scope.rmweightSelected) {$scope.errorRM = "<p><i class='fa fa-minus-circle'></i> Raw Material Weight (in KGs) is required!</p>";return;}
      if (!$scope.rmthickSelected) {$scope.rmthickSelected = 0;}
      if (!$scope.rmdiaSelected) {$scope.rmdiaSelected = 0;}
      if (!$scope.rmIDSelected) {$scope.rmIDSelected = 0;}
      if (!$scope.rmODSelected) {$scope.rmODSelected = 0;}
      if (!$scope.rmPitchSelected) {$scope.rmPitchSelected = 0;}
      if (!$scope.rmlenSelected) {$scope.rmlenSelected = 0;}
      if (!$scope.rmqtySelected) {$scope.rmqtySelected = 0;}
      
      $scope.rmArr.push(
      {
        rm_type:$scope.rmtypeSelected,
        rmgradeSelected:$scope.rmgradeSelected,
        rmthickSelected:$scope.rmthickSelected,
        rmdiaSelected:$scope.rmdiaSelected,
        rmIDSelected:$scope.rmIDSelected,
        rmODSelected:$scope.rmODSelected,
        rmPitchSelected:$scope.rmPitchSelected,
        rmweightSelected:$scope.rmweightSelected,
        rmlenSelected:$scope.rmlenSelected,
        rmqtySelected:$scope.rmqtySelected
      });
      $scope.addedRM=($scope.rmArr);

      $scope.errorRM = "";
      $scope.rmgradeSelected='';
      $scope.rmweightSelected='';
      $scope.rmthickSelected='';
      $scope.rmdiaSelected='';
      $scope.rmIDSelected='';
      $scope.rmODSelected='';
      $scope.rmPitchSelected='';
      $scope.rmlenSelected='';
      $scope.rmqtySelected='';

      $scope.rm_table='true';
    }

      // remove material from temp table
      $scope.removeMaterial = function (x) {
        $scope.errorRM = "";    
        $scope.rmArr.splice(x, 1);
        $scope.addedRM=JSON.stringify($scope.rmArr);
      }

    });

// ------------POST form data to PHP controller--------------
$(function () {
  $("#addProduct").submit(function () {
    dataString = $("#addProduct").serialize();
        // alert(dataString);
        $.ajax({
          type: "POST",
          url: BASE_URL+"admin/products/addproduct/addNewProduct",
          dataType : 'text',
          data: dataString,
            return: false, //stop the actual form post !important!
            beforeSend: function(){
              $("#submitForm").attr("disabled", true);
              $('#submitForm').html(' <i class="fa fa-circle-o-notch fa-spin w3-large"></i> Saving New Product details, Hold on... ');
            },
            success: function(data){
              $('#formOutput').html(data);
            //$('form :input').val("");
            $('#submitForm').removeAttr("disabled");
            $('#submitForm').html(' <i class="fa fa-save"></i> Save and Add New Product ');
          },
          error:function(data){
            $('#submitForm').removeAttr("disabled");
            $('#formOutput').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');

            $('#submitForm').html(' <i class="fa fa-save"></i> Save and Add New Product ');
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
              });
            }, 5000);
          }
        });
        return false;  //stop the actual form post !important!
      });
});
// POST method to add product ends here--------------------------
