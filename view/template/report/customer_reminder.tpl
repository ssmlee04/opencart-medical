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
            <td class="left"><input type='hidden' value='<?php echo $user['user_id']; ?>'/><span class='togglethis'><?php echo $user['name']; ?></span></td>
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
              <table>
                <tr>
                  <td><?php echo $entry_customer; ?></td>
                  <td>text_message</td>
                  <td>text_message</td>
                  <td>text_message</td>
                  <td>text_message</td>
                </tr>
                <?php if ($user['reminders']) { ?>
                <?php foreach ($user['reminders'] as $reminder) { ?>
                <tr>
                  <td><?php echo $reminder['clastname'] . $reminder['cfirstname']; ?></td>
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
  //  ).click(function(){
  //   var ID = $(this).prev().attr('id');
  //   console.log($(this).prev().attr('id'));
  //   $('#r' + ID).toggle('show', function(){

  //   });
  // });
  
  $('.togglethis').one('click', function(){
    var ID = $(this).prev().val();
    $('#r' + ID).toggle('show', function(){});
  });

  // $('.togglethis').one('click', function(){
  //   var ID = $(this).prev().val();
  //   var filter_reminder_date_start = $('input[name=filter_date_start]').val();
  //   var filter_reminder_date_end = $('input[name=filter_date_end]').val();
  //   $.ajax({
  //   url: 'index.php?route=sale/customer/history&token=<?php echo $token; ?>&filter_reminder_date_start=' + filter_reminder_date_start + '&filter_reminder_date_end=' + filter_reminder_date_end,
  //   type: 'post',
  //   dataType: 'html',
  //   data: 'filter_user_id=' + ID,
  //   beforeSend: function() {
  //     // $('.success, .warning').remove();
  //     // $('#button-history').attr('disabled', true);
  //     // $('#history').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
  //   },
  //   complete: function() {
  //     // $('#button-history').attr('disabled', false);
  //     // $('.attention').remove();
  //         // $('#tab-history textarea[name=\'comment\']').val('');
  //   },
  //   success: function(html) {

  //     $('#r' + ID).html(html);
      
  //     // $('#tab-history input[name=\'comment\']').val('');
  //   }
  // });

  // });



</script>