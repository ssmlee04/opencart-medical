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
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs">
        <a href="#tab-data"><?php echo $tab_data; ?></a>
        <a href="#tab-history"><?php echo $tab_history; ?></a>
        <!-- <a href="#tab-image"><php echo $tab_image; ?></a> -->

      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <!-- <input type='' name='type' value='<php echo $type;?>'/> -->
        <div id="tab-history">

        <h4><?php echo $text_purchase_info; ?></h4>
        <table class="list">
          <thead>
          <tr>
            <td><?php echo $text_purchase_id; ?></td>
            <td><?php echo $text_date_added; ?></td>
            <td><?php echo $text_order_total; ?></td>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($purchase_infos as $info) { ?>
            <tr>
            <td><?php echo $info['purchase_id']; ?></td>
            <td><?php echo $info['date_added']; ?></td>
            <td><?php echo $info['total']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        <br>

        <h4><?php echo $text_order_info; ?></h4>
        <table class="list">
          <thead>
          <tr>
            <td><?php echo $text_order_id; ?></td>
            <td><?php echo $text_date_added; ?></td>
            <td><?php echo $text_order_total; ?></td>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($order_infos as $info) { ?>
            <tr>
            <td><?php echo $info['order_id']; ?></td>
            <td><?php echo $info['date_added']; ?></td>
            <td><?php echo $info['total']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>

        </div>
        <div id="tab-data">
          <input type='hidden' name='product_type_id' value = '<?php echo $type; ?>'/>
          <table id="storequantity" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_store; ?></td>
                <td class="left"><?php echo $entry_quantity; ?></td>
              </tr>
            </thead>
            <?php $storequantity_row = 0; ?>
            <?php foreach ($store_quantitys as $store_quantity) { ?>
            <tbody id="storequantity-row<?php echo $storequantity_row; ?>">
              <tr>
                <td class="left"><input type="text" name="store_quantity[<?php echo $storequantity_row; ?>][name]" value="<?php echo $store_quantity['name']; ?>" disabled/>
                  <input type="hidden" name="store_quantity[<?php echo $storequantity_row; ?>][store_id]" value="<?php echo $store_quantity['store_id']; ?>" /></td>

                <td class="left">
                  <input type="number" name="store_quantity[<?php echo $storequantity_row; ?>][quantity]" value="<?php echo $store_quantity['quantity']; ?>" disabled></input><br />
                 </td>

                <!-- <td class="left" ><a onclick="$('#storequantity-row<php echo $storequantity_row; ?>').remove();" class="button"><php echo $button_remove; ?></a></td> -->
              </tr>
            </tbody>
            <?php $storequantity_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <!-- <td class="left"><a onclick="addStoreQuantity();" class="button">php echo $button_add_store_quantity; ?></a></td> -->
              </tr>
            </tfoot>
          </table>

          <table class="form">

            <?php foreach ($languages as $language) { ?>
          <tr id="language<?php echo $language['language_id']; ?>">
            
              
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              
            
          </tr>
          <?php } ?>
            <tr>
                <td><?php echo $entry_price; ?></td>
                <td><input type="text" name="price" value="<?php echo $price; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_unit_quantity; ?></td>
              <td><input type="text" name="unit_quantity" value="<?php echo $unit_quantity; ?>" size="5" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_unit_class; ?></td>
              <td><select name="unit_class_id">
                  <?php foreach ($unit_classes as $unit_class) { ?>
                  <?php if ($unit_class['unit_class_id'] == $unit_class_id) { ?>
                  <option alt="<?php echo $unit_class['value']; ?>" alt2="<?php echo $unit_class['unit']; ?>" value="<?php echo $unit_class['unit_class_id']; ?>" selected="selected"><?php echo $unit_class['value'] . $unit_class['unit']; ?></option>
                  <?php } else { ?>
                  <option alt="<?php echo $unit_class['value']; ?>" alt2="<?php echo $unit_class['unit']; ?>" value="<?php echo $unit_class['unit_class_id']; ?>"><?php echo $unit_class['value'] . $unit_class['unit']; ?></option>
                  <?php } ?>
                  <?php } ?>
                  </select>
                  <div style='display:inline'  id='unit_total'></div>
                </td>
            </tr>
            <tr>
              <td><?php echo $entry_image; ?></td>
              <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>
            <tr>
              <td><?php echo $entry_date_available; ?></td>
              <td><input type="text" name="date_available" value="<?php echo $date_available; ?>" size="12" class="date" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <?php if ($type != 1) { ?>
            <tr>
              <td><?php echo $entry_subtract; ?></td>
              <td><select name="subtract">
                  <?php if ($subtract) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <?php } ?>

            <?php if ($type == 2) { ?>
            <tr>
              <td><?php echo $entry_bonus; ?></td>
              <td><input type="checkbox" name="bonus" value="1" size="2" <?php if ($bonus) {echo 'checked';} ?> /></td>
              </tr>
            <tr class='bonusgroup'>
              <td><?php echo $entry_bonus_percent_doctor; ?></td>
              <td><input type="text" name="bonus_percent_doctor" value="<?php echo $bonus_percent_doctor; ?>" size="3"/> %</td>
              </tr>
            <tr class='bonusgroup'>
              <td><?php echo $entry_bonus_percent_consultant; ?></td>
              <td><input type="text" name="bonus_percent_consultant" value="<?php echo $bonus_percent_consultant; ?>" size="3"/> %</td>
              </tr>
            <tr class='bonusgroup'>
              <td><?php echo $entry_bonus_percent_outsource; ?></td>
              <td><input type="text" name="bonus_percent_outsource" value="<?php echo $bonus_percent_outsource; ?>" size="3"/> %</td>
              </tr>
            <tr class='bonusgroup'>
              <td><?php echo $entry_bonus_percent_beauty; ?></td>
              <td><input type="text" name="bonus_percent_beauty" value="<?php echo $bonus_percent_beauty; ?>" size="3"/> %</td>
            </tr>
            <?php } ?>

          </div>

            <tr>
              <td><?php echo $entry_reminder; ?></td>
              <td><input type="checkbox" name="reminder" value="1" size="2" <?php if ($reminder) {echo 'checked';} ?> /></td>
              <!-- <td><input type="checkbox" name="reminder" value="<php echo $reminder; ?>" size="2" /></td> -->
            </tr>
            <tr class='remindgroup'>
              <td><?php echo $entry_reminder_days; ?></td>
              <td><input type="text" name="reminder_days" value="<?php echo $reminder_days; ?>" size="3"/></td>
            </tr>
          </table>
        </div>
          

          <?php $image_row = 0; ?>
        <!-- <div id="tab-image">
          <table id="images" class="list">
            <thead>
              <tr>
                <td class="left"><php echo $entry_image; ?></td>
                <td class="right"><php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
            <php $image_row = 0; ?>
            <php foreach ($product_images as $product_image) { ?>
            <tbody id="image-row<php echo $image_row; ?>">
              <tr>
                <td class="left"><div class="image"><img src="<php echo $product_image['thumb']; ?>" alt="" id="thumb<php echo $image_row; ?>" />
                    <input type="hidden" name="product_image[<php echo $image_row; ?>][image]" value="<php echo $product_image['image']; ?>" id="image<php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<php echo $image_row; ?>', 'thumb<php echo $image_row; ?>');"><php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<php echo $image_row; ?>').attr('src', '<php echo $no_image; ?>'); $('#image<php echo $image_row; ?>').attr('value', '');"><php echo $text_clear; ?></a></div></td>
                <td class="right"><input type="text" name="product_image[<php echo $image_row; ?>][sort_order]" value="<php echo $product_image['sort_order']; ?>" size="2" /></td>
                <td class="left"><a onclick="$('#image-row<php echo $image_row; ?>').remove();" class="button"><php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <php $image_row++; ?>
            <php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addImage();" class="button"><php echo $button_add_image; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div> -->
        <!-- <div id="tab-reward">
          <table class="form">
            <tr>
              <td><php echo $entry_points; ?></td>
              <td><input type="text" name="points" value="<php echo $points; ?>" /></td>
            </tr>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td class="left"><php echo $entry_customer_group; ?></td>
                <td class="right"><php echo $entry_reward; ?></td>
              </tr>
            </thead>
            <php foreach ($customer_groups as $customer_group) { ?>
            <tbody>
              <tr>
                <td class="left"><php echo $customer_group['name']; ?></td>
                <td class="right"><input type="text" name="product_reward[<php echo $customer_group['customer_group_id']; ?>][points]" value="<php echo isset($product_reward[$customer_group['customer_group_id']]) ? $product_reward[$customer_group['customer_group_id']]['points'] : ''; ?>" /></td>
              </tr>
            </tbody>
            <php } ?>
          </table>
        </div> -->
        <!-- <div id="tab-design">
          <table class="list">
            <thead>
              <tr>
                <td class="left"><php echo $entry_store; ?></td>
                <td class="left"><php echo $entry_layout; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><php echo $text_default; ?></td>
                <td class="left"><select name="product_layout[0][layout_id]">
                    <option value=""></option>
                    <php foreach ($layouts as $layout) { ?>
                    <php if (isset($product_layout[0]) && $product_layout[0] == $layout['layout_id']) { ?>
                    <option value="<php echo $layout['layout_id']; ?>" selected="selected"><php echo $layout['name']; ?></option>
                    <php } else { ?>
                    <option value="<php echo $layout['layout_id']; ?>"><php echo $layout['name']; ?></option>
                    <php } ?>
                    <php } ?>
                  </select></td>
              </tr>
            </tbody>
            <php foreach ($stores as $store) { ?>
            <tbody>
              <tr>
                <td class="left"><php echo $store['name']; ?></td>
                <td class="left"><select name="product_layout[<php echo $store['store_id']; ?>][layout_id]">
                    <option value=""></option>
                    <php foreach ($layouts as $layout) { ?>
                    <php if (isset($product_layout[$store['store_id']]) && $product_layout[$store['store_id']] == $layout['layout_id']) { ?>
                    <option value="<php echo $layout['layout_id']; ?>" selected="selected"><php echo $layout['name']; ?></option>
                    <php } else { ?>
                    <option value="<php echo $layout['layout_id']; ?>"><php echo $layout['name']; ?></option>
                    <php } ?>
                    <php } ?>
                  </select></td>
              </tr>
            </tbody>
            <php } ?>
          </table>
        </div> -->
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
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

// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.manufacturer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'manufacturer\']').attr('value', ui.item.label);
		$('input[name=\'manufacturer_id\']').attr('value', ui.item.value);
	
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

// Category
$('input[name=\'category\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.category_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-category' + ui.item.value).remove();
		
		$('#product-category').append('<div id="product-category' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_category[]" value="' + ui.item.value + '" /></div>');

		$('#product-category div:odd').attr('class', 'odd');
		$('#product-category div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-category div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-category div:odd').attr('class', 'odd');
	$('#product-category div:even').attr('class', 'even');	
});

// Filter
$('input[name=\'filter\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.filter_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-filter' + ui.item.value).remove();
		
		$('#product-filter').append('<div id="product-filter' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_filter[]" value="' + ui.item.value + '" /></div>');

		$('#product-filter div:odd').attr('class', 'odd');
		$('#product-filter div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-filter div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-filter div:odd').attr('class', 'odd');
	$('#product-filter div:even').attr('class', 'even');	
});

// Downloads
$('input[name=\'download\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/download/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.download_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-download' + ui.item.value).remove();
		
		$('#product-download').append('<div id="product-download' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_download[]" value="' + ui.item.value + '" /></div>');

		$('#product-download div:odd').attr('class', 'odd');
		$('#product-download div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-download div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-download div:odd').attr('class', 'odd');
	$('#product-download div:even').attr('class', 'even');	
});

// Related
$('input[name=\'related\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-related' + ui.item.value).remove();
		
		$('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

		$('#product-related div:odd').attr('class', 'odd');
		$('#product-related div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-related div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-related div:odd').attr('class', 'odd');
	$('#product-related div:even').attr('class', 'even');	
});
//--></script> 

