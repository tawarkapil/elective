$(function(){
     // CKEDITOR.replace( 'description');

     $('#srch_start_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        minYear: 1901,
        autoUpdateInput: false,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
            format: "DD-MM-YYYY",
        }
      });

    $('#srch_end_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        minYear: 1901,
        autoUpdateInput: false,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
            format: "DD-MM-YYYY",
        }
    });

    $('.custom-date-pickeer').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD-MM-YYYY'));
      });

      $('.custom-date-pickeer').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });

    $("body").on("click", ".searchBtn", function(e) {
        e.preventDefault();
        $("#custom-ajax-tbl").DataTable().destroy();
        draw_data();
    });

    $("body").on("click", ".resetBtn", function(e) {
        e.preventDefault();
        $("#srch_start_date").val('');
        $("#srch_end_date").val('');
        $("#custom-ajax-tbl").DataTable().destroy();
        draw_data();
        ajaxTbl.search('').draw();
    });

    draw_data();
    function draw_data() {
        var srch_start_date = $("#srch_start_date").val();
        var srch_end_date = $("#srch_end_date").val();
        ajaxTbl = $('#custom-ajax-tbl').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,      
            responsive: true, 
            ajax: {
                url: ADMIN_HTTP_PATH + "our-members/ajax_list",
                type: "POST",
                data: {
                    srch_start_date: srch_start_date,
                    srch_end_date: srch_end_date,
                    _token: CSRF_TOKEN,
                },
            },
            "drawCallback": function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            order: [
                [5, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', "orderable": false},
                // { data: 'cover_image', "orderable": false},
                { data: 'name', "orderable": true},
                // { data: 'email', "orderable": true},
                { data: 'mst_destinations.title', "orderable": true},
                // { data: 'designation', "orderable": true},
                { data: 'description', "orderable": true},
                { data: 'status', "orderable": true},
                { data: 'created_at', "orderable": true},
                { data: "action", orderable: false, searchable: false},
            ],
            columnDefs: [{
                "width": "84px",
                "targets": 6
            }]
        });
    }


    var id = '';

     $("body").on("click", '.addNewBtn', function (e) {
        e.preventDefault();
        id = 0;
        formReset();
        $(".imgDisplayBx").html('');
        //CKEDITOR.instances.description.setData("", function () {});
        $('#submitFrmMdl').find('#page_headline').text('Add Member');
        $("#submitFrmMdl").modal("show");
    });


    $("body").on("click", ".editBtn", function (e) {
        e.preventDefault();
        var _this = this;
        formReset();
        id = $(this).attr("data-key");
        $(".imgDisplayBx").html('');
        $('#submitFrmMdl').find("#page_headline").html('Edit Member');
        getfillform(_this);
    });


    function getfillform(_this){
        $.ajax({
            type: "POST",
            url: ADMIN_HTTP_PATH + 'our-members/get_content',
            data: 'id=' + id + "&_token=" + CSRF_TOKEN,
            dataType: 'json',
            success: function(data){
                if (data.status == 1){
                    //CKEDITOR.instances.description.setData(data.description, function () {});
                    $(".imgDisplayBx").html(data.cover_image);
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#destination").val(data.destination);
                    $("#designation").val(data.designation);
                    $("#description").val(data.description);
                    $("#status").val(data.cstatus);
                    $("#submitFrmMdl").modal("show");
                }else{
                    display_toster(data.message, 2); 
                }
            }
        });
    }


    $("body").on('submit', '#submitFrm', function (e) {
        e.preventDefault();
        var dataS = new FormData(this);
        //var description = CKEDITOR.instances.description.getData();
        dataS.append('id', id);
        //dataS.append('description', description);
        dataS.append('_token', CSRF_TOKEN);
        $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: ADMIN_HTTP_PATH + 'our-members/addnewajax',
         data: dataS,
         contentType: false,
         cache: false,
         processData:false,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
              formReset();
              display_toster(data.message, 1);
              $("#submitFrmMdl").modal("hide");
              $("#custom-ajax-tbl").DataTable().destroy();
              draw_data();
                ajaxTbl.search('').draw();
            }else if (data.status == 0){
              error_display(data.message);
            }else if(data.status == 2){
              display_toster(data.message, 2); 
            }
         }
      });
    });


    $('body').on('click', '.deleteBtn', function (e) {
        e.preventDefault();
        var _this = this;
        id = $(this).data('key');
        $('#delConfirmationMdl').modal('show');
    });

    $('body').on('click', '.delConfirmationBtn', function(e){
        $('.delConfirmationBtn').attr('disabled', 'disabled').addClass('disable-btn'); 
        $.ajax({
         type: "POST",
         url: ADMIN_HTTP_PATH + 'our-members/delete',
         data: 'id=' + id + "&_token=" + CSRF_TOKEN,
         dataType: 'json',
         success: function(data){
            error_remove();
            $('.delConfirmationBtn').removeAttr('disabled').removeClass('disable-btn');
            if (data.status == 1){
                formReset();
                display_toster(data.message, 1);
                $("#delConfirmationMdl").modal("hide");
                $("#custom-ajax-tbl").DataTable().destroy();
                draw_data();
                ajaxTbl.search('').draw();
            }else{
              error_display(data.message);
            }
         }
        });
    });


    $("body").on("click", ".open_view_description_btn", function (e) {
        e.preventDefault();
        var key = $(this).attr("data-key");
        var html = $("#open_description_box_" + key).html();
        $("#viewdescriptionMdl .modal-body").html(html);
        $("#viewdescriptionMdl").modal("show");
    });



    $("body").on("click", ".update_status", function (e) {
         e.preventDefault();
         id = $(this).data("key");
         status = $(this).data("status");
         if(status==1){
         var html = '<strong>Do you want to change status from Inactive to Active? Click Confirm to change status.</strong>';
         }
         else
          {
             var html = '<strong>Do you want to change status from Active to Inactive? Click Confirm to change status.</strong>'; 
          }
         $("#confirm_modal .modal-content-value").html(html);
         $("#confirm_modal").modal("show");
    });

    $("body").on("click", ".confirm_status", function (e) {
         e.preventDefault();
         block_form();
         $.ajax({
             type: "POST",
                 url: ADMIN_HTTP_PATH + "our-members/update_status",
                 data: "id=" + id + "&status=" + status + "&_token=" + CSRF_TOKEN,
                 dataType: "json",
                success: function(data){
                error_remove();
                if (data.status == 1){
                  formReset();
                  display_toster(data.message, 1);
                  $("#confirm_modal").modal("hide");
                $("#custom-ajax-tbl").DataTable().ajax.reload();
                }else if (data.status == 0){
                  error_display(data.message);
                }else if(data.status == 2){
                 display_toster(data.message, 2);
                }
              }
        });
    });
});