/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var myApp = angular.module('showInventoryApp', []);
myApp.controller('showInventoryController', function ($scope, $http) {
    
    $http.get(BASE_URL + "inventory/showinventory/getAllMaterialDetails").then(function (materialinfo) {
        console.log(materialinfo);
        $scope.materials = materialinfo.data;
    });
    
});