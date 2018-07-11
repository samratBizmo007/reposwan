/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function deleteMaterialDetails(material_id) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "materials/allmaterial/deleteMaterialDetails",
        data: {
            material_id: material_id
        },
        return: false, //stop the actual form post !important!
        success: function (data)
        {
            $.alert(data);
        }
    });
    return false;  //stop the actual form post !important!
}
var myApp = angular.module('showMaterialApp', []);
myApp.controller('showMaterialController', function ($scope, $http) {
    $scope.submit = function () {
        // POST form data to controller
        $http({
            method: 'POST',
            url: BASE_URL + 'materials/allmaterial/updateMaterialDetails',
            headers: {'Content-Type': 'application/json'},
            data: JSON.stringify($scope.materialData)
        }).then(function (data) {
            console.log(data);
            alert(data);
        });
    };

});