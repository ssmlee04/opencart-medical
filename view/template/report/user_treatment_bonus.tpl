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
      <table class="list">
        <thead>
          <tr>
            <td><?php echo $entry_date_start; ?></td>
 <!--            <td><php echo $entry_doctor; ?></td>
            <td><php echo $entry_beauty; ?></td>
            <td><php echo $entry_consultant; ?></td>
            <td><php echo $entry_outsource; ?></td> -->
          </tr>
        </thead>
        <tr>
          <td>
            <input type="date_available" name="filter_date_start" value="<?php echo $filter_date_start; ?>"  size="12" />
            ~
            <input type="date_available" name="filter_date_end" value="<?php echo $filter_date_end; ?>" size="12" /></td>
          <!-- <td>
              <input type="text" name="filter_doctor" value="<php echo $filter_doctor; ?>" id="user" size="12" /><input type="hidden" name="filter_doctor_id" value="<php echo $filter_doctor_id; ?>" id="doctor_id" size="12" /></td>
          <td>
              <input type="text" name="filter_beauty" value="<php echo $filter_beauty; ?>" id="user" size="12" /><input type="hidden" name="filter_beauty_id" value="<php echo $filter_beauty_id; ?>" id="beauty_id" size="12" /></td>
          <td>
              <input type="text" name="filter_consultant" value="<php echo $filter_consultant; ?>" id="user" size="12" /><input type="hidden" name="filter_consultant_id" value="<php echo $filter_consultant_id; ?>" id="consultant_id" size="12" /></td>
          <td>
              <input type="text" name="filter_outsource" value="<php echo $filter_outsource; ?>" id="user" size="12" /><input type="hidden" name="filter_outsource_id" value="<php echo $filter_outsource_id; ?>" id="outsource_id" size="12" /></td> -->
            <tr></tr>
          <td style="text-align: right;" colspan='1'><a onclick="filter();" class="button"><?php echo $button_filter; ?></a> | <a onclick="print();" class="button"><?php echo $button_print; ?></a></td>

        </tr>
      </table>
      <br>
      <table class="list">
        <thead>
          <tr>
              <td><?php echo $text_customer_fullname; ?></td>
              <td><?php echo $text_customer_id; ?></td>
              <td><?php echo $text_product_name; ?></td>
              <td><?php echo $text_date_used; ?></td>
              <td><?php echo $text_comment; ?></td>
              <td><?php echo $text_unit_used; ?></td>
              <td><?php echo $text_doctor_name; ?></td>
              <td><?php echo $text_outsource_name; ?></td>
              <td><?php echo $text_consultant_name; ?></td>
              <td><?php echo $text_beauty_name; ?></td>

              <td><?php echo $text_bonus_doctor; ?></td>
              <td><?php echo $text_bonus_beauty; ?></td>
              <td><?php echo $text_bonus_outsource; ?></td>
              <td><?php echo $text_bonus_consultant; ?></td>

              <td><?php echo $text_total_amount; ?></td>
<!--               <td><php echo $text_payment_cash; ?></td>
              <td><php echo $text_payment_visa; ?></td>
              <td><php echo $text_payment_balance; ?></td>
              <td><php echo $text_payment_final; ?></td> -->
              <!-- <td><php echo $text_user_fullname; ?></td> -->
              
          </tr>
        </thead>
        <tbody>
        <?php $total = 0;?>
          <?php if ($treatment_bonus) { ?>
          <?php foreach ($treatment_bonus as $result) { ?>
        <?php $total += (float)$result['total_amount']; ?>
            <tr style="background-color: <?php echo $result['color']; ?>">

            <!-- <td><php echo $result['treatment_usage_id']; ?></td> -->
            <!-- <td><php echo $result['order_id']; ?></td> -->

              <td><?php echo $result['cfullname']; ?></td>
              <td><?php echo $result['customer_id']; ?></td>
              <td><?php echo $result['product_name']; ?></td>
              <td><?php echo $result['date']; ?></td>
              <!-- <td><php echo $result['date_added']; ?></td> -->
              <!-- <td><php echo $result['date_modified']; ?></td> -->
              <td><?php echo $result['comment']; ?></td>
              <td><?php echo $result['subquantity']; ?></td>
              <td><?php echo $result['doctor_name']; ?></td>
              <td><?php echo $result['outsource_name']; ?></td>
              <td><?php echo $result['consultant_name']; ?></td>
              <td><?php echo $result['beauty_name']; ?></td>

              <td><?php echo $result['bonus_doctor']; ?></td>
              <td><?php echo $result['bonus_beauty']; ?></td>
              <td><?php echo $result['bonus_outsource']; ?></td>
              <td><?php echo $result['bonus_consultant']; ?></td>

              <td><?php echo $result['total_amount']; ?></td>
<!--               <td><php echo $result['payment_cash']; ?></td>
              <td><php echo $result['payment_visa']; ?></td>
              <td><php echo $result['payment_balance']; ?></td>
              <td><php echo $result['payment_final']; ?></td> -->
              <!-- <td><php echo $result['ufullname']; ?></td> -->
              
            </tr>
          <?php } ?>
          <?php } ?>
            <tr>
              <td colspan="15" style="text-align: right;"><?php echo $total; ?></td>
            </tr>
        </tbody>
      </table>
      <!-- <div class="pagination"><php echo $pagination; ?></div> -->
    </div>
  </div>
