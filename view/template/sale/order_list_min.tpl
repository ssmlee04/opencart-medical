

    <!-- <div class="heading"> -->
      <!-- <h1><img src="view/image/order.png" alt="" /> <php echo $heading_title; ?></h1> -->
      <div class="buttons2">
        <!-- <a onclick="$('#form').attr('action', '?php echo $invoice; ?>'); $('#form').attr('target', '_blank'); $('#form').submit();" class="button"> -->
          <!-- <php echo $button_invoice; ?> -->
          <!-- </a> -->
          <a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a>
          <a onclick="$('#form').attr('action', '<?php echo $delete; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="button"><?php echo $button_delete; ?></a>
        </div><br>
    <!-- </div> -->
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <!-- <td class="right"><php if ($sort == 'o.order_id') { ?>
                <a href="<php echo $sort_order; ?>" class="<php echo strtolower($order); ?>"><php echo $column_order_id; ?></a>
                <php } else { ?>
                <a href="<php echo $sort_order; ?>"><php echo $column_order_id; ?></a>
                <php } ?></td> -->
              <td class="left"><?php if ($sort == 'customer') { ?>
                <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="right"><?php if ($sort == 'o.total') { ?>
                <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_total; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_total; ?>"><?php echo $column_total; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'o.date_added') { ?>
                <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'o.date_modified') { ?>
                <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          
          <tbody>
            


            <!-- <tr class="filter"> -->
              <!-- <td></td> -->

              <!-- <td><input type="text" name="filter_customer" value="<php echo $filter_customer; ?>" /></td>
              <td><select name="filter_order_status_id">
                  <option value="*"></option>
                  <php foreach ($order_statuses as $order_status) { ?>
                  <php if ($order_status['order_status_id'] == $filter_order_status_id) { ?>
                  <option value="<php echo $order_status['order_status_id']; ?>" selected="selected"><php echo $order_status['name']; ?></option>
                  <php } else { ?>
                  <option value="<php echo $order_status['order_status_id']; ?>"><php echo $order_status['name']; ?></option>
                  <php } ?>
                  <php } ?>
                </select></td>
              <td align="right">
                <input type="text" name="filter_total_min" value="<php echo $filter_total_min; ?>" size="4" style="text-align: right;" /> ~ <input type="text" name="filter_total_max" value="<php echo $filter_total_max; ?>" size="4" style="text-align: right;" />
              </td> -->
              <!-- <td>
                <input type="text" name="filter_date_added_start" value="<php echo $filter_date_added_start; ?>" size="12" class="date" />  ~
                <input type="text" name="filter_date_added_end" value="<php echo $filter_date_added_end; ?>" size="12" class="date" />
              </td>
              <td>
                <input type="text" name="filter_date_modified_start" value="<php echo $filter_date_modified_start; ?>" size="12" class="date" /> ~ 
                <input type="text" name="filter_date_modified_end" value="<php echo $filter_date_modified_end; ?>" size="12" class="date" />
              </td>
              <td align="right"><a onclick="filter();" class="button"><php echo $button_filter; ?></a></td>
            </tr> -->


            <?php if ($orders) { ?>
            <?php foreach ($orders as $order) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($order['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                <?php } ?></td>
              <!-- <td class="right"><php echo $order['order_id']; ?></td> -->
              <td class="left"><?php echo $order['customer']; ?></td>
              <td class="left"><?php echo $order['status']; ?></td>
              <td class="right"><?php echo $order['total']; ?></td>
              <td class="left"><?php echo $order['date_added']; ?></td>
              <td class="left"><?php echo $order['date_modified']; ?></td>
              <td class="right"><?php foreach ($order['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
  