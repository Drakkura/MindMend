<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Doctor Login</title>
    <style>
        .container {
            max-width: 600px;
            margin: auto;
            padding: 2rem;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-body {
            text-align: left;
        }
        .label-td {
            padding: 1rem 0;
        }
        .errors {
            color: red;
        }
    </style>
</head>
<body>
<center>
    <div class="container">
        <h2 class="header-text">Welcome Back!</h2>
        <p class="sub-text">Login with your details to continue</p>
        <p>Are you a patient? <a href="{{ route('patient.login') }}">Login as Patient</a></p>
        <form action="{{ route('doctor.login') }}" method="POST">
            @csrf
            <div class="form-body">
                <div class="label-td">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="input-text" placeholder="Email Address" required>
                </div>
                <div class="label-td">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="input-text" placeholder="Password" required>
                </div>
                <div class="label-td">
                    @if($errors->any())
                        <div class="errors">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="label-td">
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </div>
                <div class="label-td">
                    <br>
                    <label class="sub-text">Don't have an account? </label>
                    <a href="{{ route('signup') }}" class="hover-link1 non-style-link">Sign Up</a>
                </div>
            </div>
        </form>
    </div>
</center>
</body>
</html>
