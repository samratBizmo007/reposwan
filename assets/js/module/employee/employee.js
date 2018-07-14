/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var myApp = angular.module('employeeApp', ['ngSanitize']);
myApp.controller('employeeController', function ($scope, $http, $window) {
    $scope.products = [];
//console.log($scope.products);
    // add skill to temp 
    $scope.addSkill = function () {
        $scope.errortext = "";
        if (!$scope.addSkillbtn) {
            return;
        }
        if ($scope.products.indexOf($scope.addSkillbtn) == -1) {
            $scope.products.push($scope.addSkillbtn);
            $scope.skilJSON = JSON.stringify($scope.products);
            $scope.employee.skillAdded_field = JSON.stringify($scope.products);
        } else {
            $scope.errortext = "This operation is already listed.";
        }
    };

    // remove skill from temp
    $scope.removeSkill = function (x) {
        $scope.errortext = "";
        $scope.products.splice(x, 1);
        $scope.skilJSON = JSON.stringify($scope.products);
    };

    // get all skills in select box
    $scope.getSkills = function () {
        $http({
            method: 'get',
            url: BASE_URL + 'admin/products/addproduct/getAllSkills'
        }).then(function successCallback(response) {
            // Assign response to skills object
            $scope.skills = response.data;
        });
    };
    $scope.getSkills();

    //-----get employee skills
//    $scope.deleteSkill = function (skill,emp_id) {
//        //alert(emp_id);
//        $http({
//            method: 'get',
//            url: BASE_URL + 'employee/employee/deleteSkill?emp_id=' + emp_id + '&skill=' + skill
//        }).then(function successCallback(response) {
//            // Assign response to skills object
//            console.log(response);
//            alert(response);
////            $scope.employeeSkills = response.data[0].employee_skills;
////            //alert(employeeSkills);
////            $scope.products.push($scope.employeeSkills);
////            $scope.empSkills = JSON.stringify($scope.products);
////            $scope.existingskills(empSkills);
//
//        });
//    };
    //$scope.existingskills(empSkills);
//    $scope.existingskills = function (id) {
//        $scope.products = id;
//    };
    $scope.submit = function () {
        $http({
            method: "POST",
            url: BASE_URL + "employee/employee/addEmployeeDetails",
            data: $scope.employee
        }).then(function (data) {
            console.log(data);
            //$.alert(data.data);
            $scope.message = data.data;
            $window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
                location.reload();
            }, 2000);
        });
    };

//    $http.get(BASE_URL + "employee/employee/getAllEmployeeDetails").then(function (EmployeeInfo) {
//        console.log(EmployeeInfo);
//        $scope.EmpData = EmployeeInfo.data;
//    });
});
//angular.bootstrap(document.getElementById("App"), ['employeeApp']);


//var empApp = angular.module('updateEmployeeApp', ['ngSanitize']);
//empApp.controller('updateEmployeeController', function ($scope, $http) {
//
//    
//});
//angular.bootstrap(document.getElementById("updateEmp"), ['updateEmployeeApp']);
