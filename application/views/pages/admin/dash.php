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
                <label for="skill">Add Skill:</label>
                  <div class="w3-card w3-padding" ng-app="skillApp" ng-controller="skillController" >
                   <div class="w3-container w3-light-grey">
                     <div class="w3-row w3-margin-top">
                      <form ng-submit="submit()" method="POST">
                      <div class="w3-col l10 s10">
                      <input type="text" ng-model="skillname" class="form-control w3-small"  required>
                    </div>
                      <div class="w3-col l2 s2"> 
                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i></button>
                      </div>
                    </form>
                    </div>
                    <div class="row">
                     <div class="col-lg-12 w3-padding " ng-repeat='skill in skills'>
                      <span>{{skill.skill_name}} </span>
                      <button type="btn" ng-click="delskill()" class="w3-right" ><i class="fa fa-close"></i>
                        <p>{{skill.skill_id}}</p></button>
                     </div>
                    </div>
                  </div>
                </div>
              </div>


              </div>




         <!-- add skill div end -->
            </div>
        </div>
        <!-- /page content -->
 <script>
    var skill = angular.module('skillApp', ['ngSanitize']);
    skill.controller('skillController',function($scope, $http){


     $scope.submit = function ()
      {           // POST form data to controller
          $http({
           method: 'POST',
           url: '<?php echo base_url(); ?>admin/dashboard/addskills',
           headers: {'Content-Type': 'application/json'},
           data: JSON.stringify({skillname: $scope.skillname})
         }).then(function (data) {
          // alert(data);
          console.log(data);
           
           
         });
       }
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
   }
   $scope.getUsers()

   //---del skill
    $scope.delskill = function(skillid){
      $http({
       method: 'get',
       url: '<?php base_url(); ?>dashboard/delSkill?skillid='+skillid
     }).then(function successCallback(response) {
      // Assign response to skills object
      console.log(response);
      $scope.skills = response.data;
      // $scope.mes=response;
    }); 
   }
      
    });
  </script>
     <!--  </div>
    </div>
  
  </body>
</html> -->
