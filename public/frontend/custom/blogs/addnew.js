$(function(){

	CKEDITOR.replace( 'description');
	$('#tags').select2({
		tags:true,
    minimumInputLength:3,
	});

  $('body').on('change', 'input[name="upload_type"]', function(){
    var type = $(this).val();
      $('.upload_file_bx').hide();
      $('.youtube_url_bx').hide();
      $('.image_upload_bx').hide();
      $('input[name="upload_file"]').prop('checked', false);
    if(type == 1){
      $('.upload_file_bx').show();
    }
  });

  $('body').on('change', 'input[name="upload_file"]', function(){
    var type = $(this).val();
    console.log(type);
    if(type == 'Image'){
      console.log('test');
      $('.youtube_url_bx').hide();
      $('.image_upload_bx').show();
    }else{
      $('.image_upload_bx').hide();
      $('.youtube_url_bx').show();
    }
  });


	$("body").on('submit', '#submitFrm', function (e) {
        e.preventDefault();
        var dataS = new FormData(this);
        var description = CKEDITOR.instances.description.getData();
        dataS.append('id', id);
        dataS.append('description', description);
        dataS.append('_token', CSRF_TOKEN);
        dataS.append('attachments', attachments);
        $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: HTTP_PATH + 'my-blogs/addnewajax',
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



    var fileIsProcessing = false;
    $('#uploadFiles').fileupload({
        // dataType: 'json',
        maxChunkSize: 1 * 1024 * 1024,
        url : HTTP_PATH + "my-blogs/uploadChunkFile",
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
          $('.video-progress-bar').removeClass('bg-success bg-danger').addClass('bg-warning').css('width', '0%');
          $('label[for="uploadFile"]').text(file_name);
        },

        progressall: function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          console.log(progress);
          $('.progress').show();
          $('.video-progress-bar').removeClass('bg-success bg-danger').addClass('bg-warning').css('width', progress + '%');
        },

        done: function (e, data) {
          fileIsProcessing = false;
          $('label[for="uploadFile"]').text('Choose file');
          var result = JSON.parse(data.result);
          if(result.uploaded_fileurl){
                attachments.push(result.uploaded_filekey);
                //var uploadHTML = '<p class="documentfileContainer mt-2" data-key="'+result.uploaded_filekey+'"><i class="fa fa-check-circle" style="color: green;"></i> '+result.name+'<a target="_blank" class="allow_download_cstm" href="'+result.uploaded_fileurl+'" data-toggle="tooltip" data-original-title="Download"> <i class="fa fa-download m-r-5 m-l-10"></i></a><a data-toggle="tooltip" data-original-title="Remove"> <i class="fa fa-trash m-r-5 removeUploadFile"></i></a></p>';


                var uploadHTML = '<div class="gallery-item documentfileContainer" data-key="'+result.uploaded_filekey+'"><div class="thumb"><img class="img-fullwidth" src="'+result.uploaded_fileurl+'" alt="project"><div class="overlay-shade"></div><div class="icons-holder"><div class="icons-holder-inner"><div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored"><a data-lightbox="image" href="'+result.uploaded_fileurl+'"><i class="fa fa-plus"></i></a><a href="#"><i class="fa fa-trash removeUploadFile"></i></a></div></div></div></div></div>';

                $('.displayUploadedFileName').append(uploadHTML).show();

                $('.gallery-isotope').isotope( 'reloadItems').isotope({ sortBy: 'original-order'});

                $('[data-toggle="tooltip"]').tooltip();
                $('.video-progress-bar').removeClass('bg-warning bg-danger').addClass('bg-success');
                setTimeout(function(){
                    $('.progress').hide();
                }, 2000);
          }else{
            $('label[for="attachments"]').append(' <span class="error">('+result.attachments[0].error+')</span>');
            $('.video-progress-bar').removeClass('bg-warning bg-success').addClass('bg-danger');
            // var uploadHTML = '<p class="documentfileContainer mt-2"><i class="fa fa-times-circle" style="color: red;"></i> '+result.attachments[0].name+'<a data-toggle="tooltip" data-original-title="Remove"> <i class="fa fa-trash m-r-5 m-l-10 removeWrongUploadFile"></i></a></p>';
            // $('.displayUploadedFileName').append(uploadHTML).show();
            setTimeout(function(){
                $('.progress').hide();
            }, 2000);
          }
        },
        fail : function(){
          fileIsProcessing = false;
          //attachments = [];
          $('label[for="uploadFile"]').text('Choose file');
        },
    });

    $('body').on('click', '.removeUploadFile', function(e){
        e.preventDefault();
        var _this = this;
        var removeFile = $(_this).closest('.documentfileContainer').attr('data-key');
        attachments.splice($.inArray(removeFile, attachments), 1);
        $(_this).closest('.documentfileContainer').remove();
        $('.progress').hide();
        $('.gallery-isotope').isotope( 'reloadItems').isotope({ sortBy: 'original-order'});
        // $.ajax({
        //   type: "POST",
        //   url: HTTP_PATH + "my-blogs/deleteUploadFiles",
        //   data: '_token=' + CSRF_TOKEN + '&upload_file=' + removeFile,
        //   dataType: 'json',
        //   success: function (data) {
        //     if (data.status == 1) {
        //       attachments.splice($.inArray(removeFile, attachments), 1);
        //       $(_this).closest('.documentfileContainer').remove();
        //       $('.progress').hide();
        //       $('.gallery-isotope').isotope( 'reloadItems').isotope({ sortBy: 'original-order'});
        //     }
        //   }
        // });
    });

    $('body').on('click', '.removeWrongUploadFile', function(e){
        e.preventDefault();
        $(this).closest('.documentfileContainer').fadeOut("slow");
        $('.progress').hide();
    });

});