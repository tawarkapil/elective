$(function(){
    $('body').on('submit', '#submitFrm', function(e){
      e.preventDefault();
      var dataS = new FormData(this);
      dataS.append('_token', CSRF_TOKEN);
      block_form();
        $.ajax({
           type: "POST",
           url: ADMIN_HTTP_PATH + 'update-profile',
           data: dataS,
            cache: false,
            contentType: false,
            processData: false,
           dataType: 'json',
           success: function(data){
              error_remove();
              
              if (data.status == 1){
                //formReset();
                display_toster(data.message, 1);
                //$('#page-refresh-container').load(window.location.href + ' #page-refresh-box');
                //window.location.href = data.redirect_url;
              }else if (data.status == 0){
                error_display(data.message);
              }else if(data.status == 2){
                display_toster(data.message, 2);
                 // alert(data.message);
                 
              }
           }
        });
  });
});