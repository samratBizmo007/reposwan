
// script to add extra div for serial no and item code
//$(document).ready(function () {
//    var max_fields = 10;
//    var wrapper = $("#addedmore_DivGeneral");
//    var add_button = $("#addMoreBtnGeneral");
//    var x = 1;
//    var srno = 1;
//    $(add_button).click(function (e) {
//        e.preventDefault();
//        if (x < max_fields) {
//            x++;
//            $(wrapper).append('<div><div class="w3-col l12"><hr>\n\
//        <div class="col-md-6 col-sm-12 col-xs-12">\n\
//        <div class="form-group">\n\
//        <label for="sr_no">Serial Number ' + x + ' :</label>\n\
//        <input type="number" min="0" class="form-control" id="sr_no' + x + '" value="' + srno + '" name="sr_no[]" placeholder="Enter serial number">\n\
//        </div>\n\
//        </div>\n\
//        <div class="col-md-6 col-sm-12 col-xs-12">\n\
//        <div class="form-group">\n\
//        <label for="part_no">Item Code ' + x + ' :</label>\n\
//        <input type="text" class="form-control" id="item_code' + x + '" name="item_code[]" placeholder="Enter Item Code">\n\
//        </div>\n\
//        </div>\n\
//        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
//        </a>\n\
//        </div>\n\
//        </div>');
//            //add input box
//
//            srno++;
//        } else {
//            $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');
//            //alert when added more than 10 input fields
//        }
//    });
//    $(wrapper).on("click", ".delete", function (e) {
//        e.preventDefault();
//        $(this).parent('div').remove();
//        x--;
//        srno--;
//    });
//});

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
//--------------------------------------------------------------------------------------------------------------------------------
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
    //-------------------------------------------------------------------------------------------------------------
    $scope.showPlants();

    // check product type and display plant
    $scope.prodType = function () {
        if ($scope.typeSelected == "1")
            $scope.plantDiv = true;
        else
            $scope.plantDiv = false;
    };

    // check raw material type
    // function to disable all fields
    $scope.InputDisable = function () {
        document.getElementById("rm_thick").value = '';
        document.getElementById("rm_dia").value = '';
        document.getElementById("rm_id").value = '';
        document.getElementById("rm_od").value = '';
        document.getElementById("rm_pitch").value = '';
        document.getElementById("rm_weight").value = '';
        document.getElementById("rm_length").value = '';
        document.getElementById("rm_quantity").value = '';
        document.getElementById("Drawing_no").value = '';


        document.getElementById("rm_thick").disabled = true;
        document.getElementById("rm_dia").disabled = true;
        document.getElementById("rm_id").disabled = true;
        document.getElementById("rm_od").disabled = true;
        document.getElementById("rm_pitch").disabled = true;
        //document.getElementById("rm_weight_" + index).disabled = true;
        document.getElementById("rm_length").disabled = true;
        document.getElementById("rm_quantity").disabled = true;
        document.getElementById("Drawing_no").disabled = true;

    };
    $scope.RmType = function () {
        $scope.getMaterialDetailsByCategory();
        var type = document.getElementById("rm_type").value;
        //alert(index);
        $scope.rmSpecimen = true;
        // check type selected
        switch (type) {
            case '1':
                $scope.InputDisable();
                document.getElementById("rm_thick").disabled = false;
                document.getElementById("rm_quantity").disabled = false;
                break;
            case '2':
                $scope.InputDisable();
                document.getElementById("rm_dia").disabled = false;
                break;
            case '3':
                $scope.InputDisable();
                document.getElementById("rm_thick").disabled = false;
                document.getElementById("rm_od").disabled = false;
                document.getElementById("rm_quantity").disabled = false;
                document.getElementById("Drawing_no").disabled = false;
                break;
            case '4':
                $scope.InputDisable();
                document.getElementById("rm_length").disabled = false;
                document.getElementById("rm_id").disabled = false;
                document.getElementById("rm_od").disabled = false;
                break;
            case '5':
                $scope.InputDisable();
                document.getElementById("rm_od").disabled = false;
                document.getElementById("rm_length").disabled = false;
                break;
            case '6':
                $scope.InputDisable();
                document.getElementById("rm_id").disabled = false;
                document.getElementById("rm_pitch").disabled = false;
                document.getElementById("rm_quantity").disabled = false;
                document.getElementById("Drawing_no").disabled = false;
                break;
            case '7':
                $scope.InputDisable();
                document.getElementById("rm_od").disabled = false;
                document.getElementById("rm_pitch").disabled = false;
                document.getElementById("rm_quantity").disabled = false;
                document.getElementById("Drawing_no").disabled = false;
                break;
            case '8':
                $scope.InputDisable();
                document.getElementById("rm_id").disabled = false;
                document.getElementById("rm_pitch").disabled = false;
                document.getElementById("rm_quantity").disabled = false;
                document.getElementById("Drawing_no").disabled = false;
                break;
        }
        //$scope.enableID=true;
    };

    // script to add multiple raw material in div
    $scope.rmArr = [];
    $scope.MachineSelectedArr = [];
    $scope.MachineArr = [];
    $scope.ProductsArr = [];
    $scope.machines = [];
    $scope.machinesSelected = [];
    $scope.req_materials = [];
    //$scope.machines = '';

