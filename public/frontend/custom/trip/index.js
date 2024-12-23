$(function(){



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
                url: HTTP_PATH + "my-trips/ajaxLoad",
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
                { data: 'cover_image', "orderable": false},
                { data: 'title', "orderable": true},
                { data: 'mst_programs.title', "orderable": true},
                { data: 'status', "orderable": true},
                { data: 'created_at', "orderable": true},
                { data: "action", orderable: false, searchable: false},

            ]
        });

    }



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

                 url: HTTP_PATH + "my-trips/update_status",

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