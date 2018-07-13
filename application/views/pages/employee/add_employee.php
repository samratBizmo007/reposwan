<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title"><div class="w3-padding"><h3><i class="fa fa-plus"></i> Add Employee</h3></div></div>
        <fieldset>
            <div class="row" style=" margin-top: 5px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="" id="App" ng-cloak ng-app="employeeApp" ng-controller="employeeController">
                        <form id="add_MaterialForm" ng-submit="submit()" method="post" role="form">
                            <div class="w3-col l12 w3-margin-bottom">
                                <div class="col-lg-6 col-xs-12 col-sm-12" id="">
                                    <label>Employee Name <b class="w3-text-red w3-medium">*</b></label>
                                    <input type="text" name="emp_name" ng-model="employee.emp_name" id="emp_name" class="form-control" placeholder="Employee Name" value="" required>
                                </div>
                                <div class="col-lg-6 col-xs-12 col-sm-12" id="">
                                    <label>Punch Id <b class="w3-text-red w3-medium">*</b></label>
                                    <input type="number" name="emp_punch_id" ng-model="employee.emp_punch_id" id="emp_punch_id" class="form-control" placeholder="Employee Punching Id" value="" required>
                                </div>
                            </div>
                            <div class="w3-col l12">
                                <div class="col-lg-6 col-xs-12 col-sm-12 w3-margin-bottom">
                                    <label for="operations">Operations Performed <b class="w3-text-red w3-medium">*</b> </label>
                                    <div class="w3-card" >

                                        <ul class="w3-ul">
                                            <li ng-repeat="x in products">{{x| uppercase}}<span ng-click="removeSkill($index)" style="cursor:pointer;" class="w3-right w3-margin-right">×</span></li>
                                        </ul>
                                        <div class="w3-container w3-light-grey">
                                            <div class="w3-row w3-margin-top">
                                                <div class="w3-col l10 s10">
                                                    <!-- fetch skills from db -->
                                                    <select name="operations" ng-model="addSkillbtn" ng-trim="false" class="form-control w3-small" id="operations" required>
                                                        <option value="{{skill.skill_name}}" ng-repeat='skill in skills' class="w3-text-grey">{{skill.skill_name| uppercase}}</option>
                                                    </select>
                                                </div>
                                                <div class="w3-col l2 s2">
                                                    <button class="w3-button theme_bg" type="button" ng-click="addSkill()" title="add operation"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="skillAdded_field" ng-model="employee.skillAdded_field" id="skillAdded_field" value="{{skilJSON}}">
                                            <p class="w3-text-red w3-center">{{errortext}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" w3-center w3-col l12" style="">
                                <button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Employee</button>
                            </div>
                        </form>
                        <div class="" ng-bind-html="message"></div>
                    </div>                   
                </div>
                <div class="col-lg-1"></div>
            </div>
        </fieldset>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/employee/employee.js"></script>
