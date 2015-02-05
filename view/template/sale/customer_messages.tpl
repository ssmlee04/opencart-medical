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
				<td class="right"><?php echo $column_title; ?></td>
				<td class="right"><?php echo $column_user; ?></td>
				<td class="right"><?php echo $column_message; ?></td>
			</tr>
		</thead>
		<tbody>
			<tr class='r<?php echo $message['customer_history_id']; ?>'>
				<td class="left"><input type='hidden' value='<?php echo $message['customer_history_id']; ?>'/><?php echo $message['clastname'] . ' ' . $message['cfirstname']; ?></td>
				
				<td class="left"><?php echo $message['telephone']; ?></td>
				<td class="left"><?php echo $message['mobile']; ?></td>
				<td class="left"><?php echo $message['reminder_date']; ?></td>
				<td class="left"><?php echo $message['title']; ?></td>
				<td class="left"><?php echo $message['ufullname']; ?></td>
				</tr>


				<tr>
				<td class="right" colspan='7'>
					<input type='text' style="display:inline" value='<?php echo $message['reply']; ?>' size='80px'/>
					<select id="reminder_class" style="display:inline">
						<option></option>
						<?php foreach ($reminder_classes as $reminder_class) { ?>
						<option value="<?php echo $reminder_class['reminder_status_id']; ?>"><?php echo $reminder_class['name']; ?></option>
						<?php } ?>
					</select>
					<button id='<?php echo $message['customer_history_id']; ?>' class='updatehistory'><?php echo $button_record_history; ?></button>
				</td>
				</tr>
				<tr class='r<?php echo $message['customer_history_id']; ?>'>
					<td class="left" colspan='7'><?php echo $message['comment']; ?></td>
				</tr>

				<tr class='r<?php echo $message['customer_history_id']; ?>'>
					<td colspan='7' style='background-color:white'></td>
				</tr>

				<?php } ?>
				<?php } else { ?>
				<tr>
					<td class="center" colspan='7'><?php echo $text_no_results; ?></td>
				</tr>

			<?php } ?>
		</tbody>
	</table>
</div>


<script>

$('.updatehistory').on('click', function(){ 
		
		var customer_history_id = $(this).attr('id');
		var reply = $(this).prev().prev().val();
		var reminder_status_id = $(this).prev().val();

		if (reminder_status_id !== '')
		$.ajax({
		  url: 'index.php?route=sale/customer/messages&token=<?php echo $token; ?>',
		  type: 'POST',
		  dataType: 'text',
		  data: 'reminder_status_id='+reminder_status_id+'&reply='+reply+'&customer_history_id='+ customer_history_id,
		  complete: function(xhr, textStatus) {
		    //called when complete

		  },
		  success: function(data, textStatus, xhr) {
		    //called when successful
		    
		    $('.attention, .success, .warning').remove();
	    	
	    	$('.box').before('<div class="success" style="display: none;"><?php echo $text_change_status_success; ?></div>');

				$('.success').fadeIn('slow');

			setTimeout(function(){
				$('#messages').html(data);
			}, 500);

		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }
		});
	});

</script>