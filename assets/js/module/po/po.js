function getCustomerSpecifications() {

    var customer_name = $('#customer_name').val();
    $('#PoDiv').css("display", "block");
    // var poSpecificationDiv = $('#poSpecificationDiv');

}
;

var myApp = angular.module('PoApp', []);
myApp.controller('PoController', function ($scope, $http, $sce) {
    //  ------------------------Add Material data -------------------------//
    // $(function () {
    //     $("#add_PurchaseForm").submit(function () {
    //         dataString = $("#add_PurchaseForm").serialize();
    //         $('#btnsubmit').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding Material. Hang on...</b></span>');
    //         $.ajax({
    //             type: "POST",
    //             url: BASE_URL + "materials/addmaterial/addMaterialInfo",
    //             data: dataString,
    //             return: false, //stop the actual form post !important!
    //             success: function (data)
    //             {
    //                 $.alert(data);
    //                 $('#btnsubmit').html('<button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Material</button>');
    //             }
    //         });
    //         return false;  //stop the actual form post !important!
    //     });
    // });
//  -------------------------END -------------------------------//

    $http.get(BASE_URL + "po_order/po_order/getAllCustomerName").then(function (customer_name) {
        console.log(customer_name);
        $scope.customer = customer_name.data;
    });
}
);