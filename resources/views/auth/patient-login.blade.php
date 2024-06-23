<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Patient Login</title>
</head>
<body>
<center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Login</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Login with your details to continue</p>
                </td>
            </tr>
            <div class="container">
            <tr>
            <form action="{{ route('patient.login') }}" method="POST">
            @csrf
            <tr>
                <td class="label-td">
                    <label for="email" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="email" class="input-text" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="password" class="form-label">Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="password" name="password" class="input-text" placeholder="Password" required>
                </td>
            </tr>

            <tr>
                <td><br>
                @if($errors->any())
                    <div class="errors">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                </td>
            </tr>

            </div>
            
            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </td>
            </tr>
            </form>
        </div>
            <tr>
            <td>
        <br>
            <label for="" class="sub-text" style="font-weight: 280; color: black;">Don't have an account&#63; </label>
            <a href="{{ route('signup') }}" class="non-style-link" style="color: black;">Sign Up</a>
            <br><br><br>
        </td>
            </tr>
                    
        </table>
    </div>
</center>
</body>
</html>