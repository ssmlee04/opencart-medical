<?php if (isset($error_warning) && $error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if (isset($success) && $success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $column_date_added; ?></td>
      <td class="left"><?php echo $column_user; ?></td>
      <td class="left"><?php echo $column_customer; ?></td>
      <td class="left"><?php echo $column_comment; ?></td>
      <td class="left"><?php echo $column_treatment; ?></td>
      <td class="left"><?php echo $column_reminder_date; ?></td>
      <td class="right"></td>
    </tr>
  </thead>
  <tbody>
    <?php $history_count = 0; ?>
    <?php if ($histories) { ?>
    <?php foreach ($histories as $history) { ?>
    <?php $history_count++; ?>
    <tr <?php if ($history_count%2) echo "class='color1'"; ?>>
      <td class="left"><?php echo $history['date_added']; ?></td>
      <td class="left"><?php echo $history['ufullname']; ?></td>
      <td class="left"><?php echo $history['cfullname']; ?></td>
      <td class="left"><?php echo $history['comment']; ?></td>
      <td class="left"><?php echo $history['title']; ?></td>
      <td class="left"><?php echo $history['reminder_date']; ?></td>
       <td class="right" style="width: 3px;">
        <div class='group12'>
        <?php if ($history['if_treatment'] != 1 && $candelete) { ?>
        <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove(); deleteCustomerHistory('<?php echo $history['customer_history_id']; ?>')" />
        <?php } ?>
        </div>
      </td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="pagination"><?php echo $pagination; ?></div>



<script type="text/javascript">  

function deleteCustomerHistory(id) {

  $.ajax({
      url: 'index.php?route=sale/customer/deletecustomerhistory&token=<?php echo $token; ?>&customer_history_id=' + id,
      type: 'post',
      data: 'customer_history_id=' + id,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {
        
        $('.attention, .success, .warning').remove();

        if (json['error']) {

          $('#history').before('<div class="warning">' + json['error'] + '</div>');
        }

        if (json['success']) {

          $('#history').before('<div class="success">' + json['success'] + '</div>');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
      } 
    });

}

</script>

