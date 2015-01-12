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
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-sales-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			


      <div class="buttons">
        <!-- <a onclick="$('#form').submit();" class="button save"><php echo $button_save; ?></a> -->
        <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="vtabs" class="vtabs"><a href="#tab-customer" id="tab-customer-link"><?php echo $tab_customer; ?></a>
        <a href="#tab-product"><?php echo $tab_product; ?></a>
        <!-- <a href="#tab-voucher"><php echo $tab_voucher; ?></a> -->
        <a href="#tab-total" onclick="$('#button-product').click()"><?php echo $tab_total; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-customer" class="vtabs-content">
          <table class="form">
            <tr>
              <td><?php echo $entry_customer; ?></td>
              <td> <?php if (!$is_insert)  { ?>
              <?php echo $customer; ?>
                <?php } ?> <input <?php if (!$is_insert) echo 'style="display:none"'; ?> type="customer" name="customer" value="<?php echo $customer; ?>" />
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                <input type="hidden" name="customer_name" value="<?php echo $customer_name; ?>" />
                <input type="hidden" name="customer_group_id" value="<?php echo $customer_group_id; ?>" />
                <?php if ($error_customer) { ?>
                  <span class="error"><?php echo $error_customer; ?></span>
                <?php } ?>

                </td>
            </tr>
            <tr>
              <td class="left"><?php echo $entry_store; ?></td>
              <td class="left">

                <?php if (!$is_insert)  { ?>
                <?php foreach ($stores as $store) { ?>
                  <?php if ($store['store_id'] == $store_id) {  echo $store['name']; } ?>
                <?php } ?><?php } ?>
                <select name="store_id" <?php if (!$is_insert) echo 'style="display:none"'; ?>>
                  <option value=''><?php echo $text_select; ?></option>
                  <?php foreach ($stores as $store) { ?>
                  <?php if ($store['store_id'] == $store_id) { ?>
                  <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>

                <?php if ($error_store) { ?>
                  <span class="error"><?php echo $error_store; ?></span>
                  <?php } ?></td>
            </tr>
            <!-- <tr>
              <td><span class="required">*</span> <php echo $entry_email; ?></td>
              <td><php echo $email; ?><input type="text" style='display:none' name="email" value="<php echo $email; ?>"/>
                <php if ($error_email) { ?>
                <span class="error"><php echo $error_email; ?></span>
                <php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <php echo $entry_telephone; ?></td>
              <td><php echo $telephone; ?><input type="text" style='display:none' name="telephone" value="<php echo $telephone; ?>"/>
                <php if ($error_telephone) { ?>
                <span class="error"><php echo $error_telephone; ?></span>
                <php } ?></td>
            </tr> -->
          </table>
        </div>
        <div id="tab-product" class="vtabs-content">
          <table class="list">
            <thead>
              <tr>
                <td></td>
                <td class="left"><?php echo $column_product; ?></td>
                <!-- <td class="left"><php echo $column_model; ?></td> -->
                <td class="right"><?php echo $column_quantity; ?></td>
                <td class="right" ><?php echo $column_price; ?></td>
                <td class="right"><?php echo $column_actual_price; ?></td>
                <td class="right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <?php $product_row = 0; ?>
            <!-- <php $option_row = 0; ?> -->
            <!-- <php $download_row = 0; ?> -->
            <tbody id="product">
              <?php if ($order_products) { ?>
              <?php foreach ($order_products as $order_product) { ?>
              <tr id="product-row<?php echo $product_row; ?>">
                <td class="center" style="width: 3px;">
                  <img  <?php if (!$is_insert) echo "style='display:none'"; ?> src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$('#product-row<?php echo $product_row; ?>').remove(); $('#button-update').trigger('click');" /></td>
                <td class="left"><?php echo $order_product['name']; ?><br />
                  <input type="hidden" name="order_product[<?php echo $product_row; ?>][order_product_id]" value="<?php echo $order_product['order_product_id']; ?>" />
                  <input type="hidden" name="order_product[<?php echo $product_row; ?>][product_id]" value="<?php echo $order_product['product_id']; ?>" />
                  <input type="hidden" name="order_product[<?php echo $product_row; ?>][name]" value="<?php echo $order_product['name']; ?>" />
                  <!--<php foreach ($order_product['option'] as $option) { ?>
                  - <small><php echo $option['name']; ?>: <php echo $option['value']; ?></small><br />
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][order_option][<php echo $option_row; ?>][order_option_id]" value="<php echo $option['order_option_id']; ?>" />
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][order_option][<php echo $option_row; ?>][product_option_id]" value="php echo $option['product_option_id']; ?>" />
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][order_option][<php echo $option_row; ?>][product_option_value_id]" value="<php echo $option['product_option_value_id']; ?>" />
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][order_option][<php echo $option_row; ?>][name]" value="<php echo $option['name']; ?>" />
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][order_option][<php echo $option_row; ?>][value]" value="<php echo $option['value']; ?>" />
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][order_option][<php echo $option_row; ?>][type]" value="<php echo $option['type']; ?>" />
                  <php $option_row++; ?>
                  <php } ?>-->
                 </td>
                <!-- <td class="left"><php echo $order_product['model']; ?>
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][model]" value="<php echo $order_product['model']; ?>" /></td> -->
                <td class="right"><?php echo $order_product['quantity']; ?>
                  <input type="hidden" name="order_product[<?php echo $product_row; ?>][quantity]" value="<?php echo $order_product['quantity']; ?>" /></td>                 
                <td class="right"><?php echo $order_product['ref_price']; ?>
                  <input type="hidden" name="order_product[<?php echo $product_row; ?>][ref_price]" value="<?php echo $order_product['ref_price']; ?>" /></td>

                <td class="right">
                  <?php if (!$is_insert) echo $order_product['price']; ?>
                  <input <?php if (!$is_insert) echo "style='display:none'"; ?> type="text" id="<?php echo $product_row; ?>" name="order_product[<?php echo $product_row; ?>][price]" class="price" size="8" value="<?php echo $order_product['price']; ?>"/></td>

                <td class="right"><div class="order_product[<?php echo $product_row; ?>][labeltotal]"><?php echo $order_product['total']; ?></div>
                  <input type="hidden" name="order_product[<?php echo $product_row; ?>][total]" value="<?php echo $order_product['total']; ?>" />
                  <!-- <input type="hidden" name="order_product[<php echo $product_row; ?>][tax]" value="<php echo $order_product['tax']; ?>" />
                  <input type="hidden" name="order_product[<php echo $product_row; ?>][reward]" value="<php echo $order_product['reward']; ?>" /> --></td>
              </tr>
              <?php $product_row++; ?>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <br>
          <input type='hidden' name='is_insert' value='<?php echo $is_insert; ?>'/>
          <table class="list" <?php if ($route == 'sale/order/update') echo "style='display:none'"; ?>>
            <thead>
              <tr>
                <td colspan="2" class="left"><?php echo $text_product; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><?php echo $entry_product; ?></td>
                <td class="left">
                  <!-- <input type="product" name="product23" alt='1,2,3' value="" /> -->
                  <input type="product" name="product" alt='1,2,3' alt2='1' value="" />
                  <!-- <input type="text" name="product" alt='1,2,3' alt2='1' value="" /> -->
                  <input type="hidden" name="product_id" value="" />
                 / 
                
                <select type='product' alt='1,2,3' alt2='1'/></td>
              </tr>
              <tr id="option"></tr>
              <tr>
                <td class="left"><?php echo $entry_quantity; ?></td>
                <td class="left"><input type="text" name="quantity" value="1" /></td>
              </tr>             
            </tbody>
            <tfoot>
              <tr>
                <td class="left">&nbsp;</td>
                <td class="left"><a id="button-product" class="button"><?php echo $button_add_product; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- <div id="tab-voucher" class="vtabs-content">
          <table class="list">
            <thead>
              <tr>
                <td></td>
                <td class="left"><php echo $column_product; ?></td>
                <td class="left"><php echo $column_model; ?></td>
                <td class="right"><php echo $column_quantity; ?></td>
                <td class="right"><php echo $column_price; ?></td>
                <td class="right"><php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody id="voucher">
              <php $voucher_row = 0; ?>
              <php if ($order_vouchers) { ?>
              <php foreach ($order_vouchers as $order_voucher) { ?>
              <tr id="voucher-row<php echo $voucher_row; ?>">
                <td class="center" style="width: 3px;"><img src="view/image/delete.png" title="<php echo $button_remove; ?>" alt="<php echo $button_remove; ?>" style="cursor: pointer;" onclick="$('#voucher-row<php echo $voucher_row; ?>').remove(); $('#button-update').trigger('click');" /></td>
                <td class="left"><php echo $order_voucher['description']; ?>
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][order_voucher_id]" value="<php echo $order_voucher['order_voucher_id']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][voucher_id]" value="<php echo $order_voucher['voucher_id']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][description]" value="<php echo $order_voucher['description']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][code]" value="<php echo $order_voucher['code']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][from_name]" value="<php echo $order_voucher['from_name']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][from_email]" value="<php echo $order_voucher['from_email']; ?>" />
                  <input type="hidden" name="order_voucher[php echo $voucher_row; ?>][to_name]" value="<php echo $order_voucher['to_name']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][to_email]" value="<php echo $order_voucher['to_email']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][voucher_theme_id]" value="<hp echo $order_voucher['voucher_theme_id']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][message]" value="<php echo $order_voucher['message']; ?>" />
                  <input type="hidden" name="order_voucher[<php echo $voucher_row; ?>][amount]" value="<php echo $order_voucher['amount']; ?>" /></td>
                <td class="left"></td>
                <td class="right">1</td>
                <td class="right">php echo $order_voucher['amount']; ?></td>
                <td class="right"><hp echo $order_voucher['amount']; ?></td>
              </tr>
              <php $voucher_row++; ?>
              <php } ?>
              <php } else { ?>
              <tr>
                <td class="center" colspan="6"><php echo $text_no_results; ?></td>
              </tr>
              <php } ?>
            </tbody>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td colspan="2" class="left"><php echo $text_voucher; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><span class="required">*</span> <php echo $entry_theme; ?></td>
                <td class="left"><select name="voucher_theme_id">
                    <php foreach ($voucher_themes as $voucher_theme) { ?>
                    <option value="<php echo $voucher_theme['voucher_theme_id']; ?>"><php echo addslashes($voucher_theme['name']); ?></option>
                    <php } ?>
                  </select></td>
              </tr>
              <tr>
                <td class="left"><php echo $entry_message; ?></td>
                <td class="left"><textarea name="message" cols="40" rows="5"></textarea></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span> <php echo $entry_amount; ?></td>
                <td class="left"><input type="text" name="amount" value="0.00" size="5" /></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="left">&nbsp;</td>
                <td class="left"><a id="button-voucher" class="button"><php echo $button_add_voucher; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div> -->
        <div id="tab-total" class="vtabs-content">
          <table class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $column_product; ?></td>
                <!-- <td class="left"><php echo $column_model; ?></td> -->
                <td class="right"><?php echo $column_quantity; ?></td>
                <td class="right"><?php echo $column_price; ?></td>
                <td class="right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody id="total">
              <?php $total_row = 0; ?>
              <?php if ($order_products || $order_vouchers || $order_totals) { ?>
              <?php foreach ($order_products as $order_product) { ?>
              <tr>
                <td class="left"><?php echo $order_product['name']; ?><br />
                  <!--<php foreach ($order_product['option'] as $option) { ?>
                  - <small><php echo $option['name']; ?>: <hp echo $option['value']; ?></small><br />
                  <php } ?>--></td>
                <!-- <td class="left"><php echo $order_product['model']; ?></td> -->
                <td class="right"><?php echo $order_product['quantity']; ?></td>
                <td class="right"><?php echo $order_product['price']; ?></td>
                <td class="right"><?php echo $order_product['total']; ?></td>
              </tr>
              <?php } ?>
             <!--  <php foreach ($order_vouchers as $order_voucher) { ?>
              <tr>
                <td class="left"><php echo $order_voucher['description']; ?></td>
                <td class="left"></td>
                <td class="right">1</td>
                <td class="right"><php echo $order_voucher['amount']; ?></td>
                <td class="right"><php echo $order_voucher['amount']; ?></td>
              </tr>
              <php } ?> -->
              <?php foreach ($order_totals as $order_total) { ?>
              <tr id="total-row<?php echo $total_row; ?>">
                <td class="right" colspan="3"><?php echo $order_total['title']; ?>:
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][order_total_id]" value="<?php echo $order_total['order_total_id']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][code]" value="<?php echo $order_total['code']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][title]" value="<?php echo $order_total['title']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][text]" value="<?php echo $order_total['text']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][value]" value="<?php echo $order_total['value']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][sort_order]" value="<?php echo $order_total['sort_order']; ?>" /></td>
                <td class="right"><?php echo $order_total['value']; ?></td>
              </tr>
              <?php $total_row++; ?>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td class="left" colspan="2"><?php echo $text_order; ?></td>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <td class="left"><php echo $entry_shipping; ?></td>
                <td class="left"><select name="shipping">
                    <option value=""><php echo $text_select; ?></option>
                  
                    <hp if ($shipping_code) { ?>
                    <option value="<php echo $shipping_code; ?>" selected="selected"><php echo $shipping_method; ?></option>
                    <php } ?>


                  </select>
                  <input type="hidden" name="shipping_method" value="<php echo $shipping_method; ?>" />
                  <input type="hidden" name="shipping_code" value="<php echo $shipping_code; ?>" />
                  <php if ($error_shipping_method) { ?>
                  <span class="error"><php echo $error_shipping_method; ?></span>
                  <php } ?></td>
              </tr>
              <tr>
                <td class="left"><php echo $entry_payment; ?></td>
                <td class="left"><select name="payment">
                    <option value=""><php echo $text_select; ?></option>
                    <php if ($payment_code) { ?>
                    <option value="<php echo $payment_code; ?>" selected="selected"><php echo $payment_method; ?></option>
                    <php } ?>
                  </select>
                  <input type="hidden" name="payment_method" value="<php echo $payment_method; ?>" />
                  <input type="hidden" name="payment_code" value="<php echo $payment_code; ?>" />
                  <php if ($error_payment_method) { ?>
                  <span class="error"><php echo $error_payment_method; ?></span>
                  <php } ?></td>
              </tr>             
              <tr>
                <td class="left"><php echo $entry_coupon; ?></td>
                <td class="left"><input type="text" name="coupon" value="" /></td>
              </tr>
              <tr>
                <td class="left"><php echo $entry_voucher; ?></td>
                <td class="left"><input type="text" name="voucher" value="" /></td>
              </tr>
              <tr>
                <td class="left"><php echo $entry_reward; ?></td>
                <td class="left"><input type="text" name="reward" value="" /></td>
              </tr> -->
              <tr style='display:none'>
                <td class="left"><?php echo $entry_order_status; ?></td>
                <td class="left"><select name="order_status_id">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $order_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>

              <tr>
                <td class="left"><?php echo $entry_comment; ?></td>
                <td class="left"><textarea name="comment" cols="40" rows="5"><?php echo $comment; ?></textarea></td>
              </tr>

              <tr>
                <td class="left"><span class="required">*</span><?php echo $entry_payment_cash; ?></td>
                <td class="left"><input name='payment_cash' value='<?php echo $payment_cash; ?>'/>
                <?php if ($error_payment_cash) { ?>
                  <span class="error"><?php echo $error_payment_cash; ?></span>
                <?php } ?></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span><?php echo $entry_payment_visa; ?></td>
                <td class="left"><input name='payment_visa' value='<?php echo $payment_visa; ?>'/>
                <?php if ($error_payment_visa) { ?>
                  <span class="error"><?php echo $error_payment_visa; ?></span>
                <?php } ?></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span><?php echo $entry_payment_final; ?></td>
                <td class="left"><input name='payment_final' value='<?php echo $payment_final; ?>'/>
                <?php if ($error_payment_final) { ?>
                  <span class="error"><?php echo $error_payment_final; ?></span>
                <?php } ?></td>
              </tr>
              <tr>

              </tr>
              <tr>
                <td class="left"><?php echo $entry_payment_balance; ?></td>
                <td class="left"><input name='payment_balance'/ value='<?php echo $payment_balance; ?>' disabled></td>
              </tr>

              <!-- <tr>
                <td class="left"><php echo $entry_affiliate; ?></td>
                <td class="left"><input type="text" name="affiliate" value="<php echo $affiliate; ?>" />
                  <input type="hidden" name="affiliate_id" value="<php echo $affiliate_id; ?>" /></td>
              </tr> -->
            </tbody>
            <tfoot>
              <!-- <tr>
                <td class="left">&nbsp;</td>
                <td class="left"><a id="button-update" class="button"><php echo $button_update_total; ?></a></td>
              </tr> -->
            </tfoot>
          </table>

          <div class="buttons2">
        <a onclick="$('#form').submit();" class="button save"><?php echo $button_save; ?></a>
      </div>


         

        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--



