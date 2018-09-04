/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var myApp = angular.module('sharedPOApp', []);
myApp.controller('sharedPOController', function ($scope, $http, $sce) {

    $scope.po = [];

    $http.get(BASE_URL + "sharing/shared_PO/getPurchaseOrdersDetails").then(function (response) {
        //console.log(response.data);
        var data = response.data;
        var i, products, srItemCode, machineQuantityPerHr, rawMaterialRequired;
        for (i = 0; i < data.length; i++) {
            //console.log(JSON.parse(data[i].product_details));
            //alert(data[i].customer_name);
            products = JSON.parse(data[i].product_details);
            //srItemCode = JSON.parse(data[i].sr_item_code);
            //machineQuantityPerHr = JSON.parse(data[i].machine_qtyhr);
            //rawMaterialRequired = JSON.parse(data[i].rm_required);
            $scope.po.push({'customer_name': data[i].customer_name,
                'order_no': data[i].order_no,
                'po_duedate': data[i].po_duedate,
                'line_no': data[i].line_no,
                'unit_rate': data[i].unit_rate,
                'part_drwing_no': data[i].part_drwing_no,
                'sr_no': data[i].sr_no,
                'balanced': data[i].balanced,
                'remark': data[i].remark,
                'prod_id': data[i].prod_id,
                'product_code': data[i].product_code,
                'quantity': data[i].quantity,
                'revision_no': data[i].revision_no,
                'net_amount': data[i].net_amount,
                'po_total': data[i].po_total,
                'po_id': data[i].po_id,
                'product_details': products,
                'added_date': data[i].added_date,
                'added_time': data[i].added_time,
                'modified_date': data[i].modified_date,
                'shared_product_quantity': data[i].shared_product_quantity,
                'modified_time': data[i].modified_time
            });
        }
        //console.log($scope.po);
        //$scope.poData = $scope.po;
    });

    $scope.getSharedPo = function () {
        var from_date = document.getElementById("from_date").value;
        var to_date = document.getElementById("to_date").value;
        //alert(from_date);
        if (from_date == '') {
            $scope.message = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select From Date.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
            return false;
        }
        if (to_date == '') {
            $scope.message = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select To date.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
            return false;
        }
        $http({
            method: 'get',
            url: BASE_URL + 'sharing/shared_PO/getSharedPo?from_date=' + from_date + '&to_date=' + to_date
        }).then(function successCallback(response) {
            // Assign response to skills object
            $scope.po = [];
            var data = response.data;
            var i, products;
            //console.log(data);
            if (data != 500) {
                for (i = 0; i < data.length; i++) {
                    // console.log(data[i].product_details);
                    //alert(data[i].customer_name);
                    products = JSON.parse(data[i].product_details);
//                    srItemCode = JSON.parse(data[i].sr_item_code);
//                    machineQuantityPerHr = JSON.parse(data[i].machine_qtyhr);
//                    rawMaterialRequired = JSON.parse(data[i].rm_required);
                    $scope.po.push({'customer_name': data[i].customer_name,
                        'order_no': data[i].order_no,
                        'po_duedate': data[i].po_duedate,
                        'line_no': data[i].line_no,
                        'unit_rate': data[i].unit_rate,
                        'part_drwing_no': data[i].part_drwing_no,
                        'sr_no': data[i].sr_no,
                        'balanced': data[i].balanced,
                        'remark': data[i].remark,
                        'prod_id': data[i].prod_id,
                        'product_code': data[i].product_code,
                        'quantity': data[i].quantity,
                        'revision_no': data[i].revision_no,
                        'net_amount': data[i].net_amount,
                        'po_total': data[i].po_total,
                        'po_id': data[i].po_id,
                        'product_details': products,
                        'added_date': data[i].added_date,
                        'added_time': data[i].added_time,
                        'modified_date': data[i].modified_date,
                        'shared_product_quantity': data[i].shared_product_quantity,
                        'modified_time': data[i].modified_time

                    });
                }
            } else {
                $scope.po = [];
                // $
            }
        });
    };


    $scope.getSharedPoDetails = function () {
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        //alert(from_date);
        if (from_date == '') {
            $scope.message = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select From Date.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
            return false;
        }
        if (to_date == '') {
            $scope.message = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select To date.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
            return false;
        }
        $.ajax({
            type: "GET",
            url: BASE_URL + "sharing/shared_PO/getSharedPoDetails",
            data: {
                from_date: from_date,
                to_date: to_date
            },
            cache: false,
            success: function (data) {
                //$.alert(data);
                var podata = '';
                console.log(JSON.parse(data));
                podata = JSON.parse(data);
                var i, str;
                //$("#sharedpoOrdersSelected").empty();
                for (i = 0; i < podata.length; i++) {
                    //alert(podata[i].product_code);
                    $('#sharedpoOrdersSelected').append('<option value="' + podata[i].product_code + '/' + podata[i].po_id + '">Order_No- </p>' + podata[i].order_no + ' - Line_No: ' + podata[i].line_no + ' - Part code: ' + podata[i].product_code + ' - Due Date: ' + podata[i].po_duedate + '</option>');
                    //str += '<option value="' + podata[i].product_code + '/' + podata[i].po_id + '">Order_No- </p>' + podata[i].order_no + ' - Line_No: ' + podata[i].line_no + ' - Part code: ' + podata[i].product_code + ' - Due Date: ' + podata[i].po_duedate + '</option>';
                }
                //$("#sharedpoOrdersSelected").html(str);
            }
        });
    };

    $scope.getUpdatePoForSharedQuantityDetails = function () {
        var sharedpo_orders = $("#sharedpoOrdersSelected").val();
        //alert(sharedpo_orders);
        if (sharedpo_orders == '' || sharedpo_orders == 0) {
            $("#message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select The Valid Purchase Order.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
            return false;
        }
        //alert(po_orders);
        $.ajax({
            type: "GET",
            url: BASE_URL + "sharing/shared_PO/getUpdatePoForSharedQuantityDetails",
            data: {
                sharedpo_orders: sharedpo_orders
            },
            cache: false,
            success: function (data) {
                //$.alert(data);
                $("#sharedPurchasedOrders").empty();
                $("#sharedPurchasedOrders").html(data);
            }
        });
    };

});

function getUpdatePoForSharedQuantityDetails() {
    var sharedpo_orders = $("#sharedpoOrdersSelected").val();
    //alert(sharedpo_orders);
    if (sharedpo_orders == '' || sharedpo_orders == 0) {
        $("#message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select The Valid Purchase Order.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
        return false;
    }
    //alert(po_orders);
    $.ajax({
        type: "GET",
        url: BASE_URL + "sharing/shared_PO/getUpdatePoForSharedQuantityDetails",
        data: {
            sharedpo_orders: sharedpo_orders
        },
        cache: false,
        success: function (data) {
            //$.alert(data);
            $("#sharedPurchasedOrders").empty();
            $("#sharedPurchasedOrders").html(data);
        }
    });
}
function updateSharedQuantity(po_id) {
    var sharedQuantity = $("#sharedQuantity").val();
    if (sharedQuantity == '' || sharedQuantity == 0) {
        $("#message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Add Valid Shared Product Quantity.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
        return false;
    }
    //alert(po_orders);
    $.ajax({
        type: "GET",
        url: BASE_URL + "sharing/shared_PO/updateSharedQuantity",
        data: {
            sharedQuantity: sharedQuantity,
            po_id: po_id
        },
        cache: false,
        success: function (data) {
            //$.alert(data);
            //$("#sharedPurchasedOrders").empty();
            $("#message").html(data);
        }
    });
}