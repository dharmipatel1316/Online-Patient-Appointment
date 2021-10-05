<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            font-family: 'Source Sans Pro', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="content">
            <div class="row ">
                <nav class="navbar navbar-expand-lg navbar-light bg-info">
                    <a class="navbar-brand text-white">Appointment Management System</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-flex flex-row-reverse" style="flex:3" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    {{ Session::get("firstname")." ".Session::get("lastname") }}
                                </a>
                                <div class="dropdown-menu">
                                    <a style="cursor:pointer;" class="dropdown-item" id="profileUpdate" class="">Edit Profile</a>
                                    <a class="dropdown-item" href="signout">Change Password</a>
                                    <a class="dropdown-item" href="signout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="col-sm-12 col-md-4 col-lg-2 sidenav bg-light d-flex flex-column">
                    <h4 class="text-center pt-2">Admin</h4>
                    <ul class="navbar-nav p-3">
                        <li class="nav-item"><a class="nav-link text-info" href="dashboard"><i class="fa fa-dashboard pr-1"></i> Dashboard</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-info" href="doctor"><i class="fa fa-user-md pr-1"></i> Doctor</a></li>
                        <li class="nav-item"><a class="nav-link text-info" href="speciality"><i class="fa fa-dashboard pr-1"></i> Speciality</a></li>
                        <li class="nav-item"><a class="nav-link text-info" href="patient"><i class="fa fa-wheelchair pr-1"></i> Patient</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-info" href="doctorSchedule"><i class="fa fa-hourglass-half"></i> Doctor Schedule</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-info" href=""><i class="fa fa-calendar pr-1"></i> Appointment</a>
                        </li>
                    </ul>
                </div>