<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a href="<?php echo $invoice; ?>" target="_blank" class="button"><?php echo $button_invoice; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div class="vtabs"><a href="#tab-order"><?php echo $tab_order; ?></a>
        <a href="#tab-product"><?php echo $tab_product; ?></a>


      </div>
      <div id="tab-order" class="vtabs-content">
        <table class="form">
          <tr>
            <td><?php echo $text_order_id; ?></td>
            <td>#<?php echo $order_id; ?></td>
          </tr>
          <?php if (!empty($amazon_order_id)) { ?>
          
          <tr>
            <td><?php echo $text_amazon_order_id; ?></td>
            <td><?php echo $amazon_order_id; ?></td>
          </tr>
          
          <?php } ?>
          <tr>
            <td><?php echo $text_invoice_no; ?></td>
            <td><?php if ($invoice_no) { ?>
              <?php echo $invoice_no; ?>
              <?php } else { ?>
              <span id="invoice"><b>[</b> <a id="invoice-generate"><?php echo $text_generate; ?></a> <b>]</b></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $text_store_name; ?></td>
            <td><?php echo $store_name; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_store_url; ?></td>
            <td><a href="<?php echo $store_url; ?>" target="_blank"><u><?php echo $store_url; ?></u></a></td>
          </tr>
          <?php if ($customer) { ?>
          <tr>
            <td><?php echo $text_customer; ?></td>
            <td><a href="<?php echo $customer; ?>"><?php echo $firstname; ?> <?php echo $lastname; ?></a></td>
          </tr>
          <?php } else { ?>
          <tr>
            <td><?php echo $text_customer; ?></td>
            <td><?php echo $firstname; ?> <?php echo $lastname; ?></td>
          </tr>
          <?php } ?>
          <?php if ($customer_group) { ?>
          <tr>
            <td><?php echo $text_customer_group; ?></td>
            <td><?php echo $customer_group; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo $text_email; ?></td>
            <td><?php echo $email; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_telephone; ?></td>
            <td><?php echo $telephone; ?></td>
          </tr>
          <?php if ($fax) { ?>
          <tr>
            <td><?php echo $text_fax; ?></td>
            <td><?php echo $fax; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo $text_total; ?></td>
            <td><?php echo $total; ?></td>
          </tr>
        
          <?php if ($order_status) { ?>
          <tr>
            <td><?php echo $text_order_status; ?></td>
            <td id="order-status"><?php echo $order_status; ?></td>
          </tr>
          <?php } ?>
          <?php if ($comment) { ?>
          <tr>
            <td><?php echo $text_comment; ?></td>
            <td><?php echo $comment; ?></td>
          </tr>
          <?php } ?>
          
          <tr>
            <td><?php echo $text_date_added; ?></td>
            <td><?php echo $date_added; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_date_modified; ?></td>
            <td><?php echo $date_modified; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_payment_cash; ?></td>
            <td><?php echo $payment_cash; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_payment_visa; ?></td>
            <td><?php echo $payment_visa; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_payment_final; ?></td>
            <td><?php echo $payment_final; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_payment_balance; ?></td>
            <td><?php echo $payment_balance; ?></td>
          </tr>


        </table>
      </div>
      
      
      <div id="tab-product" class="vtabs-content">



        <table class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $column_product; ?></td>
              <td class="left"><?php echo $column_model; ?></td>
              <td class="right"><?php echo $column_quantity; ?></td>
              <td class="right"><?php echo $column_price; ?></td>
              <td class="right"><?php echo $column_total; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td class="left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                <?php foreach ($product['option'] as $option) { ?>
                <br />
                <?php if ($option['type'] != 'file') { ?>
                &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                <?php } else { ?>
                &nbsp;<small> - <?php echo $option['name']; ?>: <a href="<?php echo $option['href']; ?>"><?php echo $option['value']; ?></a></small>
                <?php } ?>
                <?php } ?></td>
              <td class="left"><?php echo $product['model']; ?></td>
              <td class="right"><?php echo $product['quantity']; ?></td>
              <td class="right"><?php echo $product['price']; ?></td>
              <td class="right"><?php echo $product['total']; ?></td>
            </tr>
            <?php } ?>
            <?php foreach ($vouchers as $voucher) { ?>
            <tr>
              <td class="left"><a href="<?php echo $voucher['href']; ?>"><?php echo $voucher['description']; ?></a></td>
              <td class="left"></td>
              <td class="right">1</td>
              <td class="right"><?php echo $voucher['amount']; ?></td>
              <td class="right"><?php echo $voucher['amount']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
          <?php foreach ($totals as $totals) { ?>
          <tbody id="totals">
            <tr>
              <td colspan="4" class="right"><?php echo $totals['title']; ?>:</td>
              <td class="right"><?php echo $totals['text']; ?></td>
            </tr>
          </tbody>
          <?php } ?>
        </table>
      

      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript"><!--

$('#invoice-generate').live('click', function() {
	$.ajax({
		url: 'index.php?route=sale/order/createinvoiceno&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>',
		dataType: 'json',
		beforeSend: function() {
			$('#invoice').after('<img src="view/image/loading.gif" class="loading" style="padding-left: 5px;" />');	
		},
		complete: function() {
			$('.loading').remove();
		},
		success: function(json) {
			$('.success, .warning').remove();
						
			if (json['error']) {
				$('#tab-order').prepend('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
				$('.warning').fadeIn('slow');
			}
			
			if (json.invoice_no) {
				$('#invoice').fadeOut('slow', function() {
					$('#invoice').html(json['invoice_no']);
					
					$('#invoice').fadeIn('slow');
				});
			}
		}
	});
});


$('#history .pagination a').live('click', function() {
	$('#history').load(this.href);
	
	return false;
});			

$('#history').load('index.php?route=sale/order/history&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>');

$('#button-history').live('click', function() {

    if(typeof verifyStatusChange == 'function'){
        if(verifyStatusChange() == false){
            return false;
        }else{
            addOrderInfo();
        }
    }else{
        addOrderInfo();
    }

	$.ajax({
		url: 'index.php?route=sale/order/history&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>',
		type: 'post',
		dataType: 'html',
		data: 'order_status_id=' + encodeURIComponent($('select[name=\'order_status_id\']').val()) + '&notify=' + encodeURIComponent($('input[name=\'notify\']').attr('checked') ? 1 : 0) + '&append=' + encodeURIComponent($('input[name=\'append\']').attr('checked') ? 1 : 0) + '&comment=' + encodeURIComponent($('textarea[name=\'comment\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-history').attr('disabled', true);
			$('#history').prepend('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-history').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {
			$('#history').html(html);
			
			$('textarea[name=\'comment\']').val('');
			
			$('#order-status').html($('select[name=\'order_status_id\'] option:selected').text());
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script>
<script type="text/javascript"><!--

function addProductQuantity() {

  html  = '<tbody id="storequantity-row' + productquantity_row + '">';
    html += '  <tr>';
  html += '    <td class="left"><input type="text" name="store_quantity[' + productquantity_row + '][name]" value="" /><input type="hidden" name="store_quantity[' + productquantity_row + '][store_id]" value="" /></td>';
  html += '    <td class="left">';
  
  html += '<input type="text" name="store_quantity[' + productquantity_row + '][quantity]" cols="40" rows="5"></textarea><br />';

  html += '    </td>';
  html += '    <td class="left"><a onclick="$(\'#storequantity-row' + productquantity_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '  </tr>';  
    html += '</tbody>';
  
  $('#storequantity tfoot').before(html);
  
  productquantityautocomplete(productquantity_row);
  
  productquantity_row++;
}


function productquantityautocomplete(productquantity_row) {
  // prepare for autocomplete

  console.log(productquantity_row) ;
  $('input[name=\'store_quantity[' + productquantity_row + '][name]\']').catcomplete({
    delay: 500,
    source: function(request, response) {
      $.ajax({
        url: 'index.php?route=setting/store/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
        dataType: 'json',
        success: function(json) {
        
          response($.map(json, function(item) {
            return {
              //category: item.attribute_group,
              label: item.name,
              value: item.store_id
            }
          }));
        }
      });
    }, 
    select: function(event, ui) {
      $('input[name=\'store_quantity[' + productquantity_row + '][name]\']').attr('value', ui.item.label);
      $('input[name=\'store_quantity[' + productquantity_row + '][product_id]\']').attr('value', ui.item.value);
      
      return false;
    },
    focus: function(event, ui) {
          return false;
      }
  });
}

$('#productquantity tbody').each(function(index, element) {
  productquantityautocomplete(index);
});


    function orderStatusChange(){
        var status_id = $('select[name="order_status_id"]').val();

        $('#openbayInfo').remove();

        $.ajax({
            url: 'index.php?route=extension/openbay/ajaxOrderInfo&token=<?php echo $this->request->get['token']; ?>&order_id=<?php echo $this->request->get['order_id']; ?>&status_id='+status_id,
            type: 'post',
            dataType: 'html',
            beforeSend: function(){},
            success: function(html) {
                $('#history').after(html);
            },
            failure: function(){},
            error: function(){}
        });
    }

    function addOrderInfo(){
        var status_id = $('select[name="order_status_id"]').val();
        var old_status_id = $('#old_order_status_id').val();

        $('#old_order_status_id').val(status_id);

        $.ajax({
            url: 'index.php?route=extension/openbay/ajaxAddOrderInfo&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>&status_id='+status_id+'&old_status_id='+old_status_id,
            type: 'post',
            dataType: 'html',
            data: $(".openbayData").serialize(),
            beforeSend: function(){},
            success: function() {},
            failure: function(){},
            error: function(){}
        });
    }

    $(document).ready(function() {
        orderStatusChange();
    });

    $('select[name="order_status_id"]').change(function(){orderStatusChange();});
//--></script>
<?php echo $footer; ?>