/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var myApp = angular.module('allPOApp', []);
myApp.controller('allPOAppController', function ($scope, $http, $sce) {

    $scope.po = [];

    $http.get(BASE_URL + "po_order/show_purchase_orders/getAllPODetails").then(function (response) {
        // console.log(response.data);
        var data = response.data;
        var i, products;
        if (data != '') {
            for (i = 0; i < data.length; i++) {
                console.log(JSON.parse(data[i].product_details));
                //alert(data[i].customer_name);
                products = JSON.parse(data[i].product_details);
                $scope.po.push({'customer_name': data[i].customer_name,
                    'order_no': data[i].order_no,
                    'po_duedate': data[i].po_duedate,
                    'po_total': data[i].po_total,
                    'po_id': data[i].po_id,
                    'product_details': products,
                    'added_date': data[i].added_date,
                    'added_time': data[i].added_time,
                    'modified_date': data[i].modified_date,
                    'modified_time': data[i].modified_time});
            }
        } else {
            $scope.po = [];
        }
        console.log($scope.po);
        //$scope.poData = $scope.po;
    });
//-------------get Po details ends-------------------------------------//
//--------------------funn for get po by date --------------------------//
    $scope.getAllPoByDate = function () {
        var from_date = document.getElementById("from_date").value;
        var to_date = document.getElementById("to_date").value;
        //alert(from_date);
        if (from_date == '') {
            $scope.messg_info = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select From Date.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
            return false;
        }
        if (to_date == '') {
            $scope.messg_info = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select To date.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
            return false;
        }

        $http({
            method: 'get',
            url: BASE_URL + 'po_order/show_purchase_orders/getAllPoByDate?from_date=' + from_date + '&to_date=' + to_date
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
                    $scope.po.push({'customer_name': data[i].customer_name,
                        'order_no': data[i].order_no,
                        'po_duedate': data[i].po_duedate,
                        'po_id': data[i].po_id,
                        'po_total': data[i].po_total,
                        'product_details': products,
                        'added_date': data[i].added_date,
                        'added_time': data[i].added_time,
                        'modified_date': data[i].modified_date,
                        'modified_time': data[i].modified_time});
                }
            } else {
                $scope.po = [];
                // $
            }
        });
    };
//---------------------fun ends--------------------------------------------//
    $scope.deletePODetails = function (po_id) {
        //alert(po_id);
        $.confirm({
            title: '<h4 class="w3-text-red"><i class="fa fa-warning"></i> Are you sure you want to Delete This P.O?</h4>',
            content: '',
            type: 'red',
            buttons: {
                confirm: function () {
                    $http({
                        method: 'get',
                        url: BASE_URL + 'po_order/show_purchase_orders/deletePODetails?po_id=' + po_id
                    }).then(function successCallback(data) {
                        //console.log(data.data);
                        if (data.data == 200) {
                            $("#err_message").html('<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Purchase Order Deleted successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});	location.reload();}, 2000);</script>');
                        } else {
                            $("#err_message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Purchase Order Not Deleted successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 2000);</script>');
                        }
                    });
                },
                cancel: function () {
                }
            }
        });
    };

});