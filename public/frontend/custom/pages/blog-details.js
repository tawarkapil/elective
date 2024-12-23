$(function(){
  $("body").on('submit', '#commentSubmitFrm', function (e) {
      e.preventDefault();
      var dataS =  $(this).serialize();
      $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn'); 
      $.ajax({
         type: "POST",
         url: HTTP_PATH + 'commentSubmitFrm',
         data: dataS + '&blog_id=' + blog_id + '&id=' + id + "&_token=" + CSRF_TOKEN,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
              formReset();
              display_toster(data.message, 1);
              $('#comment-refresh-container').load(window.location.href + ' #comment-refresh-box');
            }else if (data.status == 0){
              error_display(data.message);
            }else if(data.status == 2){
              display_toster(data.message, 2); 
            }
         }
      });
    });
});