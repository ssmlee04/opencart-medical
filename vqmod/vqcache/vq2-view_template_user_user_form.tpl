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
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-users-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			

      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_username; ?></td>
            <td><input type="text" name="username" value="<?php echo $username; ?>" />
              <?php if ($error_username) { ?>
              <span class="error"><?php echo $error_username; ?></span>
              <?php } ?></td>
          </tr>
<!--           <tr>
            <td><span class="required">*</span> <php echo $entry_firstname; ?></td>
            <td><input type="text" name="firstname" value="<php echo $firstname; ?>" />
              <php if ($error_firstname) { ?>
              <span class="error"><php echo $error_firstname; ?></span>
              <php } ?></td>
          </tr> -->
          <tr>
            <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
            <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" />
              <?php if ($error_lastname) { ?>
              <span class="error"><?php echo $error_lastname; ?></span>
              <?php } ?></td>
          </tr>
<!--           <tr>
            <td><php echo $entry_email; ?></td>
            <td><input type="text" name="email" value="<php echo $email; ?>" /></td>
          </tr> -->
          <tr>
            <td><?php echo $entry_user_group; ?></td>
            <td><select name="user_group_id">
                <?php foreach ($user_groups as $user_group) { ?>
                <?php if ($user_group['user_group_id'] == $user_group_id) { ?>
                <option value="<?php echo $user_group['user_group_id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $user_group['user_group_id']; ?>"><?php echo $user_group['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>

         
          <tr>
            <td><?php echo $entry_password; ?></td>
            <td><input type="password" name="password" />
              <?php if ($error_password) { ?>
              <span class="error"><?php echo $error_password; ?></span>
              <?php  } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_confirm; ?></td>
            <td><input type="password" name="confirm" value="" />
              <?php if ($error_confirm) { ?>
              <span class="error"><?php echo $error_confirm; ?></span>
              <?php  } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="status">
                <?php if ($status) { ?>
                <option value="0"><?php echo $text_disabled; ?></option>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <option value="1"><?php echo $text_enabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
              <td><?php echo $entry_default_store; ?></td>
              <td>
                <select name="defaultstore" class='defaultstore'>
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
              <td><?php echo $entry_store_permission; ?></td>
              <td><input type="text" name="store" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div id="stores" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($allowedstores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="store<?php echo $store['store_id']; ?>" class="<?php echo $class; ?>"><?php echo $store['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="store[]" value="<?php echo $store['store_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
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