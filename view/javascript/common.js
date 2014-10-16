$(document).ready(function(){

	$("input[type='date_available']").on("focusin", function(){
	   $(this).datepicker({dateFormat: 'yy-mm-dd'});
	});

	$.widget('custom.catcomplete', $.ui.autocomplete, {
		_renderMenu: function(ul, items) {
			var self = this, currentCategory = '';
			
			$.each(items, function(index, item) {
				if (item.category != currentCategory) {
					ul.append('<li class="ui-autocomplete-category"></li>');
					currentCategory = item.category;
				}
				self._renderItem(ul, item);
			});
		}
	});

	$("input[type='text'][name='filter_customer']").on("focusin", function(){
	   $(this).catcomplete({
		  	delay: 500,
		  	source: function(request, response) {
		    $.ajax({
		      url: 'index.php?route=sale/customer/autocomplete&token=' + $('#tk').val() + '&filter_name=' +  encodeURIComponent(request.term),
		      dataType: 'json',
		      success: function(json) { 
		        response($.map(json, function(item) {
		          return {
		            label: item['fullname'] + ' ' + item['dob'],
		            fullname: item['fullname'],
		            value: item['customer_id']
		          }
		        }));
		      }
		    });
		  }, 
		  select: function(event, ui) { 
		    $('input[name=\'filter_customer\']').attr('value', ui.item['fullname']);
		    $('input[name=\'filter_customer_id\']').attr('value', ui.item['value']);
		    return false;
		  },
		  focus: function(event, ui) {
		    return false;
		  }
		});
	});

	$("input[type='text'][name='filter_product']").on("focusin", function(){
		$(this).autocomplete({
			delay: 500,
			source: function(request, response) {
				$.ajax({
					url: 'index.php?route=catalog/product/autocompletesellables&token=' + $('#tk').val() + '&filter_name=' + encodeURIComponent(request.term),
					dataType: 'json',
					success: function(json) {	
						response($.map(json, function(item) {
							return {
								label: item.name,
								value: item.product_id,
								// model: item.model,
								// option: item.option,
								price: item.price
							}
						}));
					}
				});
			}, 
			select: function(event, ui) {
				$('input[name=\'filter_product\']').attr('value', ui.item['label']);
				$('input[name=\'filter_product_id\']').attr('value', ui.item['value']);

				// $('#option td').remove();
				return false;
			},
			focus: function(event, ui) {
		    return false;
		 	}
		});	
	});


	$("input[type='text'][name='filter_user']").on("focusin", function(){
		$(this).catcomplete({
		  delay: 500,
		  source: function(request, response) {
		    $.ajax({
		      url: 'index.php?route=user/user/autocomplete&token=' + $('#tk').val() + '&filter_name=' +  encodeURIComponent(request.term),
		      dataType: 'json',
		      success: function(json) { 
		      	console.log(json);
		        response($.map(json, function(item) {
		          return {
		            label: item['fullname'],
		            fullname: item['fullname'],
		            value: item['user_id']
		          }
		        }));
		      }
		    });
		  }, 
		  select: function(event, ui) { 
		    $('input[name=\'filter_user\']').attr('value', ui.item['fullname']);
		    $('input[name=\'filter_user_id\']').attr('value', ui.item['value']);
		    return false;
		  },
		  focus: function(event, ui) {
		    return false;
		  }
		});
	});


	$("input[name='filter_product']").on('keypress', function(e){
		$("input[name='filter_product_id']").val('');
	});
	$("input[name='filter_user']").on('keypress', function(e){
		$("input[name='filter_user_id']").val('');
	});
	$("input[name='filter_customer']").on('keypress', function(e){
		$("input[name='filter_customer_id']").val('');
	});

});

