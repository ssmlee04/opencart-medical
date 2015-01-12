<?php echo $header; ?>

<style>
  .color1 {
    background-color: beige;
  }
  .payment {
    display: none;
  }
  <?php if ($is_insert=='1') {?>
    .group11 {
    display: none; 
  }
  <?php } else { ?>
 .group12 {
    display: none; 
  }
  <?php } ?>
  
</style>

<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
    <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    
			<div class="heading"><h1><img src="view/image/admin_theme/base5builder_impulsepro/icon-customers-large.png" alt="" /> <?php echo $heading_title; ?></h1>
			

      <div class="buttons">
        <?php if (!$is_insert) { ?>
        <a onclick="showhide()" class="button" id='button_basic'><?php echo $button_edit_basic; ?></a>
        <?php } ?>
        <a onclick="$('#form').submit();" class="button" id='button_save'><?php echo $button_save; ?></a>
        <a href="<?php echo $cancel; ?>" class="button" id='button_cancel'><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="htabs" class="htabs"><a style="display:none" href="#tab-general" id='tab-general-link'><?php echo $tab_general; ?></a>
        <?php if ($filter_customer_id) { ?>
        <a href="#tab-history" id='tab-history-link'><?php echo $tab_history; ?></a>
        <a href="#tab-transaction" id='tab-transaction-link'><?php echo $tab_transaction; ?></a>
        <a href="#tab-transaction2" id='tab-transaction2-link'><?php echo $tab_product; ?></a>
        <a href="#tab-lendto" id='tab-lendto-link'><?php echo $tab_lendto; ?></a>
        <a href="#tab-payment" id='tab-payment-link'><?php echo $tab_payment; ?></a>
        <a href="#tab-image" id='tab-image-link'><?php echo $tab_image; ?></a>
        <a href="#tab-order" id='tab-order-link'><?php echo $tab_order; ?></a>

        <!-- <a href="#tab-reward"><php echo $tab_reward; ?></a> -->

        <?php } ?>
        <!-- <a href="#tab-ip"><php echo $tab_ip; ?></a> -->
      </div>


      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general" >
          
          <div id="vtabs" class="vtabs"><a href="#tab-customer"><?php echo $tab_general; ?></a>
            

            <!-- <span id="address-add"><php echo $button_add_address; ?>&nbsp;<img src="view/image/add.png" alt="" onclick="addAddress();" /></span> --></div>
          <div id="tab-customer" class="vtabs-content">
            

            
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><div class='group11' ><?php echo $lastname; ?></div>
                  <div class='group12' ><input type="text" name="lastname" value="<?php echo $lastname; ?>" />
                  </div><?php if ($error_lastname) { ?>
                  <span class="error"><?php echo $error_lastname; ?></span>
                  <?php } ?></td>
              </tr>

    <tr>
      <td><span class="required">*</span><?php echo $entry_sex; ?></td>
      <td>
      <?php $sexname = '';?>
      <?php if ($sex==1) $sexname = $text_sex_male; ?>
      <?php if ($sex==2) $sexname = $text_sex_female; ?>
        <div class='group11' ><?php echo $sexname; ?></div>
        <div class='group12' >
          <select name="sex">
        <option value=""></option>
        <option value="1" <?php if ($sex==1) echo 'selected'; ?>><?php echo $text_sex_male; ?></option>
        <option value="2" <?php if ($sex==2) echo 'selected'; ?>><?php echo $text_sex_female; ?></option>
        </select></div>
        <?php if ($error_sex) { ?>
        <span class="error"><?php echo $error_sex; ?></span>
        <?php  } ?>
      </td>
      </td>
    </tr>

              <tr>
                <td><?php echo $entry_email; ?></td>
                <td><div class='group11' ><?php echo $email; ?></div>
                  <div class='group12' ><input type="text" name="email" value="<?php echo $email; ?>" />
                  </div><?php if ($error_email) { ?>
                  <span class="error"><?php echo $error_email; ?></span>
                  <?php  } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_telephone; ?></td>
                <td><div class='group11' ><?php echo $telephone; ?></div>
                  <div class='group12' ><input type="text" name="telephone" value="<?php echo $telephone; ?>" />
                  <?php if ($error_telephone) { ?>
                  <span class="error"><?php echo $error_telephone; ?></span>
                  <?php  } ?></div></td>
              </tr>

              <tr>
                <td><?php echo $entry_mobile; ?></td>
                <td><div class='group11' ><?php echo $mobile; ?></div>
                  <div class='group12' ><input type="text" name="mobile" value="<?php echo $mobile; ?>" />
                    </div><?php if ($error_mobile) { ?>
                  <span class="error"><?php echo $error_mobile; ?></span>
                  <?php  } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_dob; ?></td>
                <td><div class='group11' ><?php echo $dob; ?></div>
                  <div class='group12' ><input type="text" name="dob" class='date' value="<?php echo $dob; ?>" />
                    </div><?php if ($error_dob) { ?>
                  <span class="error"><?php echo $error_dob; ?></span>
                  <?php  } ?></span>
              </td>
              <tr>
                <td><?php echo $entry_ssn; ?></td>
                <td><div class='group11' ><?php echo $ssn; ?></div>
                  <div class='group12' ><input type="text" name="ssn" value="<?php echo $ssn; ?>" /></div><?php if ($error_ssn) { ?>
                  <span class="error"><?php echo $error_ssn; ?></span>
                  <?php  } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_nickname; ?></td>
                <td><div class='group11' ><?php echo $nickname; ?></div>
                  <div class='group12' ><input type="text" name="nickname" value="<?php echo $nickname; ?>" /></div></td>
              </tr>
              <tr>
                <td><?php echo $entry_line_id; ?></td>
                <td><div class='group11' ><?php echo $line_id; ?></div>
                  <div class='group12' ><input type="text" name="line_id" value="<?php echo $line_id; ?>" /></div></td>
              </tr>
              <tr>
                <td><?php echo $entry_fb_id; ?></td>
                <td><div class='group11' ><?php echo $fb_id; ?></div>
                  <div class='group12' ><input type="text" name="fb_id" value="<?php echo $fb_id; ?>" /></div></td>
              </tr>
              <tr>
                <td><?php echo $entry_image; ?></td>
                <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="avatarthumb" /><br />
                    <input type="hidden" name="avatarimage" value="<?php echo $image; ?>" id="avatarimage" />
                    
                    <div class='group12' >
                    <a onclick="avatar_upload('avatarimage', 'avatarthumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#avatarthumb').attr('src', '<?php echo $no_image; ?>'); $('#avatarimage').attr('value', '');"><?php echo $text_clear; ?></a></div>

                  </div></td>
              </tr>
              <!-- <tr>
                <td><php echo $entry_password; ?></td>
                <td><input type="password" name="password" value="<php echo $password; ?>"  />
                  <php if ($error_password) { ?>
                  <span class="error"><php echo $error_password; ?></span>
                  <php  } ?></td>
              </tr>
              <tr>
                <td><php echo $entry_confirm; ?></td>
                <td><input type="password" name="confirm" value="<php echo $confirm; ?>" />
                  <php if ($error_confirm) { ?>
                  <span class="error"><php echo $error_confirm; ?></span>
                  <php  } ?></td>
              </tr> -->
              <tr>
                <td><span class="required">*</span><?php echo $entry_store; ?></td>
                <td>
                  <div class='group11' ><?php foreach ($stores as $st) { ?>
                    <?php if ($st['store_id'] == $store) { echo $st['name']; } ?>
                    <?php } ?></div>
                  <div class='group12' >
                    <select name="store">
                  <option value=""></option>
                    <?php if ($stores) { ?>
                    <?php foreach ($stores as $st) { ?>
                    <?php if ($st['store_id'] == $store) { ?>
                      <option value="<?php echo $st['store_id']; ?>" selected><?php echo $st['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $st['store_id']; ?>"><?php echo $st['name']; ?></option>
                    <?php } ?>
                    

                    <?php } ?>
                    <?php } ?>
                  </select></div>
                  <?php if ($error_store) { ?>
                  <span class="error"><?php echo $error_store; ?></span>
                  <?php  } ?>
                </td>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_customer_group; ?></td>
                <td>
                  <div class='group11' ><?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $customer_group_id) { echo $customer_group['name']; } ?>
                    <?php } ?></div>

                  <div class='group12' ><select name="customer_group_id">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></div></td>
              </tr>
              <!-- <tr>
                <td><php echo $entry_status; ?></td>
                <td><select name="status">
                    <php if ($status) { ?>
                    <option value="1" selected="selected"><php echo $text_enabled; ?></option>
                    <option value="0"><php echo $text_disabled; ?></option>
                    <php } else { ?>
                    <option value="1"><php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><php echo $text_disabled; ?></option>
                    <php } ?>
                  </select></td>
              </tr> -->
              </table>
              <hr>
              <table class="form">
               

              <?php $address_row = 1; ?>
              <tr>
                <td><?php echo $entry_address_1; ?></td>
                <td>
                  <div class='group11'><?php echo $address['address_1']; ?></div>
                  <div class='group12' ><input type="text" name="address[address_1]" value="<?php echo $address['address_1']; ?>" />
                  </div><?php if (isset($error_address_address_1)) { ?>
                  <span class="error"><?php echo $error_address_address_1; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_address_2; ?></td>
                <td><div class='group11'><?php echo $address['address_2']; ?></div>
                  <div class='group12'><input type="text" name="address[address_2]" value="<?php echo $address['address_2']; ?>" /></div></td>
              </tr>
              <tr>
                <td><?php echo $entry_city; ?></td>
                <td><div class='group11'><?php echo $address['city']; ?></div>
                  <div class='group12'><input type="text" name="address[city]" value="<?php echo $address['city']; ?>" /></div>
                  <?php if (isset($error_address_city)) { ?>
                  <span class="error"><?php echo $error_address_city; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_postcode; ?></td>
                <td><div class='group11'><?php echo $address['postcode']; ?></div>
                  <div class='group12'><input type="text" name="address[postcode]" value="<?php echo $address['postcode']; ?>" /></div></td>
              </tr>
            </table>

            <?php if (!$is_insert) {?>
            <hr>
            <table class="form">
               <tr class='color1'><td><?php echo $entry_last_visit; ?></td><td><?php echo $last_visit; ?></td></tr>
                <tr class='color1'><td><?php echo $entry_last_doctor; ?></td><td><?php echo $last_doctor; ?></td></tr>
                <tr class='color1'><td><?php echo $entry_last_consultant; ?></td><td><?php echo $last_consultant; ?></td></tr>
                <tr class='color1'><td><?php echo $entry_last_beauty; ?></td><td><?php echo $last_beauty; ?></td></tr>
                <tr class='color1'><td><?php echo $entry_last_outsource; ?></td><td><?php echo $last_outsource; ?></td></tr>
            </table>
            <?php } ?>

          </div>

          
        </div>

        <?php if ($filter_customer_id) { ?>
        <div id="tab-history">
          <div id="history"></div>
          <table class="form">
            <tr>
              <td><?php echo $entry_comment; ?></td>
              <td><textarea name="comment" cols="40" rows="8" style="width: 99%;"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><input type='checkbox' value='1' name='reminder'/><span><?php echo $text_reminder; ?></span>
                <input type='date_available' name='reminder_date'/></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-history" class="button"><span><?php echo $button_add_history; ?></span></a></td>
            </tr>
          </table>
        </div>





        <div id="tab-transaction2">
          <table class="form">

            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="product" name="treatment_product2" alt='1' alt2='1' value="" />
                <input type="hidden" name="treatment_product2_name" value="" />
                <input type="hidden" name="treatment_product2_id" value="" />

                <select type="product" name="treatment_product2_add" alt='1' alt2='1' ></select>
              </td>
              <td colspan="2" style="text-align: right;"><a id="button-filter2" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
            <tr>
              <td><?php echo $entry_treatment_status; ?></td>
              <td><select name='filter_treatment_status2'>
                <option></option>
                <?php foreach ($treatmentstatuses as $treatmentstatus) { ?>
                  <option value="<?php echo $treatmentstatus['treatment_status_id']; ?>"><?php echo $treatmentstatus['name']; ?></option>
                <?php } ?>
              <select></td>
              <td colspan="2" style="text-align: right;"></td>
            </tr>
            <tr>
              <td colspan="4" style="text-align: right;"></td>
            </tr>
          </table>

          <table class="form" style="display:none">
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="text" name="product" value="" /><input type="hidden" name="product_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_unit_used; ?></td>
              <td><input type="text" name="unitspend" value="" /></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-transaction2" class="button"><span><?php echo $button_add_transaction; ?></span></a></td>
            </tr>
          </table>
          <div id="transaction2"></div>
        </div>





        <div id="tab-transaction">
          <input type='hidden' id='image1'/>
          <input type='hidden' id='image2'/>



          <table class="form">
<!--             <tr>
              <td>php echo $entry_customer; ?></td>
              <td><input type="text" name="customer" value="" />
                <input type="hidden" name="customer_id" value="" />
                <input type="hidden" name="customer_name" value="" />
              </td>
            </tr> -->
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type='product' name="treatment_product" alt='2' alt2='1' value="" />
                <input type="hidden" name="treatment_product_name" value="" />
                <input type="hidden" name="treatment_product_id" value="" />

                <select type="product" name="treatment_product_add" alt='2' alt2='1'></select>
                <!-- <a class='group101'>132123</a> -->

              </td>
              <td colspan="2" style="text-align: right;"><a id="button-filter" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
            <tr>
              <td><?php echo $entry_treatment_status; ?></td>
              <td><select name='filter_treatment_status'>
                <option></option>
                <?php foreach ($treatmentstatuses as $treatmentstatus) { ?>
                  <option value="<?php echo $treatmentstatus['treatment_status_id']; ?>"><?php echo $treatmentstatus['name']; ?></option>
                <?php } ?>
              <select></td>
              <td colspan="2" style="text-align: right;"></td>
            </tr>
            <tr>
              <td colspan="4" style="text-align: right;"><a id="button-displayimage" onclick="showhide2()" class="button"><span><?php echo $button_display_2image; ?></span></a></td>
            </tr>
          </table>


<!-- <table class="list">
  <thead>
    <tr>
      <td class="left">treatment</td>
      <td class="left">units used</td>
      <td class="left">go</td>
      
    </tr>
  </thead>
  <tr>
    <td><select type='product' alt='2'></select></td>
    <td><input type='text' /></td>
    <td><input type='button' class='group_change_status_button' value='go ahead'/></td>
  </tr>
  <tr>
    <td><php echo $entry_beauty; ?><select type='user' alt='2'/></td>
    <td><select type='user' alt='3'/></td>
    <td><select type='user' alt='4'/></td>
    <td><select type='user' alt='5'/></td>
  </tr>
</table>
<br> -->


          <table class="form" style="display:none">
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="text" name="product" value="" /><input type="hidden" name="product_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_unit_used; ?></td>
              <td><input type="text" name="unitspend" value="" /></td>
            </tr>
            <!-- <tr>
              <td><php echo $entry_amount; ?></td>
              <td><input type="text" name="amount" value="" /></td>
            </tr> -->
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-transaction" class="button"><span><?php echo $button_add_transaction; ?></span></a></td>
              <!-- <td colspan="2" style="text-align: right;"><a id="button-transaction" class="button" onclick="addTransaction2();"><span><php echo $button_add_transaction2; ?></span></a></td> -->
            </tr>
          </table>
          <div id="transaction"></div>
        </div>

        <div id="tab-lendto">
          <div id="lendto"></div>
          <table class="form">
            <tr>
              <td><?php echo $entry_lendto; ?></td>
              <td><input type="customer" name="lendto_customer" value="" />
                <input type="hidden" name="lendto_customer_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="product" name="lendto_product" alt='2' value="" />
                <input type="hidden" name="lendto_product_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_quantity; ?></td>
              <td><input type="text" name="lendto_quantity" value="" />
                <div id='lendto_minunit2' style='display:inline'></div>
                <input type="hidden" name="lendto_product_unit" value="" />
                <input type="hidden" name="lendto_product_unitvalue" value="" />
                <div id='lendto_minunit'></div>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-lendto" class="button"><span><?php echo $button_lendto; ?></span></a></td>
            </tr>
          </table>

          <hr>
          <div id="borrowfrom"></div>
          <table class="form">
            <tr>
              <td><?php echo $entry_borrowfrom; ?></td>
              <td><input type="customer" name="borrowfrom_customer" value="" />
                <input type="hidden" name="borrowfrom_customer_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td><input type="product" name="borrowfrom_product" alt='2' value="" />
                <input type="hidden" name="borrowfrom_product_id" value="" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_quantity; ?></td>
              <td><input type="text" name="borrowfrom_quantity" value="" />
                <div id='borrowfrom_minunit2'  style='display:inline'></div>
                <input type="hidden" name="borrowfrom_product_unit" value="" />
                <input type="hidden" name="borrowfrom_product_unitvalue" value="" />
                <div id='borrowfrom_minunit'></div>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-borrowfrom" class="button"><span><?php echo $button_borrowfrom; ?></span></a></td>
            </tr>
          </table>


        </div>

        <?php $currentdate = 0; ?>
        <div id="tab-payment">
          <div id='payment'></div>
          <a id="button-payment" class="button"></a>

          
        </div>

        <div id="tab-image">
          <!-- <a onclick="$('.group13').toggle(); $('.group14').toggle()"><php echo $button_edit_basic; ?></a> -->
          <div id='tab-images'></div>
          <a id="button-image" class="button"></a>
        </div>

        <div id="tab-order">
          <div id='cusorder'></div>
          <a id="button-order" class="button"></a>
          <!-- <a href="<php echo $neworder; ?>">sssssssssss</a> -->
        </div>

        <!-- <div id="tab-reward">
          <table class="form">
            <tr>
              <td><php echo $entry_description; ?></td>
              <td><input type="text" name="description" value="" /></td>
            </tr>
            <tr>
              <td><php echo $entry_points; ?></td>
              <td><input type="text" name="points" value="" /></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: right;"><a id="button-reward" class="button" onclick="addRewardPoints();"><span><php echo $button_add_reward; ?></span></a></td>
            </tr>
          </table>
          <div id="reward"></div>
        </div> -->
        <?php } ?>
        <!-- <div id="tab-ip">
          <table class="list">
            <thead>
              <tr>
                <td class="left"><php echo $column_ip; ?></td>
                <td class="right"><php echo $column_total; ?></td>
                <td class="left"><php echo $column_date_added; ?></td>
                <td class="right"><php echo $column_action; ?></td>
              </tr>
            </thead>
            <tbody>
              <php if ($ips) { ?>
              <php foreach ($ips as $ip) { ?>
              <tr>
                <td class="left"><a href="http://www.geoiptool.com/en/?IP=<php echo $ip['ip']; ?>" target="_blank"><hp echo $ip['ip']; ?></a></td>
                <td class="right"><a href="<php echo $ip['filter_ip']; ?>" target="_blank"><php echo $ip['total']; ?></a></td>
                <td class="left"><php echo $ip['date_added']; ?></td>
                <td class="right"><php if ($ip['ban_ip']) { ?>
                  <b>[</b> <a id="<php echo str_replace('.', '-', $ip['ip']); ?>" onclick="removeBanIP('<php echo $ip['ip']; ?>');"><php echo $text_remove_ban_ip; ?></a> <b>]</b>
                  <php } else { ?>
                  <b>[</b> <a id="<php echo str_replace('.', '-', $ip['ip']); ?>" onclick="addBanIP('<php echo $ip['ip']; ?>');"><php echo $text_add_ban_ip; ?></a> <b>]</b>
                  <php } ?></td>
              </tr>
              <php } ?>
              <php } else { ?>
              <tr>
                <td class="center" colspan="4"><php echo $text_no_results; ?></td>
              </tr>
              <php } ?>
            </tbody>
          </table>
        </div> -->
      </form>
    </div>
  </div>
</div>
<link rel="stylesheet" href="view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script> 
<script type="text/javascript"><!--

// var totalproducts = <php echo json_encode($totalproducts); ?>;// '<php echo $totalproducts; ?>';
// // console.log(totalproducts);

//   var changename = function(str){
//     // console.log(str);
//     $('input[type=product]').val(str);
//   }

// $(document).ready(function(){
//   $(".group1").colorbox({rel:'group1'});

//   var html = '<table>'; 
//   // console.log(totalproducts);
//   for (var i=0; i<totalproducts.length; i++) {

//     // console.log(totalproducts[i].name);
//     html += "<tr><td onclick='changename(" + totalproducts[i].name.toString() + ")'>" + totalproducts[i].name.toString()  +"</td></tr>";
//   }
//   html += '</table>';

//   $(".group101").colorbox({html: html});
// });

$('select[name=\'customer_group_id\']').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('.company-id-display').show();
		} else {
			$('.company-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('.tax-id-display').show();
		} else {
			$('.tax-id-display').hide();
		}
	}
});

