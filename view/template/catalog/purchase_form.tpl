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
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="vtabs" class="vtabs"><a href="#tab-general"><?php echo $tab_general; ?></a>
        <a href="#tab-product"><?php echo $tab_product; ?></a>
      
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general" class="vtabs-content">
          <table class="form">
            <tr>
              <td class="left"><?php echo $entry_date; ?></td>
              <td class="left"><input type='date_available' name='date_added' class='date'/></td>
              <!-- <td class="left"><a name='set_today'><php echo $text_today; ?></a></td> -->
            </tr>

            <tr>
              <td class="left"><?php echo $entry_store; ?></td>
              <td class="left"><select name="store_id" class='store_id'>
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
              <td class="left"><select name="user_id" class='user_id'>
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
            <tr>
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
                <td class="center" style="width: 3px;"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$('#product-row<?php echo $product_row; ?>').remove(); $('#button-update').trigger('click');" /></td>
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
                  <input type="hidden" name="purchase_product[<?php echo $product_row; ?>][total]" value="<?php echo $purchase_product['total']; ?>" />
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
          <table class="list">
            <thead>
              <tr>
                <td colspan="2" class="left"><?php echo $text_product; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><?php echo $entry_product; ?></td>
                <td class="left"><input type="text" name="product" value="" />
                  <input type="hidden" name="product_id" value="" /></td>
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
        
        
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--

// $('a[name=\'set_today\']').on('click', function(){
//   alert(123);
//   $('input[name=\'product\']').val('01/01/2014');
//   $('input[name=\'date_added\']').val('01/01/2014');
// alert(234);
// })
    


$.widget('custom.catcomplete', $.ui.autocomplete, {
  _renderMenu: function(ul, items) {
    var self = this, currentCategory = '';
    
    $.each(items, function(index, item) {
      if (item['category'] != currentCategory) {
        ul.append('<li class="ui-autocomplete-category">' + item['category'] + '</li>');
        
        currentCategory = item['category'];
      }
      
      self._renderItem(ul, item);
    });
  }
});

$('input[name=\'user\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=sale/user/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        response($.map(json, function(item) {
          return {
            category: item['user_group'],
            label: item['name'],
            value: item['user_id'],
            user_group_id: item['user_group_id'],
            firstname: item['firstname'],
            lastname: item['lastname'],
            email: item['email'],
            telephone: item['telephone'],
            fax: item['fax'],
            address: item['address']
          }
        }));
      }
    });
  }, 
  select: function(event, ui) { 
    $('input[name=\'user\']').attr('value', ui.item['label']);
    $('input[name=\'user_id\']').attr('value', ui.item['value']);
    $('input[name=\'firstname\']').attr('value', ui.item['firstname']);
    $('input[name=\'lastname\']').attr('value', ui.item['lastname']);
    $('input[name=\'email\']').attr('value', ui.item['email']);
    $('input[name=\'telephone\']').attr('value', ui.item['telephone']);
    $('input[name=\'fax\']').attr('value', ui.item['fax']);
      
    html = '<option value="0"><?php echo $text_none; ?></option>'; 
      
    for (i in  ui.item['address']) {
      html += '<option value="' + ui.item['address'][i]['address_id'] + '">' + ui.item['address'][i]['firstname'] + ' ' + ui.item['address'][i]['lastname'] + ', ' + ui.item['address'][i]['address_1'] + ', ' + ui.item['address'][i]['city'] + ', ' + ui.item['address'][i]['country'] + '</option>';
    }
    
    $('select[name=\'shipping_address\']').html(html);
    $('select[name=\'payment_address\']').html(html);
    
    $('select[id=\'user_group_id\']').attr('disabled', false);
    $('select[id=\'user_group_id\']').attr('value', ui.item['user_group_id']);
    $('select[id=\'user_group_id\']').trigger('change');
    $('select[id=\'user_group_id\']').attr('disabled', true); 
            
    return false; 
  },
  focus: function(event, ui) {
        return false;
    }
});

//--></script> 
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocompletestockables&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.product_id,
            model: item.model,
            option: item.option,
            cost: item.cost
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('input[name=\'product\']').attr('value', ui.item['label']);
    $('input[name=\'product_id\']').attr('value', ui.item['value']);
    return false;
  },
  focus: function(event, ui) {
        return false;
    }
}); 
//--></script> 
<script type="text/javascript"><!--

var product_row = '<?php echo $product_row;?>';

//var product_row = 
$('#button-product, #button-voucher, #button-update').live('click', function() {  

  $('.success, .warning, .attention, .error').remove();

  var product = $('input[name=\'product\']').val();
  var product_id = $('input[name=\'product_id\']').val();
  var quantity = $('input[name=\'quantity\']').val();
  var cost = $('input[name=\'cost\']').val();
  var total = cost * quantity;

  var match = false;
  $('.list').eq(0).find('tr').map(function(inx,val){
      var cell1 = $(val).find('td').eq(1).find('input').eq(1).attr('value');  
      if (cell1 == product_id) match = true;
  });

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
          if (json['success']) {
            product_row++;
            var html = '<tr>';
            html += '<td class="center" style="width: 3px;"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove();" /></td>';

            html += "<td class=\"left\">" + product + "<input type='hidden' name=\"purchase_product[" + product_row + "][purchase_product_id]\" value='' /><input type='hidden' name=\"purchase_product[" + product_row + "][product_id]\" value='" + product_id + "' /><input type='hidden' name=\"purchase_product[" + product_row + "][name]\" value='" + product + "' /></td>";
            html += "<td class=\"right\">" + quantity + "<input type='hidden' name=\"purchase_product[" + product_row + "][quantity]\" value='" + quantity + "' /></td>";
            html += "<td class=\"right\">" + cost + "<input type='hidden' name=\"purchase_product[" + product_row + "][cost]\" value='" + cost + "' /></td>";
            html += "<td class=\"right\">" + total + "<input type='hidden' name=\"purchase_product[" + product_row + "][total]\" value='" + total + "' /></td>";
            html += '</tr>';
            $('tbody#product').append(html);
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
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--

$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script> 
<?php echo $footer; ?>