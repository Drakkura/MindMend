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
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}"> <!-- Rename this file to navbar.css as planned -->
    <title>Edit User Details</title>
    <style>

        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .navbar-custom {
            background-color: #161c2d; /* Sama seperti .container-color */
            color: white;
        }
        .add-new-form {
            width: 50%;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
    </style>
</head>
<body>
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
                    <a class="nav-link" href="{{ route('patient.appointment') }}">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('patient.settings') }}">Settings</a>
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
    
    <br><br><br><br>
    <div class="container-fluid">
        <div class="add-new-form">
            <h2>Edit User Account Details</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('patient.edit-user') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="pemail">Email:</label>
                    <input type="email" name="pemail" class="form-control" value="{{ $user->pemail }}" required>
                </div>
                <div class="form-group">
                    <label for="pname">Name:</label>
                    <input type="text" name="pname" class="form-control" value="{{ $user->pname }}" required>
                </div>
                <div class="form-group">
                    <label for="ptel">Phone Number:</label>
                    <input type="tel" name="ptel" class="form-control" value="{{ $user->ptel }}" required>
                </div>
                <div class="form-group">
                    <label for="paddress">Address:</label>
                    <input type="text" name="paddress" class="form-control" value="{{ $user->paddress }}" required>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <input type="reset" value="Reset" class="btn btn-secondary">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">
        Delete Account
    </button>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                    <form id="deleteAccountForm" method="POST">
                        @csrf
                        <label for="currentPassword">Enter Your Current Password:</label>
                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete My Account</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
