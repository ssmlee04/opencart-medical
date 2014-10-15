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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-settings-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			

      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            
    
            <tr>
              <td><span class="required">*</span> <?php echo $entry_name; ?></td>
              <td><input type="text" name="config_name" value="<?php echo $config_name; ?>" size="40" />
                <?php if ($error_name) { ?>
                <span class="error"><?php echo $error_name; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_owner; ?></td>
              <td><input type="text" name="config_owner" value="<?php echo $config_owner; ?>" size="40" />
                <?php if ($error_owner) { ?>
                <span class="error"><?php echo $error_owner; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_url; ?></td>
              <td><input type="text" name="config_url" value="<?php echo $config_url; ?>" size="40" />
                <?php if ($error_url) { ?>
                <span class="error"><?php echo $error_url; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_address; ?></td>
              <td><textarea name="config_address" cols="40" rows="5"><?php echo $config_address; ?></textarea>
                <?php if ($error_address) { ?>
                <span class="error"><?php echo $error_address; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_email; ?></td>
              <td><input type="text" name="config_email" value="<?php echo $config_email; ?>" size="40" />
                <?php if ($error_email) { ?>
                <span class="error"><?php echo $error_email; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_telephone; ?></td>
              <td><input type="text" name="config_telephone" value="<?php echo $config_telephone; ?>" />
                <?php if ($error_telephone) { ?>
                <span class="error"><?php echo $error_telephone; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_fax; ?></td>
              <td><input type="text" name="config_fax" value="<?php echo $config_fax; ?>" /></td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#template').load('index.php?route=setting/store/template&token=<?php echo $token; ?>&template=' + encodeURIComponent($('select[name=\'config_template\']').attr('value')));
//--></script>
<script type="text/javascript"><!--
$('select[name=\'config_country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=setting/store/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
		},		
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $config_zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'config_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'config_country_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<?php echo $footer; ?>