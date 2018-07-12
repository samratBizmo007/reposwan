<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-cubes"></i> All Material</h3>
            </div>
        </div>
        <div class="row clearfix" style=" margin-top: 5px;">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <table class="table table-responsive" id="tab_logic" width:50px;">
                       <thead>
                        <tr class="theme_bg">
                            <th width="7%" class="text-center">
                                Sr No
                            </th>
                            <th class="text-center">
                                Material Type
                            </th>
                            <th class="text-center">
                                Material Name
                            </th>
                            <th class="text-center">
                                Rate
                            </th>
                            <th class="text-center">
                                Weight
                            </th>                           
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id='addedRows'>
                        <?php
                        //print_r($details);
                        if ($details['status'] == 200) {
                            $i = 1;
                            foreach ($details['status_message'] as $val) {
                                //print_r($val);
                                ?>
                                <tr id="rowCount">
                                    <td class="w3-center"><?php echo $i ?></td>
                                    <td class="w3-center"><?php echo $val['material_type']; ?></td>
                                    <td class="w3-center"><?php echo $val['material_grade']; ?></td>
                                    <td class="w3-center"><?php echo $val['material_rate']; ?></td>
                                    <td class="w3-center"><?php echo $val['material_weight']; ?></td>
                                    <td class="w3-center">
                                        <a class="btn w3-padding-small" data-toggle="modal" data-target="#updateMaterialModal_<?php echo $val['material_id']; ?>" title="Update Material Details">
                                            <i class="w3-text-green w3-large fa fa-edit"></i>
                                        </a>                   
                                        <a class="btn w3-padding-small" onclick="deleteMaterialDetails(<?php echo $val['material_id']; ?>)" title="Delete Material">
                                            <i class="w3-text-red w3-large fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <!-- Modal -->
                            <div id="updateMaterialModal_<?php echo $val['material_id']; ?>" class="modal" role="dialog">
                                <form id="updateMaterialForm_<?php echo $val['material_id']; ?>" name="updateMaterialForm_<?php echo $val['material_id']; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <!----------------------------------- Modal content------------------------------------>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Material Details</h4>
                                            </div>
                                            <!----------------------------------- Modal Body------------------------------------>                                        
                                            <div class="modal-body">
                                                <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
                                                    <fieldset>
                                                        <div class="row" style=" margin-top: 5px;">
                                                            <div class="col-lg-1"></div>
                                                            <div class="col-lg-10">
                                                                <div class="" id="App" style="padding:12px 36px 12px 36px">
                                                                    <div class="w3-col l12"></div>
                                                                    <div class="w3-col l12 w3-margin-bottom">
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12" id="materialCategoryDiv">
                                                                            <label>Material Type <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="text" name="mat_category" id="mat_category"  class="form-control" placeholder="Material Type" disabled value="<?php echo $val['material_type']; ?>" required>
                                                                            <input type="hidden" name="mat_cat_id" id="mat_cat_id" value="<?php echo $val['mat_cat_id']; ?>" required>
                                                                            <input type="hidden" name="material_id" id="material_id" value="<?php echo $val['material_id']; ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w3-col l12 w3-margin-bottom">
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12" id="materialGrade">
                                                                            <label>Material Grade <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="text" name="material_grade" disabled id="material_grade"  class="form-control" placeholder="Material Grade" value="<?php echo $val['material_grade']; ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w3-col l12 w3-margin-bottom">
                                                                        <div id="materialRate" class="col-lg-6 col-xs-12 col-sm-12">										
                                                                            <label>Material Rate <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="material_rate" value="<?php echo $val['material_rate']; ?>" id="material_rate" min="0" step="0.01" class="form-control" placeholder="Material Rate" required>
                                                                        </div>
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12" id="materialWeight">
                                                                            <label>Material Weight <b class="w3-text-red w3-medium">*</b></label>
                                                                            <input type="number" name="material_weight" value="<?php echo $val['material_weight']; ?>" id="material_weight" min="0" step="0.01" class="form-control" placeholder="Material Weight" required>
                                                                        </div>											                           
                                                                    </div>
                                                                    <div class="w3-col l12 w3-margin-bottom">
                                                                        <div class="col-lg-12 col-xs-12 col-sm-12">
                                                                            <label>Remark</label>
                                                                            <textarea  class="form-control" name="remark" id="remark" placeholder="Remark" rows="5" cols="50" style="resize: none;"><?php echo $val['remark']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    switch ($val['mat_cat_id']) {
                                                                        case '1':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                                        <label>Thickness <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="thickness" value="<?php echo $val['thickness']; ?>" min="0" step="0.01" id="thickness" class="form-control" placeholder="Material Thickness" required>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                                        <label>Sheet Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="quantity" value="<?php echo $val['quantity']; ?>" min="0" step="0.01" id="quantity" class="form-control" placeholder="Sheet Quantity" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            break;
                                                                        case '2':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                                        <label>Diameter <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="diameter" value="<?php echo $val['diameter']; ?>" id="diameter" min="0" step="0.01" class="form-control" placeholder="Material Diameter" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            break;
                                                                        case '3':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Thickness <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="thickness" value="<?php echo $val['thickness']; ?>" id="thickness" min="0" step="0.01" class="form-control" placeholder="Material Thickness" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Circle Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="quantity" value="<?php echo $val['quantity']; ?>" min="0" step="0.01" id="quantity" class="form-control" placeholder="Quantity" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Diagram No <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="Diagram_no" value="<?php echo $val['diagram_no']; ?>" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Diagram No" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            break;
                                                                        case '4':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>ID <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="id" value="<?php echo $val['id']; ?>" id="id" class="form-control" min="0" step="0.01" placeholder="ID" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>OD <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="od" id="od" value="<?php echo $val['od']; ?>" class="form-control" min="0" step="0.01" placeholder="OD" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Length <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="length" value="<?php echo $val['length']; ?>" id="length" min="0" step="0.01" class="form-control" placeholder="Length" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            break;
                                                                        case '5':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                                        <label>OD <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="od" value="<?php echo $val['od']; ?>" id="od" min="0" step="0.01" class="form-control" placeholder="OD" required>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                                        <label>Length <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="length" value="<?php echo $val['length']; ?>" id="length" min="0" step="0.01" class="form-control" placeholder="Length" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            break;
                                                                        case '6':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>ID <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="id" value="<?php echo $val['id']; ?>" id="id" class="form-control" min="0" step="0.01" placeholder="ID" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Pitching <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="pitching" value="<?php echo $val['pitching']; ?>" id="pitching" min="0" step="0.01" class="form-control" placeholder="Pitching" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="quantity" value="<?php echo $val['quantity']; ?>" id="quantity" min="0" step="0.01" class="form-control" placeholder="Quantity" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12 w3-margin-top">
                                                                                        <label>Diagram No <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="Diagram_no" value="<?php echo $val['diagram_no']; ?>" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Diagram No" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            break;
                                                                        case '7':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>OD <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="od" value="<?php echo $val['od']; ?>" id="od" class="form-control" min="0" step="0.01" placeholder="OD" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Pitching <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="pitching" value="<?php echo $val['pitching']; ?>" id="pitching" min="0" step="0.01" class="form-control" placeholder="Pitching" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="quantity" value="<?php echo $val['quantity']; ?>" id="quantity" min="0" step="0.01" class="form-control" placeholder="Quantity" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12 w3-margin-top">
                                                                                        <label>Diagram No <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="Diagram_no" value="<?php echo $val['diagram_no']; ?>" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Diagram No" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            break;
                                                                        case '8':
                                                                            ?>
                                                                            <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv">
                                                                                <div class="w3-col l12">
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>ID <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="id" value="<?php echo $val['id']; ?>" id="id" class="form-control" min="0" step="0.01" placeholder="ID" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Pitching <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="pitching" value="<?php echo $val['pitching']; ?>" id="pitching" min="0" step="0.01" class="form-control" placeholder="Pitching" required>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                                                                        <label>Quantity <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="quantity" value="<?php echo $val['quantity']; ?>" id="quantity" min="0" step="0.01" class="form-control" placeholder="Quantity" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <div class="col-lg-4 col-xs-12 col-sm-12 w3-margin-top">
                                                                                        <label>Diagram No <b class="w3-text-red w3-medium">*</b></label>
                                                                                        <input type="number" name="Diagram_no" value="<?php echo $val['diagram_no']; ?>" id="Diagram_no" min="0" step="0.01" class="form-control" placeholder="Diagram No" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>?>
                                                                            <?php
                                                                            break;
                                                                    }
                                                                    ?>                                                                       
                                                                    <div class=" w3-center w3-col l12" style="">
                                                                        <button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Update Material</button>
                                                                    </div>
                                                                </div>
                                                                <!-- REGISTER DIV ENDS -->   
                                                            </div>
                                                            <div class="col-lg-1"></div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <!----------------------------------- Modal Body------------------------------------>                                                                               
                                        </div>
                                        <!----------------------------------- Modal content------------------------------------->
                                    </div>
                                </form>
                            </div>
                            <!-------script for update material-->
                            <script type="text/javascript">
                                $(function () {
                                    $("#updateMaterialForm_<?php echo $val['material_id']; ?>").submit(function (e) {
                                        e.preventDefault();
                                        dataString = $("#updateMaterialForm_<?php echo $val['material_id']; ?>").serialize();
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url(); ?>materials/allmaterial/updateMaterialDetails",
                                            data: dataString,
                                            return: false, //stop the actual form post !important!
                                            success: function (data)
                                            {
                                                $.alert(data);
                                            }
                                        });
                                        return false;  //stop the actual form post !important!
                                    });
                                });
                            </script>
                            <!-------script for update material-->
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
</div>
</div>
<!-- page content ends-->
<script src="<?php echo base_url(); ?>assets/js/module/material/all_material.js"></script>
