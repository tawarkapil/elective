$(function(){

    $('#dob').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        autoUpdateInput: true,
        minDate: 0,
        locale: {
            format: "DD-MM-YYYY",
        }
    });

    $('#trip_start_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        autoUpdateInput: true,
        minDate: 0,
        locale: {
            format: "DD-MM-YYYY",
        }
    });

    $('body').on('submit', '#personalInfoFrm', function(e){
        e.preventDefault();
        var dataS =  $(this).serialize();
        block_form();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "application/personalInfoFrm",
            data: dataS + '&_token=' + CSRF_TOKEN,
            dataType : "json",
            success: function(data){
                error_remove();
                if (data.status == 1){
                    //formReset();
                    display_toster(data.message, 1);
                    window.location = data.redirect_url;
                }else if (data.status == 0){ 
                    error_display_input(data.message);
                    if(data.message.accept_terms_condition){
                        console.log(data.message);
                        $('#terms-chckbox').addClass('custom-control-input-danger custom-control-input-outline');
                        $('.display-terms-error').html('<span id="accept_terms_condition-error" class="error is-invalid-error">The accept terms condition field is required.</span>')
                    }
                }else if(data.status == 2){
                    display_toster(data.message, 2);
                }
            }
        });
    });

    $('body').on('submit', '#submitFrm', function(e){
        e.preventDefault();
        var dataS =  $(this).serialize();
        block_form();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "application/submitFrm",
            data: dataS + '&_token=' + CSRF_TOKEN,
            dataType : "json",
            success: function(data){
                error_remove();
                if (data.status == 1){
                    //formReset();
                    display_toster(data.message, 1);
                     window.location = data.redirect_url;
                }else if (data.status == 0){ 
                    error_display_input(data.message);
                }else if(data.status == 2){
                    display_toster(data.message, 2);
                }
            }
        });
    });


    $('body').on('change', '#program', function(e){
        e.preventDefault();
        var program =  $(this).val();
        $("#destinationNameSpan").text(''); 
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "application/loadDestination",
            data: 'program=' + program + '&_token=' + CSRF_TOKEN,
            dataType : "json",
            success: function(data){
                if (data.status == 1){
                    $('#destination').html(data.html);
                    
                }
            }
        });
    });
   
    $('body').on('change', '.changeSummaryVal', function(e){
        e.preventDefault();
        //program
        var program =  $('#program').val();
        let programText = $('#program').find('option:selected').text();
        $("#programNameSpan").text(programText);
        //destination
        let selectBoxId = $(this).attr('id');
        var destination =  $('#destination').val();
        if(selectBoxId === 'destination'){
            let destinationText = $('#destination').find('option:selected').text();
            $("#destinationNameSpan").text(destinationText);
        }
        //duration
        var duration =  $('#duration').val();
        let durationText = $('#duration').find('option:selected').text();
        $("#durationSpan").text(durationText);
        
        var trip_start_date =  $('#trip_start_date').val();
        let tripDate =dateFormetChange(trip_start_date);
        $("#arrivalDateSpan").text(tripDate);
        
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "application/loadPaymentSummary",
            data: 'program=' + program + '&destination=' + destination + '&duration=' + duration + '&trip_start_date=' + trip_start_date + '&_token=' + CSRF_TOKEN,
            dataType : "json",
            success: function(data){
                if (data.status == 1){
                    $('.summary-container').html(data.html); 
                }
            }
        });
    });

    function dateFormetChange(inputDate){
        let [day, month, year] = inputDate.split("-");
        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        return `${parseInt(day)} ${months[parseInt(month) - 1]}, ${year}`;
    }
    
    $('body').on('submit', '#acceptTermsAndConditionFrm', function(e){
        e.preventDefault();
        $(this).find('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn');
        var dataS = $(this).serialize();        
        block_form();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'application/acceptTermAndCondition',
            data: dataS + '&_token=' + CSRF_TOKEN,
            dataType : 'json',
            success: function(data) {
                error_remove();
                $(this).find('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
                if (data.status == 1) {
                    // display_toster(data.message, 1);
                    window.location.href = data.redirect_url;
                } else if (data.status == 0) {
                    grecaptcha.reset();
                    error_display(data.message);
                } else if (data.status == 2) {
                    grecaptcha.reset();
                   display_toster(data.message, 0);
                }
            }
        });
    });
});