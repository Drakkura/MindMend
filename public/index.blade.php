<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
<title>MindMend</title>
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    .full-height {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .header {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        position: absolute;
        top: 0;
    }
    .header-links {
        display: flex;
        gap: 20px;
    }
    table {
        animation: transitionIn-Y-bottom 0.5s;
    }
</style>
</head>
<body>
<div class="full-height">
    <div class="header">
        <div class="edoc-logo">MindMend</div>
        <div class="header-links">
            <a href="{{ route('patient.login') }}" class="non-style-link"><p class="nav-item">LOGIN</p></a>
            <a href="{{ route('signup') }}" class="non-style-link"><p class="nav-item" style="padding-right: 10px;">REGISTER</p></a>
        </div>
    </div>
    <center>
        <table border="0">
            <tr>
                <td colspan="3">
                    <p class="heading-text">Minimize Inconveniences & Wait Times.</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p class="sub-text2">Feeling under the weather today? No need to fret!<br>
                        Take advantage of our instant appointment service for psychologists and psychiatrists at MindMend. <br>
                        Whether you're seeking a therapist or a mental health specialist, book your session conveniently online. 
                        <br>Best of all, our service is free of charge. Schedule your appointment now.</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <center>
                        <a href="{{ route('patient.login') }}">
                            <input type="button" value="Make Appointment" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </a>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
        </table>
        <p class="sub-text2 footer-hashen">Presented by Kelompok 4.</p>
    </center>
</div>
</body>
</html>
