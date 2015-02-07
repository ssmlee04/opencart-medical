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
      <div class="buttons"><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>

                <td class="left"><?php if ($sort == 'p.store_id') { ?>
                <a href="<?php echo $sort_store; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_store; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_store; ?>"><?php echo $column_store; ?></a>
                <?php } ?></td>
                
                <td class="left"><?php if ($sort == 'p.user_id') { ?>
                <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_user; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_user; ?>"><?php echo $column_user; ?></a>
                <?php } ?></td>

                <td class="left"><?php if ($sort == 'p.total') { ?>
                <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_total; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_total; ?>"><?php echo $column_total; ?></a>
                <?php } ?></td>

                <td class="left"><?php if ($sort == 'p.date_expensed') { ?>
                <a href="<?php echo $sort_date_expensed; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_expensed; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_expensed; ?>"><?php echo $column_date_expensed; ?></a>
                <?php } ?></td>

                <td class="left"><?php if ($sort == 'p.date_added') { ?>
                <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_expensed; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added ?></a>
                <?php } ?></td>
 
<!--               <td class="left"><php if ($sort == 'p.status') { ?>
                <a href="<php echo $sort_status; ?>" class="<php echo strtolower($order); ?>"><php echo $column_status; ?></a>
                <php } else { ?>
                <a href="<php echo $sort_status; ?>"><php echo $column_status; ?></a>
                <php } ?></td> -->
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              
              <td>
                <select name="filter_store" style='display:none'>
                  <option value=""></option>
                  <?php if ($stores) { ?>
                    <?php foreach ($stores as $store) { ?>
                      <?php if ($filter_store == $store['store_id']) { ?>
                        <option value="<?php echo $store['store_id']; ?>" selected><?php echo $store['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </select></td>
              
              <td>
              <!-- <select name="filter_user">
                  <option value=""></option>
                  <php if ($users) { ?>
                    <php foreach ($users as $user) { ?>  
                       <php if ($filter_user == $user['user_id']) { ?>
                        <option value="<php echo $user['user_id']; ?>" selected><php echo $user['lastname'] . ' ' . $user['firstname']; ?></option>
                      <php } else { ?>
                        <option value="<php echo $user['user_id']; ?>"><php echo $user['lastname'] . ' ' . $user['firstname']; ?></option>
                      <php } ?>
                    php } ?>
                  <php } ?>
                </select> -->
                </td>

                <td align="left"><input type="text" name="filter_total_min" value="<?php echo $filter_total_min; ?>" style='width: 60px'/>~<input type="text" name="filter_total_max" value="<?php echo $filter_total_max; ?>" style='width: 60px'/></td>

                <td align="left"><input type="date_available" name="filter_date_expensed_start" value="<?php echo $filter_date_expensed_start; ?>" size="8"/>~<input type="date_available" name="filter_date_expensed_end" value="<?php echo $filter_date_expensed_end; ?>" size="8"/></td>

                <td align="left"></td>

                <!-- <td align="left"><input type="date_available" class='date' name="filter_date_expensed" value="<php echo $filter_date_expensed; ?>" size=""/></td> -->

                <!-- <td align="left"><input type="date_available" class='date' name="filter_date_added" value="<php echo $filter_date_added; ?>" size=""/></td> -->

              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>

            </tr>


            <?php if ($expenses) { ?>
            <?php foreach ($expenses as $expense) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($expense['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $expense['purchase_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $expense['purchase_id']; ?>" />
                <?php } ?></td>

              <td class="left"><?php foreach ($expense['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><?php echo $expense['store']; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php echo $expense['name']; ?></td>
              <td class="left"><?php echo $expense['total']; ?></td>
              <td class="left"><?php echo $expense['date_expensed']; ?></td>
              <td class="left"><?php echo $expense['date_added']; ?></td>
            
              <td class="right"><?php echo $expense['message']; ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=sale/expense&token=<?php echo $token; ?>';
	
  var filter_total_min = $('input[name=\'filter_total_min\']').attr('value');
  
  if (filter_total_min) {
    url += '&filter_total_min=' + encodeURIComponent(filter_total_min);
  }
 
  var filter_total_max = $('input[name=\'filter_total_max\']').attr('value');
  
  if (filter_total_max) {
    url += '&filter_total_max=' + encodeURIComponent(filter_total_max);
  }

  var filter_date_expensed_start = $('input[name=\'filter_date_expensed_start\']').attr('value');
  
  if (filter_date_expensed_start) {
    url += '&filter_date_expensed_start=' + encodeURIComponent(filter_date_expensed_start);
  } 

  var filter_date_expensed_end = $('input[name=\'filter_date_expensed_end\']').attr('value');
  
  if (filter_date_expensed_end) {
    url += '&filter_date_expensed_end=' + encodeURIComponent(filter_date_expensed_end);
  } 

  var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
  
  if (filter_date_added) {
    url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
  }
  
  var filter_user = $('select[name=\'filter_user\']').attr('value');
  
  if (filter_user) {
    url += '&filter_user=' + encodeURIComponent(filter_user);
  }

  var filter_store = $('select[name=\'filter_store\']').attr('value');
  
  if (filter_store) {
    url += '&filter_store=' + encodeURIComponent(filter_store);
  }

	// var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	// if (filter_status != '*') {
	// 	url += '&filter_status=' + encodeURIComponent(filter_status);
	// }

	location = url;

}
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
    e.preventDefault();
	}
});
//--></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/expense/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.purchase_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

//--></script> 
<?php echo $footer; ?>