<script type="text/javascript"><!--
// var storequantity_row = <?php echo $storequantity_row; ?>;
// function addStoreQuantity() {

//   html  = '<tbody id="storequantity-row' + storequantity_row + '">';
//     html += '  <tr>';
//   html += '    <td class="left"><input type="text" name="store_quantity[' + storequantity_row + '][name]" value="" /><input type="hidden" name="store_quantity[' + storequantity_row + '][store_id]" value="" /></td>';
//   html += '    <td class="left">';
  
//   html += '<input type="text" name="store_quantity[' + storequantity_row + '][quantity]" cols="40" rows="5"></textarea><br />';

//   html += '    </td>';
//   html += '    <td class="left"><a onclick="$(\'#storequantity-row' + storequantity_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
//     html += '  </tr>';  
//     html += '</tbody>';
  
//   $('#storequantity tfoot').before(html);
  
//   storequantityautocomplete(storequantity_row);
  
//   storequantity_row++;
// }


// function attributeautocomplete(attribute_row) {
// 	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').catcomplete({
// 		delay: 500,
// 		source: function(request, response) {
// 			$.ajax({
// 				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
// 				dataType: 'json',
// 				success: function(json) {	
// 					response($.map(json, function(item) {
// 						return {
// 							category: item.attribute_group,
// 							label: item.name,
// 							value: item.attribute_id
// 						}
// 					}));
// 				}
// 			});
// 		}, 
// 		select: function(event, ui) {
// 			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
// 			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
			
