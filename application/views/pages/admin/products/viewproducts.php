<title>Swan Industries | View Product</title>
<style type="text/css">
#addProduct fieldset{
  /*display: none;*/
  margin-bottom: 16px
}
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="page_title">

        <div class="row x_title">
          <div class="col-md-6">
            <h3><i class="fa fa-search-plus"></i> View Product </h3>
          </div>
        </div>
        <?php 
        //print_r($allProducts);die();
        if($prodDetails){
          foreach ($prodDetails as $key) { 
            ?>
            <div class="w3-col l12" id="detailsDiv">
              <div class="w3-col l12">
                <h5><b><u>General Details</u></b></h5>
                <table class="table table-bordered table-responsive">
                  <thead>
                    <tr class="theme_bg w3-center">
                      <th class="w3-center">Type</th>
                      <th class="w3-center">Customer Name</th>
                      <th class="w3-center">Part name / Title</th>
                      <th class="w3-center">Drawing No. / Part No.</th>
                      <th class="w3-center">Serial No.</th>
                      <th class="w3-center">Revision No.</th>
                      <th class="w3-center">Item Code</th>
                      <th class="w3-center">Date of Addition</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $rowspan=count(json_decode($key['sr_item_code'],TRUE));
                    $type='REGULAR';
                    if($key['prod_type']=='1'){
                      $type='EX-STOCK';
                    }
                    ?>
                    <tr class="w3-center">
                      <td><?php echo $type; if($key['prod_type']!='0'){echo '<br>('.$key['stock_plant'].')';} ?></td>
                      <td><?php echo $key['customer_name']; ?></td>
                      <td><?php echo $key['product_name']; ?></td>
                      <td><?php echo $key['drawing_no']; ?></td>
                      <td><?php 
                      foreach (json_decode($key['sr_item_code'],TRUE) as $val) {
                        echo '<div class="w3-col l12 w3-center w3-border">'.$val['sr_no'].'</div>';
                      }
                      ?></td>
                      <td><?php echo $key['revision_no']; ?></td>
                      <td><?php 
                      foreach (json_decode($key['sr_item_code'],TRUE) as $val) {
                        echo '<div class="w3-col l12 w3-center w3-border">'.$val['item_code'].'</div>';
                      }
                      ?></td>
                      <td><?php echo $key['added_date']; ?></td>
                    </tr>
                    
                  </tbody>
                </table>
                <div class="w3-col l12">
                  <div class="w3-col l4">
                    <div class="col-lg-6">
                      <h5><b><u>Machinery Details</u></b></h5>
                      <table class="table table-responsive table-bordered">
                        <thead>
                          <tr>
                            <th class="w3-center">Machine used (tonnes)</th>
                            <th class="w3-center">Quantity per hour</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if($key['machine_qtyhr']!='' && $key['machine_qtyhr']!='[]'){
                            foreach (json_decode($key['machine_qtyhr'],TRUE) as $val) {
                              ?>
                              <tr class="w3-center">
                                <td><?php echo $val['machine'] ?></td>
                                <td><?php echo $val['qtyhr'] ?></td>
                              </tr>
                              <?php
                            }
                          }
                          else{
                            echo '<tr><td colspan="2" class="w3-center">No Machines added</td></tr>';
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-lg-6">
                      <h5><b><u>Operations Performed</u></b></h5>
                      <table class="table table-responsive table-bordered">
                        <thead>
                          <tr class="w3-center">
                            <th class="w3-center">Operations</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if($key['operations']!='' && $key['operations']!='[]'){
                            foreach (json_decode($key['operations'],TRUE) as $val) {
                              ?>
                              <tr class="w3-center">
                                <td><?php echo $val ?></td>
                              </tr>
                              <?php
                            }
                          }
                          else{
                            echo '<tr><td colspan="2" class="w3-center">No Machines added</td></tr>';
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                  <div class="col-lg-8">
                    <h5><b><u>Raw Material Details</u></b></h5>
                    <table class="table table-responsive table-bordered">
                      <thead>
                        <tr class="w3-center">
                          <th class="w3-center">Grade</th>
                          <th class="w3-center">Thickness</th>
                          <th class="w3-center">Diameter</th>
                          <th class="w3-center">ID</th>
                          <th class="w3-center">OD</th>
                          <th class="w3-center">Pitch</th>
                          <th class="w3-center">Weight</th>
                          <th class="w3-center">Length</th>
                          <th class="w3-center">Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if($key['rm_required']!='' && $key['rm_required']!='[]'){
                          foreach (json_decode($key['rm_required'],TRUE) as $val) {
                            ?>
                            <tr class="w3-center">
                              <td><?php echo $val['rmgradeSelected'] ?></td>
                              <td><?php echo $val['rmthickSelected'] ?></td>
                              <td><?php echo $val['rmdiaSelected'] ?></td>
                              <td><?php echo $val['rmIDSelected'] ?></td>
                              <td><?php echo $val['rmODSelected'] ?></td>
                              <td><?php echo $val['rmPitchSelected'] ?></td>
                              <td><?php echo $val['rmweightSelected'] ?> KG</td>
                              <td><?php echo $val['rmlenSelected'] ?></td>
                              <td><?php echo $val['rmqtySelected'] ?></td>
                            </tr>
                            <?php
                          }
                        }
                        else{
                          echo '<tr><td colspan="2" class="w3-center">No Machines added</td></tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>                
                </div>
              </div>
            </div>
            <?php 
          }
        }
        else{
          echo '<div class="w3-center"><b>No data available for Products</b></div>';
        }
        ?>
        <!-- <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div> -->
        <form id="addProduct" ng-show="false"></form>
          <div class="clearfix"></div>
          <div id="formOutput"></div>
        </div>
      </div>

    </div>
    <br />

  </div>
  <!-- /page content -->

  <!-- js file for product module -->
  <!-- <script src="<?php echo base_url(); ?>assets/js/module/products.js"></script> -->
       <!--  </div>
    </div>
  
  </body>
  </html> -->
