<?php echo $header; ?>
<script type="text/javascript" src="view/javascript/moment/moment.min.js"></script>
<script type="text/javascript" src="view/javascript/calendar/fullcalendar.min.js"></script>

<link type="text/css" href="view/javascript/calendar/fullcalendar.css" rel="stylesheet" />
<link type="text/css" href="view/javascript/calendar/fullcalendar.print.css" rel="stylesheet" media='print'/>


<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
      
    </div>
    <div class="content">

    	<div id='calendar'></div>
<!--     	
      <form action="" method="post" enctype="multipart/form-data" id="form">
      </form> -->
    </div>
  </div>
</div>

<script>

$(document).ready(function() {
	
	var events = <?php echo json_encode($events); ?>;
	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		defaultDate: Date(),
		selectable: true,
		selectHelper: true,
		select: function(start, end) {
			var title = prompt('Event Title:');
			var eventData;
			var customer_id = 3;
			if (title) {
				eventData = {
					title: title,
					start: start,
					end: end
				};
				// mstart = moment().format(start, 'yyyy-mm-dd');
				// alert(mstart);

				start = moment(start).format('YYYY-MM-DD HH:mm:ss');
				end = moment(end).format('YYYY-MM-DD HH:mm:ss');
				
				$.ajax({
				  url: 'index.php?route=sale/customer/recordevent&token=<?php echo $token; ?>', 
				  type: 'POST',
				  dataType: 'json',
				  data: 'title=' + title + '&start=' + start + '&end=' + end + '&customer_id=' + customer_id,
				  complete: function(xhr, textStatus) {
				    //called when complete

				    
				  },
				  success: function(json, textStatus, xhr) {
				    //called when successful

				    $('.attention, .success, .warning').remove();

				    if (json['success']) {
				    	$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
						$('.success').fadeIn('slow');

						$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				    } 

				    if (json['error']['warning']) {

				    	$('.box').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
			
						$('.warning').fadeIn('slow');
				    }	

				    
				  },
				  error: function(xhr, textStatus, errorThrown) {
				    //called when there is an error

				  }
				});
				
				
			}
			$('#calendar').fullCalendar('unselect');
		},
		editable: false,
		eventLimit: true, // allow "more" link when too many events
		eventClick: function(calEvent, jsEvent, view) {
			

			var ifdelete = confirm('are you sure you want to delete:');
			var that = this;

			if (ifdelete === true) {

				var customer_event_id = calEvent.id;
				
				$.ajax({
				  url: 'index.php?route=sale/customer/deleteevent&token=<?php echo $token; ?>',
				  type: 'POST',
				  dataType: 'json',
				  data: 'customer_event_id=' + customer_event_id,
				  complete: function(xhr, textStatus) {
				    //called when complete


				  },
				  success: function(json, textStatus, xhr) {
				    //called when successful
				    $('.attention, .success, .warning').remove();

				    if (json['success']) {
				    	$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
						$('.success').fadeIn('slow');

						$('#calendar').fullCalendar('removeEvents', calEvent.id, function (calEvent) {
			                return true;
			            });
				    } 

				    if (json['error']['warning']) {

				    	$('.box').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
			
						$('.warning').fadeIn('slow');
				    }


				    
				    // $(that).remove();
				  },
				  error: function(xhr, textStatus, errorThrown) {
				    //called when there is an error
				  }
				});
				
				
	            
	        }
        },
		events: events, 

	});
	
});
</script>
<?php echo $footer; ?> 