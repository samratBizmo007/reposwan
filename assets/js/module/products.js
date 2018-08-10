
// script to add extra div for serial no and item code
$(document).ready(function () {
    var max_fields = 10;
    var wrapper = $("#addedmore_DivGeneral");
    var add_button = $("#addMoreBtnGeneral");
    var x = 1;
    var srno = 1;
    $(add_button).click(function (e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><div class="w3-col l12"><hr>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="sr_no">Serial Number ' + x + ' :</label>\n\
        <input type="number" min="0" class="form-control" id="sr_no' + x + '" value="' + srno + '" name="sr_no[]" placeholder="Enter serial number">\n\
        </div>\n\
        </div>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="part_no">Item Code ' + x + ' :</label>\n\
        <input type="text" class="form-control" id="item_code' + x + '" name="item_code[]" placeholder="Enter Item Code">\n\
        </div>\n\
        </div>\n\
        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
        </a>\n\
        </div>\n\
        </div>');
            //add input box

            srno++;
        } else {
            $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');
            //alert when added more than 10 input fields
        }
    });
    $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        srno--;
    });
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
        <label for="machine">Machine used(in tonnes) ' + x + ' :</label>\n\
        <input type="number" min="0" class="form-control" id="machine' + x + '" name="machine[]" placeholder="eg. 20, 30, 40 ton">\n\
        </div>\n\
        </div>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="qtyhr">Quantity per hour ' + x + ' :</label>\n\
        <input type="number" min="0" class="form-control" id="qtyhr' + x + '" name="qtyhr[]" placeholder="eg.1, 2, 3, etc.">\n\
        </div>\n\
        </div>\n\
        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
        </a>\n\
        </div>\n\
        </div>');
            //add input box
        } else {
            $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');
            //alert when added more than 10 input fields
        }
    });
    $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
});

