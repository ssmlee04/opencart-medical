$(document).ready(function(){

	$('body').on('focusin', "input[type='date_available']", function(){
	// $("input[type='date_available']").on("focusin", function(){
		console.log(123);
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

	$('body').on('focusin', "input[type='customer", function(){
	// $("input[type='customer']").on("focusin", function(){
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
		  	var name = $(this).attr('name');
			$(this).attr('value', ui.item['fullname']);
			$("input[name='" + name + "_id']").attr('value', ui.item['value']);
			$("input[name='" + name + "_name']").attr('value', ui.item['fullname']);
		    // $('input[name=\'filter_customer\']').attr('value', ui.item['fullname']);
		    // $('input[name=\'filter_customer_id\']').attr('value', ui.item['value']);
		    return false;
		  },
		  focus: function(event, ui) {
		    return false;
		  }
		});
	});
	
	
	
	$('body').on('mouseenter', "select[type='treatment']", function(){
		
		// console.log(123);

		var product_type_ids = $(this).attr('alt');
		var status_ids = $(this).attr('alt2');
		var that = this;
		if ($(this).val()) return true;

		// var name = $(this).attr('name');
		$.ajax({
		  url: 'index.php?route=catalog/product/treatment&token=' + $('#tk').val() 
		  + '&filter_status_ids=' + status_ids
		  + '&filter_product_type_ids=' + product_type_ids,
		  type: 'POST',
		  dataType: 'json',
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(json, textStatus, xhr) {
		    //called when successful
				$(that).empty().append("<option></option>");
				json.map(function(d){
					$(that).append("<option alt='" + d.unit + "' alt2='" + d.value + "' value='" + d.product_id + "''>" + d.name + "</option>");
				});
			
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }
		});

	});

	$('body').on('mouseenter', "select[type='sellable']", function(){
		
		// console.log(123);

		var product_type_ids = $(this).attr('alt');
		var status_ids = $(this).attr('alt2');
		var that = this;
		if ($(this).val()) return true;

		// var name = $(this).attr('name');
		$.ajax({
		  url: 'index.php?route=catalog/product/sellable&token=' + $('#tk').val() 
		  + '&filter_status_ids=' + status_ids
		  + '&filter_product_type_ids=' + product_type_ids,
		  type: 'POST',
		  dataType: 'json',
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(json, textStatus, xhr) {
		    //called when successful
				$(that).empty().append("<option></option>");
				json.map(function(d){
					$(that).append("<option alt='" + d.unit + "' alt2='" + d.value + "' value='" + d.product_id + "''>" + d.name + "</option>");
				});
			
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }
		});

	});

	$('body').on('mouseenter', "select[type='product']", function(){

		var product_type_ids = $(this).attr('alt');
		var status_ids = $(this).attr('alt2');
		var that = this;
		if ($(this).val()) return true;

console.log('index.php?route=catalog/product/all&token=' + $('#tk').val() 
		  + '&filter_status_ids=' + status_ids
		  + '&filter_product_type_ids=' + product_type_ids);
		// var name = $(this).attr('name');
		$.ajax({
		  url: 'index.php?route=catalog/product/all&token=' + $('#tk').val() 
		  + '&filter_status_ids=' + status_ids
		  + '&filter_product_type_ids=' + product_type_ids,
		  type: 'POST',
		  dataType: 'json',
		  complete: function(xhr, textStatus) {
		    //called when complete
		    console.log('complete');
		  },
		  success: function(json, textStatus, xhr) {
		    //called when successful
				$(that).empty().append("<option></option>");
				json.map(function(d){
					$(that).append("<option alt='" + d.unit + "' alt2='" + d.value + "' value='" + d.product_id + "''>" + d.name + "</option>");
				});
			
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }
		});

	});


	$('body').on('focusin', "input[type='product']", function(){
	
		var product_type_ids = $(this).attr('alt');
		var status_ids = $(this).attr('alt2');
		$(this).autocomplete({
			delay: 500,
			source: function(request, response) {
				$.ajax({
					url: 'index.php?route=catalog/product/autocomplete&token=' + $('#tk').val() 
+ '&filter_status_ids=' + status_ids
					+ '&filter_name=' + encodeURIComponent(request.term) 
					+ '&filter_product_type_ids=' + product_type_ids,
					dataType: 'json',
					success: function(json) {	
						response($.map(json, function(item) {
							return {
								label: item.name,
								value: item.product_id,
								price: item.price,
								unit: item.unit,
								unitvalue: item.value
							}
						}));
					}
				});
			}, 
			select: function(event, ui) {
				var name = $(this).attr('name');
				console.log(ui.item);
				$(this).attr('value', ui.item['label']);
				$("input[name='" + name + "_id']").attr('value', ui.item['value']);
				$("input[name='" + name + "_name']").attr('value', ui.item['label']);
				$("input[name='" + name + "_unit']").attr('value', ui.item['unit']);
				$("input[name='" + name + "_unitvalue']").attr('value', ui.item['unitvalue']);
				return false;
			},
			focus: function(event, ui) {
		    return false;
		 	}
		});	
	});
	
	
	$('body').on('focusin', "input[type='subtractproduct']", function(){
	// $("input[type='subtractproduct']").on("focusin", function(){
		// console.log(123123);
		var product_type_ids = $(this).attr('alt');
		var status_ids = $(this).attr('alt2');
		$(this).autocomplete({
			delay: 500,
			source: function(request, response) {
				$.ajax({
					url: 'index.php?route=catalog/product/autocomplete&token=' + $('#tk').val() 
				+ '&filter_status_ids=' + status_ids
					+ '&filter_name=' + encodeURIComponent(request.term) 
					+ '&filter_product_type_ids=' + product_type_ids 
					+ '&filter_subtract=1',
					dataType: 'json',
					success: function(json) {	
						response($.map(json, function(item) {
							return {
								label: item.name,
								value: item.product_id,
								price: item.price
							}
						}));
					}
				});
			}, 
			select: function(event, ui) {
				var name = $(this).attr('name');
				$(this).attr('value', ui.item['label']);
				$("input[name='" + name + "_id']").attr('value', ui.item['value']);
				$("input[name='" + name + "_name']").attr('value', ui.item['label']);
				return false;
			},
			focus: function(event, ui) {
		    return false;
		 	}
		});	
	});

	
	var loaduser = function(that) {

		if ($(that).val()) return true;

		var user_group_id = $(that).attr('alt');
		var that = that;
		$.ajax({
		  url: 'index.php?route=user/user/all&token=' + $('#tk').val() + '&filter_user_group_id=' + user_group_id,
		  type: 'POST',
		  dataType: 'json',
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(json, textStatus, xhr) {
		    //called when successful
				$(that).empty().append("<option></option>");
				// $.each(json, function(d){
				// 	$(that).append('<option></option>').text(d.name).val(d.product_id);
				// });
				json.map(function(d){
					$(that).append("<option value='" + d.user_id + "''>" + d.fullname + "</option>");
				});
			
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }
		});
	};

	$('body').on('mouseenter', "select[type='user']", function(){loaduser(this);});
	

	$('body').on('focusin', "input[type='user']", function(){
	// $("input[type='user']").on("focusin", function(){
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
		  	var name = $(this).attr('name');
			$(this).attr('value', ui.item['label']);
			$("input[name='" + name + "_id']").attr('value', ui.item['value']);
			$("input[name='" + name + "_name']").attr('value', ui.item['label']);
		    // $('input[name=\'filter_user\']').attr('value', ui.item['fullname']);
		    // $('input[name=\'filter_user_id\']').attr('value', ui.item['value']);
		    return false;
		  },
		  focus: function(event, ui) {
		    return false;
		  }
		});
	});

	$("input[type='product']").on('keyup', function(e){
		var name = $(this).attr('name');
		// if (e.keyCode == 8) {
			$("input[name='" + name + "_id']").attr('value', '');
			$("input[name='" + name + "_name']").attr('value', '');
		// }
	});
	$("input[type='user']").on('keyup', function(e){
		var name = $(this).attr('name');
		// if (e.keyCode == 8) {
			$("input[name='" + name + "_id']").attr('value', '');
			$("input[name='" + name + "_name']").attr('value', '');
		// }
	});
	$("input[type='customer']").on('keyup', function(e){
		var name = $(this).attr('name');
		// if (e.keyCode == 8) {
			$("input[name='" + name + "_id']").attr('value', '');
			$("input[name='" + name + "_name']").attr('value', '');
		// }
	});

});

