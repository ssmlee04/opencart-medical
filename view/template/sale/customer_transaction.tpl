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
      <!-- <td class="left"></td> -->
      <td class="left"><?php echo $column_product; ?></td>
      <td class="left"><?php echo $column_quantity; ?></td>
      <td class="left"><?php echo $column_unit_quantity; ?></td>
      <td class="left"><?php echo $column_unit; ?></td>
      <td class="left"></td>
      <td class="right"></td>
      <!-- <td class="right"><php echo $column_amount; ?></td> -->
    </tr>
  </thead>
  <tbody>
    <?php if ($transactions) { ?>
    <?php foreach ($transactions as $transaction) { ?>
    <tr>
      <td class="left"><?php echo $transaction['date_added']; ?> 
        <?php if ($transaction['product_which'] > 0) { ?>
          <span>(<?php echo $text_appointment . $transaction['product_which'] . '/' . $transaction['product_total_which']; ?>)</span>
        <?php } ?>
        <input type='hidden' value='<?php echo $transaction['customer_transaction_id']; ?> ' />
      </td>
      <td class="left"><?php echo $transaction['date_modified']; ?></td>
      
    

      <td class="left"><?php echo $transaction['product_name']; ?></td>
      <td class="left"><?php echo $transaction['quantity']; ?></td>
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
      <td class="left"><input type='text' id='comment' style='width:400px'/>
      

        <?php if ($transaction['type'] == 2) { ?>
        <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(this).parent().parent().remove(); deleteCustomerTransaction('<?php echo $transaction['customer_transaction_id']; ?>')" />
        <?php } ?>

        <?php if (!$transaction['ismain'] && $transaction['status'] != 10) { ?>
          <select name='tran_status'>
          <option></option>
          <option value='-1' <?php if ($transaction['status'] == -1){echo 'selected'; } ?> ><?php echo $text_transaction_unoccured; ?></option>
          <option value='-2' <?php if ($transaction['status'] == -2){echo 'selected'; } ?> ><?php echo $text_transaction_appointed; ?></option>
          <option value='2' <?php if ($transaction['status'] == 2){echo 'selected'; } ?> ><?php echo $text_transaction_finished; ?></option>
          </select><input type='button' class='tran_status_btn' value='<?php echo $button_change_status; ?>'/>
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
      <td class="left"><?php echo $column_quantity; ?></td>
      <td class="left"><?php echo $column_total_units; ?></td>
      <td class="left"><?php echo $column_unit; ?></td>
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
      <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>

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

$('.tran_status_btn').on('click', function(e){
  e.preventDefault();
  var status = $(this).prev().val();
  var id = $(this).parent().parent().children().first().children().last().val()

  console.log('status: ' + status, 'id: ' + id);
  if (status)
  $.ajax({
      url: 'index.php?route=sale/customer/editcustomertransaction&token=<?php echo $token; ?>',
      type: 'post',
      data: 'customer_transaction_id=' + id + '&status=' + status,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {
        console.log(json);
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
  
});
</script>

