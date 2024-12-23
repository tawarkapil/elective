$().ready(function () {

      var user_id = "";
      var status = "";
      var datetime1;




      if(noRequireAction){
        var columnsDef = [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "first_name", orderable: true },
            { data: "email", orderable: true },
            { data: "created_at", orderable: true },
            { data: 'roles.role_title', "orderable": true },

        ];

      }else{

        var columnsDef = [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "first_name", orderable: true },
            { data: "email", orderable: true },
            { data: "created_at", orderable: true },
            { data: 'roles.role_title', "orderable": true },
            { data: "action", orderable: false, searchable: false },
        ];

      }
        
        var ajaxTbl;
        draw_data();

        function draw_data() {
           var srch_role = $("#srch_role").val();
           var srch_start_date = $("#srch_start_date").val();
           var srch_end_date = $("#srch_end_date").val();
            ajaxTbl = $(".ajax-custom-tbl").DataTable({
                processing: true,
                serverSide: true,

                "drawCallback": function(settings) {
                      feather.replace();
                      $('[data-toggle="tooltip"]').tooltip();
                },

                ajax: {
                    url: ADMIN_HTTP_PATH + "users/ajaxUserTable",
                    type: "POST",

                    data: {
                        srch_start_date: srch_start_date,
                        srch_end_date: srch_end_date,
                        srch_role: srch_role,
                        _token: CSRF_TOKEN,
                    },
                },
                order: [[3, "desc"]],
                columns: columnsDef,

                columnDefs: [
                    { "width": "84px", "targets": 4 }
                ]
            });
        }

        $('#srch_start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy', 
        });

        $('#srch_end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy', 
        });


        $("body").on("click", ".searchBtn", function (e) {
               e.preventDefault();   
               $(".ajax-custom-tbl").DataTable().destroy();
               draw_data();
            });

            $("body").on("click", ".resetBtn", function (e) {
               e.preventDefault();
               $("#srch_role").val('');
               $("#srch_start_date").val('');
               $("#srch_end_date").val('');
               $(".ajax-custom-tbl").DataTable().destroy();
               draw_data();
               ajaxTbl.search('').draw();
            });
      
       

        $("body").on("click", ".update_status", function (e) {
             e.preventDefault();
             user_id = $(this).data("key");
             status = $(this).data("status");
             if(status==1){
             var html = 'Do you want to change user status from Inactive to Active? Click Confirm to change status.';
             }
             else
              {
                 var html = 'Do you want to change user status from Active to Inactive? Click Confirm to change status.'; 
              }
             $("#confirm_modal .modal-content-value").html(html);
             $("#confirm_modal").modal("show");
        });

        $("body").on("click", ".confirm_status", function (e) {
             e.preventDefault();
             console.log(user_id);
             block_form();
             $.ajax({
                 type: "POST",
                     url: ADMIN_HTTP_PATH + "users/update_status",
                     data: "user_id=" + user_id + "&status=" + status + "&_token=" + CSRF_TOKEN,
                     dataType: "json",
                    success: function(data){
                    error_remove();
                    if (data.status == 1){
                      formReset();
                      display_toster(data.message, 1);
                      $("#confirm_modal").modal("hide");
                    $('.ajax-custom-tbl').DataTable().ajax.reload();
                    }else if (data.status == 0){
                      error_display(data.message);
                    }else if(data.status == 2){
                     display_toster(data.message, 2);
                    }
                  }
            });
        });
});

