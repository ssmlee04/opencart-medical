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
    </div>
    <div class="content">
      <!-- <div id="htabs" class="htabs"> -->
        <!-- <a style="display:none" href="#tab-general"><php echo $tab_general; ?></a> -->

      <!-- </div> -->
      <!-- <form action="<php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"> -->
        

        <div id="tab-transaction">
          <table class="form">
            <tr>
              <td><?php echo $entry_customer; ?></td>
              <td><input type="customer" name="customer" value="" />
                <input type="hidden" name="customer_id" value="" />
                <input type="hidden" name="customer_name" value="" />
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="product" name="product" alt='2' value="" />
                <input type="hidden" name="product_name" value="" />
                <input type="hidden" name="product_id" value="" />
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-filter" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
          </table>
          <div id="transaction"></div>
        </div>

      <!-- </form> -->
    </div>
  </div>
</div>
<!-- <script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script>  -->

<script type="text/javascript"><!--


// $('.date').datepicker({dateFormat: 'yy-mm-dd'});
// $('.datetime').datetimepicker({
//   dateFormat: 'yy-mm-dd',
//   timeFormat: 'h:m'
// });
// $('.time').timepicker({timeFormat: 'h:m'});

// $('#history .pagination a').live('click', function() {
// 	$('#history').load(this.href);
	
// 	return false;
// });			

// $('#transaction .pagination a').live('click', function() {
// 	$('#transaction').load(this.href);
	
// 	return false;
// });			

// $('#transaction').load('index.php?route=sale/customer/transaction&token=<?php echo $token; ?>');

$('#button-filter').bind('click', function() {

  var customer_name_sel = $('input[name=\'customer_name\']').val();
  var customer_name = $('input[name=\'customer\']').val();
  var product_name_sel = $('input[name=\'product_name\']').val();
  var product_name = $('input[name=\'product\']').val();
  
  // if (customer_name_sel == customer_name && product_name_sel==product_name)
	$.ajax({
		url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&show_group=1',
		type: 'post',
		dataType: 'html',
		data: 'product_id=' + encodeURIComponent($('#tab-transaction input[name=\'product_id\']').val()) 
    // + '&customer_id=' + encodeURIComponent($('#tab-transaction input[name=\'customer_id\']').val()) 
    + '&unitspend=0' 
    + '&filter_customer_name=' + customer_name.toString()
    + '&filter_product_name=' + product_name.toString(), 
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-filter').attr('disabled', true);
			$('#transaction').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-filter').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {

			$('#transaction').html(html);

			// $('#tab-transaction input[name=\'product_id\']').val('');
      // $('#tab-transaction input[name=\'product\']').val('');
      // $('#tab-transaction input[name=\'unitspend\']').val('');

		}
	});

});

//--></script> 
<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();

// $.widget('custom.catcomplete', $.ui.autocomplete, {
//   _renderMenu: function(ul, items) {
//     var self = this, currentCategory = '';
    
//     $.each(items, function(index, item) {
//       if (item['category'] != currentCategory) {
//         ul.append('<li class="ui-autocomplete-category">' + item['category'] + '</li>');
        
//         currentCategory = item['category'];
//       }
      
//       self._renderItem(ul, item);
//     });
//   }
// });


// $('input[name=\'customer\']').catcomplete({
//   delay: 500,
//   source: function(request, response) {
    
//     $.ajax({
//       url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
//       dataType: 'json',
//       success: function(json) { 
//         console.log(json);
//         response($.map(json, function(item) {
//           return {
//             category: item['customer_group'],
//             label: item['lastname'] + item['firstname'] + ' ' + item['ssn'],
//             value: item['customer_id'],
//             customer_group_id: item['customer_group_id'],
//             firstname: item['firstname'],
//             lastname: item['lastname'],
//             email: item['email'],
//             telephone: item['telephone'],
//             fax: item['fax'],
//             address: item['address']
//           }
//         }));
//       }
//     });
//   }, 
//   select: function(event, ui) { 
//     $('input[name=\'customer\']').attr('value', ui.item['lastname'] + ui.item['firstname']);
//     $('input[name=\'customer_id\']').attr('value', ui.item['value']);
//     $('input[name=\'firstname\']').attr('value', ui.item['firstname']);
//     $('input[name=\'lastname\']').attr('value', ui.item['lastname']);
//     $('input[name=\'email\']').attr('value', ui.item['email']);
//     $('input[name=\'telephone\']').attr('value', ui.item['telephone']);
//     $('input[name=\'fax\']').attr('value', ui.item['fax']);
//     $('input[name=\'customer_name\']').attr('value', ui.item['lastname'] + ui.item['firstname']);
//     // $('input[name=\'customer_store_id\']').attr('value', ui.item['store_id']);
      
//     html = '<option value="0"><?php echo $text_none; ?></option>'; 
      
//     for (i in  ui.item['address']) {
//       html += '<option value="' + ui.item['address'][i]['address_id'] + '">' + ui.item['address'][i]['firstname'] + ' ' + ui.item['address'][i]['lastname'] + ', ' + ui.item['address'][i]['address_1'] + ', ' + ui.item['address'][i]['city'] + ', ' + ui.item['address'][i]['country'] + '</option>';
//     }
    
//     // $('select[name=\'shipping_address\']').html(html);
//     // $('select[name=\'payment_address\']').html(html);
    
//     $('select[id=\'customer_group_id\']').attr('disabled', false);
//     $('select[id=\'customer_group_id\']').attr('value', ui.item['customer_group_id']);
//     $('select[id=\'customer_group_id\']').trigger('change');
//     $('select[id=\'customer_group_id\']').attr('disabled', true); 
            
//     return false; 
//   },
//   focus: function(event, ui) {
//         return false;
//     }
// });


// $('input[name=\'product\']').autocomplete({
//   delay: 500,
//   source: function(request, response) {
//     $.ajax({
//       url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
//       dataType: 'json',
//       success: function(json) { 
//         console.log(json);
//         response($.map(json, function(item) {
//           return {
//             label: item.name,
//             value: item.product_id,
//             model: item.model,
//             option: item.option,
//             price: item.price
//           }
//         }));
//       }
//     });
//   }, 
//   select: function(event, ui) {
//     $('input[name=\'product\']').attr('value', ui.item['label']);
//     $('input[name=\'product_id\']').attr('value', ui.item['value']);
//     $('input[name=\'product_name\']').attr('value', ui.item['label']);
    
//     return false;
//   },
//   focus: function(event, ui) {
//     return false;
//   }
// }); 

//--></script> 

<?php echo $footer; ?>