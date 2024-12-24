$(function(){
    let ccNumberInput = document.querySelector(".cc-number-input"),
    ccNumberPattern = /^\d{0,16}$/g,
    ccNumberSeparator = " ",
    ccNumberInputOldValue,
    ccNumberInputOldCursor,
    ccExpiryInput = document.querySelector(".cc-expiry-input"),
    ccExpiryPattern = /^\d{0,4}$/g,
    ccExpirySeparator = "/",
    ccExpiryInputOldValue,
    ccExpiryInputOldCursor,
    ccCVCInput = document.querySelector(".cc-cvc-input"),
    ccCVCPattern = /^\d{0,3}$/g,
    mask = (value, limit, separator) => {
        var output = [];
        for (let i = 0; i < value.length; i++) {
            if (i !== 0 && i % limit === 0) {
                output.push(separator);
            }

            output.push(value[i]);
        }

        return output.join("");
    },
    unmask = (value) => value.replace(/[^\d]/g, ""),
    checkSeparator = (position, interval) => Math.floor(position / (interval + 1)),
    ccNumberInputKeyDownHandler = (e) => {
        let el = e.target;
        ccNumberInputOldValue = el.value;
        ccNumberInputOldCursor = el.selectionEnd;
    },
    ccNumberInputInputHandler = (e) => {
        let el = e.target,
            newValue = unmask(el.value),
            newCursorPosition;

        if (newValue.match(ccNumberPattern)) {
            newValue = mask(newValue, 4, ccNumberSeparator);

            newCursorPosition =
                ccNumberInputOldCursor -
                checkSeparator(ccNumberInputOldCursor, 4) +
                checkSeparator(
                    ccNumberInputOldCursor + (newValue.length - ccNumberInputOldValue.length),
                    4
                ) +
                (unmask(newValue).length - unmask(ccNumberInputOldValue).length);

            el.value = newValue !== "" ? newValue : "";
        } else {
            el.value = ccNumberInputOldValue;
            newCursorPosition = ccNumberInputOldCursor;
        }
        el.setSelectionRange(newCursorPosition, newCursorPosition);
    },

    ccExpiryInputKeyDownHandler = (e) => {
        let el = e.target;
        ccExpiryInputOldValue = el.value;
        ccExpiryInputOldCursor = el.selectionEnd;
    },
    ccExpiryInputInputHandler = (e) => {
        let el = e.target,
            newValue = el.value;

        newValue = unmask(newValue);
        if (newValue.match(ccExpiryPattern)) {
            newValue = mask(newValue, 2, ccExpirySeparator);
            el.value = newValue;
        } else {
            el.value = ccExpiryInputOldValue;
        }
    };

    ccNumberInput.addEventListener("keydown", ccNumberInputKeyDownHandler);
    ccNumberInput.addEventListener("input", ccNumberInputInputHandler);

    ccExpiryInput.addEventListener("keydown", ccExpiryInputKeyDownHandler);
    ccExpiryInput.addEventListener("input", ccExpiryInputInputHandler);



    $('.full-name').attr({maxlength : 30});

    $('body').on('submit', '#stripeSubmitFrm', function (e) {
        
        var valid = true;
        $('.card-inp').each(function(){
            var val = $(this).val();
            if ($(this).val() == '') {
                valid = false;
            }
        });

        var expirydate = $('.cc-expiry-input').val();
        var expirydateArr = expirydate.split('/');

        var expiry_month = expirydateArr[0];
        var expiry_year = expirydateArr[1];

        if(expiry_month == undefined || expiry_year == undefined){
            valid = false;
        }

        if (!valid) {
            //error_remove();
            alert('Please enter valid information', 2);
            e.preventDefault(); // cancel on first error
            return false;
        }


        e.preventDefault();
        
        var $form = $("#stripeSubmitFrm");
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
            name : $('.full-name').val(),
            number: $('.cc-number-input').val(),
            cvc: $('.cc-cvc-input').val(),
            exp_month: expiry_month,
            exp_year: expiry_year
        }, stripeResponseHandler);
    });

    function stripeResponseHandler(status, response) {
        console.log('aaaa');
        var $form = $("#stripeSubmitFrm");

        if (response.error) {
            //error_remove();
            alert(response.error.message, 2);
            return false;
        } 
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        
        var dataS = $($form).serialize();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + 'application/stripepayment',
            data: dataS + '&stripeToken=' + token+ '&_token=' + CSRF_TOKEN,
            success: function (data) {
                var data = JSON.parse(data);
                //error_remove();
                if (data.status == 1) {
                    formReset();
                    window.location.href = data.redirect_url;
                } else if (data.status == 0) {
                    error_display(data.message);
                } else if (data.status == 2) {
                    alert(data.message, 2);
                }
            }
        });
    }

});