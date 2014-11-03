<?php echo $header; ?>


<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="content">
    

<table class="list">
  <thead>
    <tr>
      <td><?php echo $text_product; ?></td>
      <td><?php echo $text_date_processed; ?></td>
      <td><?php echo $text_customer; ?></td>
    </tr>
  </thead>
  <tr>
      <td><?php echo $product['name']; ?></td>
      <td><?php echo $transaction['date_modified']; ?></td>
      <td><?php echo $customer['fullname']; ?></td>
    </tr>
</table>


<div class="buttons2">
  <a onclick="showhide2();" class="button "><?php echo $button_display_2image; ?></a>
</div><br><br>

<!-- <a id="button-displayimage" onclick="showhide2()" class="button"><span>php echo $button_display_2image; ?></span></a> -->
<input type='hidden' id='image1'/>
<input type='hidden' id='image2'/>
<table class="">
  <thead>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </thead>
    <tr>
      <?php foreach ($images as $image) { ?>
      <td><a class='group1' href="<?php echo $image['href']; ?>" alt="<?php echo $image['comment']; ?>"><img src='<?php echo $image['thumb']; ?>'/></a>
      <a class='group2' style='display:none'>
          <img src="<?php echo $image['thumb']; ?>" alt="<?php echo $image['href']; ?>" style="opacity:0.4" /></a>
        </td>
      <?php } ?>
    </tr>
</table>
<div id='imagebox'/></div>
<div id='commentbox' style='color:black'/></div>
  </div>
</div>
<?php echo $footer; ?>

<link rel="stylesheet" href="view/javascript/jquery/colorbox/colorbox.css" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script> 

<script type="text/javascript">

var showhide2 = function(){
  $('.group1').toggle(); $('.group2').toggle();
};

$(".group1").on('click', function(e){
  e.preventDefault();
  var comment = $(this).attr('alt');
  var url = $(this).attr('href');
  $("#imagebox").html("<img src='" + url + "' />");
  $("#commentbox").html(comment);
});
// $(".group1").on('mouseover', function(){
//    $(".group1").colorbox({rel:'group1'});
// });

$(".group2").on('click', function(){

   var href = $(this).children().first().attr('alt');
   $('#image2').val($('#image1').val());
   $('#image1').val(href);

   if ( $('#image1').val() != '' &&  $('#image2').val() != '') {
    var twoimage = "<img style='display:inline' src='" + $('#image2').val() + "'></img><img src='" + $('#image1').val() + "'></img>";
    $.colorbox({title:'Response',html: twoimage});
    $('#image1').val('');
    $('#image2').val('');
   }

});

</script>