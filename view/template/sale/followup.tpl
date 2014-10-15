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
          <td colspan='2'><?php echo $entry_date_start; ?>
            <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" id="date-start" size="12" /> ~
            <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" id="date-end" size="12" /></td>
            </tr><tr>
          <td><?php echo $entry_status; ?>
            <select name="filter_reminder_status_id">
              <option value="" ></option>
              <option value="0" <?php if ($filter_reminder_status_id == 0) { echo 'selected';} ?>><?php echo $text_not_processed; ?></option>
              <option value="1" <?php if ($filter_reminder_status_id == 1) { echo 'selected';} ?>><?php echo $text_processed_not_finished; ?></option>
              <option value="2" <?php if ($filter_reminder_status_id == 2) { echo 'selected';} ?>><?php echo $text_processed_finished; ?></option>
              
              
             <!--  <php foreach ($reminder_statuses as $reminder_status) { ?>
              <php if ($reminder_status['reminder_status_id'] == $filter_reminder_status_id) { ?>
              <option value="<php echo $reminder_status['reminder_status_id']; ?>" selected="selected"><php echo $reminder_status['name']; ?></option>
              <php } else { ?>
              <option value="<php echo $reminder_status['reminder_status_id']; ?>"><php echo $reminder_status['name']; ?></option>
              <php } ?>
              <php } ?> -->

            </select></td>
            </tr><tr>
            <td><?php echo $entry_consultant; ?>
            <input type="text" name="filter_consultant" value="<?php echo $filter_consultant; ?>" id="consultant" size="12" /></td>
        </tr><tr>
            <td><?php echo $entry_user; ?>
            <input type="text" name="filter_user" value="<?php echo $filter_user; ?>" id="user" size="12" /><input type="hidden" name="filter_user_id" value="<?php echo $filter_user_id; ?>" id="user_id" size="12" /></td>
            </tr><tr>
			<td><?php echo $entry_customer; ?>
            <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" id="customer" size="12" /><input type="hidden" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" id="customer_id" size="12" /></td>
            </tr><tr>

            <td><?php echo $entry_comment; ?>
            <input type="text" name="filter_comment" value="<?php echo $filter_comment; ?>" id="comment" size="12" /></td>
            </tr><tr>

            <td><?php echo $entry_treatment; ?>
            <select name='filter_product_id'>
            	<option></option>
            	<?php foreach ($treatments as $result) { ?>
            	<?php if ($result['product_id'] == $filter_product_id) { ?>
            		<option value='<?php echo $result['product_id']; ?>' selected><?php echo $result['name']; ?></option>
            		<?php } else { ?>
            		<option value='<?php echo $result['product_id']; ?>'><?php echo $result['name']; ?></option>
            		<?php } ?>
            		option>
            	<?php } ?>
            </select>


            <!-- <input type="text" name="filter_treatment" value="<?php echo $filter_treatment; ?>" id="treatment" size="12" /><input type="hidden" name="filter_product_id" value="<?php echo $filter_product_id; ?>" id="product_id" size="12" /> -->
        </td>
            </tr><tr>

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
									<td class="left"><input type='hidden' value='<?php echo $message['customer_history_id']; ?>'/><?php echo $message['cfullname']; ?></td>
									
									<td class="left"><?php echo $message['reminder_date']; ?></td>
									<td class="left"><?php echo $message['ufullname']; ?></td>
									<td><?php echo $message['status']; ?></td>
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

<script type="text/javascript"><!--	
$('select[name=\'to\']').bind('change', function() {
	// $('#mail .to').hide();
	// $('#mail #to-' + $(this).attr('value').replace('_', '-')).show();
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


// $('input[name=\'filter_treatment\']').autocomplete({
//   delay: 500,
//   source: function(request, response) {
//     $.ajax({
//       url: 'index.php?route=catalog/product/autocompletetreatments&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
//       dataType: 'json',
//       success: function(json) { 
        
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
//     $('input[name=\'filter_treatment\']').attr('value', ui.item['label']);
//     $('input[name=\'filter_product_id\']').attr('value', ui.item['value']);
    
//     return false;
//   },
//   focus: function(event, ui) {
//         return false;
//     }
// }); 


// $('input[name=\'filter_customer\']').catcomplete({
// 	delay: 500,
// 	source: function(request, response) {
// 		$.ajax({
// 			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
// 			dataType: 'json',
// 			success: function(json) {	
// 				response($.map(json, function(item) {
// 					return {
// 						category: item.customer_group,
// 						label: item.name,
// 						value: item.customer_id
// 					}
// 				}));
// 			}
// 		});
		
// 	}, 
// 	select: function(event, ui) {
// 		$('#customer' + ui.item.value).remove();
		
// 		$('#customer').append('<div id="customer' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="customer[]" value="' + ui.item.value + '" /></div>');

// 		$('#customer div:odd').attr('class', 'odd');
// 		$('#customer div:even').attr('class', 'even');
				
// 		return false;
// 	},
// 	focus: function(event, ui) {
//       	return false;
//    	}
// });



$('input[name=\'filter_customer\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        response($.map(json, function(item) {
          return {
            label: item['fullname'] + ' ' + item['dob'],
            fullname: item['fullname'],
            value: item['customer_id']
          }
        }));
      }
    });
  }, 
  select: function(event, ui) { 
    $('input[name=\'filter_customer\']').attr('value', ui.item['fullname']);
    $('input[name=\'filter_customer_id\']').attr('value', ui.item['value']);
    return false;
  },
  focus: function(event, ui) {
    return false;
  }
});


