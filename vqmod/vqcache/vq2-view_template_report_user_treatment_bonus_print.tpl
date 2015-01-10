<link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/style.css" rel="stylesheet" />
  <link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/common.css" rel="stylesheet" />
  <link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/bootstrap-responsive.css" rel="stylesheet" />
  <link type="text/css" href="view/stylesheet/admin_theme/base5builder_impulsepro/style-responsive.css" rel="stylesheet" />



  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-reports-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			

    </div>
    
			<div class="content sales-report">
			
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
          <td style="text-align: right;" colspan='1'><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
          <td style="text-align: right;" colspan='1'><a onclick="print();" class="button"><?php echo $button_print; ?></a></td>
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