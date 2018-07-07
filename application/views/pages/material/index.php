
<div class="right_col" role="main">
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
                                            <option ng-repeat="z in category['status_message']" ng-selected="registerData.category_id == z.cat_id" value="{{z.cat_id}}">{{z.category_name}}</option>
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
                                    if (isset($err_msg)) {
                                        echo '
									<div class="alert alert-danger ">
									<strong>' . $err_msg . '</strong> 
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
    <!-- js file for material module -->
  <script src="<?php echo base_url(); ?>assets/js/module/material.js"></script>
