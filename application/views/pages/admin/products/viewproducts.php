<title>Swan Industries | View Product</title>
<style type="text/css">
    #addProduct fieldset{
        /*display: none;*/
        margin-bottom: 16px
    }
</style>
<?php
// get last uri segment passed    
$last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);

$prod_id = base64_decode($record_num);
?>
<!-- page content -->
<div class="right_col" role="main" ng-app="editProductForm" ng-init="hiddendata =<?php echo $prod_id; ?>" ng-cloak ng-controller="ProdCtrl" >
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="page_title">
                <div class="row x_title w3-margin-top">
                    <div class="col-md-6 ">
                        <h6><a class="btn-block" href="<?php echo base_url(); ?>/admin/products/allproduct"><i class="fa fa-arrow-circle-left"></i> Back To All Products </a></h6>
                    </div>
                </div>
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-search-plus"></i> Product Details </h3>

                    </div>
                </div>
                <?php
                //print_r($prodDetails['product_detail'][0]);die();
                // for ($i=0; $i <count($prodDetails['subProduct_detail']) ; $i++) { 
                //     print_r($prodDetails['subProduct_detail'][$i][0]);
                // }die();
                if ($prodDetails['product_detail']) {
                    foreach ($prodDetails['product_detail'] as $key) {
                        ?>
                                                                                                    <!-- <input type="text" name="hiddendata" ng-model="hiddendata"> -->
                        <div class="w3-col l12" id="detailsDiv" >
                            <div class="w3-col l12">
                                  <h2>Product Name: <?php echo $key['product_name']; ?></h2><br>
                                <h5><b><u>General Details</u></b></h5>
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr class="theme_bg w3-center">
                                            <th class="w3-center">Type</th>
                                            <?php if ($key['prod_type'] == '1') { ?>
                                                <th class="w3-center">Ex-stock Quantity</th>
                                            <?php } ?>
                                            <th class="w3-center">Customer Name</th>
                                            <th class="w3-center">Part name / Title</th>
                                            <th class="w3-center">Drawing No. / Part No.</th>
<!--                                             <th class="w3-center">Serial No.</th>
 -->                                            <th class="w3-center">Revision No.</th>
<!--                                             <th class="w3-center">Item Code</th>
 -->                                            <th class="w3-center">Packing Quantity / Tray</th>
                                            <th class="w3-center">Finished Weight</th>
                                            <th class="w3-center">Date of Addition</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rowspan = count(json_decode($key['sr_item_code'], TRUE));
                                        $type = 'REGULAR';
                                        if ($key['prod_type'] == '1') {
                                            $type = 'EX-STOCK';
                                        }
                                        ?>
                                        <tr class="w3-center">
                                            <td><?php
                                                echo $type;
                                                if ($key['prod_type'] != '0') {
                                                    echo '<br>(' . $key['stock_plant'] . ')';
                                                }
                                                ?></td>
                                            <?php if ($key['prod_type'] == '1') { ?>
                                                <td>
                                                    <?php echo $key['ex_stock_quantity']; ?>
                                                </td>
                                            <?php }
                                            ?>
                                            <td><?php echo $key['customer_name']; ?></td>
                                            <td><?php echo $key['product_name']; ?></td>
                                            <td><?php echo $key['drawing_no']; ?></td>
                                           <!--  <td><?php
                                                foreach (json_decode($key['sr_item_code'], TRUE) as $val) {
                                                    echo '<div class="w3-col l12 w3-center w3-border">' . $val['sr_no'] . '</div>';
                                                }
                                                ?></td> -->
                                            <td><?php echo $key['revision_no']; ?></td>
                                           <!--  <td><?php
                                                foreach (json_decode($key['sr_item_code'], TRUE) as $val) {
                                                    echo '<div class="w3-col l12 w3-center w3-border">' . $val['item_code'] . '</div>';
                                                }
                                                ?></td> -->
                                            <td><?php echo $key['quantity_per_tray']; ?></td>
                                            <td><?php echo $key['finished_weight']; ?></td>
                                            <td><?php echo $key['added_date']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                 <h5><b><u>Sub Product Details</u></b></h5>
                                       <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr class="theme_bg w3-center">
                                            <th class="w3-center">Part Code</th>
                                          
                                            <th class="w3-center">Machine Information</th>
                                            <th class="w3-center">Material Details</th>
                                            <th class="w3-center">Packing Quantity Per Trey</th>
                                           <th class="w3-center">Finished Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        for ($i=0; $i <count($prodDetails['subProduct_detail']) ; $i++) { ?>
                                        <tr>
                                        <td><?php echo $prodDetails['subProduct_detail'][$i][0]['part_code']; ?></td>
                                        <td><?php
                                        foreach(json_decode($prodDetails['subProduct_detail'][$i][0]['machine_info'])as $json){
                                            print_r($json);

                                        }
                                        ?></td>
                                        <td><?php echo $prodDetails['subProduct_detail'][$i][0]['']; ?></td>
                                        <td><?php echo $prodDetails['subProduct_detail'][$i][0]['packing_qty_per_tray']; ?></td>
                                        <td><?php echo $prodDetails['subProduct_detail'][$i][0]['finished_weight']; ?></td>

                                        </tr>
                                    
                                    
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="w3-col l12">
                                    <div class="w3-col l4">
                                        <div class="col-lg-12">
                           
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                       
                                    </div>                
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="w3-center"><b>No data available for Products</b></div>';
                }
                ?>
                <!-- <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <form id="editProduct" ng-show="editProd">

                    <fieldset>
                        <h2>General Details</h2>
                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="customer_name">Customer Name<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" ng-model="customer_name" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="prod_type">Product Type<b class="w3-text-red w3-medium">*</b> :</label>
                                    <select name="prod_type" class="form-control w3-small" id="prod_type" ng-change="prodType()" ng-model="typeSelected">
                                        <option value="0" class="w3-text-grey" selected>REGULAR</option>
                                        <option value="1" class="w3-text-grey">EX-STOCK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom" ng-show='plantDiv'>
                                <div class="form-group">
                                    <label for="stock_plant">Ex-stock Plant<b class="w3-text-red w3-medium">*</b> :</label>
                                    <select name="stock_plant" class="form-control w3-small" id="stock_plant">
                                        <option value="0" class="w3-text-grey w3-light-grey " selected>Please choose any one plant</option>
                                        <option value="ALANDI" class="w3-text-grey">ALANDI</option>
                                        <option value="SANASWADI" class="w3-text-grey">SANASWADI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="product_name">Product Name/ Part Name<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="divrawing_no">Drawing Number/ Part Number :</label>
                                    <input type="text" class="form-control" id="drawing_no" name="drawing_no" placeholder="Enter drawing number">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="revision_no">Revision Number :</label>
                                    <input type="text" class="form-control" id="revision_no" name="revision_no" placeholder="Enter revision number">
                                </div>
                            </div>
                        </div>

                        <div class="w3-col l12">
                            <div class="w3-col l8" style="border:1px dashed">
                                <div class="w3-col l12 w3-padding-top">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="sr_no">Serial Number 1 :</label>
                                            <input type="number" min="0" class="form-control" id="sr_no1" value="0" name="sr_no[]" placeholder="Enter serial number">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="part_no">Item Code 1 :</label>
                                            <input type="text" class="form-control" id="item_code1" name="item_code[]" placeholder="Enter Item Code">
                                        </div>
                                    </div>
                                </div>
                                <!-- extra added row div -->
                                <div class="w3-col l12" id="addedmore_DivGeneral"></div>
                                <a class="btn w3-text-red w3-right" style="padding:0" id="addMoreBtnGeneral" name="addMoreBtnGeneral"><i class="fa fa-plus"></i> Add more</a> 
                            </div>
                        </div>

                    </fieldset>
                 <fieldset>
                        <h2>Pricing Details</h2>            
                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-6 col-xs-6 w3-margin-bottom">

                                <div class="form-group">
                                    <label for="old_rate">Old Rate<b class="w3-text-red w3-medium">*</b> :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                        <input type="number" class="form-control" step="0.01" min="0" id="old_rate" name="old_rate" placeholder="Enter Old Rate" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-6 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="new_rate">New Rate<b class="w3-text-red w3-medium">*</b> :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                        <input type="number"cstep="0.01" min="0" class="form-control" id="new_rate" name="new_rate" placeholder="Enter New Rate" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="w3-col l12 w3-center">
                        <button type="submit" name="submitForm" id="submitForm" class="w3-center w3-hover-text-white btn theme_bg w3-margin-top"> <i class="fa fa-save"></i> Save and Add New Product </button>
                    </div>            


                </form>
                <div class="clearfix"></div>
                <div id="formOutput"></div>
            </div>
        </div>

    </div>
    <br />

</div>
<!-- /page content -->

<!-- js file for product module -->
<script src="<?php echo base_url(); ?>assets/js/module/editproduct.js"></script>
<!--  </div>
</div>

</body>
</html> -->
