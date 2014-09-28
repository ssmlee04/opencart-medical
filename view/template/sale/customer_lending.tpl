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
      <td class="left"><?php echo $column_borrower; ?></td>
      <td class="left"><?php echo $column_user; ?></td>
      <td class="left"><?php echo $column_product; ?></td>
      <!-- <td class="left"><php echo $column_quantity; ?></td> -->
      <td class="left"><?php echo $column_unit_quantity; ?></td>
      <td class="left"><?php echo $column_unit; ?></td>
      <td class="left"></td>
      <!-- <td class="right"><php echo $column_amount; ?></td> -->
    </tr>
  </thead>
  <tbody>
    <?php if ($lendings) { ?>
    <?php foreach ($lendings as $lending) { ?>
    <tr>
      <td class="left"><?php echo $lending['date_added']; ?></td>
      <td class="left"><?php echo $lending['borrowerlastname'] . $lending['borrowerfirstname']; ?></td>
      <td class="left"><?php echo $lending['ulastname'] . $lending['ufirstname']; ?></td>
      <td class="left"><?php echo $lending['product_name']; ?></td>
      <!-- <td class="left"><php echo $lending['quantity']; ?></td> -->
      <td class="left"><?php echo $lending['subquantity']; ?></td>
      <td class="left"><?php echo $lending['unit']; ?></td>
      <td class="right" style="width: 3px;">
        <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove(); deleteCustomerlending('<?php echo $lending['customer_lending_id']; ?>')" />
      </td>
      <!-- <td class="right"><php echo $lending['amount']; ?></td> -->
    </tr>
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

<script type="text/javascript">  

function deleteCustomerlending(id) {
  
  $.ajax({
      url: 'index.php?route=sale/customer/deletecustomerlending&token=<?php echo $token; ?>&customer_lending_id=' + id,
      type: 'post',
      data: 'customer_lending_id=' + id,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {
        console.log(json);
        $('.attention, .success, .warning').remove();

        if (json['error']) {

          $('#lendto').before('<div class="warning">' + json['error'] + '</div>');
        }

        if (json['success']) {

          // $('#button-lending').click();

          $('#lendto').before('<div class="success">' + json['success'] + '</div>');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
      } 
    });

}

</script>

