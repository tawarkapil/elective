/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';
var site_url = $("#dynamic_path").val();
//console.log(site_url+"hii");
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
       autoUpload: true,
       maxChunkSize: 2 * 1024 * 1024, 
       // url: 'http://192.168.1.1/web/public/upload_server/php/'
       url: site_url+'/upload_server/php/'
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
  
   /* if (window.location.hostname === 'blueimp.github.io') {
        
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        //alert("sdsdssd");
        /* $('#fileupload').each(function () {
            var that = this;
            $.getJSON(this.action, function (result) {
                if (result && result.length) {
                    $(that).fileupload('option', 'done')
                        .call(that, null, {result: result});
                }
            });
        });*/
        // Load existing files:
       /* $('#fileupload').addClass('fileupload-processing');
       // alert($('#fileupload').fileupload('option', 'url'));
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            type: 'POST',
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            console.log(result);
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }*/
    $(document).on('change', '#attachment_files', function (e) {
    e.preventDefault();

    $('#fileupload').addClass('fileupload-processing');
       // alert($('#fileupload').fileupload('option', 'url'));
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            autoUpload: true,
                maxChunkSize: 2 * 1024 * 1024, 
            url: $('#fileupload').fileupload('option', 'url'),
            type: 'POST',
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            console.log(result);
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
        
      /*  $('#fileupload')
            .fileupload({
                autoUpload: true,
                maxChunkSize: 2 * 1024 * 1024, 
                send: function () {
                    //ok(true, 'Started file upload automatically');
                    return true;
                }
            });*/
           $('.uploader_iframe', window.parent.document).css('height','150px');
            $('.uploader_ifr', window.parent.document).css('height','150px');
     });

});
