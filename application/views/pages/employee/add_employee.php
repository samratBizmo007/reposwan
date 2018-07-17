<!-- page content -->
<div class="right_col" role="main" id="App" ng-cloak ng-app="employeeApp" ng-controller="employeeController">
    <!-- top tiles -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title"><div class="w3-padding"><h3><i class="fa fa-plus"></i> Add Employee</h3></div></div>
        <fieldset>
            <div class="row" style=" margin-top: 5px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="" >
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
                                    <label for="operations">Operations Performed<b class="w3-text-red w3-medium">*</b> :</label>
                                    <div class="w3-card" >

                                        <ul class="w3-ul">
                                            <li ng-repeat="x in products">{{x| uppercase}}<span ng-click="removeSkill($index)" style="cursor:pointer;" class="w3-right w3-margin-right">×</span></li>
                                        </ul>
                                        <div class="w3-container w3-light-grey">
                                            <div class="w3-row w3-margin-top">
                                                <div class="w3-col l10 s10">
                                                    <!-- fetch skills from db -->
                                                    <select name="operations" ng-model="addSkillbtn" ng-trim="false" class="form-control w3-small" id="operations">
                                                        <option value="{{skill.skill_name}}" ng-repeat='skill in skills' class="w3-text-grey">{{skill.skill_name| uppercase}}</option>
                                                    </select>
                                                </div>
                                                <div class="w3-col l2 s2">
                                                    <button class="w3-button theme_bg" type="button" ng-click="addSkill()" title="add operation">Add</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="skillAdded_field" id="skillAdded_field" value="{{skilJSON}}">
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


    <div class="row x_title">
        <div class="w3-padding">
            <h3><i class="fa fa-user"></i> All Employee</h3>
        </div>
    </div>
    <div class="row clearfix" style=" margin-top: 5px;">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"    >
            <table class="table table-responsive" id="tab_logic">
                <thead>
                    <tr class="theme_bg">
                        <th class="text-center">
                            Sr.No
                        </th>
                        <th class="text-center">
                            Employee Name
                        </th>
                        <th class="text-center">
                            Punch ID
                        </th>
                        <th class="text-center">
                            Operations Performed
                        </th>
                        <th class="text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
