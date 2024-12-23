$(function(){
	var fileIsProcessing = false;
    var video_file = '';
    var oldRating = 0;

    uploadTestimonialsFile();

    function uploadTestimonialsFile(){
        $('#fileupload').fileupload({
            // dataType: 'json',
            maxChunkSize: 1 * 1024 * 1024,
            url : HTTP_PATH + "testimonials/upload-video",
            autoUpload: true,
            add: function (e, data) {
                var goUpload = true;
                var uploadFile = data.files[0];
                var regexObj = new RegExp("(" + videoUploaderMines + ")$");
                if (!regexObj.test(uploadFile.name.toLowerCase())) {
                  $('label[for="video_file"] span.error').remove();
                  $('label[for="video_file"]').append(' <span class="error">(You must select a valid file only)</span>');
                  goUpload = false;
                }else if (uploadFile.size > videoMaxSizeMb * 1024 * 1024) { // 2mb
                  $('label[for="video_file"] span.error').remove();
                  $('label[for="video_file"]').append(' <span class="error">(Please upload a smaller image, max size is '+maxSizeMb+' MB)</span>');
                  goUpload = false;
                }

                if (goUpload == true) {
                  data.submit();
                }
            },
            send : function(e, data){
                video_file = '';
                fileIsProcessing = true;
                $('label[for="video_file"] span.error').remove();
                $('.displayUploadedFileName').html('');
                $('.video-progress-bar').removeClass('bg-success bg-danger').addClass('bg-warning').css('width', '0%');
                var file_name = data.files[0].name;
                $('label[for="files"]').text(file_name);
            },

            progressall: function (e, data) {
                video_file = '';
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('.progress').show();
                $('.video-progress-bar').removeClass('bg-success bg-danger').addClass('bg-warning').css('width', progress + '%');
                console.log('processing..');
            },

            done: function (e, data) {
                fileIsProcessing = false;
                $('label[for="files"]').text('Choose file');
                var result = JSON.parse(data.result);
                if(result.uploaded_fileurl){
                    video_file = result.uploaded_filekey;
                    var uploadHTML = '<p class="documentfileContainer mt-2">'+result.name+'<a target="_blank" class="allow_download_cstm" href="'+result.uploaded_fileurl+'" data-toggle="tooltip" data-original-title="Download"> <i class="ti-download m-r-5"></i></a><a data-toggle="tooltip" data-original-title="Remove"> <i class="ti-trash m-r-5 removeUploadFile"></i></a></p>';

                    $('.displayUploadedFileName').html(uploadHTML).show();

                    feather.replace();
                    $('[data-toggle="tooltip"]').tooltip();
                    $('.video-progress-bar').removeClass('bg-warning bg-danger').addClass('bg-success');
                    setTimeout(function(){
                        $('.progress').hide();
                    }, 2000);
              }else{
                    video_file = '';
                    $('label[for="video_file"]').append(' <span class="error">('+result.video_file[0].error+')</span>');
                    $('.video-progress-bar').removeClass('bg-warning bg-success').addClass('bg-danger');
                    setTimeout(function(){
                        $('.progress').hide();
                    }, 2000);
              }
            },

            fail : function(){
                fileIsProcessing = false;
                $('label[for="files"]').text('Choose file');
            },
        });
    }

    
    $('body').on('click', '.removeUploadFile', function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: HTTP_PATH + "deleteUploadFiles",
          data: '_token=' + CSRF_TOKEN + '&upload_file=' + video_file,
          dataType: 'json',
          success: function (data) {
            if (data.status == 1) {
              $('.displayUploadedFileName').fadeOut("slow");
              $('.progress').hide();
              video_file = '';
            }
          }
        });
    });

    $('body').on('change', 'input[name="type"]', function(){
        var type = $(this).val();
        if(type == 2){
            $('#description').attr('rows', 2);
            $('.removeTestiCls').removeClass('form-group');
            $('.video-box').show();
        }else{
            $('.removeTestiCls').addClass('form-group');
            $('#description').attr('rows', 5);
            $('.video-box').hide();
        }

    });

    var rating = 0;

    $('body').on('submit', '#testimonialFrm', function(e) {
        e.preventDefault();
        if(fileIsProcessing){
            display_toster('Please waiting you file is processing...', 2);
            return false;
        }
        var dataS = new FormData(this);
        dataS.append('testimonial_id', 0);
        dataS.append('_token', CSRF_TOKEN);
        dataS.append('rating', rating);
        dataS.append('video_file', video_file);
        dataS.append('status', 1);
        block_form();
        $('.ajax-loading-loader').show();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'testimonials/addnewajax',
            data: dataS,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                error_remove();
                $('.ajax-loading-loader').hide();
                if (data.status == 1) {
                    formReset();
                    rating = 0;
                    video_file = '';
                    $('#testimonialFrm').load(window.location.href + ' .testi-refresh-bx', function(){
	                    $('#type1').prop('checked', true);
	                    $('.video-box').hide();
	                    $('.video-progress-bar').removeClass('bg-warning bg-danger bg-success');
                      	display_toster(data.message, 1);
                   	 	fillStar(0);
                        uploadTestimonialsFile();
                    });
                } else if (data.status == 0) {
                    error_display(data.message);
                } else if (data.status == 2) {
                    display_toster(data.message, 2);
                }
            }
        });
    });

    fillStar(oldRating);
    
    function fillStar(oldRating){
        // oldRating = parseInt(oldRating);
        var elem  = $('#stars li[data-value="'+oldRating+'"]');
        var onStar = parseInt(oldRating); // The star currently selected
        var stars = $(elem).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        rating = (!isNaN(ratingValue)) ? ratingValue : 0;
    }

    /* 2. Action to perform on click */
    $('body').on('click', '#stars li', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        rating = (!isNaN(ratingValue)) ? ratingValue : 0;
    });
});


