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
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-data"><?php echo $tab_data; ?></a>
        <a href="#tab-image"><?php echo $tab_image; ?></a>

      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <!-- <tr>
                <td><php echo $entry_meta_description; ?></td>
                <td><textarea name="product_description[<php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5"><php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><php echo $entry_meta_keyword; ?></td>
                <td><textarea name="product_description[<php echo $language['language_id']; ?>][meta_keyword]" cols="40" rows="5"><php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea></td>
              </tr> -->
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="product_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_tag; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['tag'] : ''; ?>" size="80" /></td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </div>
        <div id="tab-data">

          <table id="storequantity" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_store; ?></td>
                <td class="left"><?php echo $entry_quantity; ?></td>
                <td class="right"></td>
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
            <tr>
              <td><span class="required">*</span> <?php echo $entry_model; ?></td>
              <td><input type="text" name="model" value="<?php echo $model; ?>" />
                <?php if ($error_model) { ?>
                <span class="error"><?php echo $error_model; ?></span>
                <?php } ?></td>
            </tr>
            <!-- <tr>
              <td><php echo $entry_sku; ?></td>
              <td><input type="text" name="sku" value="<php echo $sku; ?>" /></td>
            </tr>
            <tr>
              <td><php echo $entry_upc; ?></td>
              <td><input type="text" name="upc" value="<php echo $upc; ?>" /></td>
            </tr>
            <tr>
              <td><php echo $entry_ean; ?></td>
              <td><input type="text" name="ean" value="<php echo $ean; ?>" /></td>
            </tr>
            <tr>
              <td><php echo $entry_jan; ?></td>
              <td><input type="text" name="jan" value="<php echo $jan; ?>" /></td>
            </tr>
            <tr>
              <td><php echo $entry_isbn; ?></td>
              <td><input type="text" name="isbn" value="<php echo $isbn; ?>" /></td>
            </tr> -->
            <!-- <tr>
              <td><php echo $entry_mpn; ?></td>
              <td><input type="text" name="mpn" value="<php echo $mpn; ?>" /></td>
            </tr> -->
            <!-- <tr>
              <td>php echo $entry_location; ?></td>
              <td><input type="text" name="location" value="<php echo $location; ?>" /></td>
            </tr> -->
            <tr>
                <td><?php echo $entry_price; ?></td>
                <td><input type="text" name="price" value="<?php echo $price; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_tax_class; ?></td>
              <td><select name="tax_class_id">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_minimum; ?></td>
              <td><input type="text" name="minimum" value="<?php echo $minimum; ?>" size="5" /></td>
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
                  <option value="<?php echo $unit_class['unit_class_id']; ?>" selected="selected"><?php echo $unit_class['unit']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $unit_class['unit_class_id']; ?>"><?php echo $unit_class['unit']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>

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
            <tr>
              <td><?php echo $entry_stock_status; ?></td>
              <td><select name="stock_status_id">
                  <?php foreach ($stock_statuses as $stock_status) { ?>
                  <?php if ($stock_status['stock_status_id'] == $stock_status_id) { ?>
                  <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_shipping; ?></td>
              <td><?php if ($shipping) { ?>
                <input type="radio" name="shipping" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="shipping" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="shipping" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="shipping" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_keyword; ?></td>
              <td><input type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>
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
              <td><?php echo $entry_dimension; ?></td>
              <td><input type="text" name="length" value="<?php echo $length; ?>" size="4" />
                <input type="text" name="width" value="<?php echo $width; ?>" size="4" />
                <input type="text" name="height" value="<?php echo $height; ?>" size="4" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_length; ?></td>
              <td><select name="length_class_id">
                  <?php foreach ($length_classes as $length_class) { ?>
                  <?php if ($length_class['length_class_id'] == $length_class_id) { ?>
                  <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_weight; ?></td>
              <td><input type="text" name="weight" value="<?php echo $weight; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_weight_class; ?></td>
              <td><select name="weight_class_id">
                  <?php foreach ($weight_classes as $weight_class) { ?>
                  <?php if ($weight_class['weight_class_id'] == $weight_class_id) { ?>
                  <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
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
            <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="2" /></td>
            </tr>
          </table>
        </div>
        
        <div id="tab-image">
          <table id="images" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_image; ?></td>
                <td class="right"><?php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $image_row = 0; ?>
            <?php foreach ($product_images as $product_image) { ?>
            <tbody id="image-row<?php echo $image_row; ?>">
              <tr>
                <td class="left"><div class="image"><img src="<?php echo $product_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                    <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                <td class="right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" size="2" /></td>
                <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $image_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
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
var attribute_row = <?php echo $attribute_row; ?>;
var storequantity_row = <?php echo $storequantity_row; ?>;

function addAttribute() {
	html  = '<tbody id="attribute-row' + attribute_row + '">';
    html += '  <tr>';
	html += '    <td class="left"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '    <td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"></textarea><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />';
    <?php } ?>
	html += '    </td>';
	html += '    <td class="left"><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '  </tr>';	
    html += '</tbody>';
	
	$('#attribute tfoot').before(html);
	
	attributeautocomplete(attribute_row);
	
	attribute_row++;
}


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


function attributeautocomplete(attribute_row) {
	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').catcomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
				dataType: 'json',
				success: function(json) {	
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		}, 
		select: function(event, ui) {
			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
			
			return false;
		},
		focus: function(event, ui) {
      		return false;
   		}
	});
}


function storequantityautocomplete(storequantity_row) {
  // prepare for autocomplete

  console.log(storequantity_row) ;
  $('input[name=\'store_quantity[' + storequantity_row + '][name]\']').catcomplete({
    delay: 500,
    source: function(request, response) {
      $.ajax({
        url: 'index.php?route=setting/store/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
        dataType: 'json',
        success: function(json) {
        
          response($.map(json, function(item) {
            return {
              //category: item.attribute_group,
              label: item.name,
              value: item.store_id
            }
          }));
        }
      });
    }, 
    select: function(event, ui) {
      $('input[name=\'store_quantity[' + storequantity_row + '][name]\']').attr('value', ui.item.label);
      $('input[name=\'store_quantity[' + storequantity_row + '][store_id]\']').attr('value', ui.item.value);
      
      return false;
    },
    focus: function(event, ui) {
          return false;
      }
  });
}

$('#storequantity tbody').each(function(index, element) {
  storequantityautocomplete(index);
});

$('#attribute tbody').each(function(index, element) {
	attributeautocomplete(index);
});
//--></script> 

<script type="text/javascript"><!--	
var option_row = <?php echo $option_row; ?>;

$('input[name=\'option\']').catcomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/option/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						category: item.category,
						label: item.name,
						value: item.option_id,
						type: item.type,
						option_value: item.option_value
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		html  = '<div id="tab-option-' + option_row + '" class="vtabs-content">';
		html += '	<input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][name]" value="' + ui.item.label + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + ui.item.value + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][type]" value="' + ui.item.type + '" />';
		html += '	<table class="form">';
		html += '	  <tr>';
		html += '		<td><?php echo $entry_required; ?></td>';
		html += '       <td><select name="product_option[' + option_row + '][required]">';
		html += '	      <option value="1"><?php echo $text_yes; ?></option>';
		html += '	      <option value="0"><?php echo $text_no; ?></option>';
		html += '	    </select></td>';
		html += '     </tr>';
		
		if (ui.item.type == 'text') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';
		}
		
		if (ui.item.type == 'textarea') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><textarea name="product_option[' + option_row + '][option_value]" cols="40" rows="5"></textarea></td>';
			html += '     </tr>';						
		}
		 
		if (ui.item.type == 'file') {
			html += '     <tr style="display: none;">';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';			
		}
						
		if (ui.item.type == 'date') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="date" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'datetime') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="datetime" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'time') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="time" /></td>';
			html += '     </tr>';			
		}
		
		html += '  </table>';
			
		if (ui.item.type == 'select' || ui.item.type == 'radio' || ui.item.type == 'checkbox' || ui.item.type == 'image') {
			html += '  <table id="option-value' + option_row + '" class="list">';
			html += '  	 <thead>'; 
			html += '      <tr>';
			html += '        <td class="left"><?php echo $entry_option_value; ?></td>';
			html += '        <td class="right"><?php echo $entry_quantity; ?></td>';
			html += '        <td class="left"><?php echo $entry_subtract; ?></td>';
			html += '        <td class="right"><?php echo $entry_price; ?></td>';
			html += '        <td class="right"><?php echo $entry_option_points; ?></td>';
			html += '        <td class="right"><?php echo $entry_weight; ?></td>';
			html += '        <td></td>';
			html += '      </tr>';
			html += '  	 </thead>';
			html += '    <tfoot>';
			html += '      <tr>';
			html += '        <td colspan="6"></td>';
			html += '        <td class="left"><a onclick="addOptionValue(' + option_row + ');" class="button"><?php echo $button_add_option_value; ?></a></td>';
			html += '      </tr>';
			html += '    </tfoot>';
			html += '  </table>';
            html += '  <select id="option-values' + option_row + '" style="display: none;">';
			
            for (i = 0; i < ui.item.option_value.length; i++) {
				html += '  <option value="' + ui.item.option_value[i]['option_value_id'] + '">' + ui.item.option_value[i]['name'] + '</option>';
            }

            html += '  </select>';			
			html += '</div>';	
		}
		
		$('#tab-option').append(html);
		
		$('#option-add').before('<a href="#tab-option-' + option_row + '" id="option-' + option_row + '">' + ui.item.label + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'#option-' + option_row + '\').remove(); $(\'#tab-option-' + option_row + '\').remove(); $(\'#vtab-option a:first\').trigger(\'click\'); return false;" /></a>');
		
		$('#vtab-option a').tabs();
		
		$('#option-' + option_row).trigger('click');		
		
		$('.date').datepicker({dateFormat: 'yy-mm-dd'});
		$('.datetime').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'h:m'
		});	
			
		$('.time').timepicker({timeFormat: 'h:m'});	
				
		option_row++;
		
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});
//--></script> 
<script type="text/javascript"><!--		
var option_value_row = <?php echo $option_value_row; ?>;

