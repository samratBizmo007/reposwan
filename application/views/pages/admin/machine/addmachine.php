<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title"><div class="w3-padding"><h3><i class="fa fa-plus"></i> Add Machine</h3></div></div>
        <fieldset>
            <div class="row" style=" margin-top: 5px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="" id="App" ng-app="machineApp" ng-controller="machineController"  style="padding:12px 36px 12px 36px">
                        <form id="add_MachineForm" method="post" role="form">
                            <div class="w3-col l12" ng-model=""></div>
                             <div id="machineDiv" style="">
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div id="machinename" class="col-lg-6 col-xs-12 col-sm-12">										<label>Machine name <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="text" name="machine_name" ng-model="machine_name" id="machine_name" class="form-control" placeholder="Machine Name" required>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="machinecapacity">
                                        <label>Machine Capacity</label>
                                        <input type="number" name="machine_capacity" ng-model="machine_capacity" id="machine_capacity" min="0" step="0.01" class="form-control" placeholder="Machine Capacity" required>
                                    </div>											                           
                                </div>
                                <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv"></div>
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="machinetype">
                                        <label>Machine Type <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="text" name="machine_type" ng-model="machine_type" id="machine_type"  class="form-control" placeholder="Machine Type" required>
                                    </div>  
                                </div>
                            </div>
                            <div class=" w3-center w3-col l12" style="">
                                <button  type="submit" title="add Machine" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Machine</button>
                            </div>
                        </form>
                    </div>
                    <!-- REGISTER DIV ENDS -->   
                </div>
                <div class="col-lg-1"></div>
            </div>
        </fieldset>
    </div>
    <!-- /top tiles -->
</div>
<!-- /page content -->

<script>
    var category = angular.module('machineApp', ['ngSanitize']);
    category.controller('machineController',function($scope, $http){


     $scope.submit = function ()
     $(function () {
        $("#add_MachineForm").submit(function () {
            dataString = $("#add_MachineForm").serialize();
            alert(dataString);
            $('#btnsubmit').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding Machine. Hang on...</b></span>');
            $.ajax({
                type: "POST",
                url: BASE_URL + "machine/addmachine/addMachine_data",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    $.alert(data);
                    $('#btnsubmit').html('<button  type="submit" title="add Machine" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Machine</button>');
                }
            });
            return false;  //stop the actual form post !important!
        });
    });
         });
    </script>