$('input[name=\'payment_cash\'], input[name=\'payment_visa\'], input[name=\'payment_final\']').keyup(function(){
  var total = $('input[name=\'order_total[0][value]\']').val();
  var balance = total - $('input[name=\'payment_final\']').val() - $('input[name=\'payment_visa\']').val() - $('input[name=\'payment_cash\']').val();
  $('input[name=\'payment_balance\']').val(balance);
  // if (balance < 0.5 && balance > -0.5) $('select[name=order_status_id]').val()
});

// $('input[name=\'customer\']').catcomplete({
// 	delay: 500,
// 	source: function(request, response) {
    
// 		$.ajax({
// 			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
// 			dataType: 'json',
// 			success: function(json) {	
//         console.log(json);
// 				response($.map(json, function(item) {
// 					return {
// 						category: item['customer_group'],
// 						label: item['lastname'] + item['firstname'] + ' ' + item['ssn'],
//             value: item['customer_id'],
// 						fullname: item['fullname'],
// 						customer_group_id: item['customer_group_id'],
//             firstname: item['firstname'],
// 						store_id: item['store_id'],
// 						lastname: item['lastname'],
// 						email: item['email'],
// 						telephone: item['telephone'],
// 						fax: item['fax'],
// 						address: item['address']
// 					}
// 				}));
// 			}
// 		});
// 	}, 
// 	select: function(event, ui) { 

