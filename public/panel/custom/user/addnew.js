 $().ready(function () {
 $('body').on('submit', '#submitFrm', function(e){
             e.preventDefault();
             var dataS =  $(this).serialize();
             block_form();
               $.ajax({
                  type: "POST",
                  url: ADMIN_HTTP_PATH + 'users/addnewajax',
                  data: dataS + "&_token=" + CSRF_TOKEN,
                  dataType: 'json',
                  success: function(data){
                 error_remove();
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
});