$('input[name=\'filter_user\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=user/user/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        response($.map(json, function(item) {
          return {
            label: item['fullname'],
            fullname: item['fullname'],
            value: item['user_id']
          }
        }));
      }
    });
  }, 
  select: function(event, ui) { 
    $('input[name=\'filter_user\']').attr('value', ui.item['fullname']);
    $('input[name=\'filter_user_id\']').attr('value', ui.item['value']);
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

// $('input[name=\'products\']').autocomplete({
// 	delay: 500,
// 	source: function(request, response) {
// 		$.ajax({
// 			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
// 			dataType: 'json',
// 			success: function(json) {		
// 				response($.map(json, function(item) {
// 					return {
// 						label: item.name,
// 						value: item.product_id
// 					}
// 				}));
// 			}
// 		});
// 	}, 
// 	select: function(event, ui) {
// 		$('#product' + ui.item.value).remove();
		
// 		$('#product').append('<div id="product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product[]" value="' + ui.item.value + '" /></div>');

// 		$('#product div:odd').attr('class', 'odd');
// 		$('#product div:even').attr('class', 'even');
				
// 		return false;
// 	},
// 	focus: function(event, ui) {
//       	return false;
//    	}
// });

$('#product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product div:odd').attr('class', 'odd');
	$('#product div:even').attr('class', 'even');	
});

// function send(url) { 
// 	$('textarea[name="message"]').val(CKEDITOR.instances.message.getData());
	
// 	$.ajax({
// 		url: url,
// 		type: 'post',
// 		data: $('select, input, textarea'),		
// 		dataType: 'json',
// 		beforeSend: function() {
// 			$('#button-send').attr('disabled', true);
// 			$('#button-send').before('<span class="wait"><img src="view/image/loading.gif" alt="" />&nbsp;</span>');
// 		},
// 		complete: function() {
// 			$('#button-send').attr('disabled', false);
// 			$('.wait').remove();
// 		},				
// 		success: function(json) {
// 			$('.success, .warning, .error').remove();
			
// 			if (json['error']) {
// 				if (json['error']['warning']) {
// 					$('.box').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
			
// 					$('.warning').fadeIn('slow');
// 				}
				
// 				if (json['error']['subject']) {
// 					$('input[name=\'subject\']').after('<span class="error">' + json['error']['subject'] + '</span>');
// 				}	
				
// 				if (json['error']['message']) {
// 					$('textarea[name=\'message\']').parent().append('<span class="error">' + json['error']['message'] + '</span>');
// 				}									
// 			}			
			
// 			if (json['next']) {
// 				if (json['success']) {
// 					$('.box').before('<div class="success">' + json['success'] + '</div>');
					
// 					send(json['next']);
// 				}		
// 			} else {
// 				if (json['success']) {
// 					$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
// 					$('.success').fadeIn('slow');
// 				}					
// 			}				
// 		}
// 	});
// }
//--></script> 
<?php echo $footer; ?>
<script type="text/javascript"><!--

function filter() {
	url = 'index.php?route=sale/followup&token=<?php echo $token; ?>';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}
	
	var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}
	
	var filter_consultant = $('input[name=\'filter_consultant\']').attr('value');
	
	if (filter_consultant) {
		url += '&filter_consultant=' + encodeURIComponent(filter_consultant);
	}
	
	var filter_comment = $('input[name=\'filter_comment\']').attr('value');
	
	if (filter_comment) {
		url += '&filter_comment=' + encodeURIComponent(filter_comment);
	}
	
	// var filter_treatment = $('input[name=\'filter_treatment\']').attr('value');
	
	// if (filter_treatment) {
	// 	url += '&filter_treatment=' + encodeURIComponent(filter_treatment);
	// }

	var filter_product_id = $('select[name=\'filter_product_id\']').attr('value');
	
	if (filter_product_id) {
		url += '&filter_product_id=' + encodeURIComponent(filter_product_id);
	}

	var filter_reminder_status_id = $('select[name=\'filter_reminder_status_id\']').attr('value');
	
	if (filter_reminder_status_id) {
		url += '&filter_reminder_status_id=' + encodeURIComponent(filter_reminder_status_id);
	}

	var filter_user = $('input[name=\'filter_user\']').attr('value');
	
	if (filter_user) {
		url += '&filter_user=' + encodeURIComponent(filter_user);
	}

	var filter_customer = $('input[name=\'filter_customer\']').attr('value');
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}

	var filter_user_id = $('input[name=\'filter_user_id\']').attr('value');
	
	if (filter_user_id) {
		url += '&filter_user_id=' + encodeURIComponent(filter_user_id);
	}

	var filter_customer_id = $('input[name=\'filter_customer_id\']').attr('value');
	
	if (filter_customer_id) {
		url += '&filter_customer_id=' + encodeURIComponent(filter_customer_id);
	}

	location = url;
}

$('input').on('keypress', function(e){
	if (e.keyCode==13) filter();
});
$("input[name='filter_user']").on('keypress', function(e){
	$("input[name='filter_user_id']").val('');
});
$("input[name='filter_customer']").on('keypress', function(e){
	$("input[name='filter_customer_id']").val('');
});
//--></script> 