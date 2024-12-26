$(function () {
    $("body").on('submit', '#quickContactFrm', function (e) {
        e.preventDefault();
        var dataS = $(this).serialize();
        $('button[type=submit]').attr('disabled', 'disabled').addClass('disable-btn');
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'quickContactFrm',
            data: dataS + '&customer_id=' + customer_id + "&_token=" + CSRF_TOKEN,
            dataType: 'json',
            success: function (data) {
                error_remove();
                $('button[type=submit]').removeAttr('disabled').removeClass('disable-btn');
                if (data.status == 1) {
                    $('#subject').val('');
                    $('#message').val('');
                    display_toster(data.message, 1);
                } else if (data.status == 0) {
                    error_display(data.message);
                } else if (data.status == 2) {
                    display_toster(data.message, 2);
                }
            }
        });
    });
    
});