// 			return false;
// 		},
// 		focus: function(event, ui) {
//       		return false;
//    		}
// 	});
// }


// function storequantityautocomplete(storequantity_row) {
//   // prepare for autocomplete

//   console.log(storequantity_row) ;
//   $('input[name=\'store_quantity[' + storequantity_row + '][name]\']').catcomplete({
//     delay: 500,
//     source: function(request, response) {
//       $.ajax({
//         url: 'index.php?route=setting/store/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
//         dataType: 'json',
//         success: function(json) {
        
//           response($.map(json, function(item) {
//             return {
//               //category: item.attribute_group,
//               label: item.name,
//               value: item.store_id
//             }
//           }));
//         }
//       });
//     }, 
//     select: function(event, ui) {
//       $('input[name=\'store_quantity[' + storequantity_row + '][name]\']').attr('value', ui.item.label);
//       $('input[name=\'store_quantity[' + storequantity_row + '][store_id]\']').attr('value', ui.item.value);
      
//       return false;
//     },
//     focus: function(event, ui) {
//           return false;
//       }
//   });
// }

$('#storequantity tbody').each(function(index, element) {
  storequantityautocomplete(index);
});

$('#attribute tbody').each(function(index, element) {
	attributeautocomplete(index);
});
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
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
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
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '    <td class="right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
	html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#images tfoot').before(html);
	
	image_row++;
}
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

<style>
.remindgroup, .bonusgroup {
  background-color: beige;
}
</style>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();


if (!$('input[name=\'reminder\']').attr('checked')) $(".remindgroup").hide();
$('input[name=\'reminder\']').on('change', function(){
  $(".remindgroup").toggle();
});

if (!$('input[name=\'bonus\']').attr('checked')) $(".bonusgroup").hide();
$('input[name=\'bonus\']').on('change', function(){
  $(".bonusgroup").toggle($(this).attr('checked'));
});

var displayunit = function(){
  var value = $('select[name="unit_class_id"]').find(":selected").attr('alt');
  var unit = $('select[name="unit_class_id"]').find(":selected").attr('alt2');
  var unit_quantity = $('input[name=unit_quantity]').val();

  var unit_id = $('select[name="unit_class_id"]').val();
  if (value && unit) {
    $('#unit_total').html('<span style="margin-left:10px">total: ' + (unit_quantity * value) + ' ' + unit + '</span>');
    console.log('<span style="margin-left:10px">(total: ' + (unit_quantity * value) + ' ' + unit + ')</span>');
  }
  // if (value && unit) $('#product_id_group').val( product_id);

  if (!$('select[name="unit_class_id"]').val()) {
    $('#unit_total').text('');
  }
}

$('select[name="unit_class_id"]').change(function(){
  displayunit();
});
$('input[name="unit_quantity"]').keyup(function(){
  displayunit();
});

//--></script>

<?php echo $footer; ?>