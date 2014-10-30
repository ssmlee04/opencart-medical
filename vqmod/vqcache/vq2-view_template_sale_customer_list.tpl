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
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-customers-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			

      <?php if (isset($if_search) && !$if_search) { ?>
      <div class="buttons">
        <a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('form').attr('action', '<?php echo $delete; ?>'); $('form').submit();" class="button"><?php echo $button_delete; ?></a>
      </div>
      <?php } ?>
    </div>
    
    
			<div class="content sales-customer">
			


      
			<form action="" method="post" enctype="multipart/form-data" id="form" class="form-fix">
			

        <?php if (isset($if_search) && $if_search) { ?>
        <table class="list">
          <thead>
            <tr><td colspan='2'><?php echo $text_search_customer; ?></td></tr>
          </thead>
          <tr>
            <td><?php echo $column_name; ?></td>
            <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
          </tr>
          <tr>
            <td><?php echo $column_customer_id; ?></td>
            <td><input type="text" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $column_ssn; ?></td>
            <td><input type="text" name="filter_ssn" value="<?php echo $filter_ssn; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $column_mobile; ?></td>
            <td><input type="text" name="filter_mobile" value="<?php echo $filter_mobile; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $column_telephone; ?></td>
            <td><input type="text" name="filter_telephone" value="<?php echo $filter_telephone; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $column_dob; ?></td>
            
			<td><input type="text" name="filter_dob" value="<?php echo $filter_dob; ?>" />(民國, 格式 75-12-31)</td>
			
          </tr>


          <tr><td colspan='2'>
            <a onclick="filter();" class="button"><?php echo $button_filter; ?></a>
          </td>
          <td style='display:none'>
            <select name="filter_customer_group_id"><option value='*'></option></select>
            <select name="filter_approved"><option value='*'></option></select>
            <select name="filter_status"><option value='*'></option></select>
          </td>
              </tr>
        </table>
        <?php } ?>

        <br>
        <?php if ($filter_name != '' || $filter_dob!='' || $filter_telephone!='' || $filter_mobile!='' || $filter_ssn!='' || $filter_customer_id != '' || isset($if_display)) { ?>
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php echo $column_name; ?></td>
              <td class="left"><?php echo $column_dob; ?></td>

              <td class="left"><?php echo $column_mobile; ?></td>
              <td class="left"><?php echo $column_doctor; ?></td>
              <td class="left"><?php echo $column_consultant; ?></td>
              <td class="left"><?php echo $column_beauty; ?></td>
              <td class="left"><?php echo $column_outsource; ?></td>
              <!-- <td class="left"><php if ($sort == 'c.approved') { ?>
                <a href="<php echo $sort_approved; ?>" class="<php echo strtolower($order); ?>"><php echo $column_approved; ?></a>
                <php } else { ?>
                <a href="<php echo $sort_approved; ?>"><php echo $column_approved; ?></a>
                <php } ?></td> -->
              <!-- <td class="left"><php if ($sort == 'c.ip') { ?>
                <a href="<php echo $sort_ip; ?>" class="<php echo strtolower($order); ?>"><php echo $column_ip; ?></a>
                <php } else { ?>
                <a href="<php echo $sort_ip; ?>"><php echo $column_ip; ?></a>
                <php } ?></td> -->
              <td class="left"><?php echo $column_date_last_visit; ?></td>
              <!-- <td class="left"><php echo $column_login; ?></td> -->
              <!-- <td class="right"><php echo $column_action; ?></td> -->
            </tr>
          </thead>
          <tbody>


          <!--   <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_name" value="<php echo $filter_name; ?>" /></td>
              <td><input type="text" name="filter_ssn" value="<php echo $filter_ssn; ?>" /></td>
              <td><input type="text" name="filter_email" value="<php echo $filter_email; ?>" /></td>
              <td><select name="filter_customer_group_id">
                  <option value="*"></option>
                  <php foreach ($customer_groups as $customer_group) { ?>
                  <php if ($customer_group['customer_group_id'] == $filter_customer_group_id) { ?>
                  <option value="<hp echo $customer_group['customer_group_id']; ?>" selected="selected"><php echo $customer_group['name']; ?></option>
                  <php } else { ?>
                  <option value="<php echo $customer_group['customer_group_id']; ?>"><php echo $customer_group['name']; ?></option>
                  <php } ?>
                  <php } ?>
                </select></td>
              <td><select name="filter_status">
                  <option value="*"></option>
                  <php if ($filter_status) { ?>
                  <option value="1" selected="selected"><php echo $text_enabled; ?></option>
                  <php } else { ?>
                  <option value="1"><php echo $text_enabled; ?></option>
                  <php } ?>
                  <php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><php echo $text_disabled; ?></option>
                  <php } else { ?>
                  <option value="0"><php echo $text_disabled; ?></option>
                  <php } ?>
                </select></td>
              <td><input type="text" name="filter_date_added" value="<php echo $filter_date_added; ?>" size="12" id="date" /></td>
              <td align="right"><a onclick="filter();" class="button"><php echo $button_filter; ?></a></td>
            </tr>
 -->  
            <?php if ($customers) { ?>
            <?php foreach ($customers as $customer) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($customer['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                <?php } ?></td>
              
              <td class="left"><?php foreach ($customer['fullname'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a>
                <?php } ?></td>

              <td class="left"><?php echo $customer['dob']; ?></td>
              <td class="left"><?php echo $customer['mobile']; ?></td>
              <td class="left"><?php echo $customer['last_doctor']; ?></td>
              <td class="left"><?php echo $customer['last_consultant']; ?></td>
              <td class="left"><?php echo $customer['last_beauty']; ?></td>
              <td class="left"><?php echo $customer['last_outsource']; ?></td>
              <!-- <td class="left"><php echo $customer['approved']; ?></td> -->
              <!-- <td class="left"><php echo $customer['ip']; ?></td> -->
              <td class="left"><?php echo $customer['last_visit']; ?></td>
              <!-- <td class="left"><select onchange="((this.value !== '') ? window.open('index.php?route=sale/customer/login&token=<php echo $token; ?>&customer_id=<php echo $customer['customer_id']; ?>&store_id=' + this.value) : null); this.value = '';">
                  <option value=""><php echo $text_select; ?></option>
                  <option value="0"><php echo $text_default; ?></option>
                  <php foreach ($stores as $store) { ?>
                  <option value="<php echo $store['store_id']; ?>"><php echo $store['name']; ?></option>
                  <php } ?>
                </select></td> -->
              <!-- <td class="right"><php foreach ($customer['action'] as $action) { ?>
                [ <a href="<php echo $action['href']; ?>"><php echo $action['text']; ?></a> ]
                <php } ?></td> -->
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
        

      </form>
      <div class="pagination">
        <?php if ($filter_name!='' || $filter_ssn!='' || isset($if_display)) { ?>
        <?php echo $pagination; ?>
       <?php } ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--

$.widget('custom.catcomplete', $.ui.autocomplete, {
  _renderMenu: function(ul, items) {
    var self = this, currentCategory = '';
    
    $.each(items, function(index, item) {
      if (item['fullname'] + ' ' + item['dob'] != currentCategory) {
        ul.append('<li class="ui-autocomplete-category"></li>');
        
        currentCategory = item['fullname'] + ' ' + item['dob'];
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
            label: item['fullname'] + ' ' + item['dob'],
            fullname: item['fullname'],
            value: item['customer_id']
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

$('input[name=\'filter_name\']').on('keyup', function(e){
  if (e.keyCode == 8) {
    $('input[name=\'filter_customer_id\']').attr('value', '');
  }
});


function filter() {
	url = 'index.php?route=sale/customer&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
  var filter_customer_id = $('input[name=\'filter_customer_id\']').attr('value');
  
  if (filter_customer_id) {
    url += '&filter_customer_id=' + encodeURIComponent(filter_customer_id);
  }

  var filter_ssn = $('input[name=\'filter_ssn\']').attr('value');
  
  if (filter_ssn) {
    url += '&filter_ssn=' + encodeURIComponent(filter_ssn);
  }

	var filter_mobile = $('input[name=\'filter_mobile\']').attr('value');
  
  if (filter_mobile) {
    url += '&filter_mobile=' + encodeURIComponent(filter_mobile);
  }
  
  var filter_telephone = $('input[name=\'filter_telephone\']').attr('value');
  
  if (filter_telephone) {
    url += '&filter_telephone=' + encodeURIComponent(filter_telephone);
  }

  var filter_dob = $('input[name=\'filter_dob\']').attr('value');
  
  if (filter_dob) {
    url += '&filter_dob=' + encodeURIComponent(filter_dob);
  }
  

	// var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').attr('value');
	
	// if (filter_customer_group_id != '*') {
	// 	url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
	// }	
	
	// var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	// if (filter_status != '*') {
	// 	url += '&filter_status=' + encodeURIComponent(filter_status); 
	// }	
	
	// var filter_approved = $('select[name=\'filter_approved\']').attr('value');
	
	// if (filter_approved != '*') {
	// 	url += '&filter_approved=' + encodeURIComponent(filter_approved);
	// }	
	
	// var filter_ip = $('input[name=\'filter_ip\']').attr('value');
	
	// if (filter_ip) {
	// 	url += '&filter_ip=' + encodeURIComponent(filter_ip);
	// }
		
	// var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	
	// if (filter_date_added) {
	// 	url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	// }
	
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	// $('#date').datepicker({dateFormat: 'yy-mm-dd'});

   $('input').keydown(function(e){
    if (e.keyCode==13) filter();
  });


});
//--></script>
<?php echo $footer; ?> 