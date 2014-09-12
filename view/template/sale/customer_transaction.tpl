<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $column_date_added; ?></td>
      <td class="left"><?php echo $column_product; ?></td>
      <td class="left"><?php echo $column_quantity; ?></td>
      <td class="left"><?php echo $column_unit_quantity; ?></td>
      <td class="left"><?php echo $column_unit; ?></td>
      <td class="left"></td>
      <!-- <td class="right"><php echo $column_amount; ?></td> -->
    </tr>
  </thead>
  <tbody>
    <?php if ($transactions) { ?>
    <?php foreach ($transactions as $transaction) { ?>
    <tr>
      <td class="left"><?php echo $transaction['date_added']; ?></td>
      <td class="left"><?php echo $transaction['product_name']; ?></td>
      <td class="left"><?php echo $transaction['quantity']; ?></td>
      <td class="left"><?php echo $transaction['subquantity']; ?></td>
      <td class="left"><?php echo $transaction['unit']; ?></td>
      <td class="right" style="width: 3px;">
        <?php if ($transaction['type'] == 2) { ?>
        <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove(); deleteCustomerTransaction('<?php echo $transaction['customer_transaction_id']; ?>')" />
        <?php } ?>
      </td>
      <!-- <td class="right"><php echo $transaction['amount']; ?></td> -->
    </tr>
    <?php } ?>
    <tr>
      <!-- <td>&nbsp;</td> -->
      <!-- <td class="right"><b><php echo $text_balance; ?></b></td>
      <td class="right"><php echo $balance; ?></td> -->
    </tr>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="3"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="pagination"><?php echo $pagination; ?></div>


<?php echo $text_service_not_rendered; ?>
<table class="list">
  <thead>
    <tr>
      <td class="left"><?php echo $column_product; ?></td>
      <td class="left"><?php echo $column_quantity; ?></td>
      <td class="left"><?php echo $column_total_units; ?></td>
      <td class="left"><?php echo $column_unit; ?></td>
      <!-- <td class="right"><php echo $column_amount; ?></td> -->
    </tr>
  </thead>
  <tbody>
    <?php if ($grouptransactions) { ?>
    <?php foreach ($grouptransactions as $transaction) { ?>
    <tr>
      <td class="left"><?php echo $transaction['name']; ?></td>
      <td class="left"><?php echo $transaction['quantity']; ?></td>
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
      <td class="center" colspan="3"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>


<script type="text/javascript">  

function deleteCustomerTransaction(id) {

  $.ajax({
      url: 'index.php?route=sale/customer/deletecustomertransaction&token=<?php echo $token; ?>&customer_transaction_id=' + id,
      type: 'post',
      data: 'customer_transaction_id=' + id,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {
        
        $('.attention, .success').remove();

        if (json['error']) {

          $('#transaction').before('<div class="attention"><?php echo $text_error; ?></div>');

          // $('#transaction').html('<div class="error" style="display: none;">' + json['error'] + '</div>');
                    
          //   $('.error').fadeIn('slow');

          //   $('html, body').animate({ scrollTop: 0 }, 'slow'); 
        }

        if (json['success']) {

          $('#transaction').before('<div class="success"><?php echo $text_success; ?></div>');

          // $('#transaction').html('<div class="success" style="display: none;">' + json['success'] + '</div>');
                    
          //   $('.success').fadeIn('slow');

          //   $('html, body').animate({ scrollTop: 0 }, 'slow'); 
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
      } 
    });

}

</script>