//     $('select[name=\'store_id\']').val(ui.item['store_id']);
//     $('input[name=\'customer\']').attr('value', ui.item['lastname'] + ui.item['firstname']);
//     $('input[name=\'customer_id\']').attr('value', ui.item['value']);
//     $('input[name=\'customer_name\']').attr('value', ui.item['fullname']);
//     $('input[name=\'firstname\']').attr('value', ui.item['firstname']);
//     $('input[name=\'lastname\']').attr('value', ui.item['lastname']);
//     $('input[name=\'email\']').attr('value', ui.item['email']);
//     $('input[name=\'telephone\']').attr('value', ui.item['telephone']);
//     // $('input[name=\'fax\']').attr('value', ui.item['fax']);
// 		// $('input[name=\'customer_store_id\']').attr('value', ui.item['store_id']);
			
// 		html = '<option value="0"><?php echo $text_none; ?></option>'; 
			
// 		for (i in  ui.item['address']) {
// 			html += '<option value="' + ui.item['address'][i]['address_id'] + '">' + ui.item['address'][i]['firstname'] + ' ' + ui.item['address'][i]['lastname'] + ', ' + ui.item['address'][i]['address_1'] + ', ' + ui.item['address'][i]['city'] + ', ' + ui.item['address'][i]['country'] + '</option>';
// 		}
		