//-----------------------------------------------------------------------------------------------------------------------------------//
//creating array of sub products for add product master
    $scope.submitProduct = function () {
        var serial_no = $('#sr_no').val();
        var item_code = $('#item_code').val();
        var packingquantity_per_tray = $('#packingquantity_per_tray').val();
        var net_finished_weight = $('#net_finished_weight').val();
        var addedMachines_field = $('#addedMachines_field').val();
        var addedRM_field = $('#addedRM_field').val();
        //alert(net_finished_weight);
        var machine_details = $scope.MachineArr;
        var machineSelected_details = $scope.MachineSelectedArr;
        var requiredMaterial = $scope.rmArr;
        if (!serial_no) {
            $scope.errorForProductDetails = "<p><i class='fa fa-minus-circle'></i> Please Add Item Serial No.!</p>";
            return;
        }
        if (!item_code) {
            $scope.errorForProductDetails = "<p><i class='fa fa-minus-circle'></i> Please Add Item Code.!</p>";
            return;
        }
        if (!packingquantity_per_tray) {
            $scope.errorForProductDetails = "<p><i class='fa fa-minus-circle'></i> Please Add Item's Packing Quantity Per Tray.!</p>";
            return;
        }
        if (!net_finished_weight) {
            $scope.errorForProductDetails = "<p><i class='fa fa-minus-circle'></i> Please Add Item's Net Finished Weight.!</p>";
            return;
        }
        if (!machine_details) {
            $scope.errorForProductDetails = "<p><i class='fa fa-minus-circle'></i> Please Select Item's Required Machines Details.!</p>";
            return;
        }
        if (!requiredMaterial) {
            $scope.errorForProductDetails = "<p><i class='fa fa-minus-circle'></i> Please Select And Add Item's Required Raw Material.!</p>";
            return;
        }

//        $scope.ProductsArr.push({
//            serial_no: serial_no,
//            item_code: item_code,
//            machine_details: machine_details,
//            machineSelected_details: machineSelected_details,
//            packingquantity_per_tray: packingquantity_per_tray,
//            net_finished_weight: net_finished_weight,
//            requiredMaterial: requiredMaterial
//        });
//        $scope.addedProducts = ($scope.ProductsArr);
        $scope.errorForProductDetails = '';

        addedMachines_field = '';
        addedRM_field = '';

        $scope.productsDiv = 'true';

        $scope.getAllProducts(serial_no, item_code, $scope.MachineArr, $scope.MachineSelectedArr, packingquantity_per_tray, net_finished_weight, $scope.rmArr);
        $('#packingquantity_per_tray').val('');
        $('#net_finished_weight').val('');
        $('#sr_no').val('');
        $('#item_code').val('');
//        $("#operations option:selected").text('');
//        $("#machine option:selected").text('');
        $("#qtyhr").val('');
//        $("#rm_type option:selected").text('');
//        $("#rm_grade option:selected").text('');
        document.getElementById("rm_thick").value = '';
        document.getElementById("rm_dia").value = '';
        document.getElementById("rm_id").value = '';
        document.getElementById("rm_od").value = '';
        document.getElementById("rm_pitch").value = '';
        document.getElementById("rm_weight").value = '';
        document.getElementById("rm_length").value = '';
        document.getElementById("rm_quantity").value = '';
        document.getElementById("Drawing_no").value = '';
        $scope.MachineArr = [];
        $scope.MachineSelectedArr = [];
        $scope.rmArr = [];
    };

    $scope.AllProduct = [];
    $scope.getAllProducts = function (serial_no, item_code, machine_details, machineSelected_details, packingquantity_per_tray, net_finished_weight, requiredMaterial) {
        $scope.AllProduct.push({
            serial_no: serial_no,
            item_code: item_code,
            machine_details: machine_details,
            machineSelected_details: machineSelected_details,
            packingquantity_per_tray: packingquantity_per_tray,
            net_finished_weight: net_finished_weight,
            requiredMaterial: requiredMaterial
        });
        $scope.addedProducts = ($scope.AllProduct);

    };

    $scope.removeProductDetails = function (x) {
        $scope.errorForProductDetails = "";
        $scope.AllProduct.splice(x, 1);
        $scope.addedProducts = JSON.stringify($scope.AllProduct);
    };


