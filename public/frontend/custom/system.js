function error_display(errorArr) {
    $.each(errorArr, function (key, val) {
        show_label_error(key, val);
        $("#" + key).focus();
        return
    })
}

function show_label_error(key, val) {
    if ($("label[for='" + key + "'] #" + key + "-error").length == 0) {
        $("label[for='" + key + "']").append(' <span id="' + key + '-error" class="error"> (' + val + ')</span>')
    } else {
        $("#" + key + "-error").html(val).show()
    }

    if ($("span.multi-custom-error[for='" + key + "'] #" + key + "-error").length == 0) {
        $("span.multi-custom-error[for='" + key + "']").append(' <span id="' + key + '-error" class="error"> (' + val + ')</span>')
    } else {
        $("#" + key + "-error").html(val).show()
    }
}


function error_display_input(errorArr) {
    $.each(errorArr, function (key, val) {
        show_label_error_input(key, val);
        $("#" + key).focus();
        return
    })
}

function show_label_error_input(key, val) {
    $('#'+key).addClass('is-invalid');
    $('#'+key).after(' <span id="' + key + '-error" class="error is-invalid-error">' + val + '</span>');

    // if ($("label[for='" + key + "'] #" + key + "-error").length == 0) {
    //     $("label[for='" + key + "']").append(' <span id="' + key + '-error" class="error"> (' + val + ')</span>')
    // } else {
    //     $("#" + key + "-error").html(val).show()
    // }

    // if ($("span.multi-custom-error[for='" + key + "'] #" + key + "-error").length == 0) {
    //     $("span.multi-custom-error[for='" + key + "']").append(' <span id="' + key + '-error" class="error"> (' + val + ')</span>')
    // } else {
    //     $("#" + key + "-error").html(val).show()
    // }
}

function formReset(form) {
    $("input[type='text'],input[type='password'], input[type='email'],input[type='hidden'],input[type='file'], textarea").val('')
}

function block_form() {
  show_loader();
     $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn');
}

function error_remove() {
    hide_loader();
    $('.is-invalid').removeClass('is-invalid');
    $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
    $("label span.error").remove();
    $(".is-invalid-error").remove();
    $("span.multi-custom-error span.error").remove();
    $("span.custom-error-show span.error").remove();
}

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

   $('body').on('click', '.header_resend_verificaiton_mail', function(e){
      e.preventDefault();
       var dataS =  $(this).serialize();
       block_form();
       $.ajax({
         type: "POST",
         url: HTTP_PATH + "resend_verificaiton_mail",
         data: {
           "_token": CSRF_TOKEN
         },
         dataType: 'json',
         success: function(data){
            error_remove();
            if (data.status == 1){
               formReset();
               display_toster(data.message, 1);
            }else if(data.status == 2){
               display_toster(data.message, 2);
            }
         }
      });
   });
});

$(function(){
    $("[data-toggle=tooltip]").tooltip();
    
  $("body").on('submit', '#gblContactSubmitFrm', function (e) {
      e.preventDefault();
      var dataS =  $(this).serialize();
      $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn'); 
      $.ajax({
         type: "POST",
         url: HTTP_PATH + 'contact-frm',
         data: dataS + "&_token=" + CSRF_TOKEN,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
              formReset();
              display_toster(data.message, 1);
            }else if (data.status == 0){
              error_display(data.message);
            }else if(data.status == 2){
              display_toster(data.message, 2); 
            }
         }
      });
    });
  });