// 		// $('select[name=\'shipping_address\']').html(html);
// 		// $('select[name=\'payment_address\']').html(html);
		
// 		$('select[id=\'customer_group_id\']').attr('disabled', false);
// 		$('select[id=\'customer_group_id\']').attr('value', ui.item['customer_group_id']);
// 		$('select[id=\'customer_group_id\']').trigger('change');
// 		$('select[id=\'customer_group_id\']').attr('disabled', true); 
					 	
// 		return false; 
// 	},
// 	focus: function(event, ui) {
//       	return false;
//    	}
// });

$('select[id=\'customer_group_id\']').live('change', function() {
	$('input[name=\'customer_group_id\']').attr('value', this.value);
	
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('select[id=\'customer_group_id\']').trigger('change');

//--></script> 
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
      // url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term) + '&filter_product_type_ids=1,2,3',
			dataType: 'json',
			success: function(json) {	
        console.log(json);
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id,
						model: item.model,
						option: item.option,
						price: item.price
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'product\']').attr('value', ui.item['label']);
		$('input[name=\'product_id\']').attr('value', ui.item['value']);

		// $('#option td').remove();
		return false;
	},
	focus: function(event, ui) {
    return false;
  }
});	
//--></script> 
<script type="text/javascript"><!--

var clearinput = function(){
  $('input[name=product]').val('');
  $('input[name=product_id]').val('');
  $('input[name=quantity]').val('');
};

