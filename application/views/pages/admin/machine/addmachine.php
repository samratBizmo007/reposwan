<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title"><div class="w3-padding"><h3><i class="fa fa-plus"></i> Add Machine</h3></div></div>
        <fieldset>
            <div class="row" style=" margin-top: 5px;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class=""  ng-app="machineApp" ng-controller="machineController"  style="padding:12px 36px 12px 36px">
                        <form id="add_MachineForm" method="post" role="form">
                            <!--                             <div class="w3-col l12" ng-model="material_err"></div>
                            -->                             <div id="machineDiv" style="">
                                <div class="w3-col l12 w3-margin-bottom">
                                    <div id="machinename" class="col-lg-6 col-xs-12 col-sm-12">										<label>Machine name <b class="w3-text-red w3-medium">*</b></label>
                                        <input type="text" name="machine_name" ng-model="machine_name" id="machine_name" class="form-control" placeholder="Machine Name" required>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" id="machinecapacity">
                                        <label>Machine Capacity (In Tons)</label>
                                        <input type="number" name="machine_capacity" ng-model="machine_capacity" id="machine_capacity" min="0" step="0.01" class="form-control" placeholder="Machine Capacity" required>
                                    </div>
                                    <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv"></div>
                                    <div class="w3-col l12 w3-margin-bottom">
                                        <div class="col-lg-6 col-xs-12 col-sm-12" id="machinetype">
                                            <label>Machine Type <b class="w3-text-red w3-medium">*</b></label>
                                            <input type="text" name="machine_type" ng-model="machine_type" id="machine_type"  class="form-control" placeholder="Machine Type" required>
                                        </div>  
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

    <!-- page content -->
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-sliders"></i> All Machine</h3>
            </div>
        </div>
        <div class="row clearfix" style=" margin-top: 5px;">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <table class="table table-responsive" id="tab_logic">
                    <thead>
                        <tr class="theme_bg">
                            <th width="7%" class="text-center">
                                Sr No
                            </th>
                            <th class="text-center">
                                Machine Name
                            </th>
                            <th class="text-center">
                                Machine Type
                            </th>
                            <th class="text-center">
                                Machine Capacity
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //print_r($details);
                        if ($details['status'] == 200) {
                            $i = 1;
                            foreach ($details['status_message'] as $val) {
                                //print_r($val);
                                ?>
                                <tr id="rowCount">
                                    <td class="w3-center"><?php echo $i ?></td>
                                    <td class="w3-center"><?php echo $val['machine_name']; ?></td>
                                    <td class="w3-center"><?php echo $val['machine_type']; ?></td>
                                    <td class="w3-center"><?php echo $val['machine_capacity']; ?></td>
                                    <td class="w3-center">
                                        <a class="btn w3-padding-small" data-toggle="modal" data-target="#updateMachineModal_<?php echo $val['machine_id']; ?>" title="Update Machine Details">
                                            <i class="w3-text-green w3-large fa fa-edit"></i>
                                        </a>                   
                                        <a class="btn w3-padding-small" onclick="deleteMachineDetails(<?php echo $val['machine_id']; ?>)" title="Delete Machine">
                                            <i class="w3-text-red w3-large fa fa-trash"></i>
                                        </a>
                                    </td>

                                    <!-- Modal -->
                            <div id="updateMachineModal_<?php echo $val['machine_id']; ?>" class="modal" role="dialog">
                                <form id="updateMachineForm_<?php echo $val['machine_id']; ?>" name="updateMachineForm_<?php echo $val['machine_id']; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <!----------------------------------- Modal content------------------------------------>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Machine Details</h4>
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
                                                                        <div id="machinename" class="col-lg-6 col-xs-12 col-sm-12">
                                                                            <label>Machine name </label>
                                                                            <input type="text" name="machine_name" value="<?php echo $val['machine_name']; ?>" id="machine_name" class="form-control" placeholder="Machine Name" required>
                                                                            <input type="hidden" name="machine_id" value="<?php echo $val['machine_id']; ?>" id="machine_id" class="form-control" placeholder="Machine Name">
                                                                        </div>
                                                                        <div class="col-lg-6 col-xs-12 col-sm-12" id="machinecapacity">
                                                                            <label>Machine Capacity (In Tons)</label>
                                                                            <input type="number" name="machine_capacity" value="<?php echo $val['machine_capacity']; ?>" id="machine_capacity" min="0" step="0.01" class="form-control" placeholder="Machine Capacity" required>
                                                                        </div>  
                                                                        <div class="w3-col l12 w3-margin-bottom" id="materialSpecificationDiv"></div>
                                                                        <div class="w3-col l12 w3-margin-bottom">
                                                                            <div class="col-lg-6 col-xs-12 col-sm-12" id="machinetype">
                                                                                <label>Machine Type </label>
                                                                                <input type="text" name="machine_type" value="<?php echo $val['machine_type']; ?>" id="machine_type"  class="form-control" placeholder="Machine Type" required>
                                                                            </div>  
                                                                        </div>                                                                   
                                                                    </div>


                                                                    <div class=" w3-center w3-col l12" style="">
                                                                        <button  type="submit" title="add Material" id="btnsubmit" class="w3-medium w3-button theme_bg">Update Machine</button>
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
                                    $("#updateMachineForm_<?php echo $val['machine_id']; ?>").submit(function (e) {
                                        e.preventDefault();
                                        dataString = $("#updateMachineForm_<?php echo $val['machine_id']; ?>").serialize();
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url(); ?>admin/machine/addmachine/updateMachineDetails",
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

                            <script type="text/javascript">
                                function deleteMachineDetails(machine_id) {
                                    $.confirm({
                                        title: '<h4 class="w3-text-red"><i class="fa fa-warning"></i> Are you sure you want to Delete Machine?</h4>',
                                        content: '',
                                        type: 'red',
                                        buttons: {
                                            confirm: function () {
                                                $.ajax({
                                                    url: "<?php echo base_url(); ?>admin/machine/addmachine/deleteMachineDetails",
                                                    type: "POST",
                                                    data: {
                                                        machine_id: machine_id
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

</div>
<!-- /page content -->
<script src="<?php echo base_url(); ?>assets/js/module/machine/machine.js"></script>

