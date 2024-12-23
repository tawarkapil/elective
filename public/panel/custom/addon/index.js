$(function(){
    var attachments = [];
     CKEDITOR.replace('description');
     CKEDITOR.replace('what_include_description');
     CKEDITOR.replace('price_description');

     $('#srch_start_date').daterangepicker({
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

    $('#srch_end_date').daterangepicker({
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

      $('.custom-date-pickeer').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });

    $("body").on("click", ".searchBtn", function(e) {
        e.preventDefault();
        $("#custom-ajax-tbl").DataTable().destroy();
        draw_data();
    });

    $("body").on("click", ".resetBtn", function(e) {
        e.preventDefault();
        $("#srch_start_date").val('');
        $("#srch_end_date").val('');
        $("#custom-ajax-tbl").DataTable().destroy();
        draw_data();
        ajaxTbl.search('').draw();
    });

    draw_data();
    function draw_data() {
        var srch_start_date = $("#srch_start_date").val();
        var srch_end_date = $("#srch_end_date").val();
        ajaxTbl = $('#custom-ajax-tbl').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,      
            responsive: true, 
            ajax: {
                url: ADMIN_HTTP_PATH + "addons/ajax_list",
                type: "POST",
                data: {
                    srch_start_date: srch_start_date,
                    srch_end_date: srch_end_date,
                    _token: CSRF_TOKEN,
                },
            },
            "drawCallback": function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            order: [
                [6, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', "orderable": false},
                 { data: 'image', "orderable": false},
                { data: 'title', "orderable": true},
                { data: 'mst_programs.title', "orderable": true},
                { data: 'payment_amount', "orderable": true},
                { data: 'status', "orderable": true},
                { data: 'created_at', "orderable": true},
                { data: "action", orderable: false, searchable: false},
            ]
        });
    }


    var id = '';

     $("body").on("click", '.addNewBtn', function (e) {
        e.preventDefault();
        id = 0;
        formReset();
        $('.imgDisplayBx').html('');
        $('.displayUploadedFileName').html('');
        $('.csrf_field_div').html('<input type="hidden" name="_token" value="'+CSRF_TOKEN+'">');

        CKEDITOR.instances.description.setData("", function () {});        
        CKEDITOR.instances.what_include_description.setData("", function () {});
        CKEDITOR.instances.price_description.setData("", function () {});

        $('#submitFrmMdl').find('#page_headline').text('Add Add-On');
        $("#submitFrmMdl").modal("show");
    });


    $("body").on("click", ".editBtn", function (e) {
        e.preventDefault();
        var _this = this;
        formReset();
        $('.imgDisplayBx').html('');
        $('.displayUploadedFileName').html('');
        $('.csrf_field_div').html('<input type="hidden" name="_token" value="'+CSRF_TOKEN+'">');

        CKEDITOR.instances.description.setData("", function () {});        
        CKEDITOR.instances.what_include_description.setData("", function () {});
        CKEDITOR.instances.price_description.setData("", function () {});
        id = $(this).attr("data-key");
        $('#submitFrmMdl').find("#page_headline").html('Edit Add-On');
        getfillform(_this);
    });


    function getfillform(_this){
        $.ajax({
            type: "POST",
            url: ADMIN_HTTP_PATH + 'addons/get_content',
            data: 'id=' + id + "&_token=" + CSRF_TOKEN,
            dataType: 'json',
            success: function(data){
                if (data.status == 1){
                    CKEDITOR.instances.description.setData(data.description, function () {});
                    CKEDITOR.instances.what_include_description.setData(data.what_include_description, function () {});
                    CKEDITOR.instances.price_description.setData(data.price_description, function () {});
                    $(".imgDisplayBx").html(data.image);
                    $(".displayUploadedFileName").html(data.attachments_html);
                    $("#title").val(data.title);
                    $("#program").val(data.program);
                    $("#payment_amount").val(data.payment_amount);
                    $("#description").val(data.description);
                    $("#what_include_description").val(data.what_include_description);
                    $("#price_description").val(data.price_description);
                    $("#status").val(data.cstatus);
                    attachments = data.attachments;
                    $("#submitFrmMdl").modal("show");
                }else{
                    display_toster(data.message, 2); 
                }
            }
        });
    }


    $("body").on('submit', '#submitFrm', function (e) {
        e.preventDefault();

        var dataS = new FormData(this);
        var description = CKEDITOR.instances.description.getData();
        var what_include_description = CKEDITOR.instances.what_include_description.getData();
        var price_description = CKEDITOR.instances.price_description.getData();
       
        dataS.append('id', id);
        dataS.append('description', description);
        dataS.append('what_include_description', what_include_description);
        dataS.append('price_description', price_description);
        dataS.append('attachments', attachments);
        dataS.append('_token', CSRF_TOKEN);
        
        $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: ADMIN_HTTP_PATH + 'addons/addnewajax',
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
              $("#submitFrmMdl").modal("hide");
              $("#custom-ajax-tbl").DataTable().destroy();
              draw_data();
                ajaxTbl.search('').draw();
            }else if (data.status == 0){
              error_display(data.message);
            }else if(data.status == 2){
              display_toster(data.message, 2); 
            }
         }
      });
    });


    $('body').on('click', '.deleteBtn', function (e) {
        e.preventDefault();
        var _this = this;
        id = $(this).data('key');
        $('#delConfirmationMdl').modal('show');
    });

    $('body').on('click', '.delConfirmationBtn', function(e){
        $('.delConfirmationBtn').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: ADMIN_HTTP_PATH + 'addons/delete',
         data: 'id=' + id + "&_token=" + CSRF_TOKEN,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('.delConfirmationBtn').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
                formReset();
                display_toster(data.message, 1);
                $("#delConfirmationMdl").modal("hide");
                $("#custom-ajax-tbl").DataTable().destroy();
                draw_data();
                ajaxTbl.search('').draw();
            }else{
              error_display(data.message);
            }
         }
        });
    });


    $("body").on("click", ".open_view_description_btn", function (e) {
        e.preventDefault();
        var key = $(this).attr("data-key");
        var html = $("#open_description_box_" + key).html();
        $("#viewDescriptionMdl .modal-body").html(html);
        $("#viewDescriptionMdl").modal("show");
    });


    $("body").on("click", ".update_status", function (e) {
         e.preventDefault();
         id = $(this).data("key");
         status = $(this).data("status");
         if(status==1){
         var html = '<strong>Do you want to change status from Inactive to Active? Click Confirm to change status.</strong>';
         }
         else
          {
             var html = '<strong>Do you want to change status from Active to Inactive? Click Confirm to change status.</strong>'; 
          }
         $("#confirm_modal .modal-content-value").html(html);
         $("#confirm_modal").modal("show");
    });

    $("body").on("click", ".confirm_status", function (e) {
         e.preventDefault();
         block_form();
         $.ajax({
             type: "POST",
                 url: ADMIN_HTTP_PATH + "addons/update_status",
                 data: "id=" + id + "&status=" + status + "&_token=" + CSRF_TOKEN,
                 dataType: "json",
                success: function(data){
                error_remove();
                if (data.status == 1){
                  formReset();
                  display_toster(data.message, 1);
                  $("#confirm_modal").modal("hide");
                $("#custom-ajax-tbl").DataTable().ajax.reload();
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
        url : ADMIN_HTTP_PATH + "addons/uploadChunkFile",
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
          $('label[for="uploadFile"]').text('Choose files');
          var result = JSON.parse(data.result);
          if(result.uploaded_fileurl){
                attachments.push(result.uploaded_filekey);
                var uploadHTML = '<div class="col-sm-2"><div class="documentfileContainer" data-key="'+result.uploaded_filekey+'"><img src="'+result.uploaded_fileurl+'" class="img-fluid mb-2" alt="white sample"><a href="#" class="removeImgBtn"><i class="fa fa-times removeUploadFile"></i></a></div></div>';

                $('.displayUploadedFileName').append(uploadHTML).show();

                $('[data-toggle="tooltip"]').tooltip();
                $('.video-progress-bar').removeClass('bg-warning bg-danger').addClass('bg-success');
                setTimeout(function(){
                    $('.progress').hide();
                }, 1000);
          }else{
            $('label[for="attachments"]').append(' <span class="error">('+result.attachments[0].error+')</span>');
            $('.video-progress-bar').removeClass('bg-warning bg-success').addClass('bg-danger');
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
        $(_this).closest('.documentfileContainer').parent().remove();
        $('.progress').hide();
    });

    $('body').on('click', '.removeWrongUploadFile', function(e){
        e.preventDefault();
        $(this).closest('.documentfileContainer').parent().fadeOut("slow");
        $('.progress').hide();
    });
});