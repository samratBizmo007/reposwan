<title>Swan Industries | All Products</title>
<style type="text/css">
fieldset{
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
            <h3><i class="fa fa-database"></i> All Products </h3>
          </div>
        </div>

        <div class="w3-container" ng-app="allProductApp" ng-cloak ng-controller="allProdCtrl">
          <div class="w3-col l12" ng-bind-html="message"></div>
          <div id="prodTableDiv">
            <table class="table table-bordered table-responsive">
            <thead>
              <tr class="theme_bg w3-center">
                <th class="w3-center">Sr.</th>
                <th class="w3-center">Type</th>
                <th class="w3-center">Customer Name</th>
                <th class="w3-center">Part name/Title</th>
                <th class="w3-center">Drg No./Part No.</th>
                <th class="w3-center">Serial No.</th>
                <th class="w3-center">Revision No.</th>
                <th class="w3-center">Item Code</th>
                <th class="w3-center">Date of Addition</th>
                <th class="w3-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //print_r($allProducts);die();
              if($allProducts){

              $srNo=1; 
              foreach ($allProducts as $key) {              
              $rowspan=count(json_decode($key['sr_item_code'],TRUE));
                $type='REGULAR';
                if($key['prod_type']=='1'){
                  $type='EX-STOCK';
                }
              ?>
                <tr class="w3-center">
                  <td><?php echo $srNo; ?></td>
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
                  <td><a class="btn" class="no-padding" title="Remove Product" ng-click="removeProduct(<?php echo $key['prod_id']; ?>)"><i class="fa fa-trash"></i></a></td>
                </tr>
                
            <?php $srNo++; }
            }
            else{
              echo '<tr class="w3-center"><td colspan="10"><b>No data available for Products</b></td></tr>';
            }
            ?>
            </tbody>
          </table>          
          </div>
          
        </div>
        
      </div>
    </div>

  </div>
  <br />

</div>
<!-- /page content -->

<!-- js file for product module -->
<script src="<?php echo base_url(); ?>assets/js/module/products.js"></script>

     <!--  </div>
    </div>
  
  </body>
  </html> -->
