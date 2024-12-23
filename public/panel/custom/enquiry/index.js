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
            // "scrollX": true,
            ajax: {
                url: ADMIN_HTTP_PATH + "enquiry/ajax_list",
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
                [4, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', "orderable": false},
                { data: 'name', "orderable": true},
                { data: 'phone_number', "orderable": true},
                // { data: 'email', "orderable": true},
                { data: 'subject', "orderable": true},
                { data: 'created_at', "orderable": true},
                { data: 'action', "orderable": false},
            ],
            columnDefs: [{
                "width": "84px",
                "targets": 5
            }]
        });
    }

    $("body").on("click", ".open_view_content_btn", function (e) {
        e.preventDefault();
        var key = $(this).attr("data-key");
        var html = $("#open_content_box_" + key).html();
        $("#viewContentMdl .modal-body").html(html);
        $("#viewContentMdl").modal("show");
    });
});