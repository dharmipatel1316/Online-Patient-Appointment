<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Doctor | Sign In</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="https://use.fontawesome.com/6587b05c56.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                        </div>
                        <form id="signinForm">
                            <div class="modal-body">
                                <input type="hidden" name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
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
                                <img style="display:none;" src="{{ asset('resources/images/loader.gif') }}" id="loader" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="saveSignin" class="btn btn-info">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('resources/ajax/doctorportalajax.js') }}"> </script>
</body>
</html>