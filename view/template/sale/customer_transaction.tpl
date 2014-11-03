<!-- <link rel="stylesheet" href="colorbox.css" /> -->
<!-- <script type="text/javascript" src="view/javascript/colorbox/jquery.colorbox-min"></script>  -->
<style>
  .color1 {
    background-color: #F5F1DE;
  }
  .color2 {
    background-color: #E7DF9C;
  }
</style>

<?php if (isset($error_warning) && $error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if (isset($success) && $success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

<?php if (isset($show_group) && $show_group) { ?>
<!-- <php echo $text_service_not_rendered; ?> -->
<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $text_service_not_rendered; ?></td>
      <!-- <td class="left"><php echo $column_quantity; ?></td> -->
      <!-- <td class="left"><php echo $column_unit_quantity; ?></td> -->
      <td class="left"><?php echo $column_unit; ?></td>
    </tr>
  </thead>
  <tbody>
    <?php if ($grouptransactions) { ?>
    <?php foreach ($grouptransactions as $transaction) { ?>
    <tr>
      <td class="left"><a onclick="add_filter_product('<?php echo $transaction['product_id']; ?>', '<?php echo $transaction['name']; ?>')"><?php echo $transaction['name']; ?></a></td>
      <!-- <td class="left"><hp echo $transaction['quantity']; ?></td> -->
      <!-- <td class="left"><php echo $transaction['subquantity']; ?></td> -->
      <td class="left"><?php echo $transaction['subquantity']; ?> <?php echo $transaction['unit']; ?></td>
    </tr>
    <?php } ?>
    <tr>
      <!-- <td>&nbsp;</td> -->
      <!-- <td class="right"><b><php echo $text_balance; ?></b></td>
      <td class="right"><php echo $balance; ?></td> -->
    </tr>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="2"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>
<br>



<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $column_product; ?></td>
      <td class="left"><?php echo $column_unit_used; ?></td>
      
    </tr>
  </thead>
  <tr>
    <td><select type='product' alt='2'></select><div style='display:inline' id='units'></div></td>
    <td><input type='text' id='unitspend'/><div style='display:inline' id='units2'></div>
      <input type='hidden' id='product_id_group'/>
      <input type='hidden' id='customer_id_group' value='<?php echo $filter_customer_id; ?>'/></td>
  </tr>
  <tr>
    <td colspan='2'>
    <?php echo $entry_beauty; ?><select name='beauty' type='user' alt='5'/>
      <?php echo $entry_doctor; ?><select name='doctor'  type='user' alt='2'/>
    <?php echo $entry_consultant; ?><select name='consultant'  type='user' alt='3'/>
    <?php echo $entry_outsource; ?><select name='outsource' type='user' alt='4'/>
    <input name='comment' type='text' id='comment' style='width:400px'/>

    <select name='tran_status' >
      <option></option>
      <option value='-1'><?php echo $text_transaction_unoccured; ?></option>
      <option value='-2'><?php echo $text_transaction_appointed; ?></option>
      <option value='2' ><?php echo $text_transaction_finished; ?></option>
    </select>
        <?php if ($is_insert) { ?>
        <a  class='group_change_status_button'><?php echo $button_change_status; ?></a>
        <?php } ?>

  </tr>
</table>
<br>



<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $column_date_purchased; ?></td>
      <td class="left"><?php echo $column_date_processed; ?></td>
      <td class="left"><?php echo $column_customer; ?></td>
      <!-- <td class="left"></td> -->
      <td class="left"><?php echo $column_product; ?></td>
      <!-- <td class="left"><php echo $column_quantity; ?></td> -->
      <!-- <td class="left"><php echo $column_unit_quantity; ?></td> -->
      <td class="left"><?php echo $column_unit; ?></td>
      <td class="right"></td>
      <td class="right"></td>
      <!-- <td class="right"><php echo $column_amount; ?></td> -->
    </tr>
  </thead>
  <tbody>
    <?php $treatment_image_row = 0; ?>
    <?php $transaction_count = 0; ?>
    <?php $transaction_day_prev = ''; ?>
    <?php $transaction_day = ''; ?>
    <?php $color = 'color1'; ?>

    <?php if ($transactions) { ?>
    <?php foreach ($transactions as $transaction) { ?>
    <?php $transaction_day_prev = $transaction_day; ?>
    <?php $transaction_day = $transaction['date_modified']; ?>
    <!-- <.php if ($transaction['status'] == 0) continue; ?> -->
    <tr <?php if ($transaction_day_prev != $transaction_day) {
      if ($color == 'color1') $color = 'color2';
      elseif ($color == 'color2') $color = 'color1';
    } ?>  <?php echo "class='$color'"; ?>>
      <td class="left"><?php echo $transaction['date_added']; ?> 
        <input type='hidden' value='<?php echo $transaction['customer_transaction_id']; ?>' />
      </td>
      <td class="left"><?php echo $transaction['date_modified']; ?></td>
      <td class="left"><?php echo $transaction['fullname']; ?></td>
      <td class="left"><?php echo $transaction['product_name']; ?>
        <?php if ($transaction['product_which'] > 0) { ?>
          <span>(<?php echo $text_appointment . $transaction['product_which'] . '/' . $transaction['product_total_which']; ?>)</span>
        <?php } ?>
      </td>
      <!-- <td class="left"><php echo $transaction['quantity']; ?></td> -->
      <!-- <td class="left"><php echo $transaction['subquantity']; ?></td> -->
      <td class="left"><?php echo -$transaction['subquantity']; ?><?php echo $transaction['unit']; ?></td>
      <td class="left">

        <?php if ($transaction['customer_lending_id'] != 0 && $transaction['status'] == 10) { ?>
          <span>(<?php echo $text_lendedout; ?>)</span>
        <?php } ?>
        <?php if ($transaction['customer_lending_id'] != 0 && $transaction['status'] != 10) { ?>
          <span>(<?php echo $text_borrowed; ?>)</span>
        <?php } ?>
        <?php if ($transaction['type'] == 2) { ?>
          <span>treatment</span>
        <?php } ?>
      </td>
      <td class="left">
        <input type='hidden' value='<?php echo $transaction['customer_transaction_id']; ?>' id='hidden<?php echo $transaction['customer_transaction_id']; ?>'/>
        
        

        <!-- value="<php echo $image['image']; ?>" -->
         <input type="hidden" name="image[<?php echo $treatment_image_row; ?>][image]"  id="treatmentimage<?php echo $treatment_image_row; ?>" />
         <?php if ($is_insert) { ?>
        <a class='addImage2'><?php echo $button_add_picture; ?> </a>
        <?php } ?>



         <?php if ($transaction['treatment_images']) { ?>
         | <a class='viewImage'><?php echo $button_view_picture; ?> </a>

        <!-- php foreach ($transaction['treatment_images'] as $image) { ?>
        <div style='display:inline' class='treatmentimage'>

          <a class='group1' href="<php echo $image['href']; ?>">
          <img src="<php echo $image['thumb']; ?>" alt="<php echo $image['href']; ?>" id="treatmentthumb<php echo $treatment_image_row; ?>" /></a>

          <a class='group2' style='display:none'>
          <img src="<php echo $image['thumb']; ?>" alt="<php echo $image['href']; ?>" style="opacity:0.4" /></a>

          <input type="hidden" name="image[<php echo $treatment_image_row; ?>][image]" value="<php echo $image['image']; ?>" id="treatmentimage<php echo $treatment_image_row; ?>" />
        </div>
        <php } ?> -->



        <?php } ?>

      </td>
    </tr>



    <tr <?php echo "class='$color'"; ?>>
      
      <td colspan='7' class="left">

        <?php if (!$transaction['ismain'] && $transaction['status'] != 10) { ?>
          
          <?php echo $entry_beauty; ?>
            <select name='beauty<?php echo $transaction['customer_transaction_id']; ?>'>
            <option></option>
            <?php foreach ($beautys as $result) { ?>
            <?php if ($result['user_id'] == $transaction['beauty_id']) { ?>
              <option value='<?php echo $result['user_id']; ?>' selected><?php echo $result['fullname']; ?></option>
              <?php } else { ?>
            <option value='<?php echo $result['user_id']; ?>'><?php echo $result['fullname']; ?></option>
              <?php } ?>
            <?php } ?>
            </select>

          <?php echo $entry_doctor; ?>
          

            <select name='doctor<?php echo $transaction['customer_transaction_id']; ?>'>
            <option></option>
            <?php foreach ($doctors as $result) { ?>
            <?php if ($result['user_id'] == $transaction['doctor_id']) { ?>
              <option value='<?php echo $result['user_id']; ?>' selected><?php echo $result['fullname']; ?></option>
              <?php } else { ?>
            <option value='<?php echo $result['user_id']; ?>'><?php echo $result['fullname']; ?></option>
              <?php } ?>
            <?php } ?>
            </select>

          <?php echo $entry_consultant; ?>
          <select name='consultant<?php echo $transaction['customer_transaction_id']; ?>'>
            <option></option>
            <?php foreach ($consultants as $result) { ?>

            <?php if ($result['user_id'] == $transaction['consultant_id']) { ?>
              <option value='<?php echo $result['user_id']; ?>' selected><?php echo $result['fullname']; ?></option>
              <?php } else { ?>
            <option value='<?php echo $result['user_id']; ?>'><?php echo $result['fullname']; ?></option>
              <?php } ?>

            <?php } ?>
            </select>

          <?php echo $entry_outsource; ?> 
            <select name='outsource<?php echo $transaction['customer_transaction_id']; ?>'>
            <option></option>
            <?php foreach ($outsource as $result) { ?>
             
               <?php if ($result['user_id'] == $transaction['outsource_id']) { ?>
              <option value='<?php echo $result['user_id']; ?>' selected><?php echo $result['fullname']; ?></option>
              <?php } else { ?>
            <option value='<?php echo $result['user_id']; ?>'><?php echo $result['fullname']; ?></option>
              <?php } ?>

            <?php } ?>
            </select>
          <?php } ?>

        <input type='text' id='comment<?php echo $transaction['customer_transaction_id']; ?>' style='width:400px' value="<?php echo $transaction['comment']; ?>"/>
        <?php if ($transaction['type'] == 2) { ?>

        <!-- <img src="view/image/delete.png" title="<php echo $button_remove; ?>" alt="<php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove(); deleteCustomerTransaction('<php echo $transaction['customer_transaction_id']; ?>')" /> -->
        <?php } ?>

        <!-- <php if (!(!$transaction['ismain'] && $transaction['status'] != 10)) { $display="style='display:none'";} else { $display = ''; } ?> -->
        <?php if (!$transaction['ismain'] && $transaction['status'] != 10) { ?>
          <select name='tran_status' >
          <option></option>
          <option value='-1' <?php if ($transaction['status'] == -1){echo 'selected'; } ?> ><?php echo $text_transaction_unoccured; ?></option>
          <option value='-2' <?php if ($transaction['status'] == -2){echo 'selected'; } ?> ><?php echo $text_transaction_appointed; ?></option>
          <option value='2' <?php if ($transaction['status'] == 2){echo 'selected'; } ?> ><?php echo $text_transaction_finished; ?></option>
          </select>
        <?php } else { ?>
          <input value='x'/ type='hidden'>
        <?php } ?>
        <?php if ($is_insert) { ?>
        <?php if ($transaction['status'] != 2 || $transaction['canmodify']) { ?>
        <a  class='change_status_button' id='<?php echo $transaction['customer_transaction_id']; ?>'><?php echo $button_change_status; ?></a>
        <?php } ?>
        <?php } ?>
      </td>
      <!-- <td class="right"><php echo $transaction['amount']; ?></td> -->
    </tr>
    
    <!-- <tr><td colspan='7' style='background-color:lightgray' height='2' ></td></tr> -->

    <?php } ?>
    <tr>
      <!-- <td>&nbsp;</td> -->
      <!-- <td class="right"><b><php echo $text_balance; ?></b></td>
      <td class="right"><php echo $balance; ?></td> -->

    </tr>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="pagination"><?php echo $pagination; ?></div>


<link rel="stylesheet" href="view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script> 
<script type="text/javascript">  

$(".group1").on('mouseover', function(){
   $(".group1").colorbox({rel:'group1'});
});

$(".group2").on('click', function(){

   var href = $(this).children().first().attr('alt');
   $('#image2').val($('#image1').val());
   $('#image1').val(href);

   if ( $('#image1').val() != '' &&  $('#image2').val() != '') {
    var twoimage = "<img style='display:inline' src='" + $('#image2').val() + "'></img><img src='" + $('#image1').val() + "'></img>";
    $.colorbox({title:'Response',html: twoimage});
    $('#image1').val('');
    $('#image2').val('');
   }

});

// $('#button_display_image')

function deleteCustomerTransaction(id) {

  $.ajax({
      url: 'index.php?route=sale/customer/deletetransaction&token=<?php echo $token; ?>&customer_transaction_id=' + id,
      type: 'post',
      data: 'customer_transaction_id=' + id,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {
        
        $('.attention, .success, .warning').remove();

        if (json['error']) {

          $('#transaction').before('<div class="warning">' + json['error'] + '</div>');
        }

        if (json['success']) {

          $('#button-transaction').click();

          $('#transaction').before('<div class="success">' + json['success'] + '</div>');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
      } 
    });

}

$('.group_change_status_button').on('click', function(e){

  e.preventDefault();
  var status = $(this).prev().val();
  var comment = $("#comment").val();
  var beauty_id = $("select[name='beauty']").val();
  var doctor_id = $("select[name='doctor']").val();
  var consultant_id = $("select[name='consultant']").val();
  var outsource_id = $("select[name='outsource']").val();
  var unitspend = $("#unitspend").val();
  var product_id = $("#product_id_group").val();
  var customer_id = $("#customer_id_group").val();
  console.log([comment, beauty_id, doctor_id, consultant_id, outsource_id, unitspend]);

  if (status)
  $.ajax({
      url: 'index.php?route=sale/customer/editgrouptransaction&token=<?php echo $token; ?>',
      type: 'post',
      data: 'status=' + status + '&comment=' + comment+ '&doctor_id=' + doctor_id+ '&consultant_id=' + consultant_id + '&outsource_id=' + outsource_id  + '&beauty_id=' + beauty_id + '&unitspend='+ unitspend + '&product_id='+ product_id+ '&customer_id='+ customer_id ,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {
    console.log(json);
        if (json['error']) {
          $('#transaction').before('<div class="warning">' + json['error'] + '</div>');
        }

        if (json['success']) {
          // $('#button-transaction').click();
          $('#button-filter').click();
          $('#transaction').before('<div class="success">' + json['success'] + '</div>');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
      } 
    });


});

$('.change_status_button').on('click', function(e){
  
  e.preventDefault();
  var id = $(this).attr('id')  

  var status = $(this).prev().val();
  var comment = $("#comment" + id).val();
  var beauty_id = $("select[name='beauty" + id + "']").val();
  var doctor_id = $("select[name='doctor" + id + "']").val();
  var consultant_id = $("select[name='consultant" + id + "']").val();
  var outsource_id = $("select[name='outsource" + id + "']").val();

  $('.attention, .success, .warning').remove();

  if (status)
  $.ajax({
      url: 'index.php?route=sale/customer/edittransaction&token=<?php echo $token; ?>',
      type: 'post',
      data: 'customer_transaction_id=' + id + '&status=' + status + '&comment=' + comment+ '&doctor_id=' + doctor_id+ '&consultant_id=' + consultant_id + '&outsource_id=' + outsource_id  + '&beauty_id=' + beauty_id,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {
    
        if (json['error']) {
          $('#transaction').before('<div class="warning">' + json['error'] + '</div>');
        }

        if (json['success']) {
          // $('#button-transaction').click();
          $('#button-filter').click();
          $('#transaction').before('<div class="success">' + json['success'] + '</div>');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
      } 
    });
  
});

</script>

<script type="text/javascript"><!--

  var treatment_image_row = <?php echo $treatment_image_row; ?>;

$('.viewImage').on('click', function(e){
  e.preventDefault();
  
  var ID = $(this).parent().children().first().val();

  window.open("index.php?route=image/imagemanage/treatmentimage&token=<?php echo $token; ?>&customer_transaction_id=" + ID);
});

$('.addImage2').on('click', function(e){
  e.preventDefault();
  
  var ID = $(this).parent().children().first().val();

  image_upload_treat('treatmentimage<?php echo $treatment_image_row; ?>', 'treatmentthumb<?php echo $treatment_image_row; ?>', ID);
});

var add_filter_product = function(product_id, product_name){
  $('input[name=product]').val(product_name);
  $('input[name=product_name]').val(product_name);
  $('input[name=product_id]').val(product_id);
  $('input[name=treatment_product]').val(product_name);
  $('input[name=treatment_product_name]').val(product_name);
  $('input[name=treatment_product_id]').val(product_id);
  $('a#button-filter').click();
}

function image_upload_treat(field, thumb, id) {
  $('#dialog').remove();  

  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  var customer_id = '<?php echo $filter_customer_id; ?>';
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      // if (true) {

      if ($('#' + field).attr('value')) {
        
        $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
          dataType: 'text',
          success: function(text) {
            
            var thumbimage  = text;
            var lastdot = thumbimage.lastIndexOf(".");
            var firstdata = thumbimage.indexOf("data");
            var lastdash = thumbimage.lastIndexOf("-");
            var imageimage = text.substring(firstdata, lastdash) + text.substring(lastdot, text.length);
            var customer_transaction_id = id;
            
            var html = '<div class="treatmentimage" style="display:inline"><img src="' + thumbimage + '" alt="" id="treatmentthumb' + treatment_image_row + '" />';
              html += '<input type="hidden" value="' + imageimage + '" name="treatment_image[' + treatment_image_row + '][image]" id="treatmentimage' + treatment_image_row +'" /></div>';
              
              
          
              if (text)
              $.ajax({
                url: 'index.php?route=sale/customer/recordimage&token=<?php echo $token; ?>',
                type: 'POST',
                // dataType: 'xml/html/script/json/jsonp',
                data: 'image=' + imageimage + '&customer_id=' + customer_id + '&customer_transaction_id=' + customer_transaction_id,
                dataType: 'json',
                complete: function(xhr, textStatus) {

                },
                success: function(json, textStatus, xhr) {
                  
                  if (json['success'] ) {
                    $('#hidden' + id).after(html);
                
                    $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
              
                    $('.success').fadeIn('slow');
        
                  } 
                  if (json['error']) {
                    $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
              
                    $('.warning').fadeIn('slow');
                  }
                },
                error: function(xhr, textStatus, errorThrown) {

                }
              });
              
              treatment_image_row++;
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


$('select[type="product"]').change(function(){
  var value = $(this).find(":selected").attr('alt2');
  var unit = $(this).find(":selected").attr('alt');
  var product_id = $(this).val();
  if (value && unit) $('#units').text(value + ' ' + unit);
  if (value && unit) $('#units2').text( unit);
  if (value && unit) $('#product_id_group').val( product_id);

  if (!$(this).val()) {
    $('#units').text('');
    $('#units2').text('');
    $('#product_id_group').val('');
  }
})

//--></script> 