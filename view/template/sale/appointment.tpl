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
    </div>
  </div>
</div>

<script>

$(document).ready(function() {
	
	$('.fc-month-button').click(function(){
		alert(222);
	})
	var events = <?php echo json_encode($events); ?>;
	console.log(events);

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		// timezoneParam: "America/Chicago", 
		timezone: false,
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

						// location.reload();
				    } 
				    if (json['error']['warning']) {

				    	$('.box').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
			
						$('.warning').fadeIn('slow');
				    }	

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
			$('#calendar').fullCalendar('unselect');
		},
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		
		eventDrop: function(event, delta, revertFunc) {
			// var that = this;

			console.log('event');
			console.log(event);
			var customer_event_id = event.id;

			if (!customer_event_id) {
$('.attention, .success, .warning').remove();
				$('.box').before('<div class="warning" style="display: none;">' + '<?php echo $text_please_refresh; ?>' + '</div>');
			
				$('.warning').fadeIn('slow');
				revertFunc();
				return; 
			}

			var date_start = event.start._d;
			var date_end = event.end._d;
			date_start = moment(date_start).add(-8, 'hour').format('YYYY-MM-DD HH:mm:ss')
			date_end = moment(date_end).add(-8, 'hour').format('YYYY-MM-DD HH:mm:ss')
			
			var a = $.fullCalendar.moment.utc(date_start);
			var b = $.fullCalendar.moment.utc(date_start);
			console.log(a);
			console.log(b);

			// var m = $.fullCalendar.moment.parseZone(event.start._d);
			// console.log(m);
			// m.stripZone();
			// m.format();
			// console.log(m);
			// console.log(event);
			console.log([date_start, date_end]);

			if (!confirm("Are you sure about this change?")) {
	            revertFunc();
	        }

			$.ajax({
				  url: 'index.php?route=sale/customer/editevent&token=<?php echo $token; ?>',
				  type: 'POST',
				  dataType: 'json',
				  data: 'customer_event_id=' + customer_event_id + '&date_start=' + date_start + '&date_end=' + date_end,
				  complete: function(xhr, textStatus) {
				    //called when complete
				  },
				  success: function(json, textStatus, xhr) {

				  	console.log(json);
				    //called when successful
				    $('.attention, .success, .warning').remove();

				    if (json['success']) {
				    	$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
						$('.success').fadeIn('slow');

						// $('#calendar').fullCalendar('removeEvents', calEvent.id, function (calEvent) {
			   //              return true;
			   //          });
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


		},

		eventResize: function(event, delta, revertFunc) {


			console.log(event);
			var customer_event_id = event.id;
			var date_start = event.start._d;
			var date_end = event.end._d;


if (!customer_event_id) {
			$('.attention, .success, .warning').remove();
				$('.box').before('<div class="warning" style="display: none;">' + '<?php echo $text_please_refresh; ?>' + '</div>');
			
				$('.warning').fadeIn('slow');
revertFunc();
				return; 
			}


			// temp fix
			date_start = moment(date_start).add(-8, 'hour').format('YYYY-MM-DD HH:mm:ss')
			date_end = moment(date_end).add(-8, 'hour').format('YYYY-MM-DD HH:mm:ss')
			console.log([date_start, date_end]);

			if (!confirm("Are you sure about this change?")) {
	            revertFunc();
	        }

			$.ajax({
				  url: 'index.php?route=sale/customer/editevent&token=<?php echo $token; ?>',
				  type: 'POST',
				  dataType: 'json',
				  data: 'customer_event_id=' + customer_event_id + '&date_start=' + date_start + '&date_end=' + date_end,
				  success: function(json, textStatus, xhr) {
				    //called when successful
				    $('.attention, .success, .warning').remove();

				    console.log(json);
				    if (json['success']) {
				    	$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
						$('.success').fadeIn('slow');
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


		},

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