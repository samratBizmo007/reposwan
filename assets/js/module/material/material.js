
function getMaterialSpecifications() {

    var material_category = $('#mat_cat_id').val();
    $('#materialDiv').css("display", "block");
    var materialSpecificationDiv = $('#materialSpecificationDiv');
    switch (material_category) {
        case '1':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Thickness <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='thickness' ng-model='materialData.thickness' min='0' step='0.01' id='thickness' class='form-control' placeholder='Material Thickness' required>\n\
</div>\n\
<div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Sheet Quantity <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='quantity' ng-model='materialData.quantity' min='0' step='0.01' id='quantity' class='form-control' placeholder='Quantity' required>\n\
</div>\n\
</div>");
            break;
        case '2':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Diameter <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='diameter' ng-model='materialData.diameter' id='diameter' min='0' step='0.01' class='form-control' placeholder='Material Diameter' required>\n\
</div>\n\
</div>");
            break;
        case '3':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Thickness <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='thickness' ng-model='materialData.thickness' id='thickness' min='0' step='0.01' class='form-control' placeholder='Material Thickness' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Circle Quantity <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='quantity' ng-model='materialData.quantity' min='0' step='0.01' id='quantity' class='form-control' placeholder='Quantity' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Drawing No <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' min='0' step='0.01' class='form-control' placeholder='Drawing No' required>\n\
</div>\n\
</div>");
            break;
        case '4':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>ID <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='id' ng-model='materialData.id' id='id' class='form-control' min='0' step='0.01' placeholder='ID' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>OD <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='od' ng-model='materialData.od' id='od' class='form-control' min='0' step='0.01' placeholder='OD' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Length <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='length' ng-model='materialData.length' id='length' min='0' step='0.01' class='form-control' placeholder='Length' required>\n\
</div>\n\
</div>");
            break;
        case '5':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>OD <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='od' ng-model='materialData.od' id='od' min='0' step='0.01' class='form-control' placeholder='OD' required>\n\
</div>\n\
<div class='col-lg-6 col-xs-12 col-sm-12'>\n\
<label>Length <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='length' ng-model='materialData.length' id='length' min='0' step='0.01' class='form-control' placeholder='Length' required>\n\
</div>\n\
</div>");
            break;
        case '6':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>ID <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='id' ng-model='materialData.id' id='id' class='form-control' min='0' step='0.01' placeholder='ID' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Pitch <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='pitching' ng-model='materialData.pitching' id='pitching' min='0' step='0.01' class='form-control' placeholder='Pitch' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Quantity <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='quantity' ng-model='materialData.quantity' id='quantity' min='0' step='0.01' class='form-control' placeholder='Quantity' required>\n\
</div>\n\
</div>\n\
<div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12 w3-margin-top'>\n\
<label>Drawing No <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' min='0' step='0.01' class='form-control' placeholder='Drawing No' required>\n\
</div>\n\
</div>");
            break;
        case '7':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>OD <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='od' ng-model='materialData.od' id='od' class='form-control' min='0' step='0.01' placeholder='OD' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Pitch <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='pitching' ng-model='materialData.pitching' id='pitching' min='0' step='0.01' class='form-control' placeholder='Pitch' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Quantity <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='quantity' ng-model='materialData.quantity' id='quantity' min='0' step='0.01' class='form-control' placeholder='Quantity' required>\n\
</div>\n\
</div>\n\
<div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12 w3-margin-top'>\n\
<label>Drawing No <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' min='0' step='0.01' class='form-control' placeholder='Drawing No' required>\n\
</div>\n\
</div>");
            break;
        case '8':
            materialSpecificationDiv.html("");
            materialSpecificationDiv.html("<div class='w3-col l12'>\n\
    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>ID <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='id' ng-model='materialData.id' id='id' min='0' step='0.01' class='form-control' placeholder='ID' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Pitch <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='pitching' ng-model='materialData.pitching' min='0' step='0.01' id='pitching' class='form-control' placeholder='Pitch' required>\n\
</div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
<label>Quantity <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='quantity' ng-model='materialData.quantity' id='quantity' min='0' step='0.01' class='form-control' placeholder='Quantity' required>\n\
</div>\n\
</div>\n\
<div>\n\
<div class='col-lg-4 col-xs-12 col-sm-12 w3-margin-top'>\n\
<label>Drawing No <b class='w3-text-red w3-medium'>*</b></label>\n\
<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' min='0' step='0.01' id='Diagram_no' class='form-control' placeholder='Drawing No' required>\n\
</div>\n\
</div>");
    }
}
;
var myApp = angular.module('materialApp', []);
myApp.controller('materialController', function ($scope, $http, $sce) {
    //  ------------------------Add Material data -------------------------//
    $(function () {
        $("#add_MaterialForm").submit(function () {
            dataString = $("#add_MaterialForm").serialize();
            $('#btnsubmit').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding Material. Hang on...</b></span>');
            $.ajax({
                type: "POST",
                url: BASE_URL + "materials/addmaterial/addMaterialInfo",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //$.alert(data);
                    if (data == '200') {
                        $("#message").html('<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Material Added successfully .</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });location.reload();}, 1000);</script>');
                    } else {
                        $("#message").html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>failure!</strong> This material category and material grade is already available in materials OR Material Not Added successfully .</div><script>window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 1000);</script>');
                    }
                    $('#btnsubmit').html('<button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Add Material</button>');
                }
            });
            return false;  //stop the actual form post !important!
        });
    });
//  -------------------------END -------------------------------//

    $http.get(BASE_URL + "materials/addmaterial/getAllMaterialCategories").then(function (categoryinfo) {
        console.log(categoryinfo);
        $scope.category = categoryinfo.data;
    });

//    $scope.getMaterialSpecificationDiv = function () {
//        var thicknesssheetquantity = $sce.trustAsHtml("<div class='w3-col l12'>\n\
//    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
//<label>Thickness</label>\n\
//<input type='number' name='thickness' ng-model='materialData.thickness' id='thickness' class='w3-input w3-border w3-light-grey' placeholder='Material Thickness' required>\n\
//</div>\n\
//<div class='col-lg-6 col-xs-12 col-sm-12'>\n\
//<label>Sheet Quantity</label>\n\
//<input type='number' name='sheet_quantity' ng-model='materialData.sheet_quantity' id='sheet_quantity' class='w3-input w3-border w3-light-grey' placeholder='Sheet Quantity' required>\n\
//</div>\n\
//</div>");
//        var diameter = $sce.trustAsHtml("<div class='w3-col l12'>\n\
//    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
//<label>Diameter</label>\n\
//<input type='number' name='diameter' ng-model='materialData.diameter' id='diameter' class='w3-input w3-border w3-light-grey' placeholder='Material Diameter' required>\n\
//</div>\n\
//</div>");
//        var thicknesscirclequantity = $sce.trustAsHtml("<div class='w3-col l12'>\n\
//    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Thickness</label>\n\
//<input type='number' name='thickness' ng-model='materialData.thickness' id='thickness' class='w3-input w3-border w3-light-grey' placeholder='Material Thickness' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Circle Quantity</label>\n\
//<input type='number' name='circle_quantity' ng-model='materialData.circle_quantity' id='circle_quantity' class='w3-input w3-border w3-light-grey' placeholder='Circle Quantity' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Diagram No</label>\n\
//<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' class='w3-input w3-border w3-light-grey' placeholder='Diagram No' required>\n\
//</div>\n\
//</div>");
//        var idodlength = $sce.trustAsHtml("<div class='w3-col l12'>\n\
//    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>ID</label>\n\
//<input type='number' name='id' ng-model='materialData.id' id='id' class='w3-input w3-border w3-light-grey' placeholder='ID' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>OD</label>\n\
//<input type='number' name='od' ng-model='materialData.od' id='od' class='w3-input w3-border w3-light-grey' placeholder='OD' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Length</label>\n\
//<input type='number' name='length' ng-model='materialData.length' id='length' class='w3-input w3-border w3-light-grey' placeholder='Length' required>\n\
//</div>\n\
//</div>");
//        var odlength = $sce.trustAsHtml("<div class='w3-col l12'>\n\
//    <div class='col-lg-6 col-xs-12 col-sm-12'>\n\
//<label>OD</label>\n\
//<input type='number' name='od' ng-model='materialData.od' id='od' class='w3-input w3-border w3-light-grey' placeholder='OD' required>\n\
//</div>\n\
//<div class='col-lg-6 col-xs-12 col-sm-12'>\n\
//<label>Length</label>\n\
//<input type='number' name='length' ng-model='materialData.length' id='length' class='w3-input w3-border w3-light-grey' placeholder='Length' required>\n\
//</div>\n\
//</div>");
//        var id_pitching_quantity_diagno = $sce.trustAsHtml("<div class='w3-col l12'>\n\
//    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>ID</label>\n\
//<input type='number' name='id' ng-model='materialData.id' id='id' class='w3-input w3-border w3-light-grey' placeholder='ID' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Pitching</label>\n\
//<input type='number' name='pitching' ng-model='materialData.pitching' id='pitching' class='w3-input w3-border w3-light-grey' placeholder='Pitching' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Quantity</label>\n\
//<input type='number' name='quantity' ng-model='materialData.quantity' id='quantity' class='w3-input w3-border w3-light-grey' placeholder='Quantity' required>\n\
//</div>\n\
//</div>\n\
//<div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12 w3-margin-top'>\n\
//<label>Diagram No</label>\n\
//<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' class='w3-input w3-border w3-light-grey' placeholder='Diagram No' required>\n\
//</div>\n\
//</div>");
//        var od_pitching_quantity_diagno = $sce.trustAsHtml("<div class='w3-col l12'>\n\
//    <div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>OD</label>\n\
//<input type='number' name='od' ng-model='materialData.od' id='od' class='w3-input w3-border w3-light-grey' placeholder='OD' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Pitching</label>\n\
//<input type='number' name='pitching' ng-model='materialData.pitching' id='pitching' class='w3-input w3-border w3-light-grey' placeholder='Pitching' required>\n\
//</div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12'>\n\
//<label>Quantity</label>\n\
//<input type='number' name='quantity' ng-model='materialData.quantity' id='quantity' class='w3-input w3-border w3-light-grey' placeholder='Quantity' required>\n\
//</div>\n\
//</div>\n\
//<div>\n\
//<div class='col-lg-4 col-xs-12 col-sm-12 w3-margin-top'>\n\
//<label>Diagram No</label>\n\
//<input type='number' name='Diagram_no' ng-model='materialData.Diagram_no' id='Diagram_no' class='w3-input w3-border w3-light-grey' placeholder='Diagram No' required>\n\
//</div>\n\
//</div>");
//        $scope.getMaterialSpecifications = function () {
//            console.log('mat_cat_id', $scope.materialData.mat_cat_id);
//            var material_category = $scope.materialData.mat_cat_id;
//            //alert(material_category);
//
//            switch (material_category) {
//                case '1':
//                    $scope.getMaterialSpecificationsDiv = thicknesssheetquantity;
//                    break;
//                case '2':
//                    $scope.getMaterialSpecificationsDiv = diameter;
//                    break;
//                case '3':
//                    $scope.getMaterialSpecificationsDiv = thicknesscirclequantity;
//                    break;
//                case '4':
//                    $scope.getMaterialSpecificationsDiv = idodlength;
//                    break;
//                case '5':
//                    $scope.getMaterialSpecificationsDiv = odlength;
//                    break;
//                case '6':
//                    $scope.getMaterialSpecificationsDiv = id_pitching_quantity_diagno;
//                    break;
//                case '7':
//                    $scope.getMaterialSpecificationsDiv = od_pitching_quantity_diagno;
//                    break;
//                case '8':
//                    $scope.getMaterialSpecificationsDiv = id_pitching_quantity_diagno;
//                    break;
//                default:
//            }
//        };

});
