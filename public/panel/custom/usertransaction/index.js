$().ready(function () {
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
        $("#srch_plan_type").val('');
        $("#custom-ajax-tbl").DataTable().destroy();
        draw_data();
        ajaxTbl.search('').draw();
    });

    draw_data();
    function draw_data() {
        var srch_start_date = $("#srch_start_date").val();
        var srch_end_date = $("#srch_end_date").val();
        var srch_plan_type = $("#srch_plan_type").val();
        ajaxTbl = $('#custom-ajax-tbl').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,      
            responsive: true,                  
            ajax: {
                url: ADMIN_HTTP_PATH + "user-transaction/ajax_list",
                type: "POST",
                data: {
                    srch_start_date: srch_start_date,
                    srch_end_date: srch_end_date,
                    srch_plan_type: srch_plan_type,
                    _token: CSRF_TOKEN,
                },
            },
            "drawCallback": function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            order: [
                [8, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', "orderable": false},
                { data: 'customers.first_name', "orderable": true},
                { data: 'customers.email', "orderable": true},
                { data: 'membership_plans.plan_title', "orderable": true},
                { data: 'txn_id', "orderable": true},
                { data: 'amount', "orderable": true},
                { data: 'payment_mode', "orderable": false},
                { data: 'status', "orderable": true},
                { data: 'created_at', "orderable": true},
                { data: "action", orderable: false, searchable: false},
            ],
            columnDefs: [{
                "width": "84px",
                "targets": 9
            }]
        });
    }
});