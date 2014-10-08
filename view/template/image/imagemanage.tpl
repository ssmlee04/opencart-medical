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
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="content">
      <div id="htabs" class="htabs">
        <!-- <a href="#tab-image" id='tab-image-link'><php echo $tab_image; ?></a> -->
      </div>

      <table class="list">
        <thead>
          <tr>
            <td></td>
            <td><?php echo $column_customer_id; ?></td>
            <td><?php echo $column_name; ?></td>
            <td><?php echo $column_treatment; ?></td>
            <td><?php echo $column_date_added; ?></td>
            <!-- <td><php echo $column_date_modified; ?></td> -->
            <td></td>
          </tr>
        </thead>
        <tr class="filter">
          <td></td>
          <!-- <td align="right"><input type="text" name="filter_customer_id" value="<php echo $filter_customer_id; ?>" size="4" style="text-align: right;" /></td> -->
          <td><input type="text" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" /></td>
          <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
          <td>
            <select name='filter_treatment'>
              <option></option>
              <?php if ($treatments) { ?>
              <?php foreach ($treatments as $treatment) { ?>
                <?php if ($treatment['product_id'] == $filter_treatment) { ?>
                  <option value='<?php echo $treatment['product_id'];?>' selected><?php echo $treatment['name'];?></option>
                <?php } else { ?>
                  <option value='<?php echo $treatment['product_id'];?>'><?php echo $treatment['name'];?></option>
                <?php } ?>    
              <?php } ?>
              <?php } ?>
            <!-- <input type="hidden" name="filter_treatment" value="<php echo $filter_treatment; ?>" /></td> -->
          <td>
            <input type="text" name="filter_date_added_start" value="<?php echo $filter_date_added_start; ?>" size="12" class="date" />  ~
            <input type="text" name="filter_date_added_end" value="<?php echo $filter_date_added_end; ?>" size="12" class="date" />
          </td>
<!--           <td>
            <input type="text" name="filter_date_modified_start" value="<php echo $filter_date_modified_start; ?>" size="12" class="date" /> ~ 
            <input type="text" name="filter_date_modified_end" value="<php echo $filter_date_modified_end; ?>" size="12" class="date" />
          </td>
 -->          <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
        </tr>
      </table>

      <br>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-image">
          
<table id="images" class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $entry_image; ?></td>
      <td class="left"></td>
      <td class="right"></td>
    </tr>
  </thead>
  <?php $image_row = 0; ?>
  <?php foreach ($customer_images as $customer_image) { ?>
  <tbody id="image-row<?php echo $image_row; ?>">
    <tr>
      <td class="left"><div class="image"><img src="<?php echo $customer_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
          </div></td>
      <td class="left"><?php echo $customer_image['comment']; ?></td>
      <td class="right">
        <input style='display:none' type="date_available" name="customer_image[<?php echo $image_row; ?>][date_added]" value="<?php echo $customer_image['date_added']; ?>" class="date"/><?php echo $customer_image['date_added']; ?>
      </td>
    </tr>
  </tbody>
  <?php $image_row++; ?>
  <?php } ?>
</table>


          <a id="button-image" class="button"></a>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<link rel="stylesheet" href="view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script> 
<script type="text/javascript"><!--

$(document).ready(function(){
  $(".group1").colorbox({rel:'group1'});
});

$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});

//--></script> 
<script type="text/javascript"><!--

$('#tab-images').load('index.php?route=sale/customer/images&token=<?php echo $token; ?>');

$('#button-image').bind('click', function() {

  $.ajax({
    url: 'index.php?route=sale/customer/images&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
    type: 'post',
    // dataType: 'html',
    // data: 'product_id=' + encodeURIComponent($('#tab-transaction input[name=\'product_id\']').val()) + '&unitspend=' + encodeURIComponent($('#tab-transaction input[name=\'unitspend\']').val()),
    beforeSend: function() {
      $('.success, .warning, .attention').remove();
      $('#button-image').attr('disabled', true);
      $('#tab-images').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-image').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {

      $('#tab-images').html(html);

      // $('#tab-transaction input[name=\'product_id\']').val('');
      // $('#tab-transaction input[name=\'product\']').val('');
      // $('#tab-transaction input[name=\'unitspend\']').val('');
    }
  });
});


//--></script> 

<script type="text/javascript"><!--
$('input').on('keypress', function(e){
  if (e.keyCode == 13) filter();
})

$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script> 
<script type="text/javascript"><!--

function filter() {
  url = 'index.php?route=image/imagemanage&token=<?php echo $token; ?>';
  
  var filter_customer_id = $('input[name=\'filter_customer_id\']').attr('value');
  
  if (filter_customer_id) {
    url += '&filter_customer_id=' + encodeURIComponent(filter_customer_id);
  }

  var filter_name = $('input[name=\'filter_name\']').attr('value');
  
  if (filter_name != '*') {
    url += '&filter_name=' + encodeURIComponent(filter_name);
  } 

  var filter_treatment = $('select[name=\'filter_treatment\']').attr('value');

  if (filter_treatment) {
    url += '&filter_treatment=' + encodeURIComponent(filter_treatment);
  } 

  var filter_date_added_start = $('input[name=\'filter_date_added_start\']').attr('value');
  
  if (filter_date_added_start) {
    url += '&filter_date_added_start=' + encodeURIComponent(filter_date_added_start);
  }
  
  var filter_date_added_end = $('input[name=\'filter_date_added_end\']').attr('value');
  
  if (filter_date_added_end) {
    url += '&filter_date_added_end=' + encodeURIComponent(filter_date_added_end);
  }

  // var filter_date_modified_start = $('input[name=\'filter_date_modified_start\']').attr('value');
  
  // if (filter_date_modified_start) {
  //   url += '&filter_date_modified_start=' + encodeURIComponent(filter_date_modified_start);
  // }
  
  // var filter_date_modified_end = $('input[name=\'filter_date_modified_end\']').attr('value');
  
  // if (filter_date_modified_end) {
  //   url += '&filter_date_modified_end=' + encodeURIComponent(filter_date_modified_end);
  // }

  location = url;
}

//--></script> 

<?php echo $footer; ?>