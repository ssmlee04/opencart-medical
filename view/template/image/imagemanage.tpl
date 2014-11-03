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
          <td><input type="customer" name="filter_customer" value="<?php echo $filter_customer; ?>" /></td>
          <td>
            <!-- <select type='product' name='filter_treatment' alt='2'></select> -->
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
            <input type="date_available" name="filter_date_added_start" value="<?php echo $filter_date_added_start; ?>" size="12" class="date" />  ~
            <input type="date_available" name="filter_date_added_end" value="<?php echo $filter_date_added_end; ?>" size="12" class="date" />
          </td>
<!--           <td>
            <input type="text" name="filter_date_modified_start" value="<php echo $filter_date_modified_start; ?>" size="12" class="date" /> ~ 
            <input type="text" name="filter_date_modified_end" value="<php echo $filter_date_modified_end; ?>" size="12" class="date" />
          </td>
 -->          <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
        </tr>
      </table>

      <br>
      <!-- <form action="<php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"> -->
        <div id="tab-image">
          
        <table id="images" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_image; ?></td>
              <td class="left"><?php echo $entry_comment; ?></td>
              <td class="left"><?php echo $entry_customer; ?></td>
              <td class="left"><?php echo $entry_treatment; ?></td>
              <td class="right"><?php echo $entry_date_added; ?></td>
            </tr>
          </thead>
          <?php $image_row = 0; ?>
          <?php foreach ($customer_images as $customer_image) { ?>
          <tbody id="image-row<?php echo $image_row; ?>">
            <tr>
              <td class="left"><div class="image"><img src="<?php echo $customer_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                  </div></td>
              <td class="left">
                <div style='color:black'><?php echo $customer_image['comment']; ?></div></td>
              <td class="left"><div style='color:black'><?php echo $customer_image['customer_name']; ?></div></td>
              <td class="left"><div style='color:black'><?php echo $customer_image['product_name']; ?></div></td>
              <td class="right">
                <div style='color:black'><?php echo $customer_image['date_added']; ?></div>
                <input style='display:none' type="date_available" name="customer_image[<?php echo $image_row; ?>][date_added]" value="<?php echo $customer_image['date_added']; ?>" class="date"/>
              </td>
            </tr>
          </tbody>
          <?php $image_row++; ?>
          <?php } ?>
        </table>

          <a id="button-image" class="button"></a>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
<div class="pagination"><?php echo $pagination; ?></div>
<link rel="stylesheet" href="view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script> 
<script type="text/javascript"><!--

$(document).ready(function(){
  $(".group1").colorbox({rel:'group1'});
});


// $('.date').datepicker({dateFormat: 'yy-mm-dd'});
// $('.datetime').datetimepicker({
//   dateFormat: 'yy-mm-dd',
//   timeFormat: 'h:m'
// });
// $('.time').timepicker({timeFormat: 'h:m'});

//--></script> 
<script type="text/javascript"><!--


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

  var filter_customer = $('input[name=\'filter_customer\']').attr('value');
  
  if (filter_customer != '*') {
    url += '&filter_customer=' + encodeURIComponent(filter_customer);
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



$.widget('custom.catcomplete', $.ui.autocomplete, {
  _renderMenu: function(ul, items) {
    var self = this, currentCategory = '';
    
    $.each(items, function(index, item) {
      if (item.category != currentCategory) {
        ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
        
        currentCategory = item.category;
      }
      
      self._renderItem(ul, item);
    });
  }
});

$('input[name=\'filter_name\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        response($.map(json, function(item) {
          return {
            label: item['fullname'] + ' ' + item['ssn'],
            value: item['customer_id'],
            fullname: item['fullname']
          }
        }));
      }
    });
  }, 
  select: function(event, ui) { 
    $('input[name=\'filter_name\']').attr('value', ui.item['fullname']);
    $('input[name=\'filter_customer_id\']').attr('value', ui.item['value']);    
    return false; 
  },
  focus: function(event, ui) {
        return false;
    }
});

$('input').on('keypress', function(e){
  if (e.keyCode == 13) {
    filter();
  }
  $(this).val('');
});
$("input[name='filter_name']").on('keydown', function(e){
  if (e.keyCode == 8) {
    $("input[name='filter_customer_id']").val('');
  }
});
//--></script> 

<?php echo $footer; ?>