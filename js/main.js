jQuery( document ).ready(function( $ ) {
	var form = $('.date-form'),
	loading = $('#form-loading')
	content = $('#form-content'),
	message = $('#form-message');

	$(form).submit(function(){
		$(loading).css({
			paddingTop: Math.round($(form).height()/2) + 'px'
		}).removeClass('hide');

		$.ajax({
			type: 'POST',
			url: '../controllers/IndexController.php',
			data: $(form).serialize(),
			dataType: 'json',
			success: function(data){
				$(loading).fadeOut('fast', function(){
					$(this).addClass('hide').fadeIn();
				});
				if (data.code == 'failed'){
					$(message).innerHTML = data.error;
					$(message).removeClass('hide');
				}else if (data.code == 'success'){
					$(content).fadeOut('fast', function(){
						$(this).addClass('hide');
						$(message).removeClass('hide');
					});
				}
			},
		});
		return false;
	});

	$('#searchbutton').click(function(){
		$(loading).css({
			paddingTop: Math.round($(form).height()/2) + 'px'
		}).removeClass('hide');

		$.ajax({
			type: 'POST',
			url: '../controllers/IndexController.php',
			data: $(form).serialize(),
			dataType: 'json',
			success: function(data){
				$(loading).fadeOut('fast', function(){
				console.log(data);
				$("#results").removeClass('hide');
				var trHTML = '';
				$("#results-table").find("tr:gt(0)").remove(); //remove all rows except header
				$.each(data, function(key, value) {
        	   		 trHTML += 
		            '<tr><td>' + value.name + 
		            '</td><td>' + value.checkin_date + 
		            '</td><td>' + value.checkout_date + 
		            '</td><td>' + value.type + 
		            '</td><td>' + value.description + 
		            '</td><td>' + value.no_of_guests + 
		            '</td><td>' + value.special_requests + 
		            '</td></tr>';         
           		 });
           		 $('#results-table').append(trHTML);	
				});
				if (data.code == 'failed'){
					$(message).innerHTML = data.error;
					$(message).removeClass('hide');
				}else if (data.code == 'success'){
					$(content).fadeOut('fast', function(){
						$(this).addClass('hide');
						$(message).removeClass('hide');
					});
				}
			},
		});
		return false;
	});

	$("#room_type").change(function() {
    var option = $(this).val();

    //make the ajax call
    $.ajax({
        url: "../controllers/IndexController.php",
        type: 'POST',
        dataType: 'json',
        data: {type:option, function:'getRoomsbyRoomType'},
        success: function(data)
        {
            $("#roomrow").removeClass('hide');
            $("#room").empty();
            $("#room").append(new Option( 'Please select a room', '' ));
            $.each(data, function(key, value) {
        	   	$("#room").append(new Option( value.description, value.roomid ));
            });
    	
        }
    	});
	});

	$('#date-from, #date-to', form).dateTimePicker({
		paging: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		picker: ['date'],
		format: 'd-m-Y',
		filter: function(date){
			// Select date in the future
			var d = new Date();
			if (date.getTime() < d.getTime()){
				return false;
			}else{
				return true;
			}
		},
		filter_show: function(date){
			var d = new Date();
			return date.getYear() > d.getYear() || (date.getYear() == d.getYear() && date.getMonth() >= d.getMonth());
		}
	}).dateTimePickerRange();

	$('#date-from, #date-to', form).dateTimePicker({
		paging: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		picker: ['date'],
		format: 'd-m-Y',
		filter: function(date){
			// Select date in the future
			var d = new Date();
			if (date.getTime() < d.getTime()){
				return false;
			}else{
				return true;
			}
		},
		filter_show: function(date){
			var d = new Date();
			return date.getYear() > d.getYear() || (date.getYear() == d.getYear() && date.getMonth() >= d.getMonth());
		}
	}).dateTimePickerRange();
	
	var groups = $('.group', form).filter(function(){
		return !$(this).hasClass('submit');
	}).click(function(){
		$(groups).removeClass('active');
		$(this).addClass('active');
	});
	$('#name').trigger('click').trigger('focus');
});
