$(function(){
    $('body').on('submit', '#submitFrm', function(e){
      e.preventDefault();
      var dataS =  $(this).serialize();
      block_form();
        $.ajax({
           type: "POST",
           url: ADMIN_HTTP_PATH + 'users/submitCreatePassword',
           data: dataS + "&_token=" + CSRF_TOKEN,
          dataType: 'json',
           success: function(data){
              error_remove();
              $('.glb-message-bx').html('').removeClass('success').removeClass('error');
              if (data.status == 1){
                formReset();
                $('.glb-message-bx').html(data.message).addClass('success');
                window.location.href = data.redirect_url;
              }else if (data.status == 0){
                error_display(data.message);
              }else if(data.status == 2){
                $('.glb-message-bx').html(data.message).addClass('error');;
              }
           }
        });
    })
  })