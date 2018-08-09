<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    Meta, title, CSS, favicons, etc.
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gentelella Alela! | </title>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container"> -->

<title>Swan Industries | Dashboard</title>
<!-- page content -->
<!--  -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
            <div class="count">2500</div>
            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
            <div class="count">123.50</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
            <div class="count green">2,500</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
            <div class="count">4,567</div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
            <div class="count">2,315</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
            <div class="count">7,325</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <!-- /top tiles -->

    <!-- add skill div start -->

    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin">
        <label for="skill"><i class="fa fa-database"></i> Add Skill:</label>
        <div class="w3-card w3-padding" id="skill" ng-app="skillApp" ng-controller="skillController">
            <div class="w3-container w3-white">
                <div class="w3-row w3-margin-top">
                    <form ng-submit="submit()" method="POST">
                        <div class="w3-col l10 s10">
                            <input type="text" ng-model="skillname" class="form-control w3-small"  required>
                        </div>
                        <div class="w3-col l2 s2"> 
                            <button class="btn btn-primary theme_bg btn-block" type="submit"><i class="fa fa-plus "></i></button>
                        </div>
                    </form>
                </div>
                <div class="row w3-padding" style="height:250px; overflow: auto;">
                    <div class="col-lg-12 col-xs-12 col-md-12 w3-padding" ng-repeat='skill in skills'>
                        <span>{{skill.skill_name}} </span>
                        <a type="btn" ng-click="delskill(skill.skill_id)" class="w3-right" ><i class="fa fa-times w3-text-black"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- div for add category -->
    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin">
        <label for="Category"><i class="fa fa-plus-square"></i> Material Category:</label>
        <div class="w3-card w3-padding" id="cat" ng-app="categoryApp" ng-controller="categoryController"  >
            <div class="w3-container w3-white" >
                <div class="w3-row w3-margin-top" >
                    <form ng-submit="submit()" method="POST">
                        <div class="w3-col l10 s10">
                            <input type="text" ng-model="material_type" class="form-control w3-small"  required>
                        </div>
                        <div class="w3-col l2 s2"> 
                            <button class=" theme_bg btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i></button>
                        </div>
                    </form>
                </div>
                <div class="row w3-padding" style=" height: 250px; overflow: auto;">
                    <div class="col-lg-12 col-xs-12 col-md-12 w3-padding" ng-repeat="cat in category['status_message']">
                        <span>{{cat.material_type}} </span>
                        <a type="btn" ng-click="delcategory(cat.mat_cat_id)" class="w3-right" ><i class="fa fa-times w3-text-black"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Div for Add Plant-->
    <div class="row" style="padding-left:10px;">
        <div class="col-md-4 col-sm-12 col-xs-12 w3-margin">
            <label for="plants"><i class="fa fa-plus-square"></i> Add Plant:</label>
            <div class="w3-card w3-padding" id="plant" ng-app="plantApp" ng-controller="plantController"  >
                <div class="w3-container w3-white" >
                    <div class="w3-row w3-margin-top" >
                        <form ng-submit="submit()" method="POST">
                            <div class="w3-col l10 s10">
                                <input type="text" ng-model="plant_location" class="form-control w3-small"  required>
                            </div>
                            <div class="w3-col l2 s2"> 
                                <button class=" theme_bg btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="row w3-padding" style=" height: 250px; overflow: auto;">
                        <div class="col-lg-12 col-xs-12 col-md-12 w3-padding" ng-repeat="p in plants['status_message']">
                            <span>{{p.plant_name}} </span>
                            <a type="btn" ng-click="delPlant(p.plant_id)" class="w3-right" ><i class="fa fa-times w3-text-black"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div ng-bind-html="message"></div>
            </div>
        </div>
        <!-- Div for Add Plant-->
    </div>
</div>

<!-- add skill div end -->          
<!-- /page content -->
<!-- script for category -->

