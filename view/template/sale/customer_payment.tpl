<!-- <link rel="stylesheet" href="colorbox.css" /> -->
<!-- <script type="text/javascript" src="view/javascript/colorbox/jquery.colorbox-min"></script>  -->

<?php if (isset($error_warning) && $error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if (isset($success) && $success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>


<table class="form">
  <?php $switch = 1; ?>
  <?php $currentdate = ''; ?>
  <?php foreach ($payments as $payment) { ?>
  <?php $prevdate = $currentdate; ?>
  <?php $currentdate = $payment['date_added']; ?>
  <tr>
    <?php if ($prevdate != $currentdate) $switch *= -1; ?>
    <td class='color<?php echo $switch; ?>'><?php echo $payment['order_id']; ?></td>
    <td class='color<?php echo $switch; ?>'><?php echo $payment['message']; ?></td>
    <td class='color<?php echo $switch; ?>'><?php echo $payment['date_added']; ?></td>
    <td class='color<?php echo $switch; ?>'><?php echo $payment['amount']; ?></td>
  </tr>
  <?php } ?>
</table>

<table class="form">

  <tr onclick="$('.payment').toggle()">
    <td><?php echo $text_total_payment; ?></td>
    <td><?php echo $total_payment; ?></td>
  </tr>

  <tr class='payment'>
    <td><?php echo $text_total_cash; ?></td>
    <td><?php echo $total_cash; ?></td>
  </tr>

  <tr class='payment'>
    <td><?php echo $text_total_visa; ?></td>
    <td><?php echo $total_visa; ?></td>
  </tr>

  


  <tr>
    <td><?php echo $text_total_expense; ?></td>
    <td><?php echo -$total_expense; ?></td>
  </tr>


  <tr class='color1'>
    <td><?php echo $text_remaining_balance; ?></td>
    <td><?php echo -$balance; ?></td>
  </tr>
</table>