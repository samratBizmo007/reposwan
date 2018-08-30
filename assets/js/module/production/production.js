var myApp = angular.module('productionApp', []);
myApp.controller('productionController', function ($scope, $http, $sce) {

    $scope.po = [];

    $http.get(BASE_URL + "production/production/getSharedInprocessPoDetails").then(function (response) {
        //console.log(response.data);
        var data = response.data;
        var i, products;
        for (i = 0; i < data.length; i++) {
            //console.log(JSON.parse(data[i].product_details));
            //alert(data[i].customer_name);
            products = JSON.parse(data[i].product_details);

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

    $scope.getAllSharedInprogressPoDetailsBydate = function () {
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
            url: BASE_URL + 'production/production/getAllSharedInprogressPoDetailsBydate?from_date=' + from_date + '&to_date=' + to_date
        }).then(function successCallback(response) {
            // Assign response to skills object
            $scope.po = [];
            var data = response.data;
            var i, products;
            console.log(data);
            if (data != 500) {
                for (i = 0; i < data.length; i++) {
                    // console.log(data[i].product_details);
                    //alert(data[i].customer_name);
                    products = JSON.parse(data[i].product_details);
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

    $scope.show_ProductionPo_Orderinfo = function (po_id, product_code) {
        $("#sharedPoDetailsDiv").html('');
        $.ajax({
            type: "GET",
            url: BASE_URL + "production/production/show_ProductionPo_Orderinfo",
            data: {
                po_id: po_id,
                product_code: product_code
            },
            cache: false,
            success: function (data) {
                //$.alert(data);
                $("#sharedPoDetailsDiv").html(data);
            }
        });
    };

});

function endDateTime() {
    $.ajax({
        type: "GET",
        url: BASE_URL + "production/production/endDateTime",
        cache: false,
        success: function (data) {
            //$.alert(data);
            $("#endDate").val(data);
        }
    });
}

function getProductionCalculation() {

    var po_shared_qty = 0;
    var produced_qty = 0;
    //var rejected_qty = 0;
    //var inprocess_qty = 0;
    po_shared_qty = $("#po_shared_qty").val();
    produced_qty = $("#produced_qty").val();
    //rejected_qty = $("#rejected_qty").val();
    //inprocess_qty = $("#inprocess_qty").val();
    var inprocess;

    if (produced_qty == '') {
        $("#inprocess_qty").val(po_shared_qty);
    } else if (produced_qty != '') {
        inprocess = po_shared_qty - produced_qty;
        $("#inprocess_qty").val(inprocess);
    }

}
function getRejectedCalculation() {
    var po_shared_qty = 0;
    var produced_qty = 0;
    var rejected_qty = 0;
    //var inprocess_qty = 0;
    po_shared_qty = $("#po_shared_qty").val();
    produced_qty = $("#produced_qty").val();
    rejected_qty = $("#rejected_qty").val();
    //inprocess_qty = $("#inprocess_qty").val();
    var inprocess;
//alert(rejected_qty);
    if (rejected_qty == '' || rejected_qty == 0) {
        inprocess = po_shared_qty - produced_qty;
        $("#inprocess_qty").val(inprocess);
    } else if (rejected_qty != '') {
        inprocess = (po_shared_qty - produced_qty) - rejected_qty; 
        $("#inprocess_qty").val(inprocess);
    }
}
