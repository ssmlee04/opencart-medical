<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/user.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
        <tr>
              <td><?php echo $entry_default_store; ?></td>
              <td>
                <select name="store_id" class='defaultstore'>
                  <option value=''><?php echo $text_select; ?></option>
                  <?php foreach ($stores as $store) { ?>
                  <?php if ($store['store_id'] == $defaultstore) { ?>
                  <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                <?php if ($error_store) { ?>
                  <span class="error"><?php echo $error_store; ?></span>
                  <?php } ?>
              </td>
            </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_message; ?></td>
            <td><input type="text" name="message" value="<?php echo $message; ?>" />
              <?php if ($error_message) { ?>
              <span class="error"><?php echo $error_message; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_user; ?></td>
            <td><select name='user_id'>
              <option></option>
              <?php foreach ($users as $user) { ?>
                <option value='<?php echo $user['user_id']; ?>'><?php echo $user['fullname']; ?></option>
              <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_date_expensed; ?></td>
            <td><input type='date_available' name='date_expensed'/></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 


<script type='text/javascript'>

$('#stores div img').live('click', function() {
  $(this).parent().remove();
  
  $('#store div:odd').attr('class', 'odd');
  $('#store div:even').attr('class', 'even');  
});

// Category
$('input[name=\'store\']').autocomplete({
  delay: 500,
  source: function(request, response) {

    $.ajax({
      url: 'index.php?route=setting/store/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {   
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.store_id
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('#store' + ui.item.value).remove();
    
    $('#stores').append('<div id="store' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="store[]" value="' + ui.item.value + '" /></div>');

    $('#store div:odd').attr('class', 'odd');
    $('#store div:even').attr('class', 'even');
        
    return false;
  },
  focus: function(event, ui) {
      return false;
   }
});

</script>