<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Add Schedule</title>
    <style>
        .navbar-custom {
            background-color: #161c2d;
            color: white;
        }

        .dash-body {
            margin-top: 70px;
        }

        .container-h1 {
            width: 85%;
            border: 1px solid #ebebeb;
            border-radius: 8px;
            margin: 20px auto 0;
            padding: 10px;
            background-color: #f8f9fa;
        }
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
                    <a class="nav-link" href="{{ route('doctor.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.doctors') }}">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('doctor.schedule') }}">Sessions</a>
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
                    <!--<span class="profile-title mr-4"></span>-->
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="btn btn-primary">Log out</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Body Content -->
    <div class="dash-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="appointment.blade.php" method="post">
                        <div class="form-group">
                            <label for="title">Schedule Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="scheduledate">Scheduled Date:</label>
                            <input type="date" class="form-control" id="scheduledate" name="scheduledate" required>
                        </div>
                        <div class="form-group">
                            <label for="scheduletime">Scheduled Time:</label>
                            <input type="time" class="form-control" id="scheduletime" name="scheduletime" required>
                        </div>
                        <div class="form-group">
                            <label for="nop">Max Number of Patients:</label>
                            <input type="number" class="form-control" id="nop" name="nop" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript and Bootstrap Bundle -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

