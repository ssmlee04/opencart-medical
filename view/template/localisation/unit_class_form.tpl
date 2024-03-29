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
      <h1><img src="view/image/length.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_value; ?></td>
            <td><input type="text" name="value" value="<?php echo $value; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_title; ?></td>
            <td>
            <!-- <td><php foreach ($languages as $language) { ?> -->
              <input type="text" name="unit" value="<?php echo $unit; ?>" />
              <?php if (isset($error_unit)) { ?>
              <span class="error"><?php echo $error_unit; ?></span><br />
              <?php } ?>
              <!-- <php } ?> -->
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>