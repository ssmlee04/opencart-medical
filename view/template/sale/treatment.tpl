<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="htabs" class="htabs"><a style="display:none" href="#tab-general"><?php echo $tab_general; ?></a>

      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        

        <div id="tab-transaction">
          <table class="form">
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="text" name="product" value="" /><input type="hidden" name="product_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_customer; ?></td>
              <td><input type="text" name="customer" value="" /><input type="hidden" name="product_id" value="" /></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-filter" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
          </table>
          <div id="transaction"></div>
        </div>

      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 

<script type="text/javascript"><!--


$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});

$('#history .pagination a').live('click', function() {
	$('#history').load(this.href);
	
	return false;
});			

$('#transaction .pagination a').live('click', function() {
	$('#transaction').load(this.href);
	
	return false;
});			

$('#transaction').load('index.php?route=sale/customer/transaction&token=<?php echo $token; ?>');

$('#button-transaction').bind('click', function() {

	$.ajax({
		url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'html',
		data: 'product_id=' + encodeURIComponent($('#tab-transaction input[name=\'product_id\']').val()) + '&show_group=0&unitspend=' + encodeURIComponent($('#tab-transaction input[name=\'unitspend\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-transaction').attr('disabled', true);
			$('#transaction').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-transaction').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {

			$('#transaction').html(html);

			$('#tab-transaction input[name=\'product_id\']').val('');
      $('#tab-transaction input[name=\'product\']').val('');
      $('#tab-transaction input[name=\'unitspend\']').val('');

		}
	});
});

//--></script> 
<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script> 

<?php echo $footer; ?>