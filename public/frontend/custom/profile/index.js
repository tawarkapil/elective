$(function(){


    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
         event.preventDefault();
         $(this).ekkoLightbox({
           alwaysShowClose: true
         });
    });
 
    $('#dob').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        minYear: 1901,
        autoUpdateInput: true,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
            format: "DD-MM-YYYY",
        }
    });

    //$('#graduation_date').mask('99/9999');


    $('select[name="countryCode"]').find('option[data-countrycode="' + country_code + '"]').attr('selected', 'selected');
    var country_title = $('select[name="countryCode"]').find('option[data-countrycode="' + country_code + '"]').text();
    $('select[name="countryCode"]').attr('title', country_title);


    $('body').on('change', 'select[name="countryCode"]', function() {
        dial_code = $(this).val();
        country_code = $('option:selected', this).attr('data-countrycode');
        var val = $(this).find('option[data-countrycode="' + country_code + '"]').text();
        $(this).attr('title', val);
    });


    $('body').on('change', '#referral_you', function(){
        var referral_you = $(this).val();
        $('.referral_box').hide();
        $('.other_refrral_box').hide();
        $('#referral_name').val('');
        $('#referral_contact_number').val('');

        if(referral_you == 'Referral'){
            $('.referral_box').show();
        }
        if(referral_you == 'Other'){
            $('.other_refrral_box').show();
        }
    });


    //---------------------------- check only number end -------------------
    $('body').on('submit', '#personalInfoFrm', function(e) {
        e.preventDefault();
        block_form();
        $('.ajax-loading-loader').show();
        var dataS = new FormData(this);
        dataS.append('country_code', country_code);
        dataS.append('dial_code', dial_code);
        dataS.append('_token', CSRF_TOKEN);
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'personalInfoFrm',
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
                    $('.personalFrmToggle').click();
                    $('.contactFrmToggle').click();
                } else if (data.status == 0) {
                    error_display_input(data.message);
                } else if (data.status == 2) {
                    display_toster(data.message, 2);
                }
            }
        });
    });

    $('body').on('submit', '#contactDetailsFrm', function(e) {
        e.preventDefault();
        block_form();
        $('.ajax-loading-loader').show();
        var dataS = new FormData(this);
        dataS.append('_token', CSRF_TOKEN);
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'contactDetailsFrm',
            data: dataS,
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.ajax-loading-loader').hide();
                error_remove();
                if (data.status == 1) {
                    display_toster(data.message, 1);
                    $('.contactFrmToggle').click();
                    $('.studiesFrmToggle').click();
                } else if (data.status == 0) {
                    error_display_input(data.message);
                } else if (data.status == 2) {
                    display_toster(data.message, 2);
                }
            }
        });
    });


    $('body').on('submit', '#studiesDetailsFrm', function(e) {
        e.preventDefault();
        block_form();
        $('.ajax-loading-loader').show();
        var dataS = new FormData(this);
        dataS.append('_token', CSRF_TOKEN);
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'studiesDetailsFrm',
            data: dataS,
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.ajax-loading-loader').hide();
                error_remove();
                if (data.status == 1) {
                    display_toster(data.message, 1);
                    $('.studiesFrmToggle').click();
                    $('.socialFrmToggle').click();
                } else if (data.status == 0) {
                    error_display_input(data.message);
                } else if (data.status == 2) {
                    display_toster(data.message, 2);
                }
            }
        });
    });

    $('body').on('submit', '#socialFrm', function(e) {
        e.preventDefault();
        block_form();
        $('.ajax-loading-loader').show();
        var dataS = new FormData(this);
        dataS.append('_token', CSRF_TOKEN);
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'socialFrm',
            data: dataS,
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.ajax-loading-loader').hide();
                error_remove();
                if (data.status == 1) {
                    display_toster(data.message, 1);
                    $('.socialFrmToggle').click();
                    $('.galleryFrmToggle').click();
                } else if (data.status == 0) {
                    error_display_input(data.message);
                } else if (data.status == 2) {
                    display_toster(data.message, 2);
                }
            }
        });
    });

    $('body').on('change', '#profile_image', function(e){
        e.preventDefault();
        var dataS = new FormData();
        dataS.append('profile_image', $(this)[0].files[0])
        dataS.append('_token', CSRF_TOKEN);
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'submitProfilePicForm',
            data: dataS,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                  $('.update-pic-cls').attr('src', data.avatar);
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
            url: HTTP_PATH + "ajaxloadstate",
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




    var fileIsProcessing = false;
    $('#uploadFiles').fileupload({
        // dataType: 'json',
        maxChunkSize: 1 * 1024 * 1024,
        url : HTTP_PATH + "profile/uploadChunkFile",
        autoUpload: true,
        add: function (e, data) {
            var goUpload = true;
            var uploadFile = data.files[0];
            var regexObj = new RegExp("(" + uploaderMines + ")$");
            if (!regexObj.test(uploadFile.name.toLowerCase())) {
              $('label[for="attachments"] span.error').remove();
              $('label[for="attachments"]').append(' <span class="error">(You must select a valid file only)</span>');
              goUpload = false;
            }else if (uploadFile.size > maxSizeMb * 1024 * 1024) { // 2mb
              $('label[for="attachments"] span.error').remove();
              $('label[for="attachments"]').append(' <span class="error">(Please upload a smaller image, max size is '+maxSizeMb+' MB)</span>');
              goUpload = false;
            }

            if (goUpload == true) {
              data.submit();
            }
        },

        send : function(e, data){
          fileIsProcessing = true;
          file_name = data.files[0].name;
          $('label[for="attachments"] span.error').remove();
          $('.video-progress-bar').removeClass('bg-success bg-danger').addClass('bg-info').css('width', '0%');
          $('label[for="uploadFile"]').text(file_name);
        },

        progressall: function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          console.log(progress);
          $('.progress').show();
          $('.video-progress-bar').removeClass('bg-success');
          $('.video-progress-bar').removeClass('bg-danger');
          $('.video-progress-bar').addClass('bg-info');
          $('.video-progress-bar').css('width', parseInt(progress) + '%');
        },
        done: function (e, data) {
          fileIsProcessing = false;
          $('label[for="uploadFile"]').text('Choose files');
          var result = JSON.parse(data.result);
          if(result.uploaded_fileurl){
                attachments.push(result.uploaded_filekey);
                // var uploadHTML = '<div class="gallery-item documentfileContainer" data-key="'+result.uploaded_filekey+'"><div class="thumb"><img class="img-fullwidth" src="'+result.uploaded_fileurl+'" alt="project"><div class="overlay-shade"></div><div class="icons-holder"><div class="icons-holder-inner"><div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored"><a data-lightbox="image" href="'+result.uploaded_fileurl+'"><i class="fa fa-plus"></i></a><a href="#"><i class="fa fa-trash removeUploadFile"></i></a></div></div></div></div></div>';
                // $('.displayUploadedFileName').append(uploadHTML).show();

                var uploadHTML = '<div class="col-sm-2"><a href="'+result.uploaded_fileurl+'" data-toggle="lightbox" data-gallery="gallery"><img src="'+result.uploaded_fileurl+'" class="img-fluid mb-2 gallery_img"/></a></div>';

                $('.displayUploadedFileName').append(uploadHTML).show();

                //$('.gallery-isotope').isotope( 'reloadItems').isotope({ sortBy: 'original-order'});
                $('[data-toggle="tooltip"]').tooltip();
                $('.video-progress-bar').removeClass('bg-info bg-danger').addClass('bg-success');
                setTimeout(function(){
                    $('.progress').hide();
                }, 2000);
          }else{
            $('label[for="attachments"]').append(' <span class="error">('+result.attachments[0].error+')</span>');
            $('.video-progress-bar').removeClass('bg-info bg-success').addClass('bg-danger');
            setTimeout(function(){
                $('.progress').hide();
            }, 2000);
          }
        },
        fail : function(){
          fileIsProcessing = false;
          //attachments = [];
          $('.video-progress-bar').css('width',  '100%');
           $('.video-progress-bar').removeClass('bg-info bg-success').addClass('bg-danger');
          $('label[for="uploadFile"]').text('Choose file');
        },
    });



    $('body').on('click', '.removeUploadFile', function(e){
        e.preventDefault();
        var _this = this;
        var upload_file = $(_this).closest('.documentfileContainer').attr('data-key');
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "profile/removeAttachmentFile",
            data: '_token=' + CSRF_TOKEN + '&upload_file=' + upload_file,
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                   $(_this).closest('.documentfileContainer').remove();
                }
            }
        });
    });


    $('body').on('click', '.removeWrongUploadFile', function(e){
        e.preventDefault();
        $(this).closest('.documentfileContainer').fadeOut("slow");
        $('.progress').hide();
    });
});