$(function(){
    $('body').on('click', '.srchSharedFileBtn', function(e){
        e.preventDefault();
        get_shared_list();
    });

    function get_shared_list(){
        var srch_keyword = $('#srch_shared_keyword').val();
        dataS  =  'srch_keyword=' + srch_keyword;
        $('.ajax-loading-loader').show();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'ajax_shared_files_search_list',
            data: dataS + '&_token=' + CSRF_TOKEN,
            dataType: 'json',
            success: function(data) {
                $('.ajax-loading-loader').hide();
                $('.srchSharedFileBtn').prop('disabled', false);;
                if (data.status == 1) {
                    $('.shared-files-container-ls').html(data.html);
                } 
            }
        });
    }
});


$(function(){
    var discussion_url = HTTP_PATH + 'ajax_discussion_forum_search_list';
    
    get_discussion_forum_list();

    $('body').on('click', 'ul.pagination li a', function(e){
        e.preventDefault();
        discussion_url = $(this).attr('href');
        get_discussion_forum_list();
    });


    $('body').on('click', '.srchDiscussionForumBtn', function(e){
        e.preventDefault();
        discussion_url = HTTP_PATH + 'ajax_discussion_forum_search_list';
        get_discussion_forum_list();
    });

    function get_discussion_forum_list(){
        var srch_keyword = $('#srch_discussion_keyword').val();
        if(typeof srch_keyword === "undefined") {
            srch_keyword = '';
        }
        dataS  =  'srch_keyword=' + srch_keyword;
        $('.ajax-loading-loader').show();
        $.ajax({
            type: "POST",
            url: discussion_url,
            data: dataS + '&_token=' + CSRF_TOKEN,
            dataType: 'json',
            success: function(data) {
                $('.ajax-loading-loader').hide();
                $('.srchDiscussionForumBtn').prop('disabled', false);;
                if (data.status == 1) {
                    $('.discussion-forum-container-ls').html(data.html);
                } 
            }
        });
    }


    $('body').on('click', '.closeNotifMembershipCertificate', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'closeNotifMembershipCertificate',
            data: '_token=' + CSRF_TOKEN + '&type=' + type,
            dataType: 'json',
            success: function(data) {
            }
        });
    });
});