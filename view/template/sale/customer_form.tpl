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
      <div id="htabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a>
        <?php if ($customer_id) { ?>
        <a href="#tab-history"><?php echo $tab_history; ?></a><a href="#tab-transaction"><?php echo $tab_transaction; ?></a>

        <!-- <a href="#tab-reward"><php echo $tab_reward; ?></a> -->

        <?php } ?>
        <!-- <a href="#tab-ip"><php echo $tab_ip; ?></a> -->
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="vtabs" class="vtabs"><a href="#tab-customer"><?php echo $tab_general; ?></a>
            <?php $address_row = 1; ?>
            <?php foreach ($addresses as $address) { ?>
            <a href="#tab-address-<?php echo $address_row; ?>" id="address-<?php echo $address_row; ?>"><?php echo $tab_address . ' ' . $address_row; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('#vtabs a:first').trigger('click'); $('#address-<?php echo $address_row; ?>').remove(); $('#tab-address-<?php echo $address_row; ?>').remove(); return false;" /></a>
            <?php $address_row++; ?>
            <?php } ?>
            <span id="address-add"><?php echo $button_add_address; ?>&nbsp;<img src="view/image/add.png" alt="" onclick="addAddress();" /></span></div>
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
                <td><?php echo $entry_dob; ?></td>
                <td><input type="date" name="dob" value="<?php echo $dob; ?>" /></td>
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
                <td><?php echo $entry_newsletter; ?></td>
                <td><select name="newsletter">
                    <?php if ($newsletter) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select></td>
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
          </div>
          <?php $address_row = 1; ?>
          <?php foreach ($addresses as $address) { ?>
          <div id="tab-address-<?php echo $address_row; ?>" class="vtabs-content">
            <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo $address['address_id']; ?>" />
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][firstname]" value="<?php echo $address['firstname']; ?>" />
                  <?php if (isset($error_address_firstname[$address_row])) { ?>
                  <span class="error"><?php echo $error_address_firstname[$address_row]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][lastname]" value="<?php echo $address['lastname']; ?>" />
                  <?php if (isset($error_address_lastname[$address_row])) { ?>
                  <span class="error"><?php echo $error_address_lastname[$address_row]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_company; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][company]" value="<?php echo $address['company']; ?>" /></td>
              </tr>
              <tr class="company-id-display">
                <td><?php echo $entry_company_id; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][company_id]" value="<?php echo $address['company_id']; ?>" /></td>
              </tr>
              <tr class="tax-id-display">
                <td><?php echo $entry_tax_id; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][tax_id]" value="<?php echo $address['tax_id']; ?>" />
                  <?php if (isset($error_address_tax_id[$address_row])) { ?>
                  <span class="error"><?php echo $error_address_tax_id[$address_row]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_address_1; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][address_1]" value="<?php echo $address['address_1']; ?>" />
                  <?php if (isset($error_address_address_1[$address_row])) { ?>
                  <span class="error"><?php echo $error_address_address_1[$address_row]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_address_2; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][address_2]" value="<?php echo $address['address_2']; ?>" /></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_city; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][city]" value="<?php echo $address['city']; ?>" />
                  <?php if (isset($error_address_city[$address_row])) { ?>
                  <span class="error"><?php echo $error_address_city[$address_row]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span id="postcode-required<?php echo $address_row; ?>" class="required">*</span> <?php echo $entry_postcode; ?></td>
                <td><input type="text" name="address[<?php echo $address_row; ?>][postcode]" value="<?php echo $address['postcode']; ?>" /></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_country; ?></td>
                <td><select name="address[<?php echo $address_row; ?>][country_id]" onchange="country(this, '<?php echo $address_row; ?>', '<?php echo $address['zone_id']; ?>');">
                    <option value=""><?php echo $text_select; ?></option>
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $address['country_id']) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                  <?php if (isset($error_address_country[$address_row])) { ?>
                  <span class="error"><?php echo $error_address_country[$address_row]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_zone; ?></td>
                <td><select name="address[<?php echo $address_row; ?>][zone_id]">
                  </select>
                  <?php if (isset($error_address_zone[$address_row])) { ?>
                  <span class="error"><?php echo $error_address_zone[$address_row]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_default; ?></td>
                <td><?php if (($address['address_id'] == $address_id) || !$addresses) { ?>
                  <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" checked="checked" /></td>
                <?php } else { ?>
                <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" />
                  </td>
                <?php } ?>
              </tr>
            </table>
          </div>
          <?php $address_row++; ?>
          <?php } ?>
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
              <td colspan="2" style="text-align: right;"><a id="button-history" class="button"><span><?php echo $button_add_history; ?></span></a></td>
            </tr>
          </table>
        </div>
        <div id="tab-transaction">
          <table class="form">
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="text" name="product" value="" /><input type="hidden" name="product_id" value="46" /></td>
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
              <td colspan="2" style="text-align: right;"><a id="button-transaction" class="button" onclick="addTransaction();"><span><?php echo $button_add_transaction; ?></span></a></td>
              <!-- <td colspan="2" style="text-align: right;"><a id="button-transaction" class="button" onclick="addTransaction2();"><span><php echo $button_add_transaction2; ?></span></a></td> -->
            </tr>
          </table>
          <div id="transaction"></div>

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
<script type="text/javascript"><!--
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
				
				$('select[name=\'address[' + index + '][zone_id]\']').html(html);
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
var address_row = <?php echo $address_row; ?>;

function addAddress() {	
	html  = '<div id="tab-address-' + address_row + '" class="vtabs-content" style="display: none;">';
	html += '  <input type="hidden" name="address[' + address_row + '][address_id]" value="" />';
	html += '  <table class="form">'; 
	html += '    <tr>';
    html += '	   <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>';
    html += '	   <td><input type="text" name="address[' + address_row + '][firstname]" value="" /></td>';
    html += '    </tr>';
    html += '    <tr>';
    html += '      <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][lastname]" value="" /></td>';
    html += '    </tr>';
    html += '    <tr>';
    html += '      <td><?php echo $entry_company; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][company]" value="" /></td>';
    html += '    </tr>';	
    html += '    <tr class="company-id-display">';
    html += '      <td><?php echo $entry_company_id; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][company_id]" value="" /></td>';
    html += '    </tr>';
    html += '    <tr class="tax-id-display">';
    html += '      <td><?php echo $entry_tax_id; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][tax_id]" value="" /></td>';
    html += '    </tr>';			
    html += '    <tr>';
    html += '      <td><span class="required">*</span> <?php echo $entry_address_1; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][address_1]" value="" /></td>';
    html += '    </tr>';
    html += '    <tr>';
    html += '      <td><?php echo $entry_address_2; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][address_2]" value="" /></td>';
    html += '    </tr>';
    html += '    <tr>';
    html += '      <td><span class="required">*</span> <?php echo $entry_city; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][city]" value="" /></td>';
    html += '    </tr>';
    html += '    <tr>';
    html += '      <td><span id="postcode-required' + address_row + '" class="required">*</span> <?php echo $entry_postcode; ?></td>';
    html += '      <td><input type="text" name="address[' + address_row + '][postcode]" value="" /></td>';
    html += '    </tr>';
	html += '    <tr>';
    html += '      <td><span class="required">*</span> <?php echo $entry_country; ?></td>';
    html += '      <td><select name="address[' + address_row + '][country_id]" onchange="country(this, \'' + address_row + '\', \'0\');">';
    html += '         <option value=""><?php echo $text_select; ?></option>';
    <?php foreach ($countries as $country) { ?>
    html += '         <option value="<?php echo $country['country_id']; ?>"><?php echo addslashes($country['name']); ?></option>';
    <?php } ?>
    html += '      </select></td>';
    html += '    </tr>';
    html += '    <tr>';
    html += '      <td><span class="required">*</span> <?php echo $entry_zone; ?></td>';
    html += '      <td><select name="address[' + address_row + '][zone_id]"><option value="false"><?php echo $this->language->get('text_none'); ?></option></select></td>';
    html += '    </tr>';
	html += '    <tr>';
    html += '      <td><?php echo $entry_default; ?></td>';
    html += '      <td><input type="radio" name="address[' + address_row + '][default]" value="1" /></td>';
    html += '    </tr>';
    html += '  </table>';
    html += '</div>';
	
	$('#tab-general').append(html);
	
	$('select[name=\'address[' + address_row + '][country_id]\']').trigger('change');	
	
	$('#address-add').before('<a href="#tab-address-' + address_row + '" id="address-' + address_row + '"><?php echo $tab_address; ?> ' + address_row + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'#vtabs a:first\').trigger(\'click\'); $(\'#address-' + address_row + '\').remove(); $(\'#tab-address-' + address_row + '\').remove(); return false;" /></a>');
		 
	$('.vtabs a').tabs();
	
	$('#address-' + address_row).trigger('click');
	
	address_row++;
}
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
		data: 'comment=' + encodeURIComponent($('#tab-history textarea[name=\'comment\']').val()),
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

$('#transaction').load('index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-transaction').bind('click', function() {

	$.ajax({
		url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
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
			
			$('#tab-transaction input[name=\'amount\']').val('');
			$('#tab-transaction input[name=\'description\']').val('');
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

function addBanIP(ip) {
	var id = ip.replace(/\./g, '-');
	
	$.ajax({
		url: 'index.php?route=sale/customer/addbanip&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		data: 'ip=' + encodeURIComponent(ip),
		beforeSend: function() {
			$('.success, .warning').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');		
		},
		complete: function() {
			
		},			
		success: function(json) {
			$('.attention').remove();
			
			if (json['error']) {
				 $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
				$('.warning').fadeIn('slow');
			}
						
			if (json['success']) {
                $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
				$('.success').fadeIn('slow');
				
				$('#' + id).replaceWith('<a id="' + id + '" onclick="removeBanIP(\'' + ip + '\');"><?php echo $text_remove_ban_ip; ?></a>');
			}
		}
	});	
}

function removeBanIP(ip) {
	var id = ip.replace(/\./g, '-');
	
	$.ajax({
		url: 'index.php?route=sale/customer/removebanip&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		data: 'ip=' + encodeURIComponent(ip),
		beforeSend: function() {
			$('.success, .warning').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');					
		},	
		success: function(json) {
			$('.attention').remove();
			
			if (json['error']) {
				 $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
				$('.warning').fadeIn('slow');
			}
			
			if (json['success']) {
				 $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
				$('.success').fadeIn('slow');
				
				$('#' + id).replaceWith('<a id="' + id + '" onclick="addBanIP(\'' + ip + '\');"><?php echo $text_add_ban_ip; ?></a>');
			}
		}
	});	
};
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
    
    if (ui.item['option'] != '') {
      html = '';

      for (i = 0; i < ui.item['option'].length; i++) {
        option = ui.item['option'][i];
        
        if (option['type'] == 'select') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
        
          html += option['name'] + '<br />';
          html += '<select name="option[' + option['product_option_id'] + ']">';
          html += '<option value=""><?php echo $text_select; ?></option>';
        
          for (j = 0; j < option['option_value'].length; j++) {
            option_value = option['option_value'][j];
            
            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
            
            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }
            
            html += '</option>';
          }
            
          html += '</select>';
          html += '</div>';
          html += '<br />';
        }
        
        if (option['type'] == 'radio') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
        
          html += option['name'] + '<br />';
          html += '<select name="option[' + option['product_option_id'] + ']">';
          html += '<option value=""><?php echo $text_select; ?></option>';
        
          for (j = 0; j < option['option_value'].length; j++) {
            option_value = option['option_value'][j];
            
            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
            
            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }
            
            html += '</option>';
          }
            
          html += '</select>';
          html += '</div>';
          html += '<br />';
        }
          
        if (option['type'] == 'checkbox') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
          
          html += option['name'] + '<br />';
          
          for (j = 0; j < option['option_value'].length; j++) {
            option_value = option['option_value'][j];
            
            html += '<input type="checkbox" name="option[' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" id="option-value-' + option_value['product_option_value_id'] + '" />';
            html += '<label for="option-value-' + option_value['product_option_value_id'] + '">' + option_value['name'];
            
            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }
            
            html += '</label>';
            html += '<br />';
          }
          
          html += '</div>';
          html += '<br />';
        }
      
        if (option['type'] == 'image') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
        
          html += option['name'] + '<br />';
          html += '<select name="option[' + option['product_option_id'] + ']">';
          html += '<option value=""><?php echo $text_select; ?></option>';
        
          for (j = 0; j < option['option_value'].length; j++) {
            option_value = option['option_value'][j];
            
            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
            
            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }
            
            html += '</option>';
          }
            
          html += '</select>';
          html += '</div>';
          html += '<br />';
        }
            
        if (option['type'] == 'text') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
          
          html += option['name'] + '<br />';
          html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" />';
          html += '</div>';
          html += '<br />';
        }
        
        if (option['type'] == 'textarea') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
          
          html += option['name'] + '<br />';
          html += '<textarea name="option[' + option['product_option_id'] + ']" cols="40" rows="5">' + option['option_value'] + '</textarea>';
          html += '</div>';
          html += '<br />';
        }
        
        if (option['type'] == 'file') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
          
          html += option['name'] + '<br />';
          html += '<a id="button-option-' + option['product_option_id'] + '" class="button"><?php echo $button_upload; ?></a>';
          html += '<input type="hidden" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" />';
          html += '</div>';
          html += '<br />';
        }
        
        if (option['type'] == 'date') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
          
          html += option['name'] + '<br />';
          html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="date" />';
          html += '</div>';
          html += '<br />';
        }
        
        if (option['type'] == 'datetime') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
          
          html += option['name'] + '<br />';
          html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="datetime" />';
          html += '</div>';
          html += '<br />';           
        }
        
        if (option['type'] == 'time') {
          html += '<div id="option-' + option['product_option_id'] + '">';
          
          if (option['required']) {
            html += '<span class="required">*</span> ';
          }
          
          html += option['name'] + '<br />';
          html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="time" />';
          html += '</div>';
          html += '<br />';           
        }
      }
      
      $('#option').html('<td class="left"><?php echo $entry_option; ?></td><td class="left">' + html + '</td>');

      for (i = 0; i < ui.item.option.length; i++) {
        option = ui.item.option[i];
        
        if (option['type'] == 'file') {   
          new AjaxUpload('#button-option-' + option['product_option_id'], {
            action: 'index.php?route=sale/order/upload&token=<?php echo $token; ?>',
            name: 'file',
            autoSubmit: true,
            responseType: 'json',
            data: option,
            onSubmit: function(file, extension) {
              $('#button-option-' + (this._settings.data['product_option_id'] + '-' + this._settings.data['product_option_id'])).after('<img src="view/image/loading.gif" class="loading" />');
            },
            onComplete: function(file, json) {

              $('.error').remove();
              
              if (json['success']) {
                
                $('input[name=\'option[' + this._settings.data['product_option_id'] + ']\']').attr('value', json['file']);
              }
              
              if (json.error) {
                $('#option-' + this._settings.data['product_option_id']).after('<span class="error">' + json['error'] + '</span>');
              }
              
              $('.loading').remove(); 
            }
          });
        }
      }
      
      $('.date').datepicker({dateFormat: 'yy-mm-dd'});
      $('.datetime').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'h:m'
      });
      $('.time').timepicker({timeFormat: 'h:m'});       
    } else {
      $('#option td').remove();
    }
    
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