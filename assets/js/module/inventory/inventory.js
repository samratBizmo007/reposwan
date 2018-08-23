/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var myApp = angular.module('showInventoryApp', []);
myApp.controller('showInventoryController', function ($scope, $http, $sce) {

    $http.get(BASE_URL + "inventory/showinventory/getAllMaterialDetails").then(function (materialinfo) {
        //console.log(materialinfo);
        $scope.materials = materialinfo.data;
    });

    $http.get(BASE_URL + "inventory/showinventory/getMaterialCategory").then(function (materialCategory) {
        //console.log(materialCategory);
        $scope.materialCategory = materialCategory.data;
    });

    $scope.updateMaterialDetails = function (material_id) {
        //alert(material_id);
        var weight = document.getElementById("weight_" + material_id).value;
        var quantity = document.getElementById("quantity_" + material_id).value;
        var length = document.getElementById("length_" + material_id).value;
        var id = document.getElementById("id_" + material_id).value;
        var od = document.getElementById("od_" + material_id).value;
        var pitching = document.getElementById("pitching_" + material_id).value;
        var diagram_no = document.getElementById("diagram_no_" + material_id).value;
        var thickness = document.getElementById("thickness_" + material_id).value;
        var diameter = document.getElementById("diameter_" + material_id).value;
        var remark = document.getElementById("remark_" + material_id).value;

        $http({
            method: "POST",
            url: BASE_URL + "inventory/showinventory/updateMaterialDetails",
            data: JSON.stringify({
                weight: weight,
                quantity: quantity,
                length: length,
                id: id,
                od: od,
                pitching: pitching,
                diagram_no: diagram_no,
                thickness: thickness,
                diameter: diameter,
                remark: remark,
                material_id: material_id
            })
        }).then(function successCallback(response) {
            console.log(response.data);
            if (response.data == 200) {
                $scope.message = $sce.trustAsHtml('<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Material Details Updated successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});	location.reload();}, 1000);</script>');
                location.reload();
            } else {
                $scope.message = $sce.trustAsHtml('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Material Details Not Updated successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});	location.reload();}, 1000);</script>');
                location.reload();
            }
//            $scope.materials = '';
//            $scope.materials = response.data;
        });
    };

    $scope.getMaterialDetailsByType = function () {
        var mat_cat_id = document.getElementById("mat_cat_id").value;
        //alert(mat_cat_id);
        $http({
            method: 'get',
            url: BASE_URL + 'inventory/showinventory/getMaterialDetailsByType?mat_cat_id=' + mat_cat_id
        }).then(function successCallback(response) {
            console.log(response.data);
            $scope.materials = '';
            $scope.materials = response.data;
        });
    };
});
//angular.bootstrap(document.getElementById("rawMaterials"), ['showInventoryApp']);

function getProducts() {
    var customerName = $('#customerName').val();
    var prod_type = $('#prod_type').val();
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/showinventory/getProducts",
        data: {
            customerName: customerName,
            prod_type: prod_type

        },
        return: false, //stop the actual form post !important!
        success: function (data) {
            //$.alert(data);
            console.log(data);
            $('#productaddedRows').html(data);
        }
    });
}

function getTotalSubproductQuantity(p_id) {
    var subProduct_Qty = $('#subProduct_Qty_' + p_id).val();
    var subProduct_DispatchQty = $('#subProduct_DispatchQty_' + p_id).val();
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/showinventory/getTotalSubproductQuantity",
        data: {
            subProduct_Qty: subProduct_Qty,
            subProduct_DispatchQty: subProduct_DispatchQty,
            p_id: p_id
        },
        return: false, //stop the actual form post !important!
        success: function (data) {
            //$.alert(data);
            console.log(data);
            $('#totalSub_Product_' + p_id).val(data);
        }
    });
}
//function showSubproducts() {
//
//}

function updateProductDetails(prod_id) {
    var production_quantity = $('#production_quantity_' + prod_id).val();
    var dispatched_quantity = $('#dispatched_quantity_' + prod_id).val();
    var total_quantity = $('#total_quantity_' + prod_id).val();
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/showinventory/updateProductDetails",
        data: {
            production_quantity: production_quantity,
            dispatched_quantity: dispatched_quantity,
            total_quantity: total_quantity,
            prod_id: prod_id
        },
        return: false, //stop the actual form post !important!
        success: function (data) {
            //$.alert(data);
            console.log(data);
            if (data == 200) {
                $('#messageDiv').html('<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Product Quantity Updated successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});	}, 1000);</script>');
            } else {
                $('#messageDiv').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Product Quantity Not Updated successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 1000);</script>')
            }
        }
    });
}
function updateSubProductDetails(p_id) {
    var subProduct_Qty = $('#subProduct_Qty_' + p_id).val();
    var subProduct_DispatchQty = $('#subProduct_DispatchQty_' + p_id).val();
    var totalSub_Product = $('#totalSub_Product_' + p_id).val();
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/showinventory/updateSubProductDetails",
        data: {
            subProduct_Qty: subProduct_Qty,
            subProduct_DispatchQty: subProduct_DispatchQty,
            totalSub_Product: totalSub_Product,
            p_id: p_id
        },
        return: false, //stop the actual form post !important!
        success: function (data) {
            //$.alert(data);
            console.log(data);
            if (data == 200) {
                $('#messageDiv').html('<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Sub Product Quantity Updated successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});	}, 1000);</script>');
            } else {
                $('#messageDiv').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Sub Product Quantity Not Updated successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 1000);</script>')
            }
        }
    });
}