$(function(){
    $('body').on('click', '.filterBtnCls', function(e){
        e.preventDefault();
        var isClickYes = $(this).hasClass('active');
        $('.searchBtnCls').removeClass('active');
        $('.data-main-container-cls').removeClass('fil-pd-remove');
        $('.page-breadcrumb').removeClass('remove_bred_mar_b');
        console.log(isClickYes);
        if(isClickYes){
            $(this).removeClass('active');
            $('#searchCollapseBox').removeClass('show');
            $('#filterCollapseBox').collapse('hide');
        }else{
            //console.log('isClickYes');
            $(this).addClass('active');
            $('.data-main-container-cls').addClass('fil-pd-remove');
            $('.page-breadcrumb').addClass('remove_bred_mar_b');
            $('#searchCollapseBox').removeClass('show');
            $('#filterCollapseBox').collapse('show');
        }
    });

    $('body').on('click', '.searchBtnCls', function(e){
        e.preventDefault();
        var isClickYes = $(this).hasClass('active');
        $('.filterBtnCls').removeClass('active');
        $('.data-main-container-cls').removeClass('fil-pd-remove');
        $('.page-breadcrumb').removeClass('remove_bred_mar_b');
        if(isClickYes){
            $(this).removeClass('active');
            $('#searchCollapseBox').collapse('hide');
            $('#filterCollapseBox').removeClass('show');
        }else{
            
            $('.data-main-container-cls').addClass('fil-pd-remove');
            $('.page-breadcrumb').addClass('remove_bred_mar_b');

            $(this).addClass('active');
            $('#filterCollapseBox').removeClass('show');
            $('#searchCollapseBox').collapse('show');
        }
    });

    $('body').on('click', '.logoutConfirmationBtn', function(e){
        e.preventDefault();
        $('#logoutConfirmationModel').modal('show');
    })

});

$(function(){
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

var yourNavigation = $(".second_navigation");
var stickyDiv = "sticky";
var yourHeader = 310;

$(window).scroll(function() {
    if( $(this).scrollTop() > yourHeader ) {
      yourNavigation.addClass(stickyDiv);
    } else {
      yourNavigation.removeClass(stickyDiv);
    }
});

$(function(){
    $('body').on('click', '.section-change-btn', function(e){
      e.preventDefault();
      var sectionname  = $(this).data('section');
      $('.section-container').hide();
      $('.' + sectionname).show();
    });

    $('body').on('click', '.normalFileUploadBtn', function(e){
    e.preventDefault();
    $(this).closest('.normalFileUploadContainer').find('.normalFileUploadInp').click();
  });


  $('body').on('change', '.normalFileUploadInp', function(){
    
    const student_doc_type = $(this).data('document');
    const document_file = $(this)[0].files[0];
    const document_type = $(this).data('section'); 
    const dataS = new FormData();

      dataS.append('document_file', document_file);
      dataS.append('document_type', document_type);
      dataS.append('student_doc_type', student_doc_type);
      dataS.append('_token', CSRF_TOKEN);
      
      //Show progress bar.
      const progressbarHTML = '<div class="row"><div class="col-lg-4"> <div class="progress mt-1"><div class="progress-bar progress-bar-striped progress-bar-animated document-progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div></div></div></div>';

      const progressbarElem = $(this).closest('.normalFileUploadContainer').find('.documents-progressbar-container');

      progressbarElem.html(progressbarHTML);

      progressbarElem.find('.document-progress-bar').removeClass('progress-bar-warning progress-bar-success progress-bar-danger').addClass('progress-bar-warning').css('width', '0%');
      progressbarElem.find('.document-progress-bar').removeClass('progress-bar-warning progress-bar-success progress-bar-danger').addClass('progress-bar-warning').css('width', '100%');

      block_form();
        $.ajax({
          type: "POST",
          url: HTTP_PATH + 'studentDocumentsUpload',
          data: dataS,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(data){
              error_remove();
              if (data.status == 1){
                  display_toster(data.message, 1);
                progressbarElem.find('.document-progress-bar').removeClass('progress-bar-warning progress-bar-success progress-bar-danger').addClass('progress-bar-success');
                setTimeout(function(){
                  progressbarElem.html('');
                  $('#page-refresh-container').load(window.location.href + ' #page-refresh-box');
                  }, 2000);
              }else{
                //progressbar should be red & hide after 3 seconds.
                progressbarElem.find('.document-progress-bar').removeClass('progress-bar-warning progress-bar-success progress-bar-danger').addClass('progress-bar-danger');
                setTimeout(function(){
                  progressbarElem.html('');
                }, 2000);

                display_toster(data.message, 2);
              }
          }
        });
  });
});
