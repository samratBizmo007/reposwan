<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Anggular JS</title>

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/header/header_overlay.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700,900" rel="stylesheet">
	<style>
	body {
		font-family: 'Roboto', sans-serif;
	}
</style>

<!-- Material Design Bootstrap -->
<link href="<?php echo base_url() ?>css/home_page/css/style.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/js/const.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/js/login/login.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/js/loadingoverlay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/js/loadingoverlay_progress.min.js"></script>

</head>
<body>
	<div class="container" ng-app="enterprise" ng-controller="Home">
		
		<div class="w3-padding-small">
			<button id="addnew" class="btn btn-warning">add <i class="fa fa-plus"></i></button>
		</div>

		<h3><?php echo $msg; ?></h3>

		<form id="addProduct_form" name="addProduct_form">
			<div class="w3-col l12 s12 m12">
				<div class="col-lg-6 w3-padding-small" id="deletecat">
					<div class="w3-col l12 s12 m12 w3-small w3-padding-bottom">
						<label> Product Name: <font color ="red"><span id ="pname_star">*</span></font></label><br>
						<font color ="red"><span id ="product_name_span"></span></font>
						<input type="text" name="product_name" id="product_name" value="" placeholder="Add Product Name" class="w3-input w3-border w3-margin-bottom" required>
					</div>                           
					<!-- kk -->
					<div class="w3-col l12 s12 m12 w3-small w3-padding-bottom">
						<label> Product Description: <font color ="red"><span id ="pdescription_star">*</span></font></label><br>
						<font color ="red"><span id ="product_description_span"></span></font>
						<textarea class="w3-input w3-border w3-margin-bottom" name="product_description" id="product_description" rows="5" cols="50" style="resize: none;" required></textarea>
					</div>
					<!-- kk -->                            
				</div>
			</div>
			<div class=" w3-col l12 w3-padding-small">
				<label>Select a Category:</label><br>
				<select class="w3-input w3-border w3-light-grey" ng-model="selectedCategory">
					<option ng-repeat="x in categories['status_message']" value="{{x.cat_id}}">{{x.category_name}}</option>
				</select>
			</div>
			<div class="w3-col l12 w3-padding-small" id="btnsubmit">
				<button  type="submit" title="add Product" class="w3-medium w3-button w3-red">Add Product</button>
			</div>
		</form>

		<?php //print_r($users);?>
		<div class="w3-col l12 w3-margin-top">
			<!-- <table class="table table-bordered">
				<tr>
					<td><strong>Name</strong></td>
					<td><strong>Phone No</strong></td>
					<td><strong>Email</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php foreach($users['status_message'] as $row){ ?>
					<tr>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['phone']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td>
							<a class="btn w3-padding-small" onclick="apprUser(<?php echo $row['user_id']; ?>);" title="Approve request">
								<i class="w3-text-green w3-large fa fa-check-circle"></i>
							</a>                   
							<a class="btn w3-padding-small" onclick="deleteUser(<?php echo $row['user_id']; ?>);" title="Delete Seller">
								<i class="w3-text-red w3-large fa fa-times-circle"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
			</table> -->

			<table class="table table-bordered">
				<tr>
					<td><strong>Name</strong></td>
					<td><strong>Phone No</strong></td>
					<td><strong>Email</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<tr ng-repeat="d in datas['status_message']">
					<td>{{ d.product_name }}</td>
					<td>{{ d.prod_description }}</td>
					<td>{{ d.category_name }}</td>						
					<td>
						<a class="btn w3-padding-small" ng-href="" onclick="apprUser()" title="Approve request">
							<i class="w3-text-green w3-large fa fa-check-circle"></i>
						</a>                   
						<a class="btn w3-padding-small" ng-href="" onclick="deleteUser()" title="Delete Seller">
							<i class="w3-text-red w3-large fa fa-times-circle"></i>
						</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
<!-- 	<div class="container" id="App2" ng-app="showdata" ng-controller="showinfo">
		<div class=" w3-col l12">
			<label>Select a Category:</label><br>
			<select class="w3-input w3-border w3-light-grey" ng-model="selectedCategory">
				<option ng-repeat="z in category['status_message']" value="{{z.cat_id}}">{{z.category_name}}</option>
			</select>
		</div>
	</div> -->
	<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<div class="container" style="margin-top: 71px;margin-bottom: 71px;">
		<div class="row">
			<div class="w3-col m4 col-md-offset-4 w3-center" id="messageDiv"></div>
		</div>
		<div class="row">
			<div class="col-lg-2 w3-hide-small"></div>
			<div class="col-lg-4">

				<!-- REGISTER DIV -->
				<div class="col-lg-12 w3-card-2 w3-margin-bottom"> 
					<div class="w3-padding " style="margin-top: 30px">
						
					</div>

					<div class="w3-container" id="App" ng-app="registerApp" ng-controller="registerController"  style="padding:0 36px 12px 36px">
						<div id="Login_RegisterDiv">
							<form id="register_form" method="post" role="form" ng-submit="submitRegister()">
								<div class="w3-col l12 " id="registration_err"></div>
								<div id = "registerDiv">
									<div class="w3-margin-bottom w3-col l12 s12"> 
										<select name="user_role" ng-model="registerData.user_role" id="user_role" class="w3-input w3-border w3-light-grey" required>
											<option class="w3-red" value="0" selected>Select your role</option>
											<option value="1">Customer</option>
											<option value="2">Seller</option>
										</select>
									</div>
									<div class="w3-col l12 w3-margin-bottom" id="categoryDiv" style="display: none;">
									<select class="w3-input w3-border w3-light-grey" id="cat_id" name="cat_id" ng-model="registerData.cat_id">
										<option ng-repeat="z in category['status_message']" ng-selected="registerData.category_id==z.cat_id" value="{{z.cat_id}}">{{z.category_name}}</option>
									</select>
									</div>
									<div id="2" class="jumla_role  w3-col l12 s12">
										<div class="w3-margin-bottom">
											<input type="text" name="register_username" ng-model="registerData.register_username" id="register_username"  class="w3-input w3-border w3-light-grey " placeholder="Username " value="" required>
										</div>

										<div class="w3-margin-bottom">
											<input type="email" name="register_email" ng-model="registerData.register_email" id="register_email" class="w3-input w3-border w3-light-grey" placeholder="Email address" required>
										</div>
										<div class="w3-col l12 w3-margin-bottom"  >
											<div class="w3-col l4 s4">
												<select class="w3-input w3-light-grey w3-border w3-small" ng-model="registerData.mobile_code" name="mobile_code" id="mobile_code">
													<option value="965" selected>+965 (Kuwait)</option>
													<option value="91">+91 (India)</option>
												</select>
											</div>
											<div class="w3-col l8 s8 w3-padding-left">
												<input type="number" ng-model="registerData.register_number" class="w3-input w3-light-grey w3-border w3-small" placeholder="mobile no" name="register_number" id="register_number" required>
											</div>                              
										</div>
									</div>
									<!-- hide this part for seller -->
									<div id="passwordField" class="w3-margin-bottom " >
										<div class="w3-margin-bottom" style="">
											<input type="password" onkeyup="checkPassword();" ng-model="registerData.register_password" name="register_password" id="register_password" class="w3-input w3-border w3-light-grey " placeholder="Password" minlength="8" >
										</div>
										<div class="w3-margin-bottom" style="">
											<input type="password" ng-model="registerData.register_confirm_password" name="register_confirm_password" id="register_confirm_password" onkeyup="checkPassword();" class="w3-input w3-border w3-light-grey " minlength="8" placeholder="Confirm Password">
										</div>
										<div id="message"></div>
									</div>
									<div class="w3-margin-bottom" style="">
										<input type="submit" name="register_register_submit" id="register_register_submit" class="form-control btn btn-register w3-blue" value="Sign Up">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- REGISTER DIV ENDS -->   
			</div>
			<!-- ---------------------------------login div----------------------------------------------- -->
			
		<div class="col-lg-4 ">			
			<!-- LOGIN DIV -->
			<div class="col-lg-12 w3-card-2 w3-margin-bottom"> 
				<div class="w3-padding " style="margin-top: 30px">
					
				</div>
				<div class="w3-container" id="login" ng-app="loginApp" ng-controller="loginController" style="padding:0 36px 12px 36px">
					<div id="Login_RegisterDiv">

						<form id="login_form" method="post" role="form" ng-submit="submitLogin()" style="">
							<div class="w3-col l12 " id="login_err">
								<?php 
								if(isset($err_msg)){
									echo '
									<div class="alert alert-danger ">
									<strong>'. $err_msg.'</strong> 
									</div>
									';
								}
								?>
							</div>
							<div id="registerDiv">
								<div class="w3-margin-bottom w3-col l12 s12"> 
								</div>
								<div id="2" class="jumla_role  w3-col l12 s12">
									<div class="w3-margin-bottom">
										<input type="text" name="login_username" ng-model="loginData.login_username" id="login_username" tabindex="2" class="w3-input w3-border w3-light-grey" placeholder="Username or Email Id" value="<?php echo $_COOKIE['jumla_uname']; ?>" required>
									</div>
									<div class="w3-margin-bottom">
										<input type="password" name="login_password" ng-model="loginDate.login_password" id="login_password" class="w3-input w3-border w3-light-grey" value="<?php echo $_COOKIE['jumla_pass']; ?>" placeholder="Password" required>
									</div>
								</div>
								<div class="w3-margin-bottom" style="">
									<input type="submit" name="login_submit" id="login_submit" class="form-control btn btn-register w3-blue" value="Log In">
								</div>													
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- LOGIN DIV ENDS -->
		</div>
	</div>
			</div>
		<!-- ---------------------------------login div----------------------------------------------- -->
		</div>
	</div>
	<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</body>	
</html>

<script>
// SELECT BOX DEPENDENCY CODE
$(document).ready(function()
{
   $(function() {
      $('#user_role').change(function(){
    // $('.jumla_role').hide();
    var val=$(this).val();
    if(val==1 || val==0){
        $('#passwordField').show();
        $('#categoryDiv').hide();
    }
    else{
        $('#passwordField').hide();
        $('#categoryDiv').show();
    }
    // $('#' + $(this).val()).show();
});
  });
});
</script>
<script type="text/javascript">
	$(document).ready(function (){
		$('#addProduct_form').hide();
	});
	$('#addnew').click(function(){
		$('#addProduct_form').show();
	});
</script>
<!--<script type="text/javascript">
	var app = angular.module('enterprise', []);
	app.controller('Home', function($scope,$http){
		$http.get('http://localhost/projpoc/api/Home_api/getallusers').then(function (mydata){
			console.log(mydata);
			$scope.datas = mydata.data;
		});

		$http.get("http://localhost/projpoc/api/ManageProduct_api/getAllCategories").then(function (categorydata){
			console.log(categorydata);
			$scope.categories = categorydata.data;
		});
	});
</script>-->
<!--<script type="text/javascript">
	var myapp = angular.module('loginApp', []);
	myapp.controller('loginController', function($scope,$http){
		$scope.submitLogin = function(){
			$http({
				method:"POST",
				url:"<?php echo base_url(); ?>login/loginCustomer",
				data:$scope.loginData
			}).then(function(data){
				alert(data);
			});
		};
		$http.get("http://localhost/projpoc/api/ManageProduct_api/getAllCategories").then(function (categoryinfo){
			console.log(categoryinfo);
			$scope.category = categoryinfo.data;
		});
	});
	angular.bootstrap(document.getElementById("login"), ['loginApp']);
</script>-->
<script type="text/javascript">
	var myapp = angular.module('registerApp', []);
	myapp.controller('registerController', function($scope,$http){
		$scope.submitRegister = function(){
			$http({
				method:"POST",
				url:"<?php echo base_url(); ?>materials/showlogin/registerCustomer",
				data:$scope.registerData
			}).then(function(data){
				//alert(data);
			});
		};
//		$http.get("http://localhost/projpoc/api/ManageProduct_api/getAllCategories").then(function (categoryinfo){
//			console.log(categoryinfo);
//			$scope.category = categoryinfo.data;
//		});
	});
	angular.bootstrap(document.getElementById("App"), ['registerApp']);

</script>