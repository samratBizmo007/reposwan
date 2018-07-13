<!-- page content -->
<div class="right_col" role="main">
    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-list"></i> Inventory</h3>
            </div>
        </div>
        <div class="row clearfix" style=" margin-top: 5px;">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a id="mat" class="btn" onclick="changecolor(1)" href="#rawMaterials" data-toggle="tab"><i class="fa fa-cubes"></i>  Raw Materials</a></li>
                    <li ><a class="btn" id="prod" href="#finishedProducts" onclick="changecolor(2)" data-toggle="tab"><i class="fa fa-cube"></i> Products</a></li>
                </ul>
            </div>
            <div class="tab-content clearfix" ><br><!-- tab containt starts -->
                <div class="tab-pane active" id="rawMaterials" ng-app="showInventoryApp" ng-controller="showInventoryController">  
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <table class="table table-responsive" id="tab_logic">
                                <thead>
                                    <tr class="theme_bg">
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
                                            Quantity
                                        </th>
                                        <th class="text-center">
                                            Length
                                        </th>
                                        <th class="text-center">
                                            added date
                                        </th>
                                        <th class="text-center">
                                            modified date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id='addedRows'>
                                    <tr id="rowCount" ng-if="materials['status'] == 200" ng-repeat=" m in materials['status_message']">
                                        <td class="w3-center">{{ m.material_type}}</td>
                                        <td class="w3-center">{{ m.material_grade}}</td>
                                        <td class="w3-center">{{ m.material_rate}}</td>
                                        <td class="w3-center">{{ m.material_weight}}</td>
                                        <td class="w3-center">{{ m.quantity}}</td>
                                        <td class="w3-center">{{ m.length}}</td>
                                        <td class="w3-center">{{ m.added_date}}</td>
                                        <td class="w3-center">{{ m.modified_date}}</td>
                                    </tr>
                                    <tr ng-if="!materials['status'] == 200">
                                        <td class="w3-center" colspan="8">No Records Found..!</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="finishedProducts"><!-- tab 2 starts here -->
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <table class="table table-responsive">
                                <thead>
                                    <tr class="theme_bg">
                                        <th class="text-center">
                                            Customer name
                                        </th>
                                        <th class="text-center">
                                            Product Name
                                        </th>
                                        <th class="text-center">
                                            Product Type
                                        </th>
                                        <th class="text-center">
                                            Sr.no
                                        </th>
                                        <th class="text-center">
                                            Rev.no
                                        </th>
                                        <th class="text-center">
                                            Item Code
                                        </th>
                                        <th class="text-center">
                                            Drawing no
                                        </th>
                                        <th class="text-center">
                                            Added date
                                        </th>                                          
                                    </tr>
                                </thead>
                                <tbody id='addedRows'>
                                    <?php
                                    //print_r($products['status_message'][0]);
                                    if ($products['status'] == 200) {
                                        foreach ($products['status_message'] as $val) {
                                            $type = 'REGULAR';
                                            if ($val['prod_type'] == '1') {
                                                $type = 'EX-STOCK';
                                            }
                                            ?>
                                            <tr id="rowCount">
                                                <td class="w3-center"><?php echo $val['customer_name']; ?></td>
                                                <td class="w3-center"><?php echo $val['product_name']; ?></td>
                                                <td class="w3-center"><?php
                                                    echo $type;
                                                    if ($val['prod_type'] != '0') {
                                                        echo '<br>(' . $val['stock_plant'] . ')';
                                                    }
                                                    ?></td>
                                                <td class="w3-center">
                                                    <?php
                                                    foreach (json_decode($val['sr_item_code'], true) as $key) {
                                                        echo '<div class="w3-center">' . $key['sr_no'] . '</div>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="w3-center"><?php echo $val['revision_no']; ?></td>
                                                <td class="w3-center">
                                                    <?php
                                                    foreach (json_decode($val['sr_item_code'], true) as $key) {
                                                        echo '<div class="w3-center">' . $key['item_code'] . '</div>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="w3-center"><?php echo $val['drawing_no']; ?></td>
                                                <td class="w3-center"><?php echo $val['added_date']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="w3-center" colspan="7">No Records Found..!</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changecolor(btn) {
        if (btn == 1) {
            $("#prod").css("background-color", "#fff");
            $("#prod").css("color", "black");
            $("#mat").css("color", "#ECF0F1");
            $("#mat").css("background-color", "#2A3F54");
        }
        if (btn == 2) {
            $("#mat").css("background-color", "#fff");
            $("#mat").css("color", "black");
            $("#prod").css("color", "#ECF0F1");
            $("#prod").css("background-color", "#2A3F54");
        }
    }
</script>
<script src="<?php echo base_url(); ?>assets/js/module/inventory/inventory.js"></script>