<!--                      <tr ng-repeat="e in EmpData['status_message']">
                        <td class="w3-center">{{e.employee_name}}</td>
                        <td class="w3-center">{{e.employee_punch_id}}</td>
                        <td class="w3-center">
                            <ul>
                                <li ng-repeat="o in JSON.parse(e.employee_skills)">{{o}}</li>
                            </ul>
                        </td>
                        <td class="w3-center"></td>
                    </tr>-->

                    <?php
                    //print_r($details);
                    if ($details['status'] == 200) {
                        $i = 1;
                        $s = 0;
                        foreach ($details['status_message'] as $val) {
                            //print_r($val);
                            ?>
                            <tr id="rowCount">
                                <td class="w3-center"><?php echo $i ?></td>
                                <td class="w3-center"><?php echo $val['employee_name']; ?></td>
                                <td class="w3-center"><?php echo $val['employee_punch_id']; ?></td>
                                <td class="w3-center"><?php
                                    foreach (json_decode($val['employee_skills'], true) as $key) {
                                        echo $key . ',';
                                    }
                                    ?>
                                </td>
                                <td class="w3-center">
                                    <a class="btn w3-padding-small" data-toggle="modal" data-target="#updateEmployeeModal_<?php echo $val['emp_id']; ?>" ng-click="getEmployeeSkills(<?php echo $val['emp_id']; ?>)" title="Update Employee Details">
                                        <i class="w3-text-green w3-large fa fa-edit"></i>
                                    </a>                   
                                    <a class="btn w3-padding-small" onclick="deleteEmployeeDetails(<?php echo $val['emp_id']; ?>)" title="Delete Employee">
                                        <i class="w3-text-red w3-large fa fa-trash"></i>
                                    </a>
                                </td>
                                <!-- Modal -->
                        <div id="updateEmployeeModal_<?php echo $val['emp_id']; ?>" class="modal" role="dialog">
                            <form id="updateEmployeeForm_<?php echo $val['emp_id']; ?>" name="updateEmployeeForm_<?php echo $val['emp_id']; ?>">
                                <div class="modal-dialog modal-lg">
                                    <!----------------------------------- Modal content------------------------------------>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Update Employee Details</h4>
                                        </div>
                                        <!----------------------------------- Modal Body------------------------------------>                                        
                                        <div class="modal-body">
                                            <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
                                                <fieldset>
                                                    <div class="row" style=" margin-top: 5px;">
                                                        <div class="col-lg-1"></div>
                                                        <div class="col-lg-10">
                                                            <div class="w3-col l12 w3-margin-bottom">
                                                                <div class="col-lg-6 col-xs-12 col-sm-12" id="">
                                                                    <label>Employee Name <b class="w3-text-red w3-medium">*</b></label>
                                                                    <input type="text" name="emp_name" id="emp_name" class="form-control" placeholder="Employee Name" value="<?php echo $val['employee_name'] ?>" required>
                                                                    <input type="hidden" name="emp_id" id="emp_id" class="form-control" placeholder="Employee Name" value="<?php echo $val['emp_id'] ?>">
                                                                </div>
                                                                <div class="col-lg-6 col-xs-12 col-sm-12" id="">
                                                                    <label>Punch Id <b class="w3-text-red w3-medium">*</b></label>
                                                                    <input type="number" name="emp_punch_id" id="emp_punch_id" class="form-control" placeholder="Employee Punching Id" value="<?php echo $val['employee_punch_id']; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="w3-col l12">
                                                                <div class="col-lg-6 col-xs-12 col-sm-12 w3-margin-bottom">
                                                                    <label for="operations">Operations Performed <b class="w3-text-red w3-medium">*</b> </label>
                                                                    <div class="w3-card" >
                                                                        <ul class="w3-ul">
                                                                            <li ng-repeat="y in employeeSkills">{{y| uppercase}}<span ng-click="deleteSkill(y,<?php echo $val['emp_id']; ?>)" style="cursor:pointer;" class="w3-right w3-margin-right">×</span></li>
                                                                        </ul>
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
                                                                                    <button class="w3-button theme_bg" type="button" ng-click="addNewSkill()" title="add operation"><i class="fa fa-plus"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="skill_field" ng-model="skill_field" id="skill_field" value="{{skilJSON}}">
                                                                            <input type="hidden" name="fromDbSkills" ng-model="fromDbSkills" id="fromDbSkills" value="{{fromDbSkills}}">
                                                                            <p class="w3-text-red w3-center">{{errortext}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="w3-center w3-col l12" style="">
                                                                <button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Update Employee</button>
                                                            </div>

                                                            <div class="" ng-bind-html="message"></div>
                                                            <!--                                                            <div class="" ng-bind="skilJSON"></div>-->
                                                        </div>
                                                        <div class="col-lg-1"></div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <!----------------------------------- Modal Body------------------------------------>                                                                               
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-------script for update material-->
                        <script type="text/javascript">
                            $(function () {
                            $("#updateEmployeeForm_<?php echo $val['emp_id']; ?>").submit(function (e) {
                            e.preventDefault();
                            var skill_field = $('#skill_field').val();
                            var fromDbSkills = $('#fromDbSkills').val();
                            if (skill_field == '' && fromDbSkills == ''){
                            $.alert('Please Choose atleast one operation');
                            return false;
                            }
                            dataString = $("#updateEmployeeForm_<?php echo $val['emp_id']; ?>").serialize();
                            $.ajax({
                            type: "POST",
                                    url: "<?php echo base_url(); ?>employee/employee/updateEmployeeDetails",
                                    data: dataString,
                                    return: false, //stop the actual form post !important!
                                    success: function (data)
                                    {
                                    $.alert(data);
                                    }
                            });
                            return false; //stop the actual form post !important!
                            });
                            });
                        </script>
                        <!-------script for update material-->
                        <script type="text/javascript">
                            function deleteEmployeeDetails(emp_id) {
                            $.confirm({
                            title: '<h4 class="w3-text-red"><i class="fa fa-warning"></i> Are you sure you want to Delete Employee?</h4>',
                                    content: '',
                                    type: 'red',
                                    buttons: {
                                    confirm: function () {
                                    $.ajax({
                                    url: "<?php echo base_url(); ?>employee/employee/deleteEmployeeDetails",
                                            type: "POST",
                                            data: {
                                            emp_id: emp_id
                                            },
                                            cache: false,
                                            success: function (data) {
                                            // alert(data);
                                            $.alert(data);
                                            }
                                    });
                                    },
                                            cancel: function () {
                                            }
                                    }
                            });
                            }
                        </script>
                        <!-- Modal Ends Here-->
                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="8" class="w3-center">No Records Found..!</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/employee/employee.js"></script>
