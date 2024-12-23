$(function(){

  $('select[name="countryCode"]').find('option[data-countrycode="'+country_code+'"]').attr('selected', 'selected');
  var country_title =  $('select[name="countryCode"]').find('option[data-countrycode="'+country_code+'"]').text();
  $('select[name="countryCode"]').attr('title', country_title);

  $('body').on('change', 'select[name="countryCode"]', function(){
    dial_code = $(this).val();
    country_code = $('option:selected', this).attr('data-countrycode');
    var val = $(this).find('option[data-countrycode="'+country_code+'"]').text();
    $(this).attr('title', val);

  });

  $('#select_country_code').select2();

  



   $('body').on('change', '#country', function(e){
    var country_id = $(this).val();
    $('label[for="postal_code"] span.addrequired').html('');
    var region_id = $(this).find('option[value="'+country_id+'"]').attr('data-region');
    if(country_id == 231){
      $('label[for="postal_code"] span.addrequired').append('<span class="required text-danger">*</span>');
    }
    $('#region-lbl').val(region_id);
    $('#region').val(region_id);

  });


  $('#dob').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'mm/dd/yyyy', 
      startDate: '-99y',
      endDate: '-18y' 
  });

  $('body').on('submit', '#personalInfoFrm', function(e){
    e.preventDefault();
    var dataS = new FormData(this);
    dataS.append('_token', CSRF_TOKEN);
    dataS.append('dial_code', dial_code);
    dataS.append('country_code', country_code);
    block_form();
    $('.ajax-loading-loader').show();
      $.ajax({
        type: "POST",
        url: HTTP_PATH + 'profile/submitPersonalInfo',
        data: dataS,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            error_remove();
            $('.ajax-loading-loader').hide();
            if (data.status == 1){
              //formReset();
              display_toster(data.message, 1);
              $("html, body").animate({ scrollTop: 0 }, "slow");
              window.location.href = data.redirect_url;
            }else if (data.status == 0){
              error_display(data.message);
            }else if(data.status == 2){
              display_toster(data.message, 2);
            }
         }
      });
  });

  $('body').on('change', '#country', function () {
    var country_id = $(this).val();
    var _this = this;
    $('#state').addClass('ajax-loading');
    $.ajax({
      type: "POST",
      url: HTTP_PATH + "ajaxloadstate",
      data: '_token=' + CSRF_TOKEN + '&country_id=' + country_id,
      dataType: 'json',
      success: function (data) {
        $('#state').removeClass('ajax-loading');
        if (data.status == 1) {
          var html = '<option value="">Please Select </option>';
          for (i in data.states) {
            html += '<option value="' + i + '">' + data.states[i] + ' </option>';
          }
          $('#state').html(html);
        }
      }
    });
  });
});  