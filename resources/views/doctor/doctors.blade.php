<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang halaman */
        }

        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .anim {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .navbar-custom {
            background-color: #161c2d; /* Sama seperti .container-color */
            color: white;
        }
        .header-search {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .header-searchbar {
            width: 500px;
            padding: 5px;
            font-size: 14px;
            background-color: #343a40; /* Warna latar belakang search bar */
            color: black; /* Warna teks pada search bar */
            border: none;
            border-radius: 5px;
        }

        .header-searchbar::placeholder {
            color: rgba(255, 255, 255, 0.5); /* Warna placeholder */
        }

        .login-btn {
            padding: 10px 20px;
            font-size: 14px;
        }

        .table-session {
            width: 100%;
            overflow: auto;
            margin: 0;
        }

        .sub-table thead th {
            border-bottom: 2px solid #465060;
            padding: 10px;
        }

        .sub-table {
            border: 0px solid #161c2d;
            border-radius: 8px;
            margin: 0;
        }
    </style>
</head>

<body>    <!-- Navbar -->
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
                    <a class="nav-link active" href="{{ route('doctor.doctors') }}">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.schedule') }}">Sessions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('doctor.appointment') }}">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.settings') }}">Settings</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="profile-title mr-4"><h1">{{ $user->pname }}</h1></span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="btn btn-primary">Log out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="dash-body">
        <table border="0" width="100%" style="border-spacing: 0;margin: 0;padding: 0;margin-top: 25px;">
            <tr>
                <td>
                <form action="{{ route('doctor.searchDoctor') }}" method="GET" class="header-search" style="margin-top: 20px;">
                    @csrf
                    <input type="Search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;
                    <datalist id="doctors">
                        @foreach ($list as $item)
                            <option value="{{ $item->docname }}"></option>
                            <option value="{{ $item->docemail }}"></option>
                        @endforeach
                    </datalist>
                    <input type="Submit" value="Search" class="login-btn btn-primary btn anim" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                </form>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <center>
                        <div class="table-session scroll">
                            <table width="95%" class="sub-table scrolldown" border="0" style="background-color: #161c2d;">
                                @if ($hasSearchResults)
                                <thead>
                                    <tr>
                                        <th class="table-headin" style="color: #BACAE1;">Doctor Name</th>
                                        <th class="table-headin" style="color: #BACAE1;">Email</th>
                                        <th class="table-headin" style="color: #BACAE1;">Specialties</th>
                                        <th class="table-headin" style="color: #BACAE1;">Events</th>
                                    </tr>
                                </thead>
                                @endif
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                    <tr>
                                        <td style="color: white; text-align: center">{{ $doctor->docname }}</td>
                                        <td style="color: white; text-align: center">{{ $doctor->docemail }}</td>
                                        <td style="color: white; text-align: center">{{ $doctor->specialties }}</td>
                                        <td>
                                            <div style="display: flex; justify-content: center;">
                                                <button class="btn btn-primary button-icon btn-view" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;" data-toggle="modal" data-target="#doctorModal{{ $doctor->docid }}">
                                                    View Details
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($doctors as $doctor)
                                    <div class="modal fade" id="doctorModal{{ $doctor->docid }}" tabindex="-1" aria-labelledby="doctorModalLabel{{ $doctor->docid }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Konten modal -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="doctorModalLabel{{ $doctor->docid }}">View Details</h5>
                                                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Informasi dokter -->
                                                    <h3>MindMend Web App</h3>
                                                    <p><strong>View Details.</strong></p>
                                                    <p>
                                                        <strong>Name:</strong> {{ $doctor->docname }}
                                                        <br>
                                                        <strong>Email:</strong> {{ $doctor->docemail }}
                                                        <br>
                                                        <strong>Phone Number:</strong> {{ $doctor->doctel }}
                                                        <br>
                                                        <strong>Specialties:</strong> {{ $doctor->specialties }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
    
