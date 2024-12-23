$(function(){
    $('body').on('submit', '#submitFrm', function(e){
      e.preventDefault();
      var nonceValue= enckey;
      var encryption = Encryption;
      var dataS =  $(this).serializeArray().reduce(function(obj, item) {
                    if(item.name=="old_password" || item.name=="new_password" || item.name=="confirm_password"){
                      obj[item.name] = encryption.encrypt(item.value,nonceValue);
                    }else{
                      obj[item.name] =item.value;
                    }
                return obj;
            }, {});


      dataS['enckey'] = nonceValue;
      dataS['_token'] = CSRF_TOKEN;

      block_form();
        $.ajax({
           type: "POST",
           url: ADMIN_HTTP_PATH + 'change-password',
          data: dataS,
          // dataType: 'json',
           success: function(data){
            var data = JSON.parse(data);
              error_remove();
             
              if (data.status == 1){
                formReset();
               display_toster(data.message, 1);
                window.location.href = data.redirect_url;
              }else if (data.status == 0){
                error_display(data.message);
              }else if(data.status == 2){
                display_toster(data.message, 2);
                 // alert(data.message);
                 
              }
           }
        });
    })
  })