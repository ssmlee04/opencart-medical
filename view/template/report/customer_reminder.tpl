<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/report.png" alt="" /> <?php echo $heading_title; ?></h1>
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
          <td style="text-align: right;"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
        </tr>
      </table>
      <table class="list">
        <thead>
          <tr>
            <td class="left"><?php echo $column_user; ?></td>
            <!-- <td class="left"><php echo $column_user_group; ?></td> -->
            <td class="right"><?php echo $column_total_reminders; ?></td>
            <td class="right"><?php echo $column_unread_reminders; ?></td>
            <td class="right"><?php echo $column_finished_reminders; ?></td>

            <td class="right"><?php echo $column_action; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php if ($users) { ?>
          <?php foreach ($users as $user) { ?>
          <tr>
            <td class="left"><input type='hidden' value='<?php echo $user['user_id']; ?>'/><?php echo $user['name']; ?></td>
            <!-- <td class="left"><php echo $user['user_group']; ?></td> -->
            <td class="right"><?php echo $user['total_reminders']; ?></td>
            <td class="right"><?php echo $user['unread_reminders']; ?></td>
            <td class="right"><?php echo $user['finished_reminders']; ?></td>

            <td class="right"><?php foreach ($user['action'] as $action) { ?>
              [ <a class='toggleclass' id='<?php echo $user['user_id']; ?>'><?php echo $action['text']; ?></a> ]
              <?php } ?></td>
          </tr>
          <tr><td colspan='5'>
            <div class='toggle' id='r<?php echo $user['user_id']; ?>' style='display:none'>
              <table>
                <?php if ($user['reminders']) { ?>
                <?php foreach ($user['reminders'] as $reminder) { ?>
                <tr>
                  <td><?php echo $reminder['clastname'] . $reminder['cfirstname']; ?></td>
                  <td><?php echo $reminder['comment']; ?></td>
                  <td><?php echo $reminder['rname']; ?></td>
                  <td><?php echo $reminder['reminder_date']; ?></td>
                </tr>
                <?php } ?>
                <?php } ?>
              </table>
            </div>
          </td></tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=report/customer_feedback&token=<?php echo $token; ?>';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}
	
	var filter_reminder_status_id = $('select[name=\'filter_reminder_status_id\']').attr('value');
	
	if (filter_reminder_status_id != 0) {
		url += '&filter_reminder_status_id=' + encodeURIComponent(filter_reminder_status_id);
	}	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date-start').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('#date-end').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script> 
<?php echo $footer; ?>

<script type='text/javascript'>
  $('.toggleclass').click(function(){
    var ID = $(this).attr('id');
    $('#r' + ID).toggle('show', function(){

    });
  });
</script>