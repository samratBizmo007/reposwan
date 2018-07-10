/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



var myApp = angular.module('showMaterialApp', []);
myApp.controller('showMaterialController', function ($scope, $http) {

    $http.get(BASE_URL + "materials/allmaterial/getAllMaterialDetails").then(function (categoryinfo) {
        console.log(categoryinfo);
        $scope.category = categoryinfo.data;
    });

});