<script>
    var plants = angular.module('plantApp', ['ngSanitize']);
    plants.controller('plantController', function($scope, $http){

    $scope.submit = function (){           // POST form data to controller
    $http({
    method: "POST",
            url: "<?php echo base_url(); ?>admin/dashboard/addPlant",
            headers: {
            'Content-Type': 'application/json'
            },
            data: JSON.stringify({plant_location: $scope.plant_location})
    }).then(function (data) {
    // alert(data);
    console.log(data);
    $scope.message = data.data;
    $scope.plant_location = '';
    $scope.showPlants();
    });
    };
    //---------show all category
    $scope.showPlants = function(){
    $http({
    method: 'get',
            url: '<?php base_url(); ?>dashboard/showPlants'
    }).then(function successCallback(response) {
    // Assign response category object
    console.log(response);
    $scope.plants = response.data;
    // $scope.mes=response;
    });
    };
    $scope.showPlants();
    //---del skill

    $scope.delPlant = function(plant_id){
    $http({
    method: 'get',
            url: '<?php base_url(); ?>dashboard/delPlant?plant_id=' + plant_id
    }).then(function successCallback(response) {
    // alert(response);
    // Assign response to skills object
    console.log(response);
    //$scope.skills = response.data;
    $scope.showPlants();
    });
    };
    });
    angular.bootstrap(document.getElementById("plant"), ['plantApp']);
</script>
<script>
    var skill = angular.module('skillApp', ['ngSanitize']);
    skill.controller('skillController', function($scope, $http){


    $scope.submit = function ()    {           // POST form data to controller
    $http({
    method: 'POST',
            url: '<?php echo base_url(); ?>admin/dashboard/addskills',
            headers: {'Content-Type': 'application/json'},
            data: JSON.stringify({skillname: $scope.skillname})
    }).then(function (data) {
    // alert(data);
    //console.log(data);
    $scope.skillname = '';
    $scope.getUsers();
    });
    };
    //---------show all skill
    $scope.getUsers = function(){
    $http({
    method: 'get',
            url: '<?php base_url(); ?>products/addproduct/getAllSkills'
    }).then(function successCallback(response) {
    // Assign response to skills object
    // console.log(response);
    $scope.skills = response.data;
    // $scope.mes=response;
    });
    };
    $scope.getUsers();
    //---del skill
    $scope.delskill = function(skillid){

    $http({
    method: 'get',
            url: '<?php base_url(); ?>dashboard/delSkill?skillid=' + skillid
    }).then(function successCallback(response) {
    // alert(response);
    // Assign response to skills object
    console.log(response);
    //$scope.skills = response.data;
    $scope.getUsers();
    });
    };
    });
    //angular.bootstrap(document.getElementById("skill"), ['skillApp']);
</script>

<script>
    var category = angular.module('categoryApp', ['ngSanitize']);
    category.controller('categoryController', function($scope, $http){

    $scope.submit = function (){           // POST form data to controller
    $http({
    method: 'POST',
            url: '<?php echo base_url(); ?>admin/dashboard/addcategory',
            headers: {'Content-Type': 'application/json'},
            data: JSON.stringify({material_type: $scope.material_type})
    }).then(function (data) {
    // alert(data);
    console.log(data);
    $scope.material_type = '';
    $scope.getCategory();
    });
    };
    //---------show all category
    $scope.getCategory = function(){
    $http({
    method: 'get',
            url: '<?php base_url(); ?>dashboard/showcategory'
    }).then(function successCallback(response) {
    // Assign response category object
    //console.log(response);
    $scope.category = response.data;
    // $scope.mes=response;
    });
    };
    $scope.getCategory();
    //---del skill
    $scope.delcategory = function(mat_cat_id){
    $http({
    method: 'get',
            url: '<?php base_url(); ?>dashboard/delcategory?mat_cat_id=' + mat_cat_id
    }).then(function successCallback(response) {
    // alert(response);
    // Assign response to skills object
    console.log(response);
    //$scope.skills = response.data;
    $scope.getCategory();
    });
    };
    });
    angular.bootstrap(document.getElementById("cat"), ['categoryApp']);
</script>

