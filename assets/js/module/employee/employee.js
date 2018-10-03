/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var myApp = angular.module('employeeApp', ['ngSanitize']);
myApp.controller('employeeController', function ($scope, $http, $window) {
    $scope.products = [];
    $scope.dbSkills = [];//console.log($scope.products);
    // add skill to temp 
    $scope.addSkill = function () {
        $scope.errortext = "";
        if (!$scope.addSkillbtn) {
            return;
        }
        if ($scope.products.indexOf($scope.addSkillbtn) == -1) {
            $scope.products.push($scope.addSkillbtn);
            $scope.skilJSON = JSON.stringify($scope.products);
            $scope.employee.skillAdded_field = $scope.skilJSON;
        } else {
            $scope.errortext = "This operation is already listed.";
        }
    };
    // remove skill from temp
    $scope.removeSkill = function (x) {
        $scope.errortext = "";
        $scope.products.splice(x, 1);
        //$scope.texts = $scope.products.splice(x, 1);
        $scope.skilJSON = JSON.stringify($scope.products);
        $scope.skill_field = $scope.skilJSON;

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
    $scope.getEmployeeSkills = function (emp_id) {
        $http({
            method: 'get',
            url: BASE_URL + 'employee/employee/getEmployeeSkills?emp_id=' + emp_id
        }).then(function successCallback(response) {
            // Assign response to skills object
            console.log(response);
            //alert(response);
            $scope.employeeSkills = response.data;
            $scope.empSkills = JSON.stringify($scope.employeeSkills);
            console.log($scope.empSkills);
            //$scope.selectedEmpSkills = JSON.stringify($scope.employeeSkills);
            $scope.fromDbSkills = JSON.stringify($scope.employeeSkills);
        });
    };
    //$scope.existingskills(empSkills);
    $scope.existingskills = function (id) {
        $scope.dbSkills = id;
    };
    $scope.deleteSkill = function (skill, emp_id) {
        $http({
            method: 'get',
            url: BASE_URL + 'employee/employee/deleteSkill?emp_id=' + emp_id + '&skill=' + skill
        }).then(function successCallback(response) {
            // Assign response to skills object
            console.log(response);
            $scope.employeeSkills = response.data;
            //alert(response);
            $scope.fromDbSkills = JSON.stringify(response.data);

            $scope.getEmployeeSkills(emp_id);
        });
    };

    $scope.submit = function () {
        if (!$scope.skilJSON) {
            $scope.message = '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Please Select atleast one operation.</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 5000);</script>';
            return false;
        }
        $('#btnsubmit').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding Employee. Hang on...</b></span>');
        $http({
            method: "POST",
            url: BASE_URL + "employee/employee/addEmployeeDetails",
            data: $scope.employee
        }).then(function (data) {
            console.log(data);
            //$.alert(data.data);
            $scope.message = data.data;
            $('#btnsubmit').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><b>Add Employee</b></span>');

            $window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
                location.reload();
            }, 2000);
        });
    };
    $http.get(BASE_URL + "employee/employee/getAllEmployeeDetailsnew").then(function (EmployeeInfo) {
        console.log(EmployeeInfo);
        $scope.EmpData = EmployeeInfo.data;
    });

    $scope.addNewSkill = function () {
        $scope.errortext = "";
        if (!$scope.addSkillbtn) {
            return;
        }
        if ($scope.products.indexOf($scope.addSkillbtn) == -1) {
            $scope.products.push($scope.addSkillbtn);
            $scope.skilJSON = JSON.stringify($scope.products);
            $scope.skill_field = $scope.skilJSON;
        } else {
            $scope.errortext = "This operation is already listed.";
        }
    };
});
