<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-reports-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			

    </div>
    
			<div class="content sales-report">
			
      <table class="form">
        <tr>
          <td><?php echo $entry_date_start; ?>
            <input type="date_available" name="filter_date_start" value="<?php echo $filter_date_start; ?>" id="date-start" size="12" /></td>
          <td><?php echo $entry_date_end; ?>
            <input type="date_available" name="filter_date_end" value="<?php echo $filter_date_end; ?>" id="date-end" size="12" /></td>
          <!-- <td><php echo $entry_status; ?>
            <select name="filter_reminder_status_id">
              <option value=""><php echo $text_all_status; ?></option>
              <php foreach ($reminder_statuses as $reminder_status) { ?>
              <php if ($reminder_status['reminder_status_id'] === $filter_reminder_status_id) { ?>
              <option value="<php echo $reminder_status['reminder_status_id']; ?>" selected="selected"><php echo $reminder_status['name']; ?></option>
              <php } else { ?>
              <option value="<php echo $reminder_status['reminder_status_id']; ?>"><php echo $reminder_status['name']; ?></option>
              <php } ?>
              <php } ?>
            </select></td> -->
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

            <!-- <td class="right"><php echo $column_action; ?></td> -->
          </tr>
        </thead>
        <tbody>
          <?php if ($users) { ?>
          <?php foreach ($users as $user) { ?>
          <tr>
            <td class="left"><input type='hidden' value='<?php echo $user['user_id']; ?>'/><span class='togglethis'><a><?php echo $user['name']; ?></a></span></td>
            <!-- <td class="left"><php echo $user['user_group']; ?></td> -->
            <td class="right"><?php echo $user['total_reminders']; ?></td>
            <td class="right"><?php echo $user['unread_reminders']; ?></td>
            <td class="right"><?php echo $user['finished_reminders']; ?></td>

            <!-- <td class="right"><php foreach ($user['action'] as $action) { ?>
              [ <a class='toggleclass' id='<php echo $user['user_id']; ?>'><php echo $action['text']; ?></a> ]
              <php } ?></td> -->
          </tr>
          <tr><td colspan='4'>
            <div id="history<?php echo $user['user_id']; ?>"></div>
            <div class='toggle' id='r<?php echo $user['user_id']; ?>' style='display:none'>
              <table class='list'>
                <tr style='background-color:beige'>
                  <td><?php echo $entry_customer; ?></td>
                  <td><?php echo $entry_comment; ?></td>
                  <td><?php echo $entry_reply; ?></td>
                  <td><?php echo $entry_status; ?></td>
                  <td><?php echo $entry_date; ?></td>
                </tr>
                <?php if ($user['reminders']) { ?>
                <?php foreach ($user['reminders'] as $reminder) { ?>
                <tr>
                  <td><a href="<?php echo $reminder['href'];?>"><?php echo $reminder['clastname'] . $reminder['cfirstname']; ?></a></td>
                  <td><?php echo $reminder['comment']; ?></td>
                  <td><?php echo $reminder['reply']; ?></td>
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
	
	if (filter_reminder_status_id != '') {
		url += '&filter_reminder_status_id=' + encodeURIComponent(filter_reminder_status_id);
	}	

	location = url;
}
//--></script> 

<?php echo $footer; ?>

<script type='text/javascript'>
  
  $('.togglethis').on('click', function(){
    var ID = $(this).prev().val();
    $('#r' + ID).toggle('slow', function(){});
  });

</script>