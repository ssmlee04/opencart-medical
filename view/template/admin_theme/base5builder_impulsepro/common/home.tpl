<?php echo $header; ?>
<div id="content">
	
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<div id = 'notification'></div>
	<?php if ($error_install) { ?>
	<div class="warning"><?php echo $error_install; ?></div>
	<?php } ?>
	<?php if ($error_image) { ?>
	<div class="warning"><?php echo $error_image; ?></div>
	<?php } ?>
	<?php if ($error_image_cache) { ?>
	<div class="warning"><?php echo $error_image_cache; ?></div>
	<?php } ?>
	<?php if ($error_cache) { ?>
	<div class="warning"><?php echo $error_cache; ?></div>
	<?php } ?>
	<?php if ($error_download) { ?>
	<div class="warning"><?php echo $error_download; ?></div>
	<?php } ?>
	<?php if ($error_logs) { ?>
	<div class="warning"><?php echo $error_logs; ?></div>
	<?php } ?>
	<div class="box">
		<div class="heading">
			<h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-dashboard-large.png" alt="" /> <?php echo $heading_title; ?></h1>
		</div>
		<div class="content">
			<div class="dashboard-top">
				
				<?php if ($user_group_id == 1) { ?>
				<div class="statistic">
					<div class="range clearfix">
						<div class="range-label"><?php echo $entry_range; ?></div>
						<select id="range">
							<option value="day"><?php echo $text_day; ?></option>
							<option value="week"><?php echo $text_week; ?></option>
							<option value="month"><?php echo $text_month; ?></option>
							<option value="year"><?php echo $text_year; ?></option>
						</select>
					</div>
					<div class="dashboard-heading"><?php echo $text_statistics; ?></div>
					<div class="dashboard-content">
						<div class="sales-customer-legend clearfix">
							<div class="sales-customer-legend-box stat-1">
								<div class="sales-customer-legend-color">
									<div class="legend-color-box"></div>
								</div>
								<div class="sales-customer-legend-text"><?php echo $text_total_order; ?></div>
							</div>
							<div class="sales-customer-legend-box stat-2">
								<div class="sales-customer-legend-color">
									<div class="legend-color-box"></div>
								</div>
								<div class="sales-customer-legend-text"><?php echo $text_total_customer; ?></div>
							</div>
						</div>
						<div id="report">
							<div id="sales-customer-graph"></div>
						</div>
					</div>
				</div>
				<div class="overview">
					<div class="dashboard-heading"><?php echo $text_overview; ?></div>
					<div class="dashboard-content">
						<div class="dashboard-overview-top clearfix">
							<div class="sales-value-graph">
								<input id="total_sale_raw" type="hidden" value="<?php echo substr($total_sale_raw, 0, -2); ?>" data-text_label="<?php echo $text_total_sale; ?>" data-currency_value="<?php echo $total_sale; ?>" />
								<input id="total_sale_year_raw" type="hidden" value="<?php echo substr($total_sale_year_raw, 0, -2); ?>" data-text_label="<?php echo $text_total_sale_year; ?>" data-currency_value="<?php echo $total_sale_year; ?>" />
								<input id="total_sales_previous_years_raw" type="hidden" value="<?php echo $total_sales_previous_years_raw; ?>" data-text_label="<?php echo $text_total_sales_previous_years; ?>" data-currency_value="<?php echo $total_sales_previous_years; ?>" />

								<div id="sales-value-graph"></div>
							</div>
							<div class="sales-value-legend">
								<div class="sales-this-year">
									<div class="number-stat-legend-color">
										<div class="legend-color-box"></div>
									</div>
									<div class="number-stat-number"><?php echo $total_sale_year; ?></div>
									<div class="number-stat-text"><?php echo $text_total_sale_year; ?></div>
								</div>
								<div class="sales-previous-years">
									<div class="number-stat-legend-color">
										<div class="legend-color-box"></div>
									</div>
									<div class="number-stat-number"><?php echo $total_sales_previous_years; ?></div>
									<div class="number-stat-text"><?php echo $text_total_sales_previous_years; ?></div>
								</div>
								<div class="sales-total">
									<div class="number-stat-legend-color">
										<div class="legend-color-box"></div>
									</div>
									<div class="number-stat-number"><?php echo $total_sale; ?></div>
									<div class="number-stat-text"><?php echo $text_total_sale; ?></div>
								</div>
							</div>
						</div>
						<div class="dashboard-overview-bottom clearfix">
							<div class="number-stat-box stat-1">
								<div class="number-stat-number"><?php echo number_format($total_order); ?></div>
								<div class="number-stat-text"><?php echo $text_total_order; ?></div>
							</div>
							<div class="number-stat-box stat-2">
								<div class="number-stat-number"><?php echo number_format($total_customer); ?></div>
								<div class="number-stat-text"><?php echo $text_total_customer; ?></div>
							</div>
							<div class="number-stat-box stat-3">
								<div class="number-stat-number"><?php echo number_format($total_review); ?></div>
								<div class="number-stat-text"><?php echo $text_total_review; ?></div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>
			<div class="dashboard-bottom">
				
				<?php if ($user_group_id == 1) { ?>
				<div class="latest">
					<div class="dashboard-heading"><?php echo $text_latest_10_orders; ?></div>
					<div class="dashboard-content">
						<table class="list">
							<thead>
								<tr>
									<td class="right"><?php echo $column_order; ?></td>
									<td class="left"><?php echo $column_customer; ?></td>
									<td class="left"><?php echo $column_status; ?></td>
									<td class="left"><?php echo $column_date_added; ?></td>
									<td class="right"><?php echo $column_total; ?></td>
									<td class="right"><?php echo $column_action; ?></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($orders) { ?>
								<?php foreach ($orders as $order) { ?>
								<tr>
									<td class="right"><?php echo $order['order_id']; ?></td>
									<td class="left"><?php echo $order['customer']; ?></td>
									<td class="left"><?php echo $order['status']; ?></td>
									<td class="left"><?php echo $order['date_added']; ?></td>
									<td class="right"><?php echo $order['total']; ?></td>
									<td class="right"><?php foreach ($order['action'] as $action) { ?>
										[ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
										<?php } ?></td>
									</tr>
									<?php } ?>
									<?php } else { ?>
									<tr>
										<td class="center" colspan="6"><?php echo $text_no_results; ?></td>
									</tr>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } else { ?>
				<div class="">
					<div class="dashboard-heading"><?php echo $text_latest_messages; ?></div>
					<div class="dashboard-content">
						<table class="list">
							<thead>
								<tr>
									<td class="left"><?php echo $column_customer; ?></td>
									<td class="left"><?php echo $column_date_added; ?></td>
									<td class="right"><?php echo $column_message; ?></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($messages) { ?>
								<?php foreach ($messages as $message) { ?>
								<tr class='r<?php echo $message['customer_history_id']; ?>'>
									<td class="left"><input type='hidden' value='<?php echo $message['customer_history_id']; ?>'/><?php echo $message['customer_id']; ?></td>
									
									<td class="left"><?php echo $message['reminder_date']; ?></td>


									<td class="right">

										<select id="reminder_class">
											<option></option>
											<?php foreach ($reminder_classes as $reminder_class) { ?>
											<option value="<?php echo $reminder_class['reminder_status_id']; ?>"><?php echo $reminder_class['name']; ?></option>
											<?php } ?>
										</select>
										<button id='<?php echo $message['customer_history_id']; ?>' class='updatehistory'><?php echo $button_record_history; ?></button>
									</td>
									</tr>
									<tr class='r<?php echo $message['customer_history_id']; ?>'>
										<td class="left" colspan='3'><?php echo $message['comment']; ?></td>
									</tr>
									<tr class='r<?php echo $message['customer_history_id']; ?>'><td colspan='3' style='background-color:lightgray'></td></tr>
									<?php } ?>
									<?php } else { ?>
									<tr>
										<td class="center" colspan="3"><?php echo $text_no_results; ?></td>
									</tr>

								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } ?>
				<!-- <div class="other-stats">
					<div class="dashboard-heading"><php echo $text_other_stats; ?></div>
					<div class="dashboard-content">
						<div class="other-stats-box stat-1">
							<div class="other-stat-number"><php echo number_format($total_customer_approval); ?></div>
							<div class="other-stat-text"><php echo $text_total_customer_approval; ?></div>
						</div>
						<div class="other-stats-box stat-2">
							<div class="other-stat-number"><php echo number_format($total_review_approval); ?></div>
							<div class="other-stat-text"><php echo $text_total_review_approval; ?></div>
						</div>
						<div class="other-stats-box stat-3">
							<div class="other-stat-number"><php echo number_format($total_affiliate); ?></div>
							<div class="other-stat-text"><php echo $text_total_affiliate; ?></div>
						</div>
						<div class="other-stats-box stat-4">
							<div class="other-stat-number"><php echo number_format($total_affiliate_approval); ?></div>
							<div class="other-stat-text"><php echo $text_total_affiliate_approval; ?></div>
						</div>
					</div>
				</div> -->
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
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