$('#button-product').live('click', function() {	


// var total = $('input[name=\'order_total[0][value]\']').val();
// $('input[name=\'payment_balance\']').val(total - $('input[name=\'payment_final\']').val() - $('input[name=\'payment_visa\']').val() - $('input[name=\'payment_cash\']').val());
// });


  var store_id = $('select[name=\'store_id\']').val();
  var customer_id = $('input[name=\'customer_id\']').val();
  
      $('.success, .warning, .attention, .error').remove();

  if (!store_id) {

        $('.box').before('<div class="warning" style="display: none;"><?php echo $text_error_store; ?></div>');
      
    $('.warning').fadeIn('slow');    
    
    return;
  }

  if (!customer_id) {

    $('.box').before('<div class="warning" style="display: none;"><?php echo $text_error_customer; ?></div>');
      
    $('.warning').fadeIn('slow');       

    return;
  }

	data  = '#tab-customer input[type=\'text\'], #tab-customer input[type=\'hidden\'], #tab-customer input[type=\'radio\']:checked, #tab-customer input[type=\'checkbox\']:checked, #tab-customer select, #tab-customer textarea, ';
	// data += '#tab-payment input[type=\'text\'], #tab-payment input[type=\'hidden\'], #tab-payment input[type=\'radio\']:checked, #tab-payment input[type=\'checkbox\']:checked, #tab-payment select, #tab-payment textarea, ';
	// data += '#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'hidden\'], #tab-shipping input[type=\'radio\']:checked, #tab-shipping input[type=\'checkbox\']:checked, #tab-shipping select, #tab-shipping textarea, ';
	
	if ($(this).attr('id') == 'button-product') {
		data += '#tab-product input[type=\'text\'], #tab-product input[type=\'hidden\'], #tab-product input[type=\'radio\']:checked, #tab-product input[type=\'checkbox\']:checked, #tab-product select, #tab-product textarea, ';
	} else {
		data += '#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea, ';
	}
	
  
	// if ($(this).attr('id') == 'button-voucher') {
	// 	data += '#tab-voucher input[type=\'text\'], #tab-voucher input[type=\'hidden\'], #tab-voucher input[type=\'radio\']:checked, #tab-voucher input[type=\'checkbox\']:checked, #tab-voucher select, #tab-voucher textarea, ';
	// } else {
	// 	data += '#voucher input[type=\'text\'], #voucher input[type=\'hidden\'], #voucher input[type=\'radio\']:checked, #voucher input[type=\'checkbox\']:checked, #voucher select, #voucher textarea, ';
	// }
	
	data += '#tab-total input[type=\'text\'], #tab-total input[type=\'hidden\'], #tab-total input[type=\'radio\']:checked, #tab-total input[type=\'checkbox\']:checked, #tab-total select, #tab-total textarea';

	$.ajax({
    url: 'index.php?route=checkout/manual&is_insert=<?php echo $is_insert; ?>&store_id=<?php echo $store_id; ?>&token=<?php echo $token; ?>',
		type: 'post',
		data: $(data),
		dataType: 'json',	
		beforeSend: function() {

			$('.success, .warning, .attention, .error').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},			
		success: function(json) {
			$('.success, .warning, .attention, .error').remove();

      console.log(json);
			// Check for errors
			if (json['error']) {
				
							
				// Order Details
				if (json['error']['customer']) {
					$('.box').before('<span class="error">' + json['error']['customer'] + '</span>');
				}	
				
        else if (json['error']['nocustomer']) {
          $('.box').before('<div class="warning">' + json['error']['nocustomer'] + '</span>');
        } 

        else if (json['error']['store']) {
          $('.box').before('<div class="warning">' + json['error']['store'] + '</span>');
        }

				else if (json['error']['firstname']) {
					$('input[name=\'firstname\']').after('<span class="error">' + json['error']['firstname'] + '</span>');
				}
				
				else if (json['error']['lastname']) {
					$('input[name=\'lastname\']').after('<span class="error">' + json['error']['lastname'] + '</span>');
				}	
				
				else if (json['error']['email']) {
					$('input[name=\'email\']').after('<span class="error">' + json['error']['email'] + '</span>');
				}
				
				else if (json['error']['telephone']) {
					$('input[name=\'telephone\']').after('<span class="error">' + json['error']['telephone'] + '</span>');
				}	

				// Products
				else if (json['error']['product']) {
					if (json['error']['product']['option']) {	
						for (i in json['error']['product']['option']) {
							$('#option-' + i).after('<span class="error">' + json['error']['product']['option'][i] + '</span>');
						}						
					}
					
					if (json['error']['product']['stock']) {
						$('.box').before('<div class="warning">' + json['error']['product']['stock'] + '</div>');
					}	
											
					if (json['error']['product']['minimum']) {	
						for (i in json['error']['product']['minimum']) {
							$('.box').before('<div class="warning">' + json['error']['product']['minimum'][i] + '</div>');
						}						
					}
				} else if (json['error']['warning']) {
          $('.box').before('<div class="warning">' + json['error']['warning'] + '</div>');
        } else {
					$('input[name=\'product\']').attr('value', '');
					$('input[name=\'product_id\']').attr('value', '');
					$('#option td').remove();			
					$('input[name=\'quantity\']').attr('value', '1');			
				}
				
				// Voucher
				// if (json['error']['vouchers']) {
				// 	// if (json['error']['vouchers']['from_name']) {
				// 	// 	$('input[name=\'from_name\']').after('<span class="error">' + json['error']['vouchers']['from_name'] + '</span>');
				// 	// }	
					
				// 	// if (json['error']['vouchers']['from_email']) {
				// 	// 	$('input[name=\'from_email\']').after('<span class="error">' + json['error']['vouchers']['from_email'] + '</span>');
				// 	// }	
								
				// 	// if (json['error']['vouchers']['to_name']) {
				// 	// 	$('input[name=\'to_name\']').after('<span class="error">' + json['error']['vouchers']['to_name'] + '</span>');
				// 	// }	
					
				// 	// if (json['error']['vouchers']['to_email']) {
				// 	// 	$('input[name=\'to_email\']').after('<span class="error">' + json['error']['vouchers']['to_email'] + '</span>');
				// 	// }	
					
				// 	if (json['error']['vouchers']['amount']) {
				// 		$('input[name=\'amount\']').after('<span class="error">' + json['error']['vouchers']['amount'] + '</span>');
				// 	}	
				// } else {
				// 	// $('input[name=\'from_name\']').attr('value', '');	
				// 	// $('input[name=\'from_email\']').attr('value', '');	
				// 	// $('input[name=\'to_name\']').attr('value', '');
				// 	// $('input[name=\'to_email\']').attr('value', '');	
				// 	$('textarea[name=\'message\']').attr('value', '');	
				// 	$('input[name=\'amount\']').attr('value', '0.00');
				// }
				
				// Shipping Method	
				// if (json['error']['shipping_method']) {
				// 	$('.box').before('<div class="warning">' + json['error']['shipping_method'] + '</div>');
				// }	
				
				// // Payment Method
				// if (json['error']['payment_method']) {
				// 	$('.box').before('<div class="warning">' + json['error']['payment_method'] + '</div>');
				// }	
															
				// // Coupon
				// if (json['error']['coupon']) {
				// 	$('.box').before('<div class="warning">' + json['error']['coupon'] + '</div>');
				// }
				
				// // Voucher
				// if (json['error']['voucher']) {
				// 	$('.box').before('<div class="warning">' + json['error']['voucher'] + '</div>');
				// }
				
				// // Reward Points		
				// if (json['error']['reward']) {
				// 	$('.box').before('<div class="warning">' + json['error']['reward'] + '</div>');
				// }	
			} else {
				$('input[name=\'product\']').attr('value', '');
				$('input[name=\'product_id\']').attr('value', '');
				$('#option td').remove();	
				$('input[name=\'quantity\']').attr('value', '1');	
				
				$('input[name=\'from_name\']').attr('value', '');	
				$('input[name=\'from_email\']').attr('value', '');	
				$('input[name=\'to_name\']').attr('value', '');
				$('input[name=\'to_email\']').attr('value', '');	
				$('textarea[name=\'message\']').attr('value', '');	
				$('input[name=\'amount\']').attr('value', '0.00');									
			}

			if (json['success']) {
				$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
				$('.success').fadeIn('slow');				
			}
			
			if (json['order_product'] != '') {
        console.log(json['order_product']);
				var product_row = 0;
				var option_row = 0;
				var download_row = 0;
	
				html = '';
				
				for (i = 0; i < json['order_product'].length; i++) {
					product = json['order_product'][i];
					
					html += '<tr id="product-row' + product_row + '">';

          if ('<?php echo $is_insert; ?>') {
            html += '<td class="center" style="width: 3px;"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(\'#product-row' + product_row + '\').remove(); $(\'#button-update\').trigger(\'click\');" /></td>';          } else {
            html += '<td class="center" style="width: 3px;"></td>';
          }

					html += '  <td class="left">' + product['name'] + '<br /><input type="hidden" name="order_product[' + product_row + '][order_product_id]" value="" /><input type="hidden" name="order_product[' + product_row + '][product_id]" value="' + product['product_id'] + '" /><input type="hidden" name="order_product[' + product_row + '][name]" value="' + product['name'] + '" />';
					
					// if (product['option']) {
					// 	for (j = 0; j < product['option'].length; j++) {
					// 		option = product['option'][j];
							
					// 		html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_option][' + option_row + '][order_option_id]" value="' + option['order_option_id'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_option][' + option_row + '][product_option_id]" value="' + option['product_option_id'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_option][' + option_row + '][product_option_value_id]" value="' + option['product_option_value_id'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_option][' + option_row + '][name]" value="' + option['name'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_option][' + option_row + '][value]" value="' + option['value'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_option][' + option_row + '][type]" value="' + option['type'] + '" />';
							
					// 		option_row++;
					// 	}
					// }
					
					// if (product['download']) {
					// 	for (j = 0; j < product['download'].length; j++) {
					// 		download = product['download'][j];
							
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_download][' + download_row + '][order_download_id]" value="' + download['order_download_id'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_download][' + download_row + '][name]" value="' + download['name'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_download][' + download_row + '][filename]" value="' + download['filename'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_download][' + download_row + '][mask]" value="' + download['mask'] + '" />';
					// 		html += '  <input type="hidden" name="order_product[' + product_row + '][order_download][' + download_row + '][remaining]" value="' + download['remaining'] + '" />';
							
					// 		download_row++;
					// 	}
					// }
					
					html += '  </td>';
					// html += '  <td class="left">' + product['model'] + '<input type="hidden" name="order_product[' + product_row + '][model]" value="' + product['model'] + '" /></td>';
					html += '  <td class="right">' + product['quantity'] + '<input type="hidden" name="order_product[' + product_row + '][quantity]" value="' + product['quantity'] + '" /></td>';
          html += '  <td class="right">' + product['ref_price'] + '<input type="hidden" name="order_product[' + product_row + '][ref_price]" value="' + product['ref_price'] + '" /></td>';
          
          if ('<?php echo $is_insert; ?>') {
            html += '  <td class="right"><input type="text" size="8" value="' + product['price'] + '" class="price" name="order_product[' + product_row + '][price]"></input></td>';          } else {
            html += '  <td class="right">' + product['price'] + '<input type="hidden" size="8" value="' + product['price'] + '" class="price" name="order_product[' + product_row + '][price]"></input></td>';
          }
                 
             
					html += '  <td class="right">' + product['total'] + '<input type="hidden" name="order_product[' + product_row + '][total]" value="' + product['total'] + '" /><input type="hidden" name="order_product[' + product_row + '][tax]" value="' + product['tax'] + '" /><input type="hidden" name="order_product[' + product_row + '][reward]" value="' + product['reward'] + '" /></td>';
					html += '</tr>';
					
					product_row++;			
				}
				
				$('#product').html(html);
			} else {
				html  = '</tr>';
				html += '  <td colspan="6" class="center"><?php echo $text_no_results; ?></td>';
				html += '</tr>';	

				$('#product').html(html);	
			}
						
			// Vouchers
			// if (json['order_voucher'] != '') {
			// 	var voucher_row = 0;
				
			// 	 html = '';
				 
			// 	 for (i in json['order_voucher']) {
			// 		voucher = json['order_voucher'][i];
					 
			// 		html += '<tr id="voucher-row' + voucher_row + '">';
			// 		html += '  <td class="center" style="width: 3px;"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(\'#voucher-row' + voucher_row + '\').remove(); $(\'#button-update\').trigger(\'click\');" /></td>';
			// 		html += '  <td class="left">' + voucher['description'];
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][order_voucher_id]" value="" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][voucher_id]" value="' + voucher['voucher_id'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][description]" value="' + voucher['description'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][code]" value="' + voucher['code'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][from_name]" value="' + voucher['from_name'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][from_email]" value="' + voucher['from_email'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][to_name]" value="' + voucher['to_name'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][to_email]" value="' + voucher['to_email'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][voucher_theme_id]" value="' + voucher['voucher_theme_id'] + '" />';	
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][message]" value="' + voucher['message'] + '" />';
			// 		html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][amount]" value="' + voucher['amount'] + '" />';
			// 		html += '  </td>';
			// 		html += '  <td class="left"></td>';
			// 		html += '  <td class="right">1</td>';
			// 		html += '  <td class="right">' + voucher['amount'] + '</td>';
			// 		html += '  <td class="right">' + voucher['amount'] + '</td>';
			// 		html += '</tr>';	
				  
			// 		voucher_row++;
			// 	}
				  
			// 	$('#voucher').html(html);				
			// } else {
			// 	html  = '</tr>';
			// 	html += '  <td colspan="6" class="center"><?php echo $text_no_results; ?></td>';
			// 	html += '</tr>';	

			// 	$('#voucher').html(html);	
			// }
						
			// Totals
			if (json['order_product'] != '' || json['order_voucher'] != '' || json['order_total'] != '') {
				html = '';
				
				if (json['order_product'] != '') {
					for (i = 0; i < json['order_product'].length; i++) {
						product = json['order_product'][i];
						
						html += '<tr>';
						html += '  <td class="left">' + product['name'] + '<br />';
						
						if (product['option']) {
							for (j = 0; j < product['option'].length; j++) {
								option = product['option'][j];
								
								html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
							}
						}
						
						html += '  </td>';
						// html += '  <td class="left">' + product['model'] + '</td>';
						html += '  <td class="right">' + product['quantity'] + '</td>';
						html += '  <td class="right">' + product['price'] + '</td>';
						html += '  <td class="right">' + product['total'] + '</td>';
						html += '</tr>';
					}				
				}
				
				// if (json['order_voucher'] != '') {
				// 	for (i in json['order_voucher']) {
				// 		voucher = json['order_voucher'][i];
						 
				// 		html += '<tr>';
				// 		html += '  <td class="left">' + voucher['description'] + '</td>';
				// 		html += '  <td class="left"></td>';
				// 		html += '  <td class="right">1</td>';
				// 		html += '  <td class="right">' + voucher['amount'] + '</td>';
				// 		html += '  <td class="right">' + voucher['amount'] + '</td>';
				// 		html += '</tr>';	
				// 	}	
				// }
				
				var total_row = 0;
				
				for (i in json['order_total']) {
					total = json['order_total'][i];
					
					html += '<tr id="total-row' + total_row + '">';
					html += '  <td class="right" colspan="3"><input type="hidden" name="order_total[' + total_row + '][order_total_id]" value="" /><input type="hidden" name="order_total[' + total_row + '][code]" value="' + total['code'] + '" /><input type="hidden" name="order_total[' + total_row + '][title]" value="' + total['title'] + '" /><input type="hidden" name="order_total[' + total_row + '][text]" value="' + total['text'] + '" /><input type="hidden" name="order_total[' + total_row + '][value]" value="' + total['value'] + '" /><input type="hidden" name="order_total[' + total_row + '][sort_order]" value="' + total['sort_order'] + '" />' + total['title'] + ':</td>';
					html += '  <td class="right">' + total['value'] + '</td>';
					html += '</tr>';
					
					total_row++;
				}
				
				$('#total').html(html);
			} else {
				html  = '</tr>';
				html += '  <td colspan="5" class="center"><?php echo $text_no_results; ?></td>';
				html += '</tr>';	

				$('#total').html(html);					
			}
			
			// Shipping Methods
			// if (json['shipping_method']) {
			// 	html = '<option value=""><?php echo $text_select; ?></option>';

			// 	for (i in json['shipping_method']) {
			// 		html += '<optgroup label="' + json['shipping_method'][i]['title'] + '">';
				
			// 		if (!json['shipping_method'][i]['error']) {
			// 			for (j in json['shipping_method'][i]['quote']) {
			// 				if (json['shipping_method'][i]['quote'][j]['code'] == $('input[name=\'shipping_code\']').attr('value')) {
			// 					html += '<option value="' + json['shipping_method'][i]['quote'][j]['code'] + '" selected="selected">' + json['shipping_method'][i]['quote'][j]['title'] + '</option>';
			// 				} else {
			// 					html += '<option value="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['title'] + '</option>';
			// 				}
			// 			}		
			// 		} else {
			// 			html += '<option value="" style="color: #F00;" disabled="disabled">' + json['shipping_method'][i]['error'] + '</option>';
			// 		}
					
			// 		html += '</optgroup>';
			// 	}
		
			// 	$('select[name=\'shipping\']').html(html);	
				
			// 	if ($('select[name=\'shipping\'] option:selected').attr('value')) {
			// 		$('input[name=\'shipping_method\']').attr('value', $('select[name=\'shipping\'] option:selected').text());
			// 	} else {
			// 		$('input[name=\'shipping_method\']').attr('value', '');
			// 	}
				
			// 	$('input[name=\'shipping_code\']').attr('value', $('select[name=\'shipping\'] option:selected').attr('value'));	
			// }
						
			// Payment Methods
			// if (json['payment_method']) {
			// 	html = '<option value=""><?php echo $text_select; ?></option>';
				
			// 	for (i in json['payment_method']) {
			// 		if (json['payment_method'][i]['code'] == $('input[name=\'payment_code\']').attr('value')) {
			// 			html += '<option value="' + json['payment_method'][i]['code'] + '" selected="selected">' + json['payment_method'][i]['title'] + '</option>';
			// 		} else {
			// 			html += '<option value="' + json['payment_method'][i]['code'] + '">' + json['payment_method'][i]['title'] + '</option>';
			// 		}		
			// 	}
		
			// 	$('select[name=\'payment\']').html(html);
				
			// 	if ($('select[name=\'payment\'] option:selected').attr('value')) {
			// 		$('input[name=\'payment_method\']').attr('value', $('select[name=\'payment\'] option:selected').text());
			// 	} else {
			// 		$('input[name=\'payment_method\']').attr('value', '');
			// 	}
				
			// 	$('input[name=\'payment_code\']').attr('value', $('select[name=\'payment\'] option:selected').attr('value'));
			// }	
		},
		error: function(xhr, ajaxOptions, thrownError) {

			console.log(thrownError, xhr.statusText, xhr.responseText);
		}
	});	

  clearinput();

});
//--></script> 
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--

  $("select[type='product']").change(function(){
    var product_id = $("select[type='product'] option:selected").val();
    var product = $("select[type='product'] option:selected").text();
    $("input[name='product_id']").val(product_id)
    $("input[name='product']").val(product)
  });

// $('.date').datepicker({dateFormat: 'yy-mm-dd'});
// $('.datetime').datetimepicker({
// 	dateFormat: 'yy-mm-dd',
// 	timeFormat: 'h:m'
// });
// $('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();

$('.price').live('keyup', function(e){
  
  if (e.keyCode == 13) {
    clearinput();
  $('#button-product').click()

  }
  
  // change product total
  // var val = $(this).val();
  // $(this).parent().next().children().val(val);
    
  // change total logic  

  
});

//--></script> 
<?php echo $footer; ?>