// Angular script to add required skills in ad product form
var app = angular.module("addProductForm", ['ngSanitize']);
app.controller("ProdCtrl", function ($scope, $http) {
//------------------------------------------------------------------------------------------------------//

    $scope.productData = [{id: 'choice1'}];

    $scope.addNewProductDiv = function () {
        //document.getElementById("remove").style.display = "block";
        var newItemNo = $scope.productData.length + 1;
        $scope.productData.push({'id': 'choice' + newItemNo});
        //$scope.removeDiv = false;

    };

    $scope.removeChoice = function () {
        var lastItem = $scope.productData.length - 1;
        $scope.productData.splice(lastItem);
    };
//------------------------------------------------------------------------------------------------------//
//-----------------------------------------div for add the product specifications-------------------------------------------------------------//
    $scope.Data = [{id: 'choice1'}];

    $scope.addNewProductSpecificationDiv = function () {
        //document.getElementById("remove").style.display = "block";
        var newItemNo = $scope.Data.length + 1;
        $scope.Data.push({'id': 'choice' + newItemNo});
        //$scope.removeDiv = false;

    };

    $scope.removeProductChoice = function () {
        var lastItem = $scope.Data.length - 1;
        $scope.Data.splice(lastItem);
    };
//-----------------------------------------div for add the product specifications-------------------------------------------------------------//

    $scope.products = [];

    // add skill to temp 
    $scope.addSkill = function () {
        $scope.errortext = "";
        if (!$scope.addSkillbtn) {
            return;
        }
        if ($scope.products.indexOf($scope.addSkillbtn) == -1) {
            $scope.products.push($scope.addSkillbtn);
            $scope.skilJSON = JSON.stringify($scope.products);
        } else {
            $scope.errortext = "This operation is already listed.";
        }
    };

    // remove skill from temp
    $scope.removeSkill = function (x) {
        $scope.errortext = "";
        $scope.products.splice(x, 1);
        $scope.skilJSON = JSON.stringify($scope.products);
    };
//---------show all category
    $scope.showPlants = function () {
        //alert('hi');
        $http({
            method: 'get',
            url: BASE_URL + 'admin/dashboard/showPlants'
        }).then(function successCallback(response) {
            // Assign response category object
            console.log(response.data);
            $scope.plants = response.data;
            // $scope.mes=response;
        });
    };
    $scope.showPlants();
    // get all skills in select box
    $scope.getSkills = function () {
        $http({
            method: 'get',
            url: BASE_URL + 'admin/products/addproduct/getAllSkills'
        }).then(function successCallback(response) {
            // Assign response to skills object
            $scope.skills = response.data;
        });
    };
    $scope.getSkills();

    // check product type and display plant
    $scope.prodType = function () {
        if ($scope.typeSelected == "1")
            $scope.plantDiv = true;
        else
            $scope.plantDiv = false;
    };

    // check raw material type
    // function to disable all fields
    $scope.InputDisable = function (index) {
        document.getElementById("rm_thick_" + index).value = '';
        document.getElementById("rm_dia_" + index).value = '';
        document.getElementById("rm_id_" + index).value = '';
        document.getElementById("rm_od_" + index).value = '';
        document.getElementById("rm_pitch_" + index).value = '';
        document.getElementById("rm_weight_" + index).value = '';
        document.getElementById("rm_length_" + index).value = '';
        document.getElementById("rm_quantity_" + index).value = '';

        document.getElementById("rm_thick_" + index).disabled = true;
        document.getElementById("rm_dia_" + index).disabled = true;
        document.getElementById("rm_id_" + index).disabled = true;
        document.getElementById("rm_od_" + index).disabled = true;
        document.getElementById("rm_pitch_" + index).disabled = true;
        //document.getElementById("rm_weight_" + index).disabled = true;
        document.getElementById("rm_length_" + index).disabled = true;
        document.getElementById("rm_quantity_" + index).disabled = true;
    };
    $scope.RmType = function (index) {
        var type = document.getElementById("rm_type_" + index).value;
        $scope.rmSpecimen = true;
        // check type selected
        switch (type) {
            case '1':
                $scope.InputDisable(index);
                document.getElementById("rm_thick_" + index).disabled = false;
                document.getElementById("rm_quantity_" + index).disabled = false;
                break;
            case '2':
                $scope.InputDisable(index);
                document.getElementById("rm_dia_" + index).disabled = false;
                break;
            case '3':
                $scope.InputDisable(index);
                document.getElementById("rm_thick_" + index).disabled = false;
                document.getElementById("rm_od_" + index).disabled = false;
                document.getElementById("rm_quantity_" + index).disabled = false;
                break;
            case '4':
                $scope.InputDisable(index);
                document.getElementById("rm_length_" + index).disabled = false;
                document.getElementById("rm_id_" + index).disabled = false;
                document.getElementById("rm_od_" + index).disabled = false;
                break;
            case '5':
                $scope.InputDisable(index);
                document.getElementById("rm_od_" + index).disabled = false;
                document.getElementById("rm_length_" + index).disabled = false;
                break;
            case '6':
                $scope.InputDisable(index);
                document.getElementById("rm_id_" + index).disabled = false;
                document.getElementById("rm_pitch_" + index).disabled = false;
                document.getElementById("rm_quantity_" + index).disabled = false;
                break;
            case '7':
                $scope.InputDisable(index);
                document.getElementById("rm_od_" + index).disabled = false;
                document.getElementById("rm_pitch_" + index).disabled = false;
                document.getElementById("rm_quantity_" + index).disabled = false;
                break;
            case '8':
                $scope.InputDisable(index);
                document.getElementById("rm_id_" + index).disabled = false;
                document.getElementById("rm_pitch_" + index).disabled = false;
                document.getElementById("rm_quantity_" + index).disabled = false;
                break;
        }
        //$scope.enableID=true;
    };

    // script to add multiple raw material in div
    $scope.rmArr = [];

    // add skill to temp 
    $scope.addRM = function (index) {
        var type = document.getElementById("rm_type_" + index).value;
        var grade = document.getElementById("rm_grade_" + index).value;
        var thickness = document.getElementById("rm_thick_" + index).value;
        var diameter = document.getElementById("rm_dia_" + index).value;
        var id = document.getElementById("rm_id_" + index).value;
        var od = document.getElementById("rm_od_" + index).value;
        var pitch = document.getElementById("rm_pitch_" + index).value;
        var weight = document.getElementById("rm_weight_" + index).value;
        var length = document.getElementById("rm_length_" + index).value;
        var quantity = document.getElementById("rm_quantity_" + index).value;

        if (!type) {
            $scope.errorRM = "<p><i class='fa fa-minus-circle'></i> Please select Raw Material Type!</p>";
            return;
        }
        if (!grade) {
            $scope.errorRM = "<p><i class='fa fa-minus-circle'></i> Raw Material Grade is required!</p>";
            return;
        }
        if (!weight) {
            $scope.errorRM = "<p><i class='fa fa-minus-circle'></i> Raw Material Weight (in KGs) is required!</p>";
            return;
        }
        if (!thickness) {
            thickness = 0;
        }
        if (!diameter) {
            diameter = 0;
        }
        if (!id) {
            id = 0;
        }
        if (!od) {
            od = 0;
        }
        if (!pitch) {
            pitch = 0;
        }
        if (!length) {
            length = 0;
        }
        if (!quantity) {
            quantity = 0;
        }

        $scope.rmArr.push({
            rm_type: type,
            rmgradeSelected: grade,
            rmthickSelected: thickness,
            rmdiaSelected: diameter,
            rmIDSelected: id,
            rmODSelected: od,
            rmPitchSelected: pitch,
            rmweightSelected: weight,
            rmlenSelected: length,
            rmqtySelected: quantity
        });
        $scope.addedRM = ($scope.rmArr);

        $scope.errorRM = "";
        grade = '';
        weight = '';
        thickness = '';
        diameter = '';
        id = '';
        od = '';
        pitch = '';
        length = '';
        quantity = '';

        $scope.rm_table = 'true';
    };

    // remove material from temp table
    $scope.removeMaterial = function (x) {
        $scope.errorRM = "";
        $scope.rmArr.splice(x, 1);
        $scope.addedRM = JSON.stringify($scope.rmArr);
    };

});

