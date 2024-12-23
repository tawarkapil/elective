$(function(){
	CKEDITOR.replace( 'description');

	$('#event_ids').select2();
	$('#tour_ids').select2();

	$("body").on('submit', '#submitFrm', function (e) {
        e.preventDefault();
        var dataS = new FormData(this);
        var description = CKEDITOR.instances.description.getData();
        dataS.append('id', id);
        dataS.append('description', description);
        dataS.append('_token', CSRF_TOKEN);
        $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: HTTP_PATH + 'my-trips/addnewajax',
         data: dataS,
         contentType: false,
         cache: false,
         processData:false,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
              formReset();
              display_toster(data.message, 1);
              window.location.href = data.redirect_url;
            }else if (data.status == 0){
              error_display(data.message);
            }else if(data.status == 2){
              display_toster(data.message, 2); 
            }
         }
      });
    });

    $('body').on('change', '#destination_id', function(e){
    	e.preventDefault();
    	var destination_id = $('#destination_id').val();
    	$('#program_id').addClass('ajax-loading');
    	$.ajax({
	         type: "POST",
	         url: HTTP_PATH + 'my-trips/loadPrograms',
	         data: 'destination_id=' + destination_id + '&_token=' + CSRF_TOKEN,
	         dataType: 'json',
	         success: function(data){
				$('#tour_ids').html('');
				$('#event_ids').html('');
	         	$('#program_id').removeClass('ajax-loading');
	            if (data.status == 1){
	            	$('#program_id').html(data.option);
	            	$('#tour_ids').html(data.tour_option);
	            	$('#event_ids').select2();
					$('#tour_ids').select2();
	            }
	         }
	    });
    });

    $('body').on('change', '#program_id', function(e){
    	e.preventDefault();
    	var program_id = $('#program_id').val();
    	$('#event_ids').addClass('ajax-loading');
    	$.ajax({
	         type: "POST",
	         url: HTTP_PATH + 'my-trips/loadEvents',
	         data: 'program_id=' + program_id + '&_token=' + CSRF_TOKEN,
	         dataType: 'json',
	         success: function(data){
	         	$('#event_ids').removeClass('ajax-loading');
	         	$('#event_ids').select2("val", "");
				$('#tour_ids').select2("val", "");
	            if (data.status == 1){
	            	$('#event_ids').html(data.option);
	            }
	         }
	    });
    });

    $('body').on('change', '.change-payment-summary-inp', function(){
    	$('.payment-info-bx').addClass('ajax-loading');
    	var dataS = $('#submitFrm').serialize();
    	$('.payment-info-bx').html('');
    	$.ajax({
	         type: "POST",
	         url: HTTP_PATH + 'my-trips/loadPaymentSummary',
	         data: dataS + '&_token=' + CSRF_TOKEN,
	         dataType: 'json',
	         success: function(data){
	         	$('.payment-info-bx').removeClass('ajax-loading');
	            if (data.status == 1){
	            	$('.payment-info-bx').html(data.html);
	            }
	         }
	    });

    });
});