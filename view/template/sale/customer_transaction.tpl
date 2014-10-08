<!-- <link rel="stylesheet" href="colorbox.css" /> -->
<!-- <script type="text/javascript" src="view/javascript/colorbox/jquery.colorbox-min"></script>  -->

<?php if (isset($error_warning) && $error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if (isset($success) && $success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $column_date_added; ?></td>
      <td class="left"><?php echo $column_date_modified; ?></td>
      <td class="left"><?php echo $column_customer; ?></td>
      <!-- <td class="left"></td> -->
      <td class="left"><?php echo $column_product; ?></td>
      <!-- <td class="left"><php echo $column_quantity; ?></td> -->
      <td class="left"><?php echo $column_unit_quantity; ?></td>
      <td class="left"><?php echo $column_unit; ?></td>
      <td class="right"></td>
      <!-- <td class="right"><php echo $column_amount; ?></td> -->
    </tr>
  </thead>
  <tbody>
    <?php if ($transactions) { ?>
    <?php foreach ($transactions as $transaction) { ?>
    <!-- <.php if ($transaction['status'] == 0) continue; ?> -->
    <tr>
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
      <td class="left"><?php echo $transaction['subquantity']; ?></td>
      <td class="left"><?php echo $transaction['unit']; ?></td>
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
    </tr>



    <tr>
      <td class="left">
        <input type='hidden' value='<?php echo $transaction['customer_transaction_id']; ?>' id='hidden<?php echo $transaction['customer_transaction_id']; ?>'/>
        <?php $treatment_image_row = 0; ?>
        <?php if ($transaction['treatment_images']) { ?>
        <?php foreach ($transaction['treatment_images'] as $image) { ?>
        <div style='display:inline' class='treatmentimage'>

          <!-- href="php echo $image['href']; ?>" -->
          <a class='group1' href="<?php echo $image['href']; ?>">

          <img src="<?php echo $image['thumb']; ?>" alt="<?php echo $image['href']; ?>" id="treatmentthumb<?php echo $treatment_image_row; ?>" /></a>
          <input type="hidden" name="image[<?php echo $treatment_image_row; ?>][image]" value="<?php echo $image['image']; ?>" id="treatmentimage<?php echo $treatment_image_row; ?>" />

                    <!-- <img src="<php echo $customer_image['thumb']; ?>" alt="" id="thumb<php echo $image_row; ?>" /> -->
                    <!-- <input type="hidden" name="customer_image[<php echo $image_row; ?>][image]" value="<php echo $customer_image['image']; ?>" id="image<php echo $image_row; ?>" /> -->
        </div>
        <?php } ?>
        <?php } ?>
         <input type="hidden" name="image[<?php echo $treatment_image_row; ?>][image]" value="<?php echo $image['image']; ?>" id="treatmentimage<?php echo $treatment_image_row; ?>" />

        <a class='addImage2'><?php echo $button_add_picture; ?></a>
      </td>
      <td colspan='6' class="left">

        <?php if (!$transaction['ismain'] && $transaction['status'] != 10) { ?>
          
          beauty
            <select name=''>
            <option></option>
            <?php foreach ($beautys as $result) { ?>
            <?php if ($result['user_id'] == $transaction['beauty_id']) { ?>
              <option value='<?php echo $result['user_id']; ?>' selected><?php echo $result['fullname']; ?></option>
              <?php } else { ?>
            <option value='<?php echo $result['user_id']; ?>'><?php echo $result['fullname']; ?></option>
              <?php } ?>
            <?php } ?>
            </select>

          doctor
            <select name=''>
            <option></option>
            <?php foreach ($doctors as $result) { ?>
            <?php if ($result['user_id'] == $transaction['doctor_id']) { ?>
              <option value='<?php echo $result['user_id']; ?>' selected><?php echo $result['fullname']; ?></option>
              <?php } else { ?>
            <option value='<?php echo $result['user_id']; ?>'><?php echo $result['fullname']; ?></option>
              <?php } ?>
            <?php } ?>
            </select>

          consultant
          <select name=''>
            <option></option>
            <?php foreach ($consultants as $result) { ?>

            <?php if ($result['user_id'] == $transaction['consultant_id']) { ?>
              <option value='<?php echo $result['user_id']; ?>' selected><?php echo $result['fullname']; ?></option>
              <?php } else { ?>
            <option value='<?php echo $result['user_id']; ?>'><?php echo $result['fullname']; ?></option>
              <?php } ?>

            <?php } ?>
            </select>

          outsource        
            <select name=''>
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


        <input type='text' id='comment' style='width:400px' value="<?php echo $transaction['comment']; ?>"/>
        <?php if ($transaction['type'] == 2) { ?>
        <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove(); deleteCustomerTransaction('<?php echo $transaction['customer_transaction_id']; ?>')" />
        <?php } ?>

        <!-- <php if (!(!$transaction['ismain'] && $transaction['status'] != 10)) { $display="style='display:none'";} else { $display = ''; } ?> -->
        <?php if (!$transaction['ismain'] && $transaction['status'] != 10) { ?>
          <select name='tran_status' <?php echo $display; ?>>
          <option></option>
          <option value='-1' <?php if ($transaction['status'] == -1){echo 'selected'; } ?> ><?php echo $text_transaction_unoccured; ?></option>
          <option value='-2' <?php if ($transaction['status'] == -2){echo 'selected'; } ?> ><?php echo $text_transaction_appointed; ?></option>
          <option value='2' <?php if ($transaction['status'] == 2){echo 'selected'; } ?> ><?php echo $text_transaction_finished; ?></option>
          </select>
        <?php } else { ?>
          <input value='x'/ type='hidden'>
        <?php } ?>
        <a class='change_status_button'><?php echo $button_change_status; ?></a>
      </td>
      <!-- <td class="right"><php echo $transaction['amount']; ?></td> -->
    </tr>
    <tr><td colspan='7' style='background-color:lightgray' height='2' ></td></tr>
    <?php } ?>
    <tr>
      <!-- <td>&nbsp;</td> -->
      <!-- <td class="right"><b><php echo $text_balance; ?></b></td>
      <td class="right"><php echo $balance; ?></td> -->

    </tr>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="pagination"><?php echo $pagination; ?></div>

<?php if (isset($show_group) && $show_group) { ?>
<?php echo $text_service_not_rendered; ?>
<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $column_product; ?></td>
      <!-- <td class="left"><php echo $column_quantity; ?></td> -->
      <td class="left"><?php echo $column_unit_quantity; ?></td>
      <td class="left"><?php echo $column_unit; ?></td>
    </tr>
  </thead>
  <tbody>
    <?php if ($grouptransactions) { ?>
    <?php foreach ($grouptransactions as $transaction) { ?>
    <tr>
      <td class="left"><?php echo $transaction['name']; ?></td>
      <!-- <td class="left"><hp echo $transaction['quantity']; ?></td> -->
      <td class="left"><?php echo $transaction['subquantity']; ?></td>
      <td class="left"><?php echo $transaction['unit']; ?></td>
    </tr>
    <?php } ?>
    <tr>
      <!-- <td>&nbsp;</td> -->
      <!-- <td class="right"><b><php echo $text_balance; ?></b></td>
      <td class="right"><php echo $balance; ?></td> -->
    </tr>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>

<link rel="stylesheet" href="view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script> 
<script type="text/javascript">  
$(".group1").on('mouseover', function(){
   $(".group1").colorbox({rel:'group1'});
});

$(".group1").on('click', function(){
   var href = $(this).children().first().attr('alt');
   $('#image2').val($('#image1').val());
   $('#image1').val(href);
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

$('.change_status_button').on('click', function(e){
  e.preventDefault();

  var status = $(this).prev().val();
  var comment = $(this).prev().prev().val();
  var beauty_id = $(this).prev().prev().prev().prev().prev().prev().val();
  var doctor_id = $(this).prev().prev().prev().prev().prev().val();
  var consultant_id = $(this).prev().prev().prev().prev().val();
  var outsource_id = $(this).prev().prev().prev().val();
  var id = $(this).parent().parent().children().first().children().first().val();

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
          $('#button-transaction').click();
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

$('.addImage2').on('click', function(e){
  e.preventDefault();
  
  var ID = $(this).parent().children().first().val();

  image_upload_treat('treatmentimage<?php echo $treatment_image_row; ?>', 'treatmentthumb<?php echo $treatment_image_row; ?>', ID);
});
//--></script> 



<script type="text/javascript"><!--

function image_upload_treat(field, thumb, id) {
  $('#dialog').remove();  

  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  var customer_id = '<?php echo $customer_id; ?>';
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      // if (true) {

      if ($('#' + field).attr('value')) {
        
        $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
          dataType: 'text',
          success: function(text) {
            // $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
            console.log(text);
            var thumbimage  = text;
            var lastdot = thumbimage.lastIndexOf(".");
            var firstdata = thumbimage.indexOf("data");
            var lastdash = thumbimage.lastIndexOf("-");
            var imageimage = text.substring(firstdata, lastdash) + text.substring(lastdot, text.length);
            var customer_transaction_id = id;
            
            var html = '<a class=\'group1\' href="' + thumbimage + '"><div class="treatmentimage" style="display:inline"><img src="' + thumbimage + '" alt="" id="treatmentthumb' + treatment_image_row + '" /></a>';
              html += '<input type="hidden" value="' + imageimage + '" name="treatment_image[' + treatment_image_row + '][image]" id="treatmentimage' + treatment_image_row +'" /></div>';
              
              $('#hidden' + id).after(html);
              
              if (text)
              $.ajax({
                url: 'index.php?route=sale/customer/recordimage&token=<?php echo $token; ?>',
                type: 'POST',
                // dataType: 'xml/html/script/json/jsonp',
                data: 'image=' + imageimage + '&customer_id=' + customer_id + '&customer_transaction_id=' + customer_transaction_id,
                complete: function(xhr, textStatus) {
                  //called when complete

                },
                success: function(data, textStatus, xhr) {
                  //called when successful
                  // addImage();
                
                  // $('#thumb' + (image_row - 1)).replaceWith('<img src="' + thumbimage + '" alt="" id="thumb' + (image_row - 1) + '" />');
                  // $('#image' + image_row).replaceWith('<input src="' + text + '" alt="" id="image' + image_row + '" />');

                },
                error: function(xhr, textStatus, errorThrown) {
                  //called when there is an error
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


//--></script> 