$('select[name=\'customer_group_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
function country(element, index, zone_id) {

  if (element.value != '') {
		$.ajax({
			url: 'index.php?route=sale/customer/country&token=<?php echo $token; ?>&country_id=' + element.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'address[' + index + '][country_id]\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				$('.wait').remove();
			},			
			success: function(json) {

				if (json['postcode_required'] == '1') {
					$('#postcode-required' + index).show();
				} else {
					$('#postcode-required' + index).hide();
				}
				
				html = '<option value=""><?php echo $text_select; ?></option>';
				if (json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';
						
						if (json['zone'][i]['zone_id'] == zone_id) {
							html += ' selected="selected"';
						}
		
						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="0"><?php echo $text_none; ?></option>';
				}
				
				$('select[name=\'address[zone_id]\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				// alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

$('select[name$=\'[country_id]\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('#history .pagination a').live('click', function() {
  $('#history').load(this.href);
  
  return false;
});     

$('#tab-images .pagination a').live('click', function() {
  $('#tab-images').load(this.href);
  
  return false;
});     


$('#cusorder .pagination a').live('click', function() {
  $('#cusorder').load(this.href);
  
  return false;
});     

$('#borrowfrom .pagination a').live('click', function() {
  $('#borrowfrom').load(this.href);
  
  return false;
}); 

$('#lendto .pagination a').live('click', function() {
  $('#lendto').load(this.href);
  
  return false;
});     

$('#button-history').bind('click', function() {
  $.ajax({
    url: 'index.php?route=sale/customer/history&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>',
    type: 'post',
    dataType: 'html',
    data: 'reminder=' + $('input[name=reminder]').is(':checked')  + 
          '&reminder_date=' + encodeURIComponent($('input[name=reminder_date]').val()) + '&comment=' + encodeURIComponent($('#tab-history textarea[name=\'comment\']').val()),
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-history').attr('disabled', true);
      $('#history').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-history').attr('disabled', false);
      $('.attention').remove();
          $('#tab-history textarea[name=\'comment\']').val('');
    },
    success: function(html) {
      $('#history').html(html);
      
      $('#tab-history input[name=\'comment\']').val('');
    }
  });
});

//--></script> 
<script type="text/javascript"><!--
$('#transaction .pagination a').live('click', function() {
  $('#transaction').load(this.href);
  
  return false;
}); 

$('#transaction2 .pagination a').live('click', function() {
	$('#transaction2').load(this.href);
	
	return false;
});			

$('#tab-general-link').on('click', function(){
  $('#button_save').show();
  if ('<?php echo $is_insert; ?>' != 1) {
    $('.group12').hide();
    $('.group11').show();
  }
});

$('#tab-transaction-link').on('click', function(){
  $('#button_save').hide();
  $('.group12').hide();
  $('.group11').show();
  $('#button-transaction').click();


  // $('input[name=treatment_product]').remove();
  // $('input[name=treatment_product_name]').remove();
  // $('input[name=treatment_product_id]').remove();  
  // $('input[name=treatment_product2]').remove();
  // $('input[name=treatment_product2_name]').remove();
  // $('input[name=treatment_product2_id]').remove();

  $('#transactionactionpanel').remove();
});

$('#tab-transaction2-link').on('click', function(){
  $('#button_save').hide();
  $('.group12').hide();
  $('.group11').show();
  $('#button-transaction2').click();

  //   $('input[name=treatment_product]').remove();
  // $('input[name=treatment_product_name]').remove();
  // $('input[name=treatment_product_id]').remove();  
  // $('input[name=treatment_product2]').remove();
  // $('input[name=treatment_product2_name]').remove();
  // $('input[name=treatment_product2_id]').remove();

  $('#transactionactionpanel').remove();
});

$('#tab-image-link').on('click', function(){
  $('#button_save').hide();
    $('.group12').hide();
  $('.group11').show();
  $('#button-image').click();
});

$('#tab-order-link').on('click', function(){
  $('#button_save').hide();
  $('#button-order').click();
});

$('#tab-payment-link').on('click', function(){
  $('#button_save').hide();
  $('#button-payment').click();
});

$('#tab-history-link').on('click', function(){
  $('#button_save').hide();
    $('.group12').hide();
  $('.group11').show();
  $('textarea[name=\'comment\']').val('');
  $('#button-history').click();
});

$('#tab-lendto-link').on('click', function(){
  $('#button_save').hide();
  $('#button-lendto').click();
  $('#button-borrowfrom').click();
});

// $('#tab-images').load('index.php?route=sale/customer/images&token=<?php echo $token; ?>

// $('#cusorder').load('index.php?route=sale/order&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>', {'minimum': 1});


// '2014-10-07 18:15'
$('#button-order').bind('click', function() {
  $.ajax({
    url: 'index.php?route=sale/order&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>&minimum=1',
    type: 'post',
    beforeSend: function() {
      $('.success, .warning, .attention').remove();
      // $('#button-image').attr('disabled', true);
      $('#cusorder').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      // $('#button-image').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {

      $('#cusorder').html(html);
    }
  });

});


$('#button-payment').bind('click', function() {
  $.ajax({
    url: 'index.php?route=sale/customer/payments&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>',
    type: 'post',
    beforeSend: function() {
      $('.success, .warning, .attention').remove();
      $('#button-payment').attr('disabled', true);
      $('#payment').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-payment').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {
      $('#payment').html(html);
    }
  });
});


$('#button-image').bind('click', function() {

  $.ajax({
    url: 'index.php?route=sale/customer/images&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>',
    type: 'post',
    beforeSend: function() {
      $('.success, .warning, .attention').remove();
      $('#button-image').attr('disabled', true);
      $('#tab-images').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-image').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {
      $('#tab-images').html(html);
    }
  });
});



$('#button-transaction2').bind('click', function() {

console.log(123);

  $.ajax({
    url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&filter_product_type_id=1&filter_customer_id=<?php echo $filter_customer_id; ?>&show_group=1',
    type: 'post',
    dataType: 'html',
    // data: 'product_id=' + encodeURIComponent($('#tab-transaction input[name=\'product_id\']').val()) + '&unitspend=' + encodeURIComponent($('#tab-transaction input[name=\'unitspend\']').val()),
    beforeSend: function() {
      $('.success, .warning, .attention').remove();
      $('#button-transaction2').attr('disabled', true);
      $('#transaction2').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-transaction2').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {

      $('#transaction2').html(html);

      $('#tab-transaction2 input[name=\'product_id\']').val('');
      $('#tab-transaction2 input[name=\'product\']').val('');
      $('#tab-transaction2 input[name=\'unitspend\']').val('');
    }
  });
});

$('#button-transaction').bind('click', function() {

	$.ajax({
		url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&filter_product_type_id=2&filter_customer_id=<?php echo $filter_customer_id; ?>&show_group=1',
		type: 'post',
		dataType: 'html',
		// data: 'product_id=' + encodeURIComponent($('#tab-transaction input[name=\'product_id\']').val()) + '&unitspend=' + encodeURIComponent($('#tab-transaction input[name=\'unitspend\']').val()),
		beforeSend: function() {
			$('.success, .warning, .attention').remove();
			$('#button-transaction').attr('disabled', true);
			$('#transaction').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-transaction').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {

			$('#transaction').html(html);

			$('#tab-transaction input[name=\'product_id\']').val('');
      $('#tab-transaction input[name=\'product\']').val('');
      $('#tab-transaction input[name=\'unitspend\']').val('');
		}
	});
});

$('#button-borrowfrom').bind('click', function() {
  $.ajax({
    url: 'index.php?route=sale/customer/borrows&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>',
    type: 'post',
    dataType: 'html',
    data: 'borrowfrom_customer_id=' + encodeURIComponent($('#tab-lendto input[name=\'borrowfrom_customer_id\']').val()) + '&borrowfrom_quantity=' + encodeURIComponent($('#tab-lendto input[name=\'borrowfrom_quantity\']').val()) + '&borrowfrom_product_id=' + encodeURIComponent($('#tab-lendto input[name=\'borrowfrom_product_id\']').val()),
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-borrowfrom').attr('disabled', true);
      $('#borrowfrom').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-borrowfrom').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {

      $('#borrowfrom').html(html);

      $('#tab-lendto input[name=\'borrowfrom_product_id\']').val('');
      $('#tab-lendto input[name=\'borrowfrom_product\']').val('');
      $('#tab-lendto input[name=\'borrowfrom_customer\']').val('');
      $('#tab-lendto input[name=\'borrowfrom_customer_id\']').val('');
      $('#tab-lendto input[name=\'borrowfrom_quantity\']').val('');

    }
  });
});


$('#button-lendto').bind('click', function() {

  $.ajax({
    url: 'index.php?route=sale/customer/lendings&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>',
    type: 'post',
    dataType: 'html',
    data: 'lendto_customer_id=' + encodeURIComponent($('#tab-lendto input[name=\'lendto_customer_id\']').val()) + '&lendto_quantity=' + encodeURIComponent($('#tab-lendto input[name=\'lendto_quantity\']').val()) + '&lendto_product_id=' + encodeURIComponent($('#tab-lendto input[name=\'lendto_product_id\']').val()),
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-lendto').attr('disabled', true);
      $('#lendto').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-lendto').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {

      // $('.attention, .success, .warning').remove();

      // if (json['error']) {

      //   $('#transaction').before('<div class="warning">' + json['error'] + '</div>');
      // }

      // if (json['success']) {

      //   $('#button-transaction').click();

      //   $('#transaction').before('<div class="success">' + json['success'] + '</div>');
      // }

      $('#lendto').html(html);

      $('#tab-lendto input[name=\'lendto_product_id\']').val('');
      $('#tab-lendto input[name=\'lendto_product\']').val('');
      $('#tab-lendto input[name=\'lendto_customer\']').val('');
      $('#tab-lendto input[name=\'lendto_customer_id\']').val('');
      $('#tab-lendto input[name=\'lendto_quantity\']').val('');

    }
  });
});

//--></script> 

<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script> 

<script type="text/javascript"><!--

function image_upload(field, thumb, customer_image_id) {

  console.log(field, thumb);
  $('#dialog').remove();
  
  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      
      var customer_id = '<?php echo $filter_customer_id; ?>';

      if ($('#' + field).attr('value')) {
        $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
          dataType: 'text',
          success: function(text) {
            
            $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
            var image = $('#' + field).attr('value');
            // var customer_transaction_id = $('#tr' + field).attr('value');
            // var customer_image_id = $('#id' + field).attr('value');
            // alert(customer_transaction_id, customer_image_id);
            var url = 'sale/customer/recordimage';
            if (Number(customer_image_id) > 0) url = 'sale/customer/editimage';
            var data = 'image=' + image + '&customer_id=' + customer_id;
            if (Number(customer_image_id) > 0) data += '&customer_image_id=' + customer_image_id;
            
            $.ajax({
                url: 'index.php?route=' + url + '&token=<?php echo $token; ?>',
                type: 'POST',
                data: data,
                complete: function(xhr, textStatus) {
                  //called when complete

                },
                success: function(json, textStatus, xhr) {
                  //called when successful
                  // addImage();

                  
                    if (json['error']) {
                      $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
                  
                      $('.warning').fadeIn('slow');
                    }
                  

                },
                error: function(xhr, textStatus, errorThrown) {
                  //called when there is an error
                  
                }
              });

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



function avatar_upload(field, thumb) {
  $('#dialog').remove();
  
  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
          dataType: 'text',
          success: function(text) {
          
            $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
            var image = $('#' + field).attr('value');
            // var customer_transaction_id = $('#tr' + field).attr('value');
            // var customer_image_id = $('#id' + field).attr('value');
            // alert(customer_transaction_id, customer_image_id);

          }
        });
    },  
    bgiframe: false,
    width: 800,
    height: 400,
    resizable: false,
    modal: false
  });
};

