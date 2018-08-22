$(document).ready(function () {
    $(function () {
        var date = new Date();
        date.setDate(date.getDate() + 1);

        var myCalendar = new dhtmlXCalendarObject("due_date");
        myCalendar.hideTime();
        myCalendar.setDateFormat("%Y-%m-%d");
        myCalendar.setInsensitiveRange(date, null);

    });
});

var myApp = angular.module('PoApp', []);
myApp.controller('PoController', function ($scope, $http, $sce) {
//----------------get calendar ---------------------------------//
    $scope.getCalendar = function (index) {
        var date = new Date();
        date.setDate(date.getDate() + 1);

        var myCalendar = new dhtmlXCalendarObject("due_date_" + index);
        myCalendar.hideTime();
        myCalendar.setDateFormat("%d-%m-%Y");
        myCalendar.setInsensitiveRange(date, null);
    };
//------------add po details----------------------------------------//
    $(function () {
        $("#addPurchaseOrderForm").submit(function () {
            dataString = $("#addPurchaseOrderForm").serialize();
            $('#btnsubmit').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding PO. Hang on...</b></span>');
            $.ajax({
                type: "POST",
                url: BASE_URL + "po_order/po_order/addPurchaseOrder",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data) {
                    //$.alert(data);
                    console.log(data);
                    if (data == 200) {
                        $("#err_message").html('<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Purchase Order Added successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});	location.reload();}, 5000);</script>');
                        $('#btnsubmit').html('<button  type="submit" title="add PO" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Purchase Order</button>');
                    } else {
                        $("#err_message").html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Purchase Order Not Added successfully.</div><script>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove();});}, 5000);</script>');

                    }
                }
            });
            return false;  //stop the actual form post !important!
        });
    });
//-------------------add po details ends---------------------------------------//
//-------------get customer name ends-------------------------------------//

    $http.get(BASE_URL + "po_order/po_order/getAllCustomerName").then(function (customer_name) {
        //console.log(customer_name);
        $scope.customer = customer_name.data;
    });
//-------------get customer name ends-------------------------------------//
//---------------fun for get partno for the all products
    $scope.getCustomerProducts = function () {
        //alert($scope.customer_name);
        $scope.partNo = '';
        document.getElementById("remove").style.display = "none";
        document.getElementById("PoDiv").style.display = "block";
        document.getElementById("addMore").style.display = "block";
        $http({
            method: 'get',
            url: BASE_URL + 'po_order/po_order/getCustomerProducts?customer_name=' + $scope.customer_name
        }).then(function successCallback(response) {
            // Assign response to skills object
            //console.log(response.data);
            $scope.partNo = response.data;
        });
    };
//------------------get product name by part no------------------------------------------//
    $scope.getProductInfo = function (index) {
        var part_no = document.getElementById("part_drwing_no_" + index).value;
        $http({
            method: 'get',
            url: BASE_URL + 'po_order/po_order/getProductInfo?part_no=' + part_no
        }).then(function successCallback(response) {
            // Assign response to skills object
            //console.log(response.data);
            var dataNew = response.data;
            document.getElementById("product_name_" + index).value = dataNew['product_name'];
            $scope.prod_id = dataNew['prod_id'];
        });
    };
//--------------------------------------------------------------------------------------------
    //------------------get product info by partno and rev no starts------------------------------------------//

    $scope.getDetailedProductInfo = function (index) {
        var part_no = document.getElementById("part_drwing_no_" + index).value;
        var rev_no = document.getElementById("revision_no_" + index).value;
//        var prod_id = document.getElementById("prod_id_" + index).value;
//        alert(prod_id);
        document.getElementById("old_rate_" + index).value = '';
        document.getElementById("unit_rate_" + index).value = '';
        document.getElementById("sr_no_" + index).value = '';
        document.getElementById("product_code_" + index).value = '';
        document.getElementById("netAmount_" + index).value = '';
        document.getElementById("quantity_" + index).value = '';
        if (part_no == '? undefined:undefined ?') {
            $scope.message_info = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong></strong>Please Select Drawing No or Part No.</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 2000);</script>');
            return false;
        }
        if (rev_no == '') {
            $scope.message_info = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong></strong>Please Enter Revision No.</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 2000);</script>');
            return false;
        }

        $http({
            method: 'get',
            url: BASE_URL + 'po_order/po_order/getDetailedProductInfo?part_no=' + part_no + '&rev_no=' + rev_no
        }).then(function successCallback(response) {

            if (response.data != '500') {
//                $('#sr_no_' + index).val('');
//                $('#product_code_' + index).val('');
                document.getElementById("old_rate_" + index).value = response.data.old_rate;
                document.getElementById("unit_rate_" + index).value = response.data.new_rate;
                var srNo = (response.data);
                var select, i, option;
                var selectNew, j, newOption;
                console.log(srNo);
                select = document.getElementById('sr_no_' + index);
                for (i = 0; i < srNo['subProd'].length; i++) {
                    option = document.createElement('option');
                    option.value = option.text = srNo['subProd'][i][0].sr_no;
                    select.add(option);
                }

                selectNew = document.getElementById('product_code_' + index);
                for (j = 0; j < srNo['subProd'].length; j++) {
                    newOption = document.createElement('option');
                    newOption.value = newOption.text = srNo['subProd'][j][0].part_code;
                    selectNew.add(newOption);
                }

                $scope.message_info = '';
            } else {
                document.getElementById("old_rate_" + index).value = 'N/A';
                document.getElementById("unit_rate_" + index).value = 'N/A';
                $scope.srItemCode = '';
                $scope.message_info = $sce.trustAsHtml('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> No product Details are available for this specification.</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 2000);</script>');
            }
        });
    };
    //------------------get product info by partno and rev no ends------------------------------------------//
    //------------------get product net-amount function starts------------------------------------------//

    $scope.getNetAmount = function (index) {
        var unit_rate = document.getElementById("unit_rate_" + index).value;
        var quantity = document.getElementById("quantity_" + index).value;
        $http({
            method: 'get',
            url: BASE_URL + 'po_order/po_order/getNetAmount?unit_rate=' + unit_rate + '&quantity=' + quantity
        }).then(function successCallback(response) {
            console.log(response.data);
            document.getElementById("netAmount_" + index).value = response.data;
        });
    };
    //------------------get product net-amount function ends------------------------------------------//
//--------------------------add more functionality-------------------------------------------------//
    $scope.productData = [{id: 'choice1'}];

    $scope.addNewProduct = function () {
        var newItemNo = $scope.productData.length + 1;
        $scope.productData.push({'id': 'choice' + newItemNo});
    };

    $scope.removeChoice = function () {
        var lastItem = $scope.productData.length - 1;
        $scope.productData.splice(lastItem);
    };
//------------------------------------------------------------------------------------------------------//

});