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
      <td class="left"><?php echo $column_lender; ?></td>
      <td class="left"><?php echo $column_user; ?></td>
      <td class="left"><?php echo $column_product; ?></td>
      <!-- <td class="left"><php echo $column_quantity; ?></td> -->
      <!-- <td class="left"><php echo $column_unit_quantity; ?></td> -->
      <td class="left"><?php echo $column_unit; ?></td>
      <td class="left"></td>
      <!-- <td class="right"><php echo $column_amount; ?></td> -->
    </tr>
  </thead>
  <tbody>
    <?php if (isset($results) && $results) { ?>
    <?php foreach ($results as $borrow) { ?>
    <tr>
      <td class="left"><?php echo $borrow['date_added']; ?></td>
      <td class="left"><?php echo $borrow['borrowerlastname'] . $borrow['borrowerfirstname']; ?></td>
      <td class="left"><?php echo $borrow['lenderlastname'] . $borrow['lenderfirstname']; ?></td>
      <td class="left"><?php echo $borrow['ulastname'] . $borrow['ufirstname']; ?></td>
      <td class="left"><?php echo $borrow['product_name']; ?></td>
      <!-- <td class="left"><php echo $borrow['quantity']; ?></td> -->
      <!-- <td class="left"><php echo $borrow['subquantity']; ?></td> -->
      <td class="left"><?php echo $borrow['subquantity'] * $borrow['value']; ?>  <?php echo $borrow['unit']; ?></td>
      <td class="right" style="width: 3px;">
        <div class='group12'>
        <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="deleteCustomerlending2('<?php echo $borrow['customer_lending_id']; ?>', this)" />
      </img>
      </td>
      <!-- <td class="right"><php echo $borrow['amount']; ?></td> -->
    </tr>
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

<script type="text/javascript">  

function deleteCustomerlending2(id, that) {
  
  $.ajax({
      url: 'index.php?route=sale/customer/deletecustomerlending&token=<?php echo $token; ?>&customer_lending_id=' + id,
      type: 'post',
      data: 'customer_lending_id=' + id,
      dataType: 'json',
      beforeSend: function(){
      
      },
      success: function(json) {

          
        // window.aaaa = $(this)
        // var parenttable = $(this).parent().parent().parent().parent();
        // console.log(parenttable);
        $('.attention, .success, .warning').remove();

        if (json['error']) {

          $(that).parent().parent().parent().parent().parent().before('<div class="warning">' + json['error'] + '</div>');
        }

        if (json['success']) {

          $(that).parent().parent().parent().parent().parent().before('<div class="success">' + json['success'] + '</div>');

          $(that).parent().parent().parent().remove(); 

        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
      } 
    });

}

</script>

