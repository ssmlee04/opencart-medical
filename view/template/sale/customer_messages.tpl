<div class="dashboard-heading"><?php echo $text_latest_messages; ?></div>
<div class="dashboard-content">
	<table class="list">
			<?php if ($messages) { ?>
			<?php foreach ($messages as $message) { ?>
		<thead class='r<?php echo $message['customer_history_id']; ?>'>
			<tr>
				<td class="left"><?php echo $column_customer; ?></td>
				<td class="left"><?php echo $column_date_added; ?></td>
				<td class="right"><?php echo $column_user; ?></td>
				<td class="right"><?php echo $column_message; ?></td>
			</tr>
		</thead>
		<tbody>
			<tr class='r<?php echo $message['customer_history_id']; ?>'>
				<td class="left"><input type='hidden' value='<?php echo $message['customer_history_id']; ?>'/><?php echo $message['clastname'] . ' ' . $message['cfirstname']; ?></td>
				
				<td class="left"><?php echo $message['reminder_date']; ?></td>
				<td class="left"><?php echo $message['ulastname'] . ' ' . $message['ufirstname']; ?></td>


				<td class="right">

					<input type='text' value='<?php echo $message['reply']; ?>'/>

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
					<td class="left" colspan='4'><?php echo $message['comment']; ?></td>
				</tr>

				<tr class='r<?php echo $message['customer_history_id']; ?>'>
					<td colspan='4' style='background-color:white'></td>
				</tr>

				<?php } ?>
				<?php } else { ?>
				<tr>
					<td class="center" colspan='4'><?php echo $text_no_results; ?></td>
				</tr>

			<?php } ?>
		</tbody>
	</table>
</div>
