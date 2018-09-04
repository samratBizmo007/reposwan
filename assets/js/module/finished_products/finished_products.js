var myApp = angular.module('finishedProdApp', []);
myApp.controller('finishedProdController', function ($scope, $http, $sce) {

    $scope.po = [];
    $scope.poInfo = [];
    $scope.poData = [];
    $scope.billInfo = [];

// add skill to temp 

    $http.get(BASE_URL + "finished_products/finished_products/getSharedInprocessPoDetails").then(function (response) {
        console.log(response.data);
        var data = response.data;
        var i, products, machinedetails, totalQty, finishedpobills;
        if (data != '') {
            for (i = 0; i < data.length; i++) {
                products = JSON.parse(data[i].product_details);
                machinedetails = JSON.parse(data[i].po_machinedetails);
                if (data[i].subproduct_quantity == 0) {
                    totalQty = parseInt(data[i].subproduct_quantity) + parseInt(data[i].produced_qty);
                } else {
                    totalQty = parseInt(data[i].produced_qty);
                }
                if (data[i].billno_dispatched_qty != '') {
                    finishedpobills = JSON.parse(data[i].billno_dispatched_qty);
                } else {
                    finishedpobills = '';
                }
                $scope.po.push({'customer_name': data[i].customer_name,
                    'order_no': data[i].order_no,
                    'po_duedate': data[i].po_duedate,
                    'line_no': data[i].line_no,
                    'unit_rate': data[i].unit_rate,
                    'part_drwing_no': data[i].part_drwing_no,
                    'sr_no': data[i].sr_no,
                    'balanced': data[i].balanced,
                    'remark': data[i].remark,
                    'remark_type': data[i].remark_type,
                    'prod_id': data[i].prod_id,
                    'product_code': data[i].product_code,
                    'quantity': data[i].quantity,
                    'revision_no': data[i].revision_no,
                    'net_amount': data[i].net_amount,
                    'po_total': data[i].po_total,
                    'po_id': data[i].po_id,
                    'produced_qty': data[i].produced_qty,
                    'rejected_qty': data[i].rejected_qty,
                    'inprocess_qty': data[i].inprocess_qty,
                    'product_details': products,
                    'added_date': data[i].added_date,
                    'added_time': data[i].added_time,
                    'modified_date': data[i].modified_date,
                    'modified_time': data[i].modified_time,
                    'subproduct_quantity': data[i].subproduct_quantity,
                    'totalQty': totalQty,
                    'po_machinedetails': machinedetails,
                    'balanced': data[i].balanced

                });
            }
        } else {
            $scope.po = [];

        }
        //console.log($scope.po);
        //$scope.poData = $scope.po;
    }
    );

    $scope.getPos = function () {
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
            url: BASE_URL + 'finished_products/finished_products/getPos?from_date=' + from_date + '&to_date=' + to_date
        }).then(function successCallback(response) {
            // Assign response to skills object
            $scope.po = [];
            var data = response.data;
            var i, products, machinedetails, totalQty, finishedpobills;
            console.log(data);
            if (data != 500) {
                for (i = 0; i < data.length; i++) {
                    products = JSON.parse(data[i].product_details);
                    machinedetails = JSON.parse(data[i].po_machinedetails);
                    totalQty = parseInt(data[i].subproduct_quantity) + parseInt(data[i].produced_qty);
                    if (data[i].billno_dispatched_qty != '') {
                        finishedpobills = JSON.parse(data[i].billno_dispatched_qty);
                    } else {
                        finishedpobills = '';
                    }
                    $scope.po.push({'customer_name': data[i].customer_name,
                        'order_no': data[i].order_no,
                        'po_duedate': data[i].po_duedate,
                        'line_no': data[i].line_no,
                        'unit_rate': data[i].unit_rate,
                        'part_drwing_no': data[i].part_drwing_no,
                        'sr_no': data[i].sr_no,
                        'balanced': data[i].balanced,
                        'remark': data[i].remark,
                        'remark_type': data[i].remark_type,
                        'prod_id': data[i].prod_id,
                        'product_code': data[i].product_code,
                        'quantity': data[i].quantity,
                        'revision_no': data[i].revision_no,
                        'net_amount': data[i].net_amount,
                        'po_total': data[i].po_total,
                        'po_id': data[i].po_id,
                        'produced_qty': data[i].produced_qty,
                        'rejected_qty': data[i].rejected_qty,
                        'inprocess_qty': data[i].inprocess_qty,
                        'product_details': products,
                        'added_date': data[i].added_date,
                        'added_time': data[i].added_time,
                        'modified_date': data[i].modified_date,
                        'modified_time': data[i].modified_time,
                        'subproduct_quantity': data[i].subproduct_quantity,
                        'totalQty': parceInt(data[i].subproduct_quantity) + parceInt(data[i].produced_qty),
                        'po_machinedetails': machinedetails,
                        'balanced': data[i].balanced

                    });
                }
            } else {
                $scope.po = [];
            }
        });
    };

    $scope.getTotalQty = function (po_id) {
        //$('#stock_quantity_' + po_id).val('');
        //$('#produced_qty_' + po_id).val('');
        var stock_quantity = $('#stock_quantity_' + po_id).val();
        var produced_qty = $('#produced_qty_' + po_id).val();
        var total_qty = 0;

        total_qty = parseInt(stock_quantity) + parseInt(produced_qty);
        $('#total_qty_' + po_id).val(parseInt(total_qty));

        if (stock_quantity == '') {
            $('#total_qty_' + po_id).val(parseInt(produced_qty));
        }
        if (produced_qty == '') {
            $('#total_qty_' + po_id).val(parseInt(stock_quantity));

        }
        //alert(total_qty);      
    };

    $scope.updateFinishedProductDetails = function (po_id, product_code, part_drwing_no) {
        var stock_quantity = $('#stock_quantity_' + po_id).val();
        var produced_qty = $('#produced_qty_' + po_id).val();
        var total_qty = $('#total_qty_' + po_id).val();
        var po_quantity = $('#po_quantity_' + po_id).val();
        var dispatched_qty = $('#dispatched_qty_' + po_id).val();
        var bill_no = $('#bill_no_' + po_id).val();
        var dispatched_date = $('#dispatched_date_' + po_id).val();
        var Balanced = $('#Balanced_' + po_id).val();
        var remainingQty = $('#Remaining_' + po_id).val();
        if (dispatched_qty == '') {
            $("#message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Add Dispatched Quantity.</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});//location.reload();}, 1000);</script>');
            return false;
        }
        if (dispatched_date == '') {
            $("#message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Add Bill NO.</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});//location.reload();}, 1000);</script>');
            return false;
        }
        if (bill_no == '') {
            $("#message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select Dispatched Date.</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});//location.reload();}, 1000);</script>');
            return false;
        }
        $.ajax({
            type: "POST",
            url: BASE_URL + "finished_products/finished_products/updateFinishedProductDetails",
            data: {
                po_id: po_id,
                product_code: product_code,
                part_drwing_no: part_drwing_no,
                stock_quantity: stock_quantity,
                produced_qty: produced_qty,
                total_qty: total_qty,
                po_quantity: po_quantity,
                dispatched_qty: dispatched_qty,
                bill_no: bill_no,
                dispatched_date: dispatched_date,
                Balanced: Balanced,
                remainingQty: remainingQty
            },
            cache: false,
            success: function (data) {
                $("#message").html(data);
            }
        });

    };

    $scope.show_FinishedPoDetails = function (po_id, product_code) {

        $http({
            method: 'get',
            url: BASE_URL + 'finished_products/finished_products/show_FinishedPoDetails?po_id=' + po_id + '&product_code=' + product_code
        }).then(function successCallback(response) {
            console.log(response.data);
            $("#finishedProductPo").css('display', 'block');
            $scope.poData = [];
            var data = response.data;
            var i, products, machinedetails, totalQty, finishedpobills;
            console.log(data[0].billno_dispatched_qty);
            if (data != 500) {
                for (i = 0; i < data.length; i++) {
                    products = JSON.parse(data[i].product_details);
                    machinedetails = JSON.parse(data[i].po_machinedetails);
                    if (data[i].billno_dispatched_qty != '') {
                        finishedpobills = JSON.parse(data[i].billno_dispatched_qty);
                    } else {
                        finishedpobills = '';
                    }
                    //alert(finishedpobills);
                    totalQty = parseInt(data[i].subproduct_quantity) + parseInt(data[i].produced_qty);

                    $scope.poData.push({'customer_name': data[i].customer_name,
                        'order_no': data[i].order_no,
                        'po_duedate': data[i].po_duedate,
                        'line_no': data[i].line_no,
                        'unit_rate': data[i].unit_rate,
                        'part_drwing_no': data[i].part_drwing_no,
                        'sr_no': data[i].sr_no,
                        'balanced': data[i].balanced,
                        'remark': data[i].remark,
                        'remark_type': data[i].remark_type,
                        'prod_id': data[i].prod_id,
                        'product_code': data[i].product_code,
                        'quantity': data[i].quantity,
                        'revision_no': data[i].revision_no,
                        'net_amount': data[i].net_amount,
                        'po_total': data[i].po_total,
                        'po_id': data[i].po_id,
                        'produced_qty': data[i].produced_qty,
                        'rejected_qty': data[i].rejected_qty,
                        'inprocess_qty': data[i].inprocess_qty,
                        'product_details': products,
                        'added_date': data[i].added_date,
                        'added_time': data[i].added_time,
                        'modified_date': data[i].modified_date,
                        'modified_time': data[i].modified_time,
                        'subproduct_quantity': data[i].subproduct_quantity,
                        'totalQty': totalQty,
                        'shared_product_quantity': data[i].shared_product_quantity,
                        'po_machinedetails': machinedetails,
                        'finishedpobills': finishedpobills,
                        'balanced': data[i].balanced
                    });
                }
            } else {
                $scope.poData = [];
            }
        });

    };
}); 