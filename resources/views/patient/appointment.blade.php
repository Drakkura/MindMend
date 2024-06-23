<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <title>Dashboard</title>
    <style>
        
        .popup { animation: transitionIn-Y-bottom 0.5s; }
        .sub-table { animation: transitionIn-Y-bottom 0.5s; }
        .filter-container { animation: transitionIn-Y-bottom 0.5s; }
        .anim { animation: transitionIn-Y-bottom 0.5s; }
        .col-md-6 { margin-top: 20px; }
        .navbar-custom { background-color: #161c2d; color: white; margin-bottom: 20px; }
        .profile-title { color: white; }
        .dash-body { padding-top: 80px; }
    </style>
</head>

<body>
    <!-- Navbar -->
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
                    <a class="nav-link" href="{{ route('patient.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient.doctors') }}">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient.schedule') }}">Sessions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('patient.appointment') }}">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient.settings') }}">Settings</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="profile-title mr-4"><h1">{{ $user->pname }}.</h1></span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="btn btn-primary">Log out</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="dash-body">
        <table border="0" width="100%" style="border-spacing: 0; margin: 0; padding: 0; margin-top: 0px;">
            <tr>
                <td colspan="4" style="padding-top: 0px; width: 100%;">
                    <center>
                        <table class="filter-container" border="0"
                            style="background-color: #161c2d; border-radius: 10px; padding: 10px; width: 1000px;">
                            <tr>
                                <td width="10%">
                                    <p class="heading-main12"
                                        style="margin-left: 45px; font-size: 18px; color: #BACAE1; text-align: center; padding-top: 15px;">
                                        Booked ({{ $appointments->count() }})</p>
                                </td>
                                <td width="5%" style="text-align: center; color: white;"></td>
                                <td width="25%">
                                    <form action="{{ route('patient.appointment') }}" method="post">
                                        @csrf
                                        <input type="date" name="scheduledate" id="date"
                                            class="input-text filter-container-items" style="margin: 0; width: 75%;">
                                </td>
                                <td width="4%" style="padding: 10px; text-align: center;">
                                    <input type="submit" name="filter" value="Filter"
                                        class="btn-primary-soft btn button-icon btn-filter"
                                        style="padding: 10px; margin: 0; width: 100%">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0" style="border: none">
                                <tbody>
                                    @if ($appointments->isEmpty())
                                        <tr>
                                            <td colspan="7">
                                                <br><br><br><br>
                                                <center>
                                                    <img src="{{ asset('assets/img/notfound.svg') }}" width="25%">
                                                    <br>
                                                    <p class="heading-main12"
                                                        style="margin-left: 45px; font-size: 20px; color: white;">We
                                                        couldn't find anything related to your keywords!</p>
                                                    <a class="non-style-link"
                                                        href="{{ route('patient.appointment') }}"><button
                                                            class="btn btn-primary"
                                                            style="display: flex; justify-content: center; align-items: center; margin-left: 20px;">&nbsp;Show
                                                            all Appointments&nbsp;</button></a>
                                                </center>
                                                <br><br><br><br>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($appointments->groupBy('appodate') as $date => $appointmentsOnDate)
                                            <tr>
                                                <td colspan="4">
                                                    <p class="heading-main12"
                                                        style="margin-left: 45px; font-size: 18px; color: #BACAE1;">Date:
                                                        {{ \Carbon\Carbon::parse($date)->format('d F, Y') }}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                @foreach ($appointmentsOnDate as $appointment)
                                                    <td class="dashboard-items search-items"
                                                        style="background-color: #161c2d;">
                                                        <div style="width: 100%;">
                                                            <div class="h3-search">
                                                                Booking Date: {{ $appointment->appodate }}<br>
                                                                Reference Number: OC-000-{{ $appointment->appoid }}
                                                            </div>
                                                            <div class="h1-search">
                                                                Appointment Number: {{ $appointment->apponum }}
                                                            </div>
                                                            <div class="h3-search">
                                                                @if ($appointment->schedule)
                                                                    Doctor: {{ $appointment->schedule->doctor->name }}
                                                                @endif
                                                            </div>
                                                            <div class="h4-search">
                                                                Scheduled Date: {{ $appointment->schedule->scheduledate }}<br>
                                                                Starts: <b>{{ $appointment->schedule->scheduletime }}</b>
                                                                (24h)
                                                            </div>
                                                            <br>
                                                            <a href="{{ route('patient.cancelAppointment', $appointment->appoid) }}">
                                                                <button class="btn btn-primary"
                                                                    style="padding-top: 11px; padding-bottom: 11px; width: 100%">
                                                                    Cancel Booking
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                @endforeach
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
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
