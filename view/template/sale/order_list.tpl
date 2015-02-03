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
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
        <!-- <a onclick="$('#form').attr('action', '?php echo $invoice; ?>'); $('#form').attr('target', '_blank'); $('#form').submit();" class="button"> -->
          <?php echo $button_invoice; ?></a><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').attr('action', '<?php echo $delete; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <!-- <td class="right"><php if ($sort == 'o.order_id') { ?>
                <a href="<php echo $sort_order; ?>" class="<php echo strtolower($order); ?>"><php echo $column_order_id; ?></a>
                <php } else { ?>
                <a href="<php echo $sort_order; ?>"><php echo $column_order_id; ?></a>
                <php } ?></td> -->
              <td class="left"><?php if ($sort == 'customer') { ?>
                <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="right"><?php if ($sort == 'o.total') { ?>
                <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_total; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_total; ?>"><?php echo $column_total; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'o.date_added') { ?>
                <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                <?php } ?></td>
              <!-- <td class="left"><php if ($sort == 'o.date_modified') { ?>
                <a href="<php echo $sort_date_modified; ?>" class="<php echo strtolower($order); ?>"><php echo $column_date_modified; ?></a>
                <php } else { ?>
                <a href="<php echo $sort_date_modified; ?>"><php echo $column_date_modified; ?></a>
                <php } ?></td> -->
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <!-- <td align="right"><input type="text" name="filter_order_id" value="<php echo $filter_order_id; ?>" size="4" style="text-align: right;" /></td> -->
              <td><input type="customer" name="filter_customer" value="<?php echo $filter_customer; ?>" /></td>
              <td><select name="filter_order_status_id">
                  <option value="*"></option>
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $filter_order_status_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td align="right">
                <input type="text" name="filter_total_min" value="<?php echo $filter_total_min; ?>" size="4" style="text-align: right;" /> ~ <input type="text" name="filter_total_max" value="<?php echo $filter_total_max; ?>" size="4" style="text-align: right;" />
              </td>
              <td>
                <input type="text" name="filter_date_added_start" value="<?php echo $filter_date_added_start; ?>" size="12" class="date" />  ~
                <input type="text" name="filter_date_added_end" value="<?php echo $filter_date_added_end; ?>" size="12" class="date" />
              </td>
              <!-- <td>
                <input type="text" name="filter_date_modified_start" value="<php echo $filter_date_modified_start; ?>" size="12" class="date" /> ~ 
                <input type="text" name="filter_date_modified_end" value="<php echo $filter_date_modified_end; ?>" size="12" class="date" />
              </td> -->
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($orders) { ?>
            <?php foreach ($orders as $order) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($order['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                <?php } ?></td>
              <!-- <td class="right"><php echo $order['order_id']; ?></td> -->
              <td class="left"><?php foreach ($order['action'] as $action) { ?>
                <a href="<?php echo $action['user']; ?>"><?php echo $order['customer']; ?></a>
                <?php } ?>

              </td>
              <td class="left"><?php echo $order['status']; ?></td>
              <td class="right"><?php echo $order['total']; ?></td>
              <td class="left"><?php echo $order['date_added']; ?></td>
              <!-- <td class="left"><php echo $order['date_modified']; ?></td> -->
              <td class="right"><?php echo $order['comment']; ?>
              <a href="<?php echo $action['href']; ?>"><?php echo $text_edit; ?></a>
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=sale/order&token=<?php echo $token; ?>';
	
	var filter_order_id = $('input[name=\'filter_order_id\']').attr('value');
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
	
	var filter_customer = $('input[name=\'filter_customer\']').attr('value');
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
	
	var filter_order_status_id = $('select[name=\'filter_order_status_id\']').attr('value');
	
	if (filter_order_status_id != '*') {
		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
	}	

	var filter_total_max = $('input[name=\'filter_total_max\']').attr('value');

  if (filter_total_max) {
    url += '&filter_total_max=' + encodeURIComponent(filter_total_max);
  } 

  var filter_total_min = $('input[name=\'filter_total_min\']').attr('value');

  if (filter_total_min) {
    url += '&filter_total_min=' + encodeURIComponent(filter_total_min);
  } 
	
	var filter_date_added_start = $('input[name=\'filter_date_added_start\']').attr('value');
	
	if (filter_date_added_start) {
		url += '&filter_date_added_start=' + encodeURIComponent(filter_date_added_start);
	}
	
  var filter_date_added_end = $('input[name=\'filter_date_added_end\']').attr('value');
  
  if (filter_date_added_end) {
    url += '&filter_date_added_end=' + encodeURIComponent(filter_date_added_end);
  }

	var filter_date_modified_start = $('input[name=\'filter_date_modified_start\']').attr('value');
	
	if (filter_date_modified_start) {
		url += '&filter_date_modified_start=' + encodeURIComponent(filter_date_modified_start);
	}
	
  var filter_date_modified_end = $('input[name=\'filter_date_modified_end\']').attr('value');
  
  if (filter_date_modified_end) {
    url += '&filter_date_modified_end=' + encodeURIComponent(filter_date_modified_end);
  }

	location = url;
}
//--></script>  
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<script type="text/javascript"><!--
// $.widget('custom.catcomplete', $.ui.autocomplete, {
// 	_renderMenu: function(ul, items) {
// 		var self = this, currentCategory = '';
		
// 		$.each(items, function(index, item) {
// 			if (item.category != currentCategory) {
// 				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
// 				currentCategory = item.category;
// 			}
			
// 			self._renderItem(ul, item);
// 		});
// 	}
// });

// $('input[name=\'filter_customer\']').catcomplete({
// 	delay: 500,
// 	source: function(request, response) {
// 		$.ajax({
// 			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
// 			dataType: 'json',
// 			success: function(json) {		
// 				response($.map(json, function(item) {
// 					return {
// 						category: item.customer_group,
// 						label: item.name,
// 						value: item.customer_id
// 					}
// 				}));
// 			}
// 		});
// 	}, 
// 	select: function(event, ui) {
// 		$('input[name=\'filter_customer\']').val(ui.item.label);
						
// 		return false;
// 	},
// 	focus: function(event, ui) {
//       	return false;
//    	}
// });
//--></script> 
<?php echo $footer; ?>