//----------------------------------------------------------------------------------------------------------------------------------------------
    $scope.addMachineDetails = function () {

        var operations = document.getElementById("operations").value;
        var machine = document.getElementById("machine").value;
        var qtyhr = document.getElementById("qtyhr").value;

        var operationSelected = $("#operations option:selected").text();
        var machineSelected = $("#machine option:selected").text();
        var qtyhrAdded = $("#qtyhr").val();
        //alert(operationSelected);
        if (!operations) {
            $scope.errorMachine = "<p><i class='fa fa-minus-circle'></i> Please select Raw Material Type!</p>";
            return;
        }
        if (!machine) {
            $scope.errorMachine = "<p><i class='fa fa-minus-circle'></i> Please Select Machine name and Type!</p>";
            return;
        }
        if (!qtyhr) {
            $scope.errorMachine = "<p><i class='fa fa-minus-circle'></i> Quantity Per Hour required!</p>";
            return;
        }

        $scope.MachineArr.push({
            operations: operations,
            machine: machine,
            qtyhr: qtyhr
        });

        $scope.MachineSelectedArr.push({
            operationSelected: operationSelected,
            machineSelected: machineSelected,
            qtyhrAdded: qtyhrAdded
        });

        $scope.addedMachines = ($scope.MachineArr);
        $scope.addedMachineSelectedArr = ($scope.MachineSelectedArr);

        $scope.errorMachine = "";
        operations = '';
        machine = '';
        qtyhr = '';
        $scope.machineDiv = 'true';
        //alert($scope.machineDiv);
    };

    // remove material from temp table
    $scope.removeMachineDetails = function (x) {
        //alert(x);
        $scope.errorMachine = "";
        $scope.MachineArr.splice(x, 1);
        $scope.addedMachines = JSON.stringify($scope.MachineArr);

        $scope.MachineSelectedArr.splice(x, 1);
        $scope.addedMachineSelectedArr = JSON.stringify($scope.MachineSelectedArr);
    };

    //----------------------------------------------------------------------------------------------------------------------------------------------

    // add skill to temp 
    $scope.addRM = function () {
        //alert(index);
        var type = document.getElementById("rm_type").value;
        var grade = document.getElementById("rm_grade").value;
        var thickness = document.getElementById("rm_thick").value;
        var diameter = document.getElementById("rm_dia").value;
        var id = document.getElementById("rm_id").value;
        var od = document.getElementById("rm_od").value;
        var pitch = document.getElementById("rm_pitch").value;
        var weight = document.getElementById("rm_weight").value;
        var length = document.getElementById("rm_length").value;
        var quantity = document.getElementById("rm_quantity").value;
        var drawing_no = document.getElementById("Drawing_no").value;

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
        if (!drawing_no) {
            drawing_no = 0;
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
            rmqtySelected: quantity,
            rmdrawingSelected: drawing_no
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
        drawing_no = '';
        $scope.rm_table = 'true';
    };

    // remove material from temp table
    $scope.removeMaterial = function (x) {
        $scope.errorRM = "";
        $scope.rmArr.splice(x, 1);
        $scope.addedRM = JSON.stringify($scope.rmArr);
    };
//----------------------------------------------------------------------------------------------------------------------------------------------

    $scope.getMaterialDetailsByCategory = function () {
        var material_category = $("#rm_type").val();
        $.ajax({
            type: "GET",
            url: BASE_URL + "materials/addmaterial/getMaterialDetailsByCategory",
            data: {
                material_category: material_category
            },
            cache: false,
            success: function (data) {
                $("#rm_grade").empty();
                $("#rm_grade").append(data);
            }
        });
    };

    $scope.getQuantityPerHr = function () {
        var machine_id = $("#machine").val();
        $.ajax({
            type: "GET",
            url: BASE_URL + "admin/machine/addmachine/getQuantityPerHr",
            data: {
                machine_id: machine_id
            },
            cache: false,
            success: function (data) {
                if (data != '') {
                    $('#qtyhr').val(data);
                }
            }
        });
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
    };
});