$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
        }
    });

    // Edit Profile
    $('body').on('click', '#profileUpdate', function (event) {
        $("#profile_title").html("Edit Profile");
        var userId = $("#user_id").val();
        $.get("profileUpdate/" + userId, function (result) {
            $('#profileModal').modal('show');
            $("#user_id").val(result.id);
            $("#firstname").val(result.firstname);
            $("#lastname").val(result.lastname);
            $("#email").val(result.email);
        });
    });
    //Save Profile
    $('#saveProfile').click(function (e) {
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            data: $('#profileForm').serialize(),
            url: "profileUpdate/save",
            type: "PUT",
            dataType: 'json',
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    if (response.message) {
                        $('#success').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                        $('#loader').hide();
                        setTimeout(function () {
                            $('#profileModal').modal('hide');
                        }, 3000);
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

    //Sign Up form
    $('#saveSignup').click(function (e) {
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            data: $('#signupForm').serialize(),
            url: "signup/save",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    if (response.message) {
                        $('#success').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                        $('#loader').hide();
                        setTimeout(function () {
                            window.location = "/";
                        }, 3000);
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

    $('#saveSignin').click(function (e) {
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            data: $('#signinForm').serialize(),
            url: "signin/save",
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

// always moved outside ready function
function getPassword() {
    var pass = document.getElementById("password");
    var cpass = document.getElementById("conpassword");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
    if (cpass.type === "password") {
        cpass.type = "text";
    } else {
        cpass.type = "password";
    }
}