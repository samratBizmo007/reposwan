
// var machine = angular.module('machineApp', ['ngSanitize']);
// machine.controller('machineController',function($scope, $http){

var machine = angular.module('machineApp', []);
machine.controller('machineController', function ($scope, $http, $sce)
{
    $(function () {
        $("#add_MachineForm").submit(function () {
            dataString = $("#add_MachineForm").serialize();
            // alert(dataString);
            $('#btnsubmit').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding Machine. Hang on...</b></span>');
            $.ajax({
                type: "POST",
                url: BASE_URL + "admin/machine/addmachine/addMachine_data",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    // alert(data);
                    $.alert(data);
                    $('#btnsubmit').html('<button  type="submit" title="add Machine" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Machine</button>');
                }
            });
            return false;  //stop the actual form post !important!
        });
    });

});