var showhide = function(){
  $('.group12').toggle(); $('.group11').toggle();
};

var showhide2 = function(){
  $('.group1').toggle(); $('.group2').toggle();
};



// var showhide13 = function(){
//   $('.group13').toggle(); $('.group14').toggle();
// };
// var showhide15 = function(){
//   $('.group15').toggle(); $('.group16').hide();
// };
// var showhide1 = function(){
//   $('.group1').toggle(); $('.group2').hide();
// };



$('select[name=\'treatment_product_add\']').on('change', function(){
  var str = $(this).find(":selected").text();
  $('input[name=treatment_product]').val(str);
});

$('select[name=\'treatment_product2_add\']').on('change', function(){
  var str = $(this).find(":selected").text();
  $('input[name=treatment_product2]').val(str);
});

$('#button-filter').bind('click', function() {

  var product_name = $('input[name=\'treatment_product\']').val(); 
  var filter_treatment_status = $('select[name=\'filter_treatment_status\']').val();
  
  $.ajax({
    url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>&show_group=1&filter_product_name=' + product_name.toString() + '&filter_ismain=0&filter_treatment_status=' + filter_treatment_status + '&filter_ismain=0&filter_product_type_id=2',
    type: 'post',
    dataType: 'html',
    // data: 'filter_product_name=' + product_name.toString() + '&filter_ismain=0', 
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-filter').attr('disabled', true);
      $('#transaction').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-filter').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {
      $('#transaction').html(html);
    }
  });
});

