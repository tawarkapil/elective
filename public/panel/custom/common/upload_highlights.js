$(function(){

	CKEDITOR.replace('description');

	$("body").on("click", '.addNewBtn', function (e) {
        e.preventDefault();
        id = 0;
        formReset();
        $('.imgDisplayBx').html('');
        CKEDITOR.instances.description.setData("", function () {});        
        $('#submitFrmMdl').find('#page_headline').text('Add Highlight');
        $("#submitFrmMdl").modal("show");
    });


    $("body").on("click", ".editBtn", function (e) {
        e.preventDefault();
        var _this = this;
        formReset();
        $('.imgDisplayBx').html('');
        CKEDITOR.instances.description.setData("", function () {});        
        id = $(this).attr("data-key");
        $('#submitFrmMdl').find("#page_headline").html('Edit Highlight');
        getfillform(_this);
    });


    function getfillform(_this){
        $.ajax({
            type: "POST",
            url: ADMIN_HTTP_PATH + 'highlights/get_content',
            data: 'id=' + id + "&_token=" + CSRF_TOKEN,
            dataType: 'json',
            success: function(data){
                if (data.status == 1){
                    CKEDITOR.instances.description.setData(data.description, function () {});
                    $(".imgDisplayBx").html(data.image);
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
        dataS.append('type', type);
        dataS.append('ref_id', ref_id);
        dataS.append('_token', CSRF_TOKEN);
        $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn');
        $.ajax({
	         type: "POST",
	         url: ADMIN_HTTP_PATH + 'highlights/addnewajax',
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
        $('#delConfirmationMdl').modal('show');
    });

    $('body').on('click', '.delConfirmationBtn', function(e){
        $('.delConfirmationBtn').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: ADMIN_HTTP_PATH + 'highlights/delete',
         data: 'id=' + id + "&_token=" + CSRF_TOKEN,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('.delConfirmationBtn').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
                formReset();
                display_toster(data.message, 1);
                $('#page-refresh-container').load(window.location.href + ' #page-refresh-box');
                $("#delConfirmationMdl").modal("hide");
            }else{
              error_display(data.message);
            }
         }
        });
    });

});