//function getCustomerSpecifications() {
//
//    var customer_name = $('#customer_name').val();
//    $('#PoDiv').css("display", "block");
//    // var poSpecificationDiv = $('#poSpecificationDiv');
//
//}
//;

var myApp = angular.module('PoApp', []);
myApp.controller('PoController', function ($scope, $http, $sce) {

    $http.get(BASE_URL + "po_order/po_order/getAllCustomerName").then(function (customer_name) {
        console.log(customer_name);
        $scope.customer = customer_name.data;
    });

    $scope.getCustomerProducts = function () {
        //alert($scope.customer_name);
        document.getElementById("PoDiv").style.display = "block";
        $http({
            method: 'get',
            url: BASE_URL + 'po_order/po_order/addproduct'
        }).then(function successCallback(response) {
            // Assign response to skills object
            $scope.skills = response.data;

        });
    };
});