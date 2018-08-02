/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var myApp = angular.module('requiredMaterialApp', []);
myApp.controller('requiredMaterialController', function ($scope, $http, $sce) {

    $scope.po = [];

    $http.get(BASE_URL + "required_rawmaterial/Required_rawmaterial/getPurchaseOrdersDetails").then(function (response) {
        console.log(response.data);
        var data = response.data;
        var i, products, srItemCode, machineQuantityPerHr, rawMaterialRequired;
        for (i = 0; i < data.length; i++) {
            //console.log(JSON.parse(data[i].product_details));
            //alert(data[i].customer_name);
            products = JSON.parse(data[i].product_details);
            srItemCode = JSON.parse(data[i].sr_item_code);
            machineQuantityPerHr = JSON.parse(data[i].machine_qtyhr);
            rawMaterialRequired = JSON.parse(data[i].rm_required);
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
                'modified_time': data[i].modified_time,
                'sr_ItemCode': srItemCode,
                'machine_qty_hr': machineQuantityPerHr,
                'rawMaterialRequired': rawMaterialRequired
            });
        }
        console.log($scope.po);
        //$scope.poData = $scope.po;
    });
//-------------get Po details ends-------------------------------------//

});