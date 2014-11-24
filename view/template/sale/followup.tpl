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
    	<h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
	</div>
    <div class="content">



    	<table class="list">
    		<thead><tr><td><?php echo $text_search;?></td></tr></thead>
        <tr>
          <td><?php echo $entry_date_start; ?>
            <input type="date_available" name="filter_date_start" value="<?php echo $filter_date_start; ?>" size="20" /> ~
            <input type="date_available" name="filter_date_end" value="<?php echo $filter_date_end; ?>" size="20" /></td>
            </tr><tr>
          <td><?php echo $entry_status; ?>

            <select name="filter_reminder_status_id">
              <option value="" ></option>
              <!-- 
              <option value="0" <php if ($filter_reminder_status_id == 0) { echo 'selected';} ?>><php echo $text_not_processed; ?></option>
              <option value="1" <php if ($filter_reminder_status_id == 1) { echo 'selected';} ?>><php echo $text_processed_not_finished; ?></option>
              <option value="2" <php if ($filter_reminder_status_id == 2) { echo 'selected';} ?>><php echo $text_processed_finished; ?></option> -->
              
              
              <?php foreach ($reminder_statuses as $reminder_status) { ?>
              <?php if ($reminder_status['reminder_status_id'] == $filter_reminder_status_id) { ?>
              <option value="<?php echo $reminder_status['reminder_status_id']; ?>" selected="selected"><?php echo $reminder_status['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $reminder_status['reminder_status_id']; ?>"><?php echo $reminder_status['name']; ?></option>
              <?php } ?>
              <?php } ?>

            </select></td>
            </tr><tr>
            <!-- <td><php echo $entry_consultant; ?> -->
            <!-- <input type="text" name="filter_consultant" value="<php echo $filter_consultant; ?>" id="consultant" size="12" /></td> -->
        </tr><tr>
            <td><?php echo $entry_user; ?>
            <input type="user" name="filter_user" value="<?php echo $filter_user; ?>" /><input type="hidden" name="filter_user_id" value="<?php echo $filter_user_id; ?>" id="user_id" size="12" /></td>
            </tr><tr>
			<td><?php echo $entry_customer; ?>
            <input type="customer" name="filter_customer" value="<?php echo $filter_customer; ?>" /><input type="hidden" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" id="customer_id" size="12" /></td>
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
      <br>

        <div class="">
					<div class="dashboard-heading"><?php echo $text_latest_messages; ?></div>
					<div class="dashboard-content">
						<table class="list">
								<?php if ($messages) { ?>
								<?php foreach ($messages as $message) { ?>
							<thead class='r<?php echo $message['customer_history_id']; ?>'>
								<tr>
									<td class="left"><?php echo $column_customer; ?></td>
									<td class="left"><?php echo $column_telephone; ?></td>
									<td class="left"><?php echo $column_mobile; ?></td>

									<td class="left"><?php echo $column_date_added; ?></td>
									<td class="left"><?php echo $column_treatment; ?></td>
									<td class="left"><?php echo $column_date_modified; ?></td>
									<td class="left"><?php echo $column_user; ?></td>
									<td class="right"><?php echo $column_message; ?></td>
								</tr>
							</thead>
							<tbody>
								<tr class='r<?php echo $message['customer_history_id']; ?>'>
									<td class="left"><input type='hidden' value='<?php echo $message['customer_history_id']; ?>'/><a href="<?php echo $message['href']; ?>"><?php echo $message['cfullname']; ?></a></td>
									
									<td class="left"><?php echo $message['telephone']; ?></td>
									<td class="left"><?php echo $message['mobile']; ?></td>
									<td class="left"><?php echo $message['reminder_date']; ?></td>
									<td class="left"><?php echo $message['title']; ?></td>
									<td class="left"><?php echo $message['date_modified']; ?></td>
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
										<td class="left" colspan='8'><?php echo $message['comment']; ?></td>
									</tr>
									<tr class='r<?php echo $message['customer_history_id']; ?>'><td colspan='5' style='background-color:white'></td></tr>
									<?php } ?>
									<?php } else { ?>
									<tr>
										<td class="center" colspan='8'><?php echo $text_no_results; ?></td>
									</tr>

								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="pagination"><?php echo $pagination; ?></div>
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

<script type="text/javascript">

$('#customer div img').live('click', function() {
	$(this).parent().remove();
	
	$('#customer div:odd').attr('class', 'odd');
	$('#customer div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--	


$('#product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product div:odd').attr('class', 'odd');
	$('#product div:even').attr('class', 'even');	
});

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

//--></script> 