// ------------POST form data to PHP controller--------------
$(function () {
    $("#addProduct").submit(function () {
        dataString = $("#addProduct").serialize();
        // alert(dataString);
        $.ajax({
            type: "POST",
            url: BASE_URL + "admin/products/addproduct/addNewProduct",
            dataType: 'text',
            data: dataString,
            return: false, //stop the actual form post !important!
            beforeSend: function () {
                $("#submitForm").attr("disabled", true);
                $('#submitForm').html(' <i class="fa fa-circle-o-notch fa-spin w3-large"></i> Saving New Product details, Hold on... ');
            },
            success: function (data) {
                //$.alert(data);
                $('#formOutput').html(data);
                //$('form :input').val("");
                $('#submitForm').removeAttr("disabled");
                $('#submitForm').html(' <i class="fa fa-save"></i> Save and Add New Product ');
            },
            error: function (data) {
                $('#submitForm').removeAttr("disabled");
                $('#formOutput').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');

                $('#submitForm').html(' <i class="fa fa-save"></i> Save and Add New Product ');
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 5000);
            }
        });
        return false;  //stop the actual form post !important!
    });
});
// POST method to add product ends here--------------------------

// Angular js for all product view
// Angular script to add required skills in ad product form
var app = angular.module("allProductApp", ['ngSanitize']);
app.controller("allProdCtrl", function ($scope, $http, $window) {

// remove product from table
    $scope.removeProduct = function (prod_id) {
        $.confirm({
            title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do yo really want to delete this product?</span>',
            content: '',
            type: 'red',
            buttons: {
                confirm: function () {
                    $http({
                        method: 'get',
                        url: BASE_URL + 'admin/products/allproduct/delProduct',
                        params: {prod_id: prod_id},
                    }).then(function successCallback(response) {
                        $scope.message = response.data;
                        $window.setTimeout(function () {
                            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                $(this).remove();
                            });
                            location.reload();
                        }, 2000);
                    });
                },
                cancel: function () {
                }
            }
        });
    }
});