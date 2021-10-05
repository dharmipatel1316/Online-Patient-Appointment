$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
        }
    });
    
    // Signin doctor
    $('#saveSignin').click(function (e) {
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            data: $('#signinForm').serialize(),
            url: "doctorportal/signin",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    if (response.message) {
                        $('#success').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                        $('#loader').hide();
                        setTimeout(function () {
                            window.location = "dashboard";
                        }, 2000);
                    } else {
                        $('#success').html('<div class="alert alert-danger" role="alert">' + response.wrong + '</div>');
                    }
                } else {
                    $.each(response.error, function (key, value) {
                        $('.' + key + '_error').text(value);
                        $('#' + key).css("border", "1px solid red");
                    });
                }
            },
        });
    });
});

})