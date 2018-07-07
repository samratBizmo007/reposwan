// script to implement multistep form in add product page
// $(document).ready(function(){
//   var current = 1,current_step,next_step,steps;
//   steps = $("fieldset").length;
//   $(".next").click(function(){
//     current_step = $(this).parent();
//     next_step = $(this).parent().next();
//     next_step.show();
//     current_step.hide();
//     setProgressBar(++current);
//   });
//   $(".previous").click(function(){
//     current_step = $(this).parent();
//     next_step = $(this).parent().prev();
//     next_step.show();
//     current_step.hide();
//     setProgressBar(--current);
//   });
//   setProgressBar(current);
//   // Change progress bar action
//   function setProgressBar(curStep){
//     var percent = parseFloat(100 / steps) * curStep;
//     percent = percent.toFixed();
//     $(".progress-bar")
//     .css("width",percent+"%")
//     .html(percent+"%");   
//   }
// });

// script to add extra div for serial no and item code
$(document).ready(function () {
  var max_fields = 10;
  var wrapper = $("#addedmore_DivGeneral");
  var add_button = $("#addMoreBtnGeneral");
  var x = 1;
  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      $(wrapper).append('<div><div class="w3-col l12"><hr>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="sr_no">Serial Number '+x+' :</label>\n\
        <input type="text" class="form-control" id="sr_no'+x+'" name="sr_no[]" placeholder="Enter serial number">\n\
        </div>\n\
        </div>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="part_no">Item Code '+x+' :</label>\n\
        <input type="text" class="form-control" id="part_no'+x+'" name="part_no[]" placeholder="Enter Item Code">\n\
        </div>\n\
        </div>\n\
        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
        </a>\n\
        </div>\n\
        </div>'); 
        //add input box
      } 
      else {
        $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');   
        //alert when added more than 10 input fields
      }
    });
  $(wrapper).on("click", ".delete", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  })
});

// script to add extra div for serial no and item code
$(document).ready(function () {
  var max_fields = 10;
  var wrapper = $("#addedmore_DivMachine");
  var add_button = $("#addMoreBtnMachine");
  var x = 1;
  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      $(wrapper).append('<div><div class="w3-col l12"><hr>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="machine">Machine used(in tonnes) '+x+' :</label>\n\
        <input type="number" class="form-control" id="machine'+x+'" name="machine[]" placeholder="eg. 20, 30, 40 ton">\n\
        </div>\n\
        </div>\n\
        <div class="col-md-6 col-sm-12 col-xs-12">\n\
        <div class="form-group">\n\
        <label for="qtyhr">Quantity per hour '+x+' :</label>\n\
        <input type="number" class="form-control" id="qtyhr'+x+'" name="qtyhr[]" placeholder="eg.1, 2, 3, etc.">\n\
        </div>\n\
        </div>\n\
        <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove section">remove <i class="fa fa-remove"></i>\n\
        </a>\n\
        </div>\n\
        </div>'); 
        //add input box
      } 
      else {
        $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xlarge"></i> You reached the maximum limit of adding ' + max_fields + ' fields</label>');   
        //alert when added more than 10 input fields
      }
    });
  $(wrapper).on("click", ".delete", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  })
});