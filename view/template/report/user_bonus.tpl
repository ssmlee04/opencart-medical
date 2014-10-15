<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/report.png" alt="" /> <?php echo $heading_title; ?></h1>
    </div>
    <div class="content">
      <table class="form">
        <tr>
          <td><?php echo $entry_date_start; ?>
            <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" id="date-start" size="12" /></td>
          <td><?php echo $entry_date_end; ?>
            <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" id="date-end" size="12" /></td>
          
          </tr><tr>
          <td><?php echo $entry_doctor; ?>
              <input type="text" name="filter_doctor" value="<?php echo $filter_doctor; ?>" id="user" size="12" /><input type="hidden" name="filter_doctor_id" value="<?php echo $filter_doctor_id; ?>" id="doctor_id" size="12" /></td>
          <td><?php echo $entry_beauty; ?>
              <input type="text" name="filter_beauty" value="<?php echo $filter_beauty; ?>" id="user" size="12" /><input type="hidden" name="filter_beauty_id" value="<?php echo $filter_beauty_id; ?>" id="beauty_id" size="12" /></td>
          <td><?php echo $entry_consultant; ?>
              <input type="text" name="filter_consultant" value="<?php echo $filter_consultant; ?>" id="user" size="12" /><input type="hidden" name="filter_consultant_id" value="<?php echo $filter_consultant_id; ?>" id="consultant_id" size="12" /></td>
          <td><?php echo $entry_outsource; ?>
              <input type="text" name="filter_outsource" value="<?php echo $filter_outsource; ?>" id="user" size="12" /><input type="hidden" name="filter_outsource_id" value="<?php echo $filter_outsource_id; ?>" id="outsource_id" size="12" /></td>
          
          <!-- <td><php echo $entry_status; ?>
            <select name="filter_order_status_id">
              <option value="0"><php echo $text_all_status; ?></option>
              <php foreach ($order_statuses as $order_status) { ?>
              <php if ($order_status['order_status_id'] == $filter_order_status_id) { ?>
              <option value="<php echo $order_status['order_status_id']; ?>" selected="selected"><php echo $order_status['name']; ?></option>
              <php } else { ?>
              <option value="<php echo $order_status['order_status_id']; ?>"><php echo $order_status['name']; ?></option>
              <php } ?>
              <php } ?>
            </select></td> -->

          <td style="text-align: right;"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
        </tr>
      </table>
      <table class="list">
        <thead>
          <tr>
            <td class="left"><?php echo $column_user; ?></td>
            <td class="left"><?php echo $column_bonus; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php if ($users) { ?>
          <?php foreach ($users as $result) { ?>
          <tr>
            <td class="left"><?php echo $result['name']; ?></td>
            <td class="left"><?php echo $result['bonus']; ?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="2"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!-- <div class="pagination"><php echo $pagination; ?></div> -->
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=report/user_bonus&token=<?php echo $token; ?>';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}

  var filter_doctor_id = $('input[name=\'filter_doctor_id\']').attr('value');
  
  if (filter_doctor_id) {
    url += '&filter_doctor_id=' + encodeURIComponent(filter_doctor_id);
  }

  var filter_beauty_id = $('input[name=\'filter_beauty_id\']').attr('value');
  
  if (filter_beauty_id) {
    url += '&filter_beauty_id=' + encodeURIComponent(filter_beauty_id);
  }
  
  var filter_consultant_id = $('input[name=\'filter_consultant_id\']').attr('value');
  
  if (filter_consultant_id) {
    url += '&filter_consultant_id=' + encodeURIComponent(filter_consultant_id);
  }
  
  var filter_outsource_id = $('input[name=\'filter_outsource_id\']').attr('value');
  
  if (filter_outsource_id) {
    url += '&filter_outsource_id=' + encodeURIComponent(filter_outsource_id);
  }
  
	
	// var filter_order_status_id = $('select[name=\'filter_order_status_id\']').attr('value');
	
	// if (filter_order_status_id != 0) {
	// 	url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
	// }	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date-start').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('#date-end').datepicker({dateFormat: 'yy-mm-dd'});
});

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


$('input[name=\'filter_doctor\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=user/user/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) { 
        response($.map(json, function(item) {
          return {
            label: item['fullname'],
            fullname: item['fullname'],
            value: item['user_id']
          }
        }));
      }
    });
  }, 
  select: function(event, ui) { 
    $('input[name=\'filter_doctor\']').attr('value', ui.item['fullname']);
    $('input[name=\'filter_doctor_id\']').attr('value', ui.item['value']);
    return false;
  },
  focus: function(event, ui) {
    return false;
  }
});

//--></script> 
<?php echo $footer; ?>