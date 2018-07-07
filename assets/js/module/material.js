// SELECT BOX DEPENDENCY CODE
function checkPassword() {
    if ($('#register_password').val() == $('#register_confirm_password').val()) {
        $('#register_register_submit').prop("disabled", false);
        $('#message').html('');

    } else {
        $('#message').html('<label>Password Not Matching</label>').css('color', 'red');
        $('#register_register_submit').prop("disabled", true);
    }
}
$(document).ready(function ()
{
    $(function () {
        $('#user_role').change(function () {
            // $('.jumla_role').hide();
            var val = $(this).val();
            if (val == 1 || val == 0) {
                $('#passwordField').show();
                $('#categoryDiv').hide();
            } else {
                $('#passwordField').hide();
                $('#categoryDiv').show();
            }
            // $('#' + $(this).val()).show();
        });
    });
});


var myapp = angular.module('registerApp', []);
myapp.controller('registerController', function ($scope, $http) {
    $scope.submitRegister = function () {
        $http({
            method: "POST",
            url: BASE_URL + "materials/showlogin/registerCustomer",
            data: $scope.registerData
        }).then(function (data) {
            alert(data);
        });
    };
//		$http.get("http://localhost/projpoc/api/ManageProduct_api/getAllCategories").then(function (categoryinfo){
//			console.log(categoryinfo);
//			$scope.category = categoryinfo.data;
//		});
});

