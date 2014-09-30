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
      <div class="buttons">
        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
        <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="htabs" class="htabs"><a style="display:none" href="#tab-general"><?php echo $tab_general; ?></a>
        <?php if ($customer_id) { ?>
        <a href="#tab-history" id='tab-history-link'><?php echo $tab_history; ?></a>
        <a href="#tab-transaction" id='tab-transaction-link'><?php echo $tab_transaction; ?></a>
        <a href="#tab-lendto" id='tab-lendto-link'><?php echo $tab_lendto; ?></a>
        <a href="#tab-payment"><?php echo $tab_payment; ?></a>
        <a href="#tab-image"><?php echo $tab_image; ?></a>

        <!-- <a href="#tab-reward"><php echo $tab_reward; ?></a> -->

        <?php } ?>
        <!-- <a href="#tab-ip"><php echo $tab_ip; ?></a> -->
      </div>


      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general" >
          <div id="vtabs" class="vtabs"><a href="#tab-customer"><?php echo $tab_general; ?></a>
            

            <!-- <span id="address-add"><php echo $button_add_address; ?>&nbsp;<img src="view/image/add.png" alt="" onclick="addAddress();" /></span> --></div>
          <div id="tab-customer" class="vtabs-content">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
                <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" />
                  <?php if ($error_firstname) { ?>
                  <span class="error"><?php echo $error_firstname; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
                <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" />
                  <?php if ($error_lastname) { ?>
                  <span class="error"><?php echo $error_lastname; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_email; ?></td>
                <td><input type="text" name="email" value="<?php echo $email; ?>" />
                  <?php if ($error_email) { ?>
                  <span class="error"><?php echo $error_email; ?></span>
                  <?php  } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_telephone; ?></td>
                <td><input type="text" name="telephone" value="<?php echo $telephone; ?>" />
                  <?php if ($error_telephone) { ?>
                  <span class="error"><?php echo $error_telephone; ?></span>
                  <?php  } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_fax; ?></td>
                <td><input type="text" name="fax" value="<?php echo $fax; ?>" /></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_dob; ?></td>
                <td><input type="date_available" name="dob" class='date' value="<?php echo $dob; ?>" />
                <span class="error"><?php echo $error_dob; ?></span>
              </td>
              </tr>
              <tr>
                <td><?php echo $entry_line_id; ?></td>
                <td><input type="text" name="line_id" value="<?php echo $line_id; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_ssn; ?></td>
                <td><input type="text" name="ssn" value="<?php echo $ssn; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_nickname; ?></td>
                <td><input type="text" name="nickname" value="<?php echo $nickname; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_fb_id; ?></td>
                <td><input type="text" name="fb_id" value="<?php echo $fb_id; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_outsource; ?></td>
                <td><input type="text" name="outsource" value="<?php echo $outsource; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_counselor_id; ?></td>
                <td><input type="text" name="counselor_id" value="<?php echo $counselor_id; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_location; ?></td>
                <td><input type="text" name="location" value="<?php echo $location; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_misc; ?></td>
                <td><input type="text" name="misc" value="<?php echo $misc; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_image; ?></td>
                <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                    <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
              </tr>
              <!-- <tr>
                <td><php echo $entry_password; ?></td>
                <td><input type="password" name="password" value="<php echo $password; ?>"  />
                  <php if ($error_password) { ?>
                  <span class="error"><php echo $error_password; ?></span>
                  <php  } ?></td>
              </tr>
              <tr>
                <td><php echo $entry_confirm; ?></td>
                <td><input type="password" name="confirm" value="<php echo $confirm; ?>" />
                  <php if ($error_confirm) { ?>
                  <span class="error"><php echo $error_confirm; ?></span>
                  <php  } ?></td>
              </tr> -->
              <tr>
                <td><?php echo $entry_store; ?></td>
                <td><select name="store">
                  <option value=""></option>
                    <?php if ($stores) { ?>
                    <?php foreach ($stores as $st) { ?>
                    <?php if ($st['store_id'] == $store) { ?>
                      <option value="<?php echo $st['store_id']; ?>" selected><?php echo $st['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $st['store_id']; ?>"><?php echo $st['name']; ?></option>
                    <?php } ?>
                    

                    <?php } ?>
                    <?php } ?>
                  </select>
                  <?php if ($error_store) { ?>
                  <span class="error"><?php echo $error_store; ?></span>
                  <?php  } ?></td>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_customer_group; ?></td>
                <td><select name="customer_group_id">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td><?php echo $entry_status; ?></td>
                <td><select name="status">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              </table>
              <hr>
              <table class="form">
              <?php $address_row = 1; ?>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_address_1; ?></td>
                <td><input type="text" name="address[address_1]" value="<?php echo $address['address_1']; ?>" />
                  <?php if (isset($error_address_address_1)) { ?>
                  <span class="error"><?php echo $error_address_address_1; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_address_2; ?></td>
                <td><input type="text" name="address[address_2]" value="<?php echo $address['address_2']; ?>" /></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_city; ?></td>
                <td><input type="text" name="address[city]" value="<?php echo $address['city']; ?>" />
                  <?php if (isset($error_address_city)) { ?>
                  <span class="error"><?php echo $error_address_city; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span id="postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></td>
                <td><input type="text" name="address[postcode]" value="<?php echo $address['postcode']; ?>" /></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_country; ?></td>
                <td><select name="address[country_id]" onchange="country(this, '', '<?php echo $address['zone_id']; ?>');">
                    <option value=""><?php echo $text_select; ?></option>
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $address['country_id']) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                  <?php if (isset($error_address_country)) { ?>
                  <span class="error"><?php echo $error_address_country; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_zone; ?></td>
                <td><select name="address[zone_id]">
                  </select>
                  <?php if (isset($error_address_zone)) { ?>
                  <span class="error"><?php echo $error_address_zone; ?></span>
                  <?php } ?></td>
              </tr>
            </table>
          </div>

          
        </div>
        <?php if ($customer_id) { ?>
        
        <div id="tab-history">
          <div id="history"></div>
          <table class="form">
            <tr>
              <td><?php echo $entry_comment; ?></td>
              <td><textarea name="comment" cols="40" rows="8" style="width: 99%;"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><input type='date_available' name='reminder_date' class='date'/><span><?php echo $text_reminder; ?></span><input type='checkbox' value='1' name='reminder'/></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-history" class="button"><span><?php echo $button_add_history; ?></span></a></td>
            </tr>
          </table>
        </div>

        <div id="tab-transaction">
          <table class="form">
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="text" name="product" value="" /><input type="hidden" name="product_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_unit_used; ?></td>
              <td><input type="text" name="unitspend" value="" /></td>
            </tr>
            <!-- <tr>
              <td><php echo $entry_amount; ?></td>
              <td><input type="text" name="amount" value="" /></td>
            </tr> -->
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-transaction" class="button"><span><?php echo $button_add_transaction; ?></span></a></td>
              <!-- <td colspan="2" style="text-align: right;"><a id="button-transaction" class="button" onclick="addTransaction2();"><span><php echo $button_add_transaction2; ?></span></a></td> -->
            </tr>
          </table>
          <div id="transaction"></div>
        </div>

        <div id="tab-lendto">
          <div id="lendto"></div>
          <table class="form">
            <tr>
              <td><?php echo $entry_lendto; ?></td>
              <td><input type="text" name="lendto_customer" value="" />
                <input type="hidden" name="lendto_customer_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="text" name="lendto_product" value="" />
                <input type="hidden" name="lendto_product_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_quantity; ?></td>
              <td><input type="text" name="lendto_quantity" value="" /></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-lendto" class="button"><span><?php echo $button_lendto; ?></span></a></td>
            </tr>
          </table>
        </div>


        <div id="tab-image">
          <table id="images" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_image; ?></td>
                <td class="left"></td>
                <td class="right"></td>
              </tr>
            </thead>
            <?php $image_row = 0; ?>
            <?php foreach ($customer_images as $customer_image) { ?>
            <tbody id="image-row<?php echo $image_row; ?>">
              <tr>
                <td class="left"><div class="image"><img src="<?php echo $customer_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                    <input type="hidden" name="customer_image[<?php echo $image_row; ?>][image]" value="<?php echo $customer_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                <td class="right"><input type="text" name="customer_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $customer_image['sort_order']; ?>" size="2" /></td>
                <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $image_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>

        <!-- <div id="tab-reward">
          <table class="form">
            <tr>
              <td><php echo $entry_description; ?></td>
              <td><input type="text" name="description" value="" /></td>
            </tr>
            <tr>
              <td><php echo $entry_points; ?></td>
              <td><input type="text" name="points" value="" /></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-reward" class="button" onclick="addRewardPoints();"><span><php echo $button_add_reward; ?></span></a></td>
            </tr>
          </table>
          <div id="reward"></div>
        </div> -->
        <?php } ?>
        <!-- <div id="tab-ip">
          <table class="list">
            <thead>
              <tr>
                <td class="left"><php echo $column_ip; ?></td>
                <td class="right"><php echo $column_total; ?></td>
                <td class="left"><php echo $column_date_added; ?></td>
                <td class="right"><php echo $column_action; ?></td>
              </tr>
            </thead>
            <tbody>
              <php if ($ips) { ?>
              <php foreach ($ips as $ip) { ?>
              <tr>
                <td class="left"><a href="http://www.geoiptool.com/en/?IP=<php echo $ip['ip']; ?>" target="_blank"><hp echo $ip['ip']; ?></a></td>
                <td class="right"><a href="<php echo $ip['filter_ip']; ?>" target="_blank"><php echo $ip['total']; ?></a></td>
                <td class="left"><php echo $ip['date_added']; ?></td>
                <td class="right"><php if ($ip['ban_ip']) { ?>
                  <b>[</b> <a id="<php echo str_replace('.', '-', $ip['ip']); ?>" onclick="removeBanIP('<php echo $ip['ip']; ?>');"><php echo $text_remove_ban_ip; ?></a> <b>]</b>
                  <php } else { ?>
                  <b>[</b> <a id="<php echo str_replace('.', '-', $ip['ip']); ?>" onclick="addBanIP('<php echo $ip['ip']; ?>');"><php echo $text_add_ban_ip; ?></a> <b>]</b>
                  <php } ?></td>
              </tr>
              <php } ?>
              <php } else { ?>
              <tr>
                <td class="center" colspan="4"><php echo $text_no_results; ?></td>
              </tr>
              <php } ?>
            </tbody>
          </table>
        </div> -->
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

$('select[name=\'customer_group_id\']').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('.company-id-display').show();
		} else {
			$('.company-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('.tax-id-display').show();
		} else {
			$('.tax-id-display').hide();
		}
	}
});

$('select[name=\'customer_group_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
function country(element, index, zone_id) {

  if (element.value != '') {
		$.ajax({
			url: 'index.php?route=sale/customer/country&token=<?php echo $token; ?>&country_id=' + element.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'address[' + index + '][country_id]\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				$('.wait').remove();
			},			
			success: function(json) {

				if (json['postcode_required'] == '1') {
					$('#postcode-required' + index).show();
				} else {
					$('#postcode-required' + index).hide();
				}
				
				html = '<option value=""><?php echo $text_select; ?></option>';
				if (json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';
						
						if (json['zone'][i]['zone_id'] == zone_id) {
							html += ' selected="selected"';
						}
		
						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="0"><?php echo $text_none; ?></option>';
				}
				
				$('select[name=\'address[zone_id]\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

$('select[name$=\'[country_id]\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('#history .pagination a').live('click', function() {
	$('#history').load(this.href);
	
	return false;
});			

$('#history').load('index.php?route=sale/customer/history&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-history').bind('click', function() {
	$.ajax({
		url: 'index.php?route=sale/customer/history&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'html',
		data: 'reminder=' + $('input[name=reminder]').attr('checked') + 
          '&reminder_date=' + encodeURIComponent($('input[name=reminder_date]').val()) + '&comment=' + encodeURIComponent($('#tab-history textarea[name=\'comment\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-history').attr('disabled', true);
			$('#history').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-history').attr('disabled', false);
			$('.attention').remove();
      		$('#tab-history textarea[name=\'comment\']').val('');
		},
		success: function(html) {
			$('#history').html(html);
			
			$('#tab-history input[name=\'comment\']').val('');
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#transaction .pagination a').live('click', function() {
	$('#transaction').load(this.href);
	
	return false;
});			

$('#tab-transaction-link').on('click', function(){
  $('#button-transaction').click();
});


$('#tab-history-link').on('click', function(){
  $('textarea[name=\'comment\']').val('');
  $('#button-history').click();
});

$('#tab-lendto-link').on('click', function(){
  // $('#button-lendto').click();
});

$('#transaction').load('index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-transaction').bind('click', function() {

	$.ajax({
		url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>&show_group=1',
		type: 'post',
		dataType: 'html',
		data: 'product_id=' + encodeURIComponent($('#tab-transaction input[name=\'product_id\']').val()) + '&unitspend=' + encodeURIComponent($('#tab-transaction input[name=\'unitspend\']').val()),
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



$('#lendto').load('index.php?route=sale/customer/lendings&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-lendto').bind('click', function() {

  $.ajax({
    url: 'index.php?route=sale/customer/lendings&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
    type: 'post',
    dataType: 'html',
    data: 'lendto_customer_id=' + encodeURIComponent($('#tab-lendto input[name=\'lendto_customer_id\']').val()) + '&lendto_quantity=' + encodeURIComponent($('#tab-lendto input[name=\'lendto_quantity\']').val()) + '&lendto_product_id=' + encodeURIComponent($('#tab-lendto input[name=\'lendto_product_id\']').val()),
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-lendto').attr('disabled', true);
      $('#lendto').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-lendto').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {

      $('#lendto').html(html);

      $('#tab-lendto input[name=\'lendto_product_id\']').val('');
      $('#tab-lendto input[name=\'lendto_product\']').val('');
      $('#tab-lendto input[name=\'lendto_customer\']').val('');
      $('#tab-lendto input[name=\'lendto_customer_id\']').val('');

    }
  });
});

//--></script> 
<script type="text/javascript"><!--
// $('#reward .pagination a').live('click', function() {
// 	$('#reward').load(this.href);
	
// 	return false;
// });			

// $('#reward').load('index.php?route=sale/customer/reward&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

// function addRewardPoints() {
// 	$.ajax({
// 		url: 'index.php?route=sale/customer/reward&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
// 		type: 'post',
// 		dataType: 'html',
// 		data: 'description=' + encodeURIComponent($('#tab-reward input[name=\'description\']').val()) + '&points=' + encodeURIComponent($('#tab-reward input[name=\'points\']').val()),
// 		beforeSend: function() {
// 			$('.success, .warning').remove();
// 			$('#button-reward').attr('disabled', true);
// 			$('#reward').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
// 		},
// 		complete: function() {
// 			$('#button-reward').attr('disabled', false);
// 			$('.attention').remove();
// 		},
// 		success: function(html) {
// 			$('#reward').html(html);
								
// 			$('#tab-reward input[name=\'points\']').val('');
// 			$('#tab-reward input[name=\'description\']').val('');
// 		}
// 	});
// }

// function addBanIP(ip) {
// 	var id = ip.replace(/\./g, '-');
	
// 	$.ajax({
// 		url: 'index.php?route=sale/customer/addbanip&token=<?php echo $token; ?>',
// 		type: 'post',
// 		dataType: 'json',
// 		data: 'ip=' + encodeURIComponent(ip),
// 		beforeSend: function() {
// 			$('.success, .warning').remove();
			
// 			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');		
// 		},
// 		complete: function() {
			
// 		},			
// 		success: function(json) {
// 			$('.attention').remove();
			
// 			if (json['error']) {
// 				 $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
// 				$('.warning').fadeIn('slow');
// 			}
						
// 			if (json['success']) {
//                 $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
// 				$('.success').fadeIn('slow');
				
// 				$('#' + id).replaceWith('<a id="' + id + '" onclick="removeBanIP(\'' + ip + '\');"><?php echo $text_remove_ban_ip; ?></a>');
// 			}
// 		}
// 	});	
// }

// function removeBanIP(ip) {
// 	var id = ip.replace(/\./g, '-');
	
// 	$.ajax({
// 		url: 'index.php?route=sale/customer/removebanip&token=<?php echo $token; ?>',
// 		type: 'post',
// 		dataType: 'json',
// 		data: 'ip=' + encodeURIComponent(ip),
// 		beforeSend: function() {
// 			$('.success, .warning').remove();
			
// 			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');					
// 		},	
// 		success: function(json) {
// 			$('.attention').remove();
			
// 			if (json['error']) {
// 				 $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
// 				$('.warning').fadeIn('slow');
// 			}
			
// 			if (json['success']) {
// 				 $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
// 				$('.success').fadeIn('slow');
				
// 				$('#' + id).replaceWith('<a id="' + id + '" onclick="addBanIP(\'' + ip + '\');"><?php echo $text_add_ban_ip; ?></a>');
// 			}
// 		}
// 	});	
// };
//--></script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
  html += '  <tr>';
  html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
  html += '    <td class="right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
  html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
  html += '  </tr>';
  html += '</tbody>';
  
  $('#images tfoot').before(html);
  
  image_row++;
}
//--></script> 

<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script> 

<script type="text/javascript"><!--


$('input[name=\'product\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        
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
    
    return false;
  },
  focus: function(event, ui) {
        return false;
    }
}); 


$('input[name=\'lendto_product\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        
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
    $('input[name=\'lendto_product\']').attr('value', ui.item['label']);
    $('input[name=\'lendto_product_id\']').attr('value', ui.item['value']);
    
    return false;
  },
  focus: function(event, ui) {
        return false;
    }
}); 




$('input[name=\'lendto_customer\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        
        response($.map(json, function(item) {
          return {
            // label: item.name,
            label: item.lastname + item.firstname + ' ' + item.ssn,
            value: item.customer_id
            // option: item.option,
            // price: item.price
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('input[name=\'lendto_customer\']').attr('value', ui.item['label']);
    $('input[name=\'lendto_customer_id\']').attr('value', ui.item['value']);
    return false;
  },
  focus: function(event, ui) {
        return false;
    }
}); 

//--></script> 

<script type="text/javascript"><!--
function image_upload(field, thumb) {
  $('#dialog').remove();
  
  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      if ($('#' + field).attr('value')) {
        $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
          dataType: 'text',
          success: function(text) {
            $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
          }
        });
      }
    },  
    bgiframe: false,
    width: 800,
    height: 400,
    resizable: false,
    modal: false
  });
};


//--></script> 

<?php echo $footer; ?>