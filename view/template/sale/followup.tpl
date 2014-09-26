<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div id = 'notification'></div>
  <div class="box">
    <div class="heading">
      
    </div>
    <div class="content">
    	<table class="form">
        <tr>
          <td><?php echo $entry_date_start; ?>
            <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" id="date-start" size="12" /></td>
          <td><?php echo $entry_date_end; ?>
            <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" id="date-end" size="12" /></td>
          <td><?php echo $entry_status; ?>
            <select name="filter_reminder_status_id">
              <option value="0"><?php echo $text_all_status; ?></option>
              <?php foreach ($reminder_statuses as $reminder_status) { ?>
              <?php if ($reminder_status['reminder_status_id'] == $filter_reminder_status_id) { ?>
              <option value="<?php echo $reminder_status['reminder_status_id']; ?>" selected="selected"><?php echo $reminder_status['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $reminder_status['reminder_status_id']; ?>"><?php echo $reminder_status['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
            <td><?php echo $entry_consultant; ?>
            <input type="text" name="filter_consultant" value="<?php echo $filter_consultant; ?>" id="consultant" size="12" /></td>
            <td><?php echo $entry_comment; ?>
            <input type="text" name="filter_comment" value="<?php echo $filter_comment; ?>" id="comment" size="12" /></td>
            <td><?php echo $entry_treatment; ?>
            <input type="text" name="filter_treatment" value="<?php echo $filter_treatment; ?>" id="treatment" size="12" /></td>

          <td style="text-align: right;"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
        </tr>
      </table>

        <div class="">
					<div class="dashboard-heading"><?php echo $text_latest_messages; ?></div>
					<div class="dashboard-content">
						<table class="list">
								<?php if ($messages) { ?>
								<?php foreach ($messages as $message) { ?>
							<thead class='r<?php echo $message['customer_history_id']; ?>'>
								<tr>
									<td class="left"><?php echo $column_customer; ?></td>
									<td class="left"><?php echo $column_date_added; ?></td>
									<td class="left"><?php echo $column_user; ?></td>
									<td class="right"><?php echo $column_message; ?></td>
								</tr>
							</thead>
							<tbody>
								<tr class='r<?php echo $message['customer_history_id']; ?>'>
									<td class="left"><input type='hidden' value='<?php echo $message['customer_history_id']; ?>'/><?php echo $message['customer_id']; ?></td>
									
									<td class="left"><?php echo $message['reminder_date']; ?></td>
									<td class="left"><?php echo $message['ulastname'] . ' ' . $message['ufirstname']; ?></td>

									<!-- <td class="right">

										<select id="reminder_class">
											<option></option>
											<php foreach ($reminder_classes as $reminder_class) { ?>
											<option value="<php echo $reminder_class['reminder_status_id']; ?>"><php echo $reminder_class['name']; ?></option>
											<php } ?>
										</select>
										<button id='<php echo $message['customer_history_id']; ?>' class='updatehistory'><php echo $button_record_history; ?></button>
									</td> -->
									</tr>
									<tr class='r<?php echo $message['customer_history_id']; ?>'>
										<td class="left" colspan='4'><?php echo $message['comment']; ?></td>
									</tr>
									<tr class='r<?php echo $message['customer_history_id']; ?>'><td colspan='4' style='background-color:white'></td></tr>
									<?php } ?>
									<?php } else { ?>
									<tr>
										<td class="center" colspan="4"><?php echo $text_no_results; ?></td>
									</tr>

								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

    </div>
  </div>
</div>
<!-- <script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> -->
<script type="text/javascript"><!--
// CKEDITOR.replace('message', {
// 	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
// 	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
// 	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
// 	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
// 	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
// 	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
// });
//--></script> 



<script type="text/javascript"><!--	
$('select[name=\'to\']').bind('change', function() {
	$('#mail .to').hide();
	
	$('#mail #to-' + $(this).attr('value').replace('_', '-')).show();
});

$('select[name=\'to\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});

$('input[name=\'customers\']').catcomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {	
				response($.map(json, function(item) {
					return {
						category: item.customer_group,
						label: item.name,
						value: item.customer_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#customer' + ui.item.value).remove();
		
		$('#customer').append('<div id="customer' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="customer[]" value="' + ui.item.value + '" /></div>');

		$('#customer div:odd').attr('class', 'odd');
		$('#customer div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#customer div img').live('click', function() {
	$(this).parent().remove();
	
	$('#customer div:odd').attr('class', 'odd');
	$('#customer div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--	
$('input[name=\'affiliates\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/affiliate/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.affiliate_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#affiliate' + ui.item.value).remove();
		
		$('#affiliate').append('<div id="affiliate' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="affiliate[]" value="' + ui.item.value + '" /></div>');

		$('#affiliate div:odd').attr('class', 'odd');
		$('#affiliate div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#affiliate div img').live('click', function() {
	$(this).parent().remove();
	
	$('#affiliate div:odd').attr('class', 'odd');
	$('#affiliate div:even').attr('class', 'even');	
});

$('input[name=\'products\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product' + ui.item.value).remove();
		
		$('#product').append('<div id="product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product[]" value="' + ui.item.value + '" /></div>');

		$('#product div:odd').attr('class', 'odd');
		$('#product div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product div:odd').attr('class', 'odd');
	$('#product div:even').attr('class', 'even');	
});

function send(url) { 
	$('textarea[name="message"]').val(CKEDITOR.instances.message.getData());
	
	$.ajax({
		url: url,
		type: 'post',
		data: $('select, input, textarea'),		
		dataType: 'json',
		beforeSend: function() {
			$('#button-send').attr('disabled', true);
			$('#button-send').before('<span class="wait"><img src="view/image/loading.gif" alt="" />&nbsp;</span>');
		},
		complete: function() {
			$('#button-send').attr('disabled', false);
			$('.wait').remove();
		},				
		success: function(json) {
			$('.success, .warning, .error').remove();
			
			if (json['error']) {
				if (json['error']['warning']) {
					$('.box').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
			
					$('.warning').fadeIn('slow');
				}
				
				if (json['error']['subject']) {
					$('input[name=\'subject\']').after('<span class="error">' + json['error']['subject'] + '</span>');
				}	
				
				if (json['error']['message']) {
					$('textarea[name=\'message\']').parent().append('<span class="error">' + json['error']['message'] + '</span>');
				}									
			}			
			
			if (json['next']) {
				if (json['success']) {
					$('.box').before('<div class="success">' + json['success'] + '</div>');
					
					send(json['next']);
				}		
			} else {
				if (json['success']) {
					$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
					$('.success').fadeIn('slow');
				}					
			}				
		}
	});
}
//--></script> 
<?php echo $footer; ?>
<script type='text/javascript'>
	// function updateHistory() {
	$('.updatehistory').on('click', function(){
		var reminder_status_id = $(this).parent().children().first().val();
		var customer_history_id = $(this).parent().parent().children().first().children().val()
		$.ajax({
			url: 'index.php?route=sale/history/updatehistory&token=<?php echo $token; ?>&reminder_status_id=' + reminder_status_id + '&customer_history_id=' + customer_history_id,
			dataType: 'json',
			beforeSend: function() {
				// $('select[name=\'address[' + index + '][country_id]\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				// $('.wait').remove();
			},			
			success: function(json) {

				if (json['success']) {

					$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '</div>');
			                    
			        $('.success').fadeIn('slow');

			        $('html, body').animate({ scrollTop: 0 }, 'slow'); 

					setTimeout( function() {
						$('.r' + customer_history_id).remove();
			        }, 500);

				} 

				if (json['error']) {

					setTimeout( function() {

			            $('#notification').html('<div class="warning" style="display: none;">' + json['error'] + '</div>');
			                    
			            $('.warning').fadeIn('slow');

			            $('html, body').animate({ scrollTop: 0 }, 'slow'); 

			        }, 200);

				}
				// if (json['postcode_required'] == '1') {
				// 	$('#postcode-required' + index).show();
				// } else {
				// 	$('#postcode-required' + index).hide();
				// }
				
				// html = '<option value=""><?php echo $text_select; ?></option>';
				
				// if (json['zone'] != '') {
				// 	for (i = 0; i < json['zone'].length; i++) {
				// 		html += '<option value="' + json['zone'][i]['zone_id'] + '"';
						
				// 		if (json['zone'][i]['zone_id'] == zone_id) {
				// 			html += ' selected="selected"';
				// 		}
		
				// 		html += '>' + json['zone'][i]['name'] + '</option>';
				// 	}
				// } else {
				// 	html += '<option value="0"><?php echo $text_none; ?></option>';
				// }
				
				// $('select[name=\'address[' + index + '][zone_id]\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				// alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	// }
</script>