function addOptionValue(option_row) {	
	html  = '<tbody id="option-value-row' + option_value_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]">';
	html += $('#option-values' + option_row).html();
	html += '    </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
	html += '    <td class="right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" size="3" /></td>'; 
	html += '    <td class="left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]">';
	html += '      <option value="1"><?php echo $text_yes; ?></option>';
	html += '      <option value="0"><?php echo $text_no; ?></option>';
	html += '    </select></td>';
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" size="5" /></td>';
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]" value="" size="5" /></td>';	
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" size="5" /></td>';
	html += '    <td class="left"><a onclick="$(\'#option-value-row' + option_value_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#option-value' + option_row + ' tfoot').before(html);

	option_value_row++;
}
//--></script> 
<script type="text/javascript"><!--
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tbody id="discount-row' + discount_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_discount[' + discount_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['name']); ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" size="2" /></td>';
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#discount-row' + discount_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';	
    html += '</tbody>';
	
	$('#discount tfoot').before(html);
		
	$('#discount-row' + discount_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	discount_row++;
}
//--></script> 
<script type="text/javascript"><!--
var special_row = <?php echo $special_row; ?>;

function addSpecial() {
	html  = '<tbody id="special-row' + special_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_special[' + special_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['name']); ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#special-row' + special_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
    html += '</tbody>';
	
	$('#special tfoot').before(html);
 
	$('#special-row' + special_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	special_row++;
}
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
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();

//var profileCount = <?php echo $profileCount ?>;

// function addProfile() {
//     profileCount++;
    
//     var html = '';
//     html += '<tr id="profile-row' + profileCount + '">';
//     html += '  <td class="left">';
//     html += '    <select name="product_profiles[' + profileCount + '][profile_id]">';
//     <?php foreach ($profiles as $profile): ?>
//     html += '      <option value="<?php echo $profile['profile_id'] ?>"><?php echo $profile['name'] ?></option>';
//     <?php endforeach; ?>
//     html += '    </select>';
//     html += '  </td>';
//     html += '  <td class="left">';
//     html += '    <select name="product_profiles[' + profileCount + '][customer_group_id]">';
//     <?php foreach ($customer_groups as $customer_group): ?>
//     html += '      <option value="<?php echo $customer_group['customer_group_id'] ?>"><?php echo $customer_group['name'] ?></option>';
//     <?php endforeach; ?>
//     html += '    <select>';
//     html += '  </td>';
//     html += '  <td class="left">';
//     html += '    <a class="button" onclick="$(\'#profile-row' + profileCount + '\').remove()"><?php echo $button_remove ?></a>';
//     html += '  </td>';
//     html += '</tr>';
    
//     $('#tab-profile table tbody').append(html);
// }

<?php if (isset($this->request->get['product_id'])) { ?>
    function openbayLinkStatus(){
        var product_id = '<?php echo $this->request->get['product_id']; ?>';
        $.ajax({
            type: 'GET',
            url: 'index.php?route=extension/openbay/linkStatus&token=<?php echo $token; ?>&product_id='+product_id,
            dataType: 'html',
            success: function(data) {
                //add the button to nav
                $('<a href="#tab-openbay"><?php echo $tab_marketplace_links ?></a>').hide().appendTo("#tabs").fadeIn(1000);
                $('#tab-general').before(data);
                $('#tabs a').tabs();
            },
            failure: function(){

            },
            error: function() {

            }
        });
    }

    $(document).ready(function(){
        //openbayLinkStatus();
    });
<?php } ?>

//--></script>

<?php echo $footer; ?>