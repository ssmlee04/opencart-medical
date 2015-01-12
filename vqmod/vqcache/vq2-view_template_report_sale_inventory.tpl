<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-reports-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			

    </div>
    
			<div class="content sales-report">
			
      <table class="form">
        <tr>
          <td><?php echo $entry_date_start; ?>
            <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" id="date-start" size="12" /></td>
          <td><?php echo $entry_date_end; ?>
            <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" id="date-end" size="12" /></td>
      
          <td style="text-align: right;"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
        </tr>
      </table>
      <table class="list">
        <thead>
          <tr>
            <td class="left"><?php echo $column_date; ?></td>
            <!-- <td class="left"><php echo $column_date_end; ?></td> -->
            <!-- <td class="right"><php echo $column_orders; ?></td> -->
            <td class="right"><?php echo $column_product; ?></td>
            <!-- <td class="right"><php echo $column_payment_cash; ?></td> -->
            <!-- <td class="right"><php echo $column_payment_visa; ?></td> -->
            <!-- <td class="right"><php echo $column_payment_balance; ?></td> -->
            <td class="right"><?php echo $column_quantity; ?></td>
            <td class="right"><?php echo $column_cost; ?></td>
            <td class="right"><?php echo $column_price; ?></td>
          </tr>
        </thead>
        <tbody>
       
          <tr style='background-color:orange'>
            <td class="left" colspan='5'>starting inventory</td>
          </tr>
          <?php if ($inventory_start) { ?>
          <?php foreach ($inventory_start as $product) { ?>
          <tr>
            <td class="left"><?php echo $filter_date_start; ?></td>
            <td class="right"><?php echo $product['name']; ?></td>
            <td class="right"><?php echo $product['quantity']; ?></td>
            <td class="right"></td>
            <td class="right"></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>


          <tr style='background-color:orange'>
            <td class="left" colspan='5'>in and outs</td>
          </tr>
          <?php if ($products) { ?>
          <?php foreach ($products as $product) { ?>
          <tr>
            <td class="left"><?php echo $product['date_added']; ?></td>
            <td class="right"><?php echo $product['name']; ?></td>
            <td class="right"><?php echo $product['quantity']; ?></td>
            <td class="right"><?php echo $product['cost']; ?></td>
            <td class="right"><?php echo $product['price']; ?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>

          <tr style='background-color:orange'>
            <td class="left" colspan='5'>ending inventory</td>
          </tr>
          <?php if ($inventory_end) { ?>
          <?php foreach ($inventory_end as $product) { ?>
          
          <tr>
            <td class="left"><?php echo $filter_date_end; ?></td>
            <td class="right"><?php echo $product['name']; ?></td>
            <td class="right"><?php echo $product['quantity']; ?></td>
            <td class="right"></td>
            <td class="right"></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>


        </tbody>
      </table>
      <!-- <div class="pagination"><php echo $pagination; ?></div> -->
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=report/sale_inventory&token=<?php echo $token; ?>';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}
		
	var filter_group = $('select[name=\'filter_group\']').attr('value');
	
	if (filter_group) {
		url += '&filter_group=' + encodeURIComponent(filter_group);
	}
	
	var filter_order_status_id = $('select[name=\'filter_order_status_id\']').attr('value');
	
	if (filter_order_status_id != '') {
		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
	}	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date-start').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('#date-end').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script> 
<?php echo $footer; ?>