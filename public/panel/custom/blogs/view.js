$(function(){
   
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
                 url: ADMIN_HTTP_PATH + "comments/update_status",
                 data: "id=" + id + "&status=" + status + "&_token=" + CSRF_TOKEN,
                 dataType: "json",
                success: function(data){
                error_remove();
                if (data.status == 1){
                  formReset();
                  display_toster(data.message, 1);
                  $("#confirm_modal").modal("hide");
                    $('#page-refresh-container').load(window.location.href + ' #page-refresh-box')
                }else if (data.status == 0){
                  error_display(data.message);
                }else if(data.status == 2){
                 display_toster(data.message, 2);
                }
              }
        });
    });
});