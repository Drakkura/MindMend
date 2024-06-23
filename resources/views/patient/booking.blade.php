<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Booking Page</title>
    <style>
        /* Sesuaikan dengan kebutuhan styling Anda */
    </style>
</head>
<body>
    <div class="container">
        <div class="menu sb-color">
        <div style="padding-top: 31px; text-align: center;">
            <p style="color: white; font-weight: bold; font-size: 36px; margin-bottom: 40px; margin-top: 0px;">
                <span style="color: white; margin-right: -4px;">MIND</span>
                <span style="color: #007bff; margin-left: -4px;">MEND</span>
            </p>
        </div>
    <table class="menu-container" style="margin-top: 0px;" border="0">
        <tr>
            <td style="padding:0px" colspan="2">
                <table border="0" class="profile-container">
                    <tr>
                        <td width="30%" style="padding-left:20px">
                            <img src="{{ asset('assets/img/user.png') }}" alt="User Image" width="100%" style="border-radius:50%">
                        </td>
                        <td style="padding:0px;margin:0px;">
                            <p class="profile-title">{{ Str::limit($user->pname, 13) }}</p>
                            <p class="profile-subtitle">{{ Str::limit($user->pemail, 22) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-bottom: 30px;">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Sidebar Menu Items -->
        <tr class="menu-row">
            <td class="menu-btn menu-icon-home pt-4">
                <a href="{{ route('patient.index') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Home</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor pt-4">
                <a href="{{ route('patient.doctors') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Appointed Doctors</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-session pt-4">
                <a href="{{ route('patient.schedule') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Scheduled Sessions</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment" style="padding-top: 25px;">
                <a href="{{ route('appointment.index') }}" class="non-style-link-menu">
                    <div><p class="menu-text">My Bookings</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-settings pt-4">
                <a href="{{ route('settings.index') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Settings</p></div>
                </a>
            </td>
        </tr>
    </table>
</div>
        </div>
        
        <div class="dash-body">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;margin-top:25px;">
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49);font-weight:400;">
                            Session Details
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <div class="dashboard-items search-items">
                            <div style="width:100%">
                                <div class="h1-search" style="font-size:25px;">Doctor Details</div><br><br>
                                <div class="h3-search" style="font-size:18px;line-height:30px">
                                    Doctor name:  &nbsp;&nbsp;<b>{{ $schedule->doctor->docname }}</b><br>
                                    Doctor Email:  &nbsp;&nbsp;<b>{{ $schedule->doctor->docemail }}</b>
                                </div>
                                <div class="h3-search" style="font-size:18px;"></div><br>
                                <div class="h3-search" style="font-size:18px;">
                                    Session Title: {{ $schedule->title }}<br>
                                    Session Scheduled Date: {{ $schedule->scheduledate }}<br>
                                    Session Starts : {{ $schedule->scheduletime }}<br>
                                    Costs : <b>IDR 200.000</b>
                                </div>
                                <br>
                            </div>
                        </div>
                    </td>
                    <td style="width: 25%;">
                        <div class="dashboard-items search-items">
                            <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                                <div class="h1-search" style="font-size:20px;line-height: 35px;margin-left:8px;text-align:center;">
                                    Your Appointment Number
                                </div>
                                <center>
                                    <div class="dashboard-icons" style="margin-left: 0px;width:90%;font-size:70px;font-weight:800;text-align:center;color:var(--btnnictext);background-color: var(--btnice)">
                                        {{ $appointmentNumber }}
                                    </div>
                                </center>
                                <br>
                                <br>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('patient.complete.booking') }}" method="post">
                            @csrf
                            <input type="hidden" name="scheduleid" value="{{ $schedule->id }}">
                            <input type="hidden" name="apponum" value="{{ $appointmentNumber }}">
                            <input type="hidden" name="date" value="{{ $today }}">
                            <input type="submit" class="login-btn btn-primary btn btn-book" style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:95%;text-align: center;" value="Book now" name="booknow">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
