$(function(){

   

    $('body').on('submit', '#submitFrm', function(e){
      e.preventDefault();  
      var nonceValue= enckey;
      var encryption = Encryption;

      var dataS =  $(this).serializeArray().reduce(function(obj, item) {
                    if(item.name=="email" || item.name=="password"){
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
           url: HTTP_PATH + 'doLogin',
           data: dataS,
          //dataType: 'json',
           success: function(data){
            var data = JSON.parse(data);
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
    });
})