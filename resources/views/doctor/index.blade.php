<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Your custom CSS files -->
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}"> <!-- Rename this file to navbar.css as planned -->
    <title>Dashboard</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .dash-body {
            margin-top: 70px; /* Adjust the margin-top value as needed */
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.2s;
        }

        .dashbord-tables,
        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .col-md-6 {
            margin-top: 20px;
        }

        .navbar-custom {
            background-color: #161c2d;
            color: white;
        }

        .profile-title {
            color: white;
        }

        .container-h1 {
            width: 85%;
            border: 1px solid #ebebeb;
            border-radius: 0;
            margin: 0;
            border-spacing: 0;
            padding: 0;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border: 2px solid #161c2d;
            animation: transitionIn-Y-bottom 0.2s;
        }

        .text-center {
            text-align: center;
        }

        .table-session {
            width: 100%;
            height: 100%;
            overflow: auto;
            margin: 0;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }

        .sub-table thead th {
            border-bottom: 2px solid #465060;
            padding: 10px;
        }

        .sub-table {
            border: 0px solid #161c2d;
            border-radius: 0;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            margin: 0;
        }

        .dashboard-icons {
            background-color: #BACAE1;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 7px;
            margin-left: 40px;
            margin-right: 0px;
        }
        .btn-icon-back {
            background-image: url{{ asset('assets/img/icons/back-iceblue.svg')}};
            background-position: 18px 50%;
            background-repeat: no-repeat;
            transition: 0.5s;
            padding: 5px 30px 5px 30px;
        }

        .anim {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body style="margin: 0; padding: 70px;">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <a class="navbar-brand" href="#">
            <span style="color: white; margin-right: -4px;">MIND</span>
            <span style="color: #007bff; margin-left: -1px;">MEND</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a class="nav-link active" href="{{ route('doctor.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.doctors') }}">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.schedule') }}">Sessions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.appointment') }}">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.settings') }}">Settings</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="profile-title mr-4"><h1">{{ $user->pname }}</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="btn btn-primary">Log out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="dash-body" style="margin-top: 0px">
        <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;">
            <tr>
                <td colspan="4">
                    <table border="0" width="100%">
                        <tr>
                            <td width=" 50%">
                                <center>
                                    <table class="filter-container" style="border: none;" border="0">
                                        <tr>
                                            <td colspan="4">
                                                <p style="font-size: 20px;font-weight:bold ;padding-left: 275px; color: #4483F7;">
                                                    Status</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%;">
                                                <div class="dashboard-items" style="padding:20px;margin:auto;width:90%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                                    <div>
                                                        <div class="h1-dashboard">
                                                        {{ $totalDoctors }}
                                                        </div>
                                                        <br>
                                                        <div class="h3-daashboard" style="font-size: 18px;color: white; font-weight: normal">
                                                            All Doctors &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 25%;">
                                                <div class="dashboard-items" style="padding:20px;margin:auto;width:100%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                                    <div>
                                                        <div class="h1-dashboard">
                                                        {{ $totalPatients }}
                                                        </div><br>
                                                        <div class="h3-dashboard" style="font-size: 18px;color: white; font-weight: normal">
                                                            All Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%;">
                                                <div class="dashboard-items" style="padding:20px;margin:auto;width:90%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                                    <div>
                                                        <div class="h1-dashboard">
                                                            {{$newBookings}}
                                                        </div><br>
                                                        <div class="h3-dashboard" style="font-size: 18px;color: white; font-weight: normal">
                                                            NewBooking &nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td style="width: 25%;">
                                                <div class="dashboard-items" style="padding:20px;margin:auto;width:100%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                                    <div>
                                                        <div class="h1-dashboard">
                                                            {{$todaySessions}}
                                                        </div><br>
                                                        <div class="h3-dashboard" style="font-size: 18px;color: white; font-weight: normal">
                                                            Today Sessions
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                            <td>
                                <div class="container-h1 mx-auto text-center" style="background-color: #161c2d;">
                                    <p id="anim" style="font-size: 20px; font-weight: bold; color: #4483F7; padding-top: 15px;">
                                        Your Upcoming Sessions until Next week
                                    </p>
                                </div>
                                <center>
                                    <div class="table-session scroll" style="padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" style="background-color: #161c2d;">
                                            <thead>
                                                <tr>
                                                    <th class="table-headin" style="color: white; font-weight: normal; text-align: center; width: 33%;">
                                                        Session Title
                                                    </th>
                                                    <th class="table-headin" style="color: white; font-weight: normal; text-align: center; width: 33%;">
                                                        Scheduled Date
                                                    </th>
                                                    <th class="table-headin" style="color: white; font-weight: normal; text-align: center; width: 33%;">
                                                        Time
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
    @if ($upcomingSessions->isEmpty())
        <tr>
            <td colspan="4">
                <br><br><br><br>
                <center>
                    <br>
                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color: white">No sessions till next week</p>
                    <a class="non-style-link" href="{{ route('doctor.schedule') }}">
                        <button class="login-btn btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</button>
                    </a>
                </center>
                <br><br><br><br>
            </td>
        </tr>
    @else
        @foreach ($upcomingSessions as $session)
            <tr>
                <td style="padding:20px;"> &nbsp;{{ Str::limit($session->title, 30) }}</td>
                <td style="padding:20px;font-size:13px;">{{ $session->scheduledate->format('Y-m-d') }}</td>
                <td style="text-align:center;">{{ $session->scheduletime->format('H:i') }}</td>
            </tr>
        @endforeach
    @endif
</tbody>
                                        </table>
                                    </div>
                                </center>
                            </td>
                        </tr>
                    </table>
                </td>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

