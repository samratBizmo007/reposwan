/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//----------------fun for delete material details------------------------------------//
function deleteMaterialDetails(material_id) {
    $.confirm({
        title: '<h4 class="w3-text-red"><i class="fa fa-warning"></i> Are you sure you want to Delete Material?</h4>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: BASE_URL + "materials/allmaterial/deleteMaterialDetails",
                    type: "POST",
                    data: {
                        material_id: material_id
                    },
                    cache: false,
                    success: function (data) {
                        $.alert(data);
                    }
                });
            },
            cancel: function () {
            }
        }
    });
}
//----------------delete material details----------------------------------------------//

