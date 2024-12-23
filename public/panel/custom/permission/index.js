$(function(){



  $('body').on('change', '.clck-parent', function(e){

    var role_id = $(this).data('role');
    var group = $(this).data('group');

    if($(this).prop("checked") == true){
      // $('.child-permission'+ group + role_id).prop('checked', true);
      $('.child-permission' + group + role_id).prop('disabled', false);

    }else{
      $('.child-permission'+ group + role_id).prop('checked', false);
      $('.child-permission' + group + role_id).prop('disabled', true);

    }

  });


  $('body').on('change', '.activity-single-clck.child', function(e){
     var role_id = $(this).data('role');
    var group = $(this).data('group');
    $('.parent-permission' + group + role_id + '.activity-single-clck.parent').prop('checked', false);
  });

  $('body').on('change', '.activity-single-clck.parent', function(e){
    var role_id = $(this).data('role');
    var group = $(this).data('group');
    $('.parent-permission' + group + role_id + '.activity-single-clck.child').prop('checked', false);
  });


  $('body').on('change', '.parent-same-clck', function(e){
    var role_id = $(this).data('role');
    var group = $(this).data('group');
    if($(this).prop("checked") == true){
     $('.parent-same-clck.child-permission' + group + role_id).prop('checked', true);
    }
  });

  $('body').on('change', '.only-single-active-clck', function(e){
    var role_id = $(this).data('role');
    var group = $(this).data('group');
    if($(this).prop("checked") == true){
     $('.only-single-active-clck.child-permission' + group + role_id).prop('checked', false);
     $(this).prop('checked', true);
    }
  });


  // $('body').on('change', '.clck-permission-level', function(e){

  //   var role_id = $(this).data('role');
  //   var lavel = $(this).data('level');
  //   var group = $(this).data('group');

  //   if($(this).prop("checked") == true){
  //     $('.permission-level' + group + lavel + role_id).prop('checked', true);

  //   }else{
  //     $('.permission-level'+ group + lavel + role_id).prop('checked', false);
  //   }

  // });


  $('body').on('submit', '#permissionFrm', function(e){
        e.preventDefault();
        block_form();
        var dataS = $(this).serialize();
       $.ajax({
           type: "POST",
           url: ADMIN_HTTP_PATH + "permissionSet",
           data: dataS + '&_token=' + CSRF_TOKEN,
           dataType: 'json',
          success: function(data){
             error_remove();
             if (data.status == 1){
              display_toster(data.message, 1);
             }else{
                display_toster(data.message, 2);
             }
          }
       });
   });
});