$('#button-filter2').bind('click', function() {

  // var customer_name_sel = $('input[name=\'customer_name\']').val();
  // var customer_name = $('input[name=\'customer\']').val();
  // var product_name_sel = $('input[name=\'treatment_product2_name\']').val();
  // var product_name = $('input[name=\'treatment_product2\']').val() || $('input[name=\'treatment_product2_add\']').val();

  var product_name = $('input[name=\'treatment_product2_name\']').val();
  var filter_treatment_status = $('select[name=\'filter_treatment_status2\']').val();
  
console.log('asd0a9d90a09hudasd');
  // console.log([product_name_sel, product_name, filter_treatment_status]);
  $.ajax({
    url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&filter_customer_id=<?php echo $filter_customer_id; ?>&show_group=1&filter_product_name=' + product_name.toString() + '&filter_ismain=0&filter_treatment_status=' + filter_treatment_status + '&filter_ismain=0&filter_product_type_id=1',
    type: 'post',
    dataType: 'html',
    // data: 'filter_product_name=' + product_name.toString() + '&filter_ismain=0', 
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-filter2').attr('disabled', true);
      $('#transaction2').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-filter2').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {

      // console.log(html);
      $('#transaction2').html(html);
    }
  });
});



$('input[type="product"]').on('blur', function(){
  $('input[name="borrowfrom_product_unit"]').change();  
  $('input[name="lendto_product_unit"]').change();  
})

$('input[name="borrowfrom_product_unit"]').on('change', function(){
  if ($('input[name="borrowfrom_product_unitvalue"]').val() + $(this).val()) {
    $('#borrowfrom_minunit').html('minimum ' + $('input[name="borrowfrom_product_unitvalue"]').val() + ' ' + $(this).val());
    $('#borrowfrom_minunit2').html($(this).val());
  }
})

// $('input[name="treatment_product_add"]').live('change', function(){
//   console.log(123);
//   // $('input[name="treatment_product"]').val(123);
// });

$('input[name="lendto_product_unit"]').on('change', function(){
  if ($('input[name="lendto_product_unitvalue"]').val() + $(this).val())
  $('#lendto_minunit').html('minimum ' +  $('input[name="lendto_product_unitvalue"]').val() + ' ' + $(this).val());
  $('#lendto_minunit2').html($(this).val());
})

//--></script> 

<?php echo $footer; ?>