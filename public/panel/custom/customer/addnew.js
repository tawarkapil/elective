$(function(){

  $('#dob').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        minYear: 1901,
        autoUpdateInput: false,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
            format: "DD-MM-YYYY",
        }
      });

   $('.custom-date-pickeer').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD-MM-YYYY'));
      });

 $('select[name="countryCode"]').find('option[data-countrycode="' + country_code + '"]').attr('selected', 'selected');
    var country_title = $('select[name="countryCode"]').find('option[data-countrycode="' + country_code + '"]').text();
    $('select[name="countryCode"]').attr('title', country_title);

    $('body').on('change', 'select[name="countryCode"]', function() {
        dial_code = $(this).val();
        country_code = $('option:selected', this).attr('data-countrycode');
        var val = $(this).find('option[data-countrycode="' + country_code + '"]').text();
        $(this).attr('title', val);
    });
   

    //---------------------------- check only number end -------------------


    $('body').on('submit', '#submitFrm', function(e) {
        e.preventDefault();
        block_form();
        $('.ajax-loading-loader').show();
        var dataS = new FormData(this);
        dataS.append('country_code', country_code);
        dataS.append('dial_code', dial_code);
        dataS.append('customer_id', customer_id);
        dataS.append('_token', CSRF_TOKEN);
        $.ajax({
            type: "POST",
            url: ADMIN_HTTP_PATH + 'customers/submitFrm',
            data: dataS,
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            success: function(data) {
                $('.ajax-loading-loader').hide();
                error_remove();
                if (data.status == 1) {
                    display_toster(data.message, 1);
                    window.location.href = data.redirect_url;
                } else if (data.status == 0) {
                    error_display(data.message);
                } else if (data.status == 2) {
                    display_toster(data.message, 2);
                }
            }
        });
    });


    $('body').on('change', '#country', function() {
        var country_id = $(this).val();
        var _this = this;
        loadCountry(country_id);
        
    });

    function loadCountry(country_id) {
        $('#state').addClass('ajax-loading');
        $.ajax({
            type: "POST",
            url: ADMIN_HTTP_PATH + "ajaxloadstate",
            data: '_token=' + CSRF_TOKEN + '&country_id=' + country_id,
            dataType: 'json',
            success: function(data) {
                $('#state').removeClass('ajax-loading');
                if (data.status == 1) {
                    var html = '<option value="">Select State</option>';
                    for (i in data.states) {
                        html += '<option value="' + i + '">' + data.states[i] + ' </option>';
                    }
                    $('#state').html(html);
                }
            }
        });
    }

});