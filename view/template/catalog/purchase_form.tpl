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
  <div id = 'notification'></div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
        <?php if (!$is_insert) { ?>
        <a onclick="showhide()" class="button"><?php echo $button_edit_basic; ?></a>
        <?php } ?>
        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="vtabs" class="vtabs"><a href="#tab-general" id='tab-general-link'><?php echo $tab_general; ?></a>
        <a href="#tab-product"><?php echo $tab_product; ?></a>
      
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general" class="vtabs-content">
          
          <table class="form">
            <tr>
              <td class="left"><?php echo $entry_date; ?></td>
              <td class="left">
                <div class='group11'>
                <?php echo $date_purchased; ?>
              </div>
                <div class='group12' <?php if (!$is_insert) { echo "style='display:none'";} ?> >
                <input type='date_available' name='date_purchased' value='<?php echo $date_purchased; ?>' />  <a onclick='setToday()'><?php echo $text_today; ?></a>
              </div>
                <?php if ($error_date) { ?>
                  <span class="error"><?php echo $error_date; ?></span>
                <?php } ?></td>
              <td class="left"></td>
            </tr>

            <tr>
              <td class="left"><?php echo $entry_store; ?></td>
              <td class="left">
<!--                 <php foreach ($stores as $store) { ?>
                  <php if ($store['store_id'] == $store_id) { ?>
                  <php echo $store['name']; ?></option>
                  <php } ?>
                  <php } ?> -->

                <select name="store_id" class='store_id'>
                  <option value=''><?php echo $text_select; ?></option>
                  <?php foreach ($stores as $store) { ?>
                  <?php if ($store['store_id'] == $store_id) { ?>
                  <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                <?php if ($error_store) { ?>
                  <span class="error"><?php echo $error_store; ?></span>
                  <?php } ?></td>
            </tr>
            <tr>
              <td class="left"><?php echo $entry_user; ?></td>
              <td class="left">
                <?php foreach ($users as $user) { ?>
                  <?php if ($user['user_id'] == $user_id) { ?>
                  <?php echo $user['lastname'] . ' ' . $user['firstname']; ?></option>
                  <?php } ?>
                  <?php } ?>

                <select name="user_id" class='user_id' style='display:none'>
                  <option value=''><?php echo $text_select; ?></option>
                  <?php foreach ($users as $user) { ?>
                  <?php if ($user['user_id'] == $user_id) { ?>
                  <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['lastname'] . ' ' . $user['firstname']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $user['user_id']; ?>"><?php echo $user['lastname'] . ' ' . $user['firstname']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                <?php if ($error_user) { ?>
                  <span class="error"><?php echo $error_user; ?></span>
                  <?php } ?></td>
            </tr>
            <tr style='display:none'>
                <td class="left"><?php echo $entry_purchase_status; ?></td>
                <td class="left"><select name="purchase_status_id">
                    <?php foreach ($purchase_statuses as $purchase_status) { ?>
                    <?php if ($purchase_status['purchase_status_id'] == $purchase_status_id) { ?>
                    <option value="<?php echo $purchase_status['purchase_status_id']; ?>" selected="selected"><?php echo $purchase_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $purchase_status['purchase_status_id']; ?>"><?php echo $purchase_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>

              <tr>
                <td class="left"></td>
                <td><div class="image"><img src="<?php echo $thumb1; ?>" alt="" id="thumb1" /><br />
                    <input type="hidden" name="image1" value="<?php echo $image1; ?>" id="image1" />
 
                    <a onclick="image_upload('image1', 'thumb1');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb1').attr('src', '<?php echo $no_image; ?>'); $('#image1').attr('value', '');"><?php echo $text_clear; ?></a>
                  </div><div class="image"><img src="<?php echo $thumb2; ?>" alt="" id="thumb2" /><br />
                    <input type="hidden" name="image2" value="<?php echo $image2; ?>" id="image2" />
 
                    <a onclick="image_upload('image2', 'thumb2');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb2').attr('src', '<?php echo $no_image; ?>'); $('#image2').attr('value', '');"><?php echo $text_clear; ?></a>
                  </div></td>
                <td style='display:none'><div class="image"><img src="<?php echo $thumb3; ?>" alt="" id="thumb3" /><br />
                    <input type="hidden" name="image3" value="<?php echo $image3; ?>" id="image3" />
 
                    <a onclick="image_upload('image3', 'thumb3');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb3').attr('src', '<?php echo $no_image; ?>'); $('#image3').attr('value', '');"><?php echo $text_clear; ?></a>
                  </div></td>
              </tr>
          </table>
        </div>
        
        <div id="tab-product" class="vtabs-content">
          <table class="list">
            <thead>
              <tr>
                <td></td>
                <td class="left"><?php echo $column_product; ?></td>
                <!-- <td class="left"><php echo $column_model; ?></td> -->
                <td class="right"><?php echo $column_quantity; ?></td>
                <td class="right"><?php echo $column_cost; ?></td>
                <td class="right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <?php $product_row = 0; ?>
            <?php $option_row = 0; ?>
            <?php $download_row = 0; ?>
            <tbody id="product">
              <?php if ($purchase_products) { ?>
              <?php foreach ($purchase_products as $purchase_product) { ?>
              <tr id="product-row<?php echo $product_row; ?>">
                <td class="center" style="width: 3px;">
                  <!-- <hp if ($is_insert) { ?> -->
                  <div class='group12'>
                  <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$('#product-row<?php echo $product_row; ?>').remove(); $('#button-update').trigger('click');" />
                </div>
                  <!-- <hp } ?> -->
                </td>
                <td class="left"><?php echo $purchase_product['name']; ?><br />
                  <input type="hidden" name="purchase_product[<?php echo $product_row; ?>][purchase_product_id]" value="<?php echo $purchase_product['purchase_product_id']; ?>" />
                  <input type="hidden" name="purchase_product[<?php echo $product_row; ?>][product_id]" value="<?php echo $purchase_product['product_id']; ?>" />
                  <input type="hidden" name="purchase_product[<?php echo $product_row; ?>][name]" value="<?php echo $purchase_product['name']; ?>" />
                  
<!--<td class="left"><php echo $purchase_product['model']; ?>
                  <input type="hidden" name="purchase_product[<php echo $product_row; ?>][model]" value="<php echo $purchase_product['model']; ?>" /></td> -->
                <td class="right"><?php echo $purchase_product['quantity']; ?>
                  <input type="hidden" name="purchase_product[<?php echo $product_row; ?>][quantity]" value="<?php echo $purchase_product['quantity']; ?>" /></td>                 
                <td class="right"><?php echo $purchase_product['cost']; ?>
                  <input type="hidden" name="purchase_product[<?php echo $product_row; ?>][cost]" value="<?php echo $purchase_product['cost']; ?>" /></td>
                <td class="right"><?php echo $purchase_product['total']; ?>
                  <input type="hidden" class='total' name="purchase_product[<?php echo $product_row; ?>][total]" value="<?php echo $purchase_product['total']; ?>" />
                <!--   <input type="hidden" name="purchase_product[<php echo $product_row; ?>][tax]" value="<php echo $purchase_product['tax']; ?>" />
                  <input type="hidden" name="purchase_product[<php echo $product_row; ?>][reward]" value="<php echo $purchase_product['reward']; ?>" /> --></td>
              </tr>
              <?php $product_row++; ?>
              <?php } ?>
              <?php } else { ?>
              <tr class='noresult'>
                <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <?php if ($error_quantity) { ?>
                  <span class="error"><?php echo $error_quantity; ?></span>
                <?php } ?></td><?php if ($error_cost) { ?>
                  <span class="error"><?php echo $error_cost; ?></span>
                <?php } ?></td>

          <!-- <php if ($is_insert) { ?> -->
          <div class='group12'>
          <table class="list" >
            <thead>
              <tr>
                <td colspan="2" class="left"><?php echo $text_product; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><?php echo $entry_product; ?></td>
                <td class="left"><input type="subtractproduct" name="product" alt="1,2,3" value="" />
                  <input type="hidden" name="product_id" value="" /><select type='sellable' name="product_add" alt='1,2,3'></select>
                  </td>
              </tr>
              <!-- <tr id="option"></tr> -->
              <tr>
                <td class="left"><?php echo $entry_quantity; ?></td>
                <td class="left"><input type="text" name="quantity" value="1" /></td>
              </tr>  
              <tr>
                <td class="left"><?php echo $entry_cost; ?></td>
                <td class="left"><input type="text" name="cost" value="1" /></td>
              </tr>             
            </tbody>
            <tfoot>
              <tr>
                <td class="left">&nbsp;</td>
                <td class="left"><a id="button-product" class="button"><?php echo $button_add_purchase; ?></a></td>
              </tr>
            </tfoot>
          </table>
          </div>
          <!-- <php } ?> -->
        </div>
        

        
      </form>
    </div>
  </div>
</div>
<style>
  <?php if ($is_insert=='1') {?>
  .group11 {
    display: none; 
  }
  <?php } else { ?>
 .group12 {
    display: none; 
  }
  <?php } ?>
</style>
<script type="text/javascript"><!--


function image_upload(field, thumb) {
  $('#dialog').remove();
  
  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
          dataType: 'text',
          success: function(text) {
          
            $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
            var image = $('#' + field).attr('value');
            // var customer_transaction_id = $('#tr' + field).attr('value');
            // var customer_image_id = $('#id' + field).attr('value');
            // alert(customer_transaction_id, customer_image_id);

          }
        });
    },  
    bgiframe: false,
    width: 800,
    height: 400,
    resizable: false,
    modal: false
  });
};

$('#tab-general-link').on('click', function(){
  if ('<?php echo $is_insert; ?>' != 1) {
    $('.group12').hide();
    $('.group11').show();
  }
});

var product_row = '<?php echo $product_row;?>';

//var product_row = 
$('#button-product, #button-voucher, #button-update').live('click', function() {  

  $('.success, .warning, .attention, .error').remove();

  var product = $('input[name=\'product\']').val();
  var product_id = parseInt($('input[name=\'product_id\']').val()) || 0;
  var quantity = parseInt($('input[name=\'quantity\']').val());
  var cost = parseFloat($('input[name=\'cost\']').val());
  var total = cost * quantity;

  var match = false;
  $('.list').eq(0).find('tr').map(function(inx,val){
      var cell1 = $(val).find('td').eq(1).find('input').eq(1).attr('value');  
      if (cell1 == product_id) match = true;
  });

// console.log([product, product_id, quantity, cost, total]);
  if (quantity != parseInt(quantity)) {
    $('.box').before('<div class="warning"><?php echo $text_error; ?></div>');
  }
  else if (match) {
    $('.box').before('<div class="warning"><?php echo $text_duplicate; ?></div>');

  } else {
    $.ajax({
        url: 'index.php?route=catalog/product/productExist&token=<?php echo $token; ?>&product_id=' +  product_id + '&name=' + product,
        dataType: 'json',
        success: function(json) { 

          $('.noresult').remove();
          $('input[name=\'product\']').val('');
          $('input[name=\'cost\']').val('');
          $('input[name=\'quantity\']').val('');
          $('input[name=\'product_id\']').val('');
          if (json['success']) {

            $('#notification').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
        
            $('.success').fadeIn('slow');

            product_row++;
            var html = '<tr>';
            html += '<td class="center" style="width: 3px;"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove();" /></td>';

            html += "<td class=\"left\">" + product + "<input type='hidden' name=\"purchase_product[" + product_row + "][purchase_product_id]\" value='' /><input type='hidden' name=\"purchase_product[" + product_row + "][product_id]\" value='" + product_id + "' /><input type='hidden' name=\"purchase_product[" + product_row + "][name]\" value='" + product + "' /></td>";
            html += "<td class=\"right\">" + quantity + "<input type='hidden' name=\"purchase_product[" + product_row + "][quantity]\" value='" + quantity + "' /></td>";
            html += "<td class=\"right\">" + cost + "<input type='hidden' name=\"purchase_product[" + product_row + "][cost]\" value='" + cost + "' /></td>";
            html += "<td class=\"right\">" + total + "<input type='hidden' name='\"purchase_product[" + product_row + "][total]\"' class='total' value='" + total + "' /></td>";
            html += '</tr>';
            $('tbody#product').append(html);

            // $("input[name^= 'purchase_product']").filter($('.total')).each(function(d){
            //   alert(d)});
            // });

          } else {
            $('.box').before('<div class="warning"><?php echo $text_product_unavailable; ?></div>');
          }
          
        },
        error: function(err) {
          // console.log(err);
        }
      });
  }

}); 
//--></script> 
<script type="text/javascript" src="view/javascript/moment/moment.min.js"></script> 
<script type="text/javascript"><!--


//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();

function setToday() {
  $('input[name=\'date_purchased\']').val(moment().format("YYYY-MM-DD"));
}

var showhide = function(){
  $('.group12').toggle(); $('.group11').toggle();
};

$('select[name=\'product_add\']').on('change', function(){
  var str = $(this).find(":selected").text();
  $('input[name=product]').val(str);
});


//--></script> 
<?php echo $footer; ?>