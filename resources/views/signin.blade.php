<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Signin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .demo-content {
            padding: 25px;
            font-size: 18px;
            background: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row bg-info">
            <div class="col-sm-6 mx-auto">
                <div class="demo-content">
                    <div class="box">
                        <div class="modal-header">
                            <h3 class="modal-title">Sign In</h3>
                            <h6><a href="signup">Sign <small>Up</a></small></h6>
                        </div>
                        <form id="signinForm">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" onclick="getPassword()" class="form-check-input">
                                </div>
                                <div id="success"></div>
                            </div>
                            <div class="modal-footer">
                                <img style="display:none;" src="{{ asset('asset/images/loader.gif') }}" id="loader" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="saveSignin" class="btn btn-info">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://use.fontawesome.com/6587b05c56.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
   
    <script src="{{ asset('asset/ajax/signinajax.js') }}"> </script>
   
</body>
</html>