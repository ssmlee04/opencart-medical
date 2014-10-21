
<table id="images" class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $entry_image; ?></td>
      <td class="left"><?php echo $entry_comment; ?></td>
      <td class="left"><?php echo $entry_date_added; ?></td>
      <td class="right"></td>
    </tr>
  </thead>
  <?php $image_row = 0; ?>
  <?php foreach ($customer_images as $customer_image) { ?>
  <tbody id="image-row<?php echo $image_row; ?>">
    <tr>
      <td class="left"><div class="image"><a href="<?php echo $customer_image['bigimage']; ?>" class='group1'><img src="<?php echo $customer_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" /></a>
          <input type="hidden" name="customer_image[<?php echo $image_row; ?>][image]" value="<?php echo $customer_image['image']; ?>" id="image<?php echo $image_row; ?>" />
          <input type="hidden" name="customer_image[<?php echo $image_row; ?>][customer_transaction_id]" value="<?php echo $customer_image['customer_transaction_id']; ?>" id="trimage<?php echo $image_row; ?>"/>
          <input type="hidden" name="customer_image[<?php echo $image_row; ?>][customer_image_id]" value="<?php echo $customer_image['customer_image_id']; ?>" id="idimage<?php echo $image_row; ?>"/>
          <br />
          <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
      <td class="left">
        &nbsp;
        <input type="text" name="customer_image[<?php echo $image_row; ?>][comment]" value="<?php echo $customer_image['comment']; ?>" size='100px'/>
        <a class='commentImage' id='<?php echo $customer_image['customer_image_id']; ?>'><?php echo $button_update_comment; ?></a>
      </td>
      <td class="right">
        <input style='display:none' type="date_available" name="customer_image[<?php echo $image_row; ?>][date_added]" value="<?php echo $customer_image['date_added']; ?>" class="date"/><?php echo $customer_image['date_added']; ?>
      </td>
      <td class="right"><a onclick="$('#image-row<?php echo $image_row; ?>').remove(); deleteImage(<?php echo $customer_image['customer_image_id']; ?>)" class="button4"><?php echo $button_remove; ?></a></td>
    </tr>
  </tbody>
  <?php $image_row++; ?>
  <?php } ?>
  <tfoot>
    <tr>
      <td colspan="3"></td>
      <td class="right"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
    </tr>
  </tfoot>
</table>



<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

$('.commentImage').on('click', function(){
  var customer_image_id = $(this).attr('id');
  var comment = $(this).prev().val();
  $.ajax({
    url: 'index.php?route=sale/customer/updateimagecomment&token=<?php echo $token; ?>',
    type: 'POST',
    dataType: 'json',
    data: 'customer_image_id=' + customer_image_id + '&comment=' + comment, 
    complete: function(xhr, textStatus) {
      //called when complete
    },
    success: function(json, textStatus, xhr) {
      $('.attention, .success, .warning').remove();
      
     if (json['error']) {
        $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
        
       $('.warning').fadeIn('slow');
     }
            
     if (json['success'] || json['success'] === 0) {
      $('.box').before('<div class="success" style="display: none;"><?php echo $text_update_comment_success; ?></div>');
        
       $('.success').fadeIn('slow');
     }

    },
    error: function(xhr, textStatus, errorThrown) {
      //called when there is an error
    }
  });
})


function deleteImage(customer_image_id) {

  // var customer_image_id = $(this).parent().parent().children().first().children().children().eq(3).val();
  // console.log($(this).parent().parent().children().first().children().children().eq(3));

  $.ajax({
    url: 'index.php?route=sale/customer/deleteimage&token=<?php echo $token; ?>',
    type: 'POST',
    dataType: 'json',
    data: 'customer_image_id=' + customer_image_id, 
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
  
  image_row--;
}

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
  html += '  <tr>';
  html += '    <td class="left">';
  html += '<div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" />';
  html += '<input type="hidden" name="customer_image[' + image_row + '][image]" value="" id="image' + image_row + '" />';
  html += '<input type="hidden" name="customer_image[' + image_row + '][customer_transaction_id]" value="" id="trimage' + image_row + '" /><br />';
  html += '<input type="hidden" name="customer_image[' + image_row + '][customer_image_id]" value="" id="idimage' + image_row + '" /><br />';
  html += '<a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
  html += '<td></td>';
  html += '<td></td>';
  // html += '    <td class="right"><input type="date_available" class="date" name="customer_image[' + image_row + '][date_added]" value="" size="2" /></td>';
  html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
  html += '  </tr>';
  html += '</tbody>';
  
  $('#images tfoot').before(html);
  
  image_row++;
}
//--></script> 

<link rel="stylesheet" href="view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script> 
<script type="text/javascript">  

$(".group1").on('mouseover', function(){
   $(".group1").colorbox({rel:'group1'});
});

</script>