</div>
<script type="text/javascript"><!--


$('input').on('keypress', function(){
  $(this).val('');
  $(this).next().val('');
});
$('input').on('keyup', function(e){
  if (e.keyCode==8) {
    $(this).next().val('');
  }
});

$('.togglethis').on('click', function(){

    var ID = $(this).attr('id');
    
    $('#r' + ID).toggle('slow');
  });

function filter() {
	url = 'index.php?route=report/user_treatment_bonus&token=<?php echo $token; ?>';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}

  var filter_doctor = $('input[name=\'filter_doctor\']').attr('value');
  
  if (filter_doctor) {
    url += '&filter_doctor=' + encodeURIComponent(filter_doctor);
  } 

  var filter_beauty = $('input[name=\'filter_beauty\']').attr('value');
  
  if (filter_beauty) {
    url += '&filter_beauty=' + encodeURIComponent(filter_beauty);
  } 

  var filter_outsource = $('input[name=\'filter_outsource\']').attr('value');
  
  if (filter_outsource) {
    url += '&filter_outsource=' + encodeURIComponent(filter_outsource);
  } 

  var filter_consultant = $('input[name=\'filter_consultant\']').attr('value');
  
  if (filter_consultant) {
    url += '&filter_consultant=' + encodeURIComponent(filter_consultant);
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

	location = url;
}



function print() {
  url = 'index.php?route=report/user_treatment_bonus&token=<?php echo $token; ?>';
  
  var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
  
  if (filter_date_start) {
    url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
  }

  var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
  
  if (filter_date_end) {
    url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
  }

  var filter_doctor = $('input[name=\'filter_doctor\']').attr('value');
  
  if (filter_doctor) {
    url += '&filter_doctor=' + encodeURIComponent(filter_doctor);
  } 

  var filter_beauty = $('input[name=\'filter_beauty\']').attr('value');
  
  if (filter_beauty) {
    url += '&filter_beauty=' + encodeURIComponent(filter_beauty);
  } 

  var filter_outsource = $('input[name=\'filter_outsource\']').attr('value');
  
  if (filter_outsource) {
    url += '&filter_outsource=' + encodeURIComponent(filter_outsource);
  } 

  var filter_consultant = $('input[name=\'filter_consultant\']').attr('value');
  
  if (filter_consultant) {
    url += '&filter_consultant=' + encodeURIComponent(filter_consultant);
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

  url += '&print=1';

  window.open (url);
}

//--></script> 
<script type="text/javascript"><!--


$.widget('custom.catcomplete', $.ui.autocomplete, {
  _renderMenu: function(ul, items) {
    var self = this, currentCategory = '';
    
    $.each(items, function(index, item) {
      if (item.category != currentCategory) {
        ul.append('<li class="ui-autocomplete-category">' + '' + '</li>');
        
        currentCategory = item.category;
      }
      
      self._renderItem(ul, item);
    });
  }
});

$("input[name='filter_doctor']").on('keypress', function(e){
    $("input[name='filter_doctor_id']").val('');
  });
$("input[name='filter_beauty']").on('keypress', function(e){
    $("input[name='filter_beauty_id']").val('');
  });
$("input[name='filter_outsource']").on('keypress', function(e){
    $("input[name='filter_outsource_id']").val('');
  });
$("input[name='filter_consultant']").on('keypress', function(e){
    $("input[name='filter_consultant_id']").val('');
  });

$('input[name=\'filter_doctor\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=user/user/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term) + '&filter_user_group_id=2',
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

$('input[name=\'filter_beauty\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=user/user/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term) + '&filter_user_group_id=5',
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
    $('input[name=\'filter_beauty\']').attr('value', ui.item['fullname']);
    $('input[name=\'filter_beauty_id\']').attr('value', ui.item['value']);
    return false;
  },
  focus: function(event, ui) {
    return false;
  }
});

$('input[name=\'filter_outsource\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=user/user/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term) + '&filter_user_group_id=4',
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
    $('input[name=\'filter_outsource\']').attr('value', ui.item['fullname']);
    $('input[name=\'filter_outsource_id\']').attr('value', ui.item['value']);
    return false;
  },
  focus: function(event, ui) {
    return false;
  }
});

$('input[name=\'filter_consultant\']').catcomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=user/user/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term) + '&filter_user_group_id=3',
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
    $('input[name=\'filter_consultant\']').attr('value', ui.item['fullname']);
    $('input[name=\'filter_consultant_id\']').attr('value', ui.item['value']);
    return false;
  },
  focus: function(event, ui) {
    return false;
  }
});



//--></script> 
<?php echo $footer; ?>