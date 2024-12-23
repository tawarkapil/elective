$().ready(function(){
    $('#custom-ajax-tbl').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        lengthChange : false,
        searching: true,
        bInfo : false,

        language: {
            'paginate': {
              'previous': '<i class="fa fa-angle-left" aria-hidden="true"></i>',
              'next': '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            }
        },
        ajax: HTTP_PATH + "notifications/ajaxLoad",
        order : [[ 2, "desc" ]],
        columns: [
            { data: 'DT_RowIndex', "orderable": false, "searchable": false},
            //{ data: 'heading', "orderable": true , "searchable": true},
            { data: 'notification', "orderable": true , "searchable": true},
            { data: 'created_at', 'orderable': true, "searchable": false},
        ],
        columnDefs: [
            { "width": "125px", "targets": 2}
        ]
    });
});