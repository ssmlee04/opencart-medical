<link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/style.css" rel="stylesheet" />
  <link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/common.css" rel="stylesheet" />
  <link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/bootstrap-responsive.css" rel="stylesheet" />
  <link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/style-responsive.css" rel="stylesheet" />



  <div class="box">
    <div class="content">
     
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
              <td><?php echo $text_total_amount; ?></td>
          <!--     <td><php echo $text_payment_cash; ?></td>
              <td><php echo $text_payment_visa; ?></td>
              <td><php echo $text_payment_balance; ?></td>
              <td><php echo $text_payment_final; ?></td> -->
              <td><?php echo $text_user_fullname; ?></td>
              
          </tr>
        </thead>
        <tbody>
          <?php if ($treatment_bonus) { ?>
          <?php foreach ($treatment_bonus as $result) { ?>
    
            <tr>
              <td><?php echo $result['cfullname']; ?></td>
              <td><?php echo $result['customer_id']; ?></td>
              <td><?php echo $result['product_name']; ?></td>
              <td><?php echo $result['date_modified']; ?></td>
              <td><?php echo $result['comment']; ?></td>
              <td><?php echo $result['subquantity']; ?></td>
              <td><?php echo $result['doctor_name']; ?></td>
              <td><?php echo $result['outsource_name']; ?></td>
              <td><?php echo $result['consultant_name']; ?></td>
              <td><?php echo $result['beauty_name']; ?></td>
              <td><?php echo $result['total_amount']; ?></td>
              <!-- <td><php echo $result['payment_cash']; ?></td> -->
              <!-- <td><php echo $result['payment_visa']; ?></td> -->
              <!-- <td><php echo $result['payment_balance']; ?></td> -->
              <!-- <td><php echo $result['payment_final']; ?></td> -->
              <td><?php echo $result['ufullname']; ?></td>
            </tr>
          <?php } ?>
          <?php } ?>
        </tbody>
      </table>
      <!-- <div class="pagination"><php echo $pagination; ?></div> -->
    </div>
  </div>
</div>