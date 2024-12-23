$(function(){

    CKEDITOR.replace('description');
    var id = 0;
    $("body").on("click", '.addNewBtn', function (e) {
        e.preventDefault();
        id = 0;
        formReset();
        $('.imgDisplayBx').html('');
        CKEDITOR.instances.description.setData("", function () {});        
        $('#submitFrmMdl').find('#page_headline').text('Add Documents');
        $("#submitFrmMdl").modal("show");
    });

    $("body").on("click", ".editBtn", function (e) {
        e.preventDefault();
        var _this = this;
        formReset();
        $('.imgDisplayBx').html('');
        CKEDITOR.instances.description.setData("", function () {});        
        id = $(this).attr("data-key");
        var document_name  = $(this).attr("data-name");
        $('#submitFrmMdl').find("#page_headline").html(document_name);
        getfillform(_this);
    });


    function getfillform(_this){
        $.ajax({
            type: "POST",
            url: ADMIN_HTTP_PATH + 'system-documents/get_content',
            data: 'country_id=' + country_id + '&id=' + id + "&_token=" + CSRF_TOKEN,
            dataType: 'json',
            success: function(data){
                if (data.status == 1){
                    CKEDITOR.instances.description.setData(data.description, function () {});
                    $('#document_type').val(data.document_type);
                    $('#document_name').val(data.document_name);
                    $(".imgDisplayBx").html(data.document_path);
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
        dataS.append('id', id);
        dataS.append('description', description);
        dataS.append('country_id', country_id);
        dataS.append('_token', CSRF_TOKEN);
        $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn');
        $.ajax({
             type: "POST",
             url: ADMIN_HTTP_PATH + 'system-documents/addnewajax',
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
                  $('#page-refresh-container').load(window.location.href + ' #page-refresh-box');
                  display_toster(data.message, 1);
                  $("#submitFrmMdl").modal("hide");
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
        document_name = $(this).data('name');
        $('#delConfirmationMdl').modal('show');
    });

    $('body').on('click', '.delConfirmationBtn', function(e){
        $('.delConfirmationBtn').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: ADMIN_HTTP_PATH + 'system-documents/delete',
         data: 'country_id=' + country_id + '&id=' + id + "&_token=" + CSRF_TOKEN,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('.delConfirmationBtn').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
                formReset();
                display_toster(data.message, 1);
                $('#page-refresh-container').load(window.location.href + ' #page-refresh-box');
                $("#delConfirmationMdl").modal("hide");
            }else if(data.status == 2){
              display_toster(data.message, 2); 
            }else{
              error_display(data.message);
            }
         }
        });
    });

});