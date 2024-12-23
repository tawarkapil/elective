function error_display(errorArr) {
    $.each(errorArr, function (key, val) {
        show_label_error(key, val);
        $("#" + key).focus();
        return
    })
}

function show_label_error(key, val) {
    if ($("label[for='" + key + "'] #" + key + "-error").length == 0) {
        $("label[for='" + key + "']").append(' <span id="' + key + '-error" class="error"> ( ' + val + ')</span>')
    } else {
        $("#" + key + "-error").html(val).show()
    }

    if ($("span.multi-custom-error[for='" + key + "'] #" + key + "-error").length == 0) {
        $("span.multi-custom-error[for='" + key + "']").append(' <span id="' + key + '-error" class="error"> ( ' + val + ')</span>')
    } else {
        $("#" + key + "-error").html(val).show()
    }
}

function custom_error_display(errorArr) {
    $.each(errorArr, function (key, val) {
        custom_show_label_error(key, val);
        $("#" + key).focus();
        return
    })
}

function custom_show_label_error(key, val) {
    if ($("span.custom-error-show[for='" + key + "'] #" + key + "-error").length == 0) {
        $("span.custom-error-show[for='" + key + "']").append(' <span id="' + key + '-error" class="error"> ( ' + val + ')</span>')
    } else {
        $("#" + key + "-error").html(val).show()
    }
}

function formReset(form) {
    error_remove();
    $("input[type='text'],input[type='password'], input[type='email'],input[type='hidden'],input[type='file'], textarea, select").val('')
}

function block_form() {
  show_loader();
     $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn');
}

function error_remove() {
    hide_loader();
    $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
    $("label span.error").remove();
    $("span.multi-custom-error span.error").remove();
    $("span.custom-error-show span.error").remove();
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();

  $('body').on('mouseenter', '.custom-tooltip', function(e){
    e.preventDefault();
    $(this).popover('show');
  });

  $('body').on('mouseleave', '.custom-tooltip', function(e){
    e.preventDefault();
    $(this).popover('hide');
  });

});

function show_loader(){
  $('#form-loader').show();
}


function hide_loader(){
  $('#form-loader').hide();
}


function display_toster(message, type = 1, timeout = 5000){
  if(type == 1){
    toastr.success(message, 'Success!', { "timeOut": timeout });
  }else{
    toastr.error(message, 'Error!', { "timeOut": timeout });
  }

}


$(function(){


  
   $('body').on('change', '.custom-file-input', function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(','));
    });

    $("body").on("click", ".read_notif_btn", function (e) {
       $.ajax({
          type: "POST",
          url: ADMIN_HTTP_PATH + "notifications/read_notification",
          data: "_token=" + CSRF_TOKEN,
          dataType: "json",
          success: function(data){
              error_remove();
              if (data.status == 1){
                if(data.count_notif > 0){
                  $('.count-notif').text(data.count_notif);
                }else{
                  $('.count-notif.remove-count-bell').remove();
                }
              }
          }
      });
    });

    $('body').on('keypress', '.allow_only_number', function (evt) {
        const txt = $(this).val();
        const charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.indexOf('.') === -1) {
              return true;
            } else {
              return false;
            }
          } else {
            if (charCode > 31 &&
              (charCode < 48 || charCode > 57))
              return false;
          }
          return true;
    });

    $('body').on('keypress', '.allow_only_integer', function (evt) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!evt.charCode ? evt.which : evt.charCode);
        if (regex.test(str)) {
            return true;
        }

        evt.preventDefault();
        return false;
    });
});