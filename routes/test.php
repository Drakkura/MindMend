<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/signup.css') }}">
    <title>Sign Up</title>
</head>
<body>
<center>
<div class="container">
    <table border="0">
        <tr>
            <td colspan="2">
                <p class="header-text">Let's Get Started</p>
                <p class="sub-text">Add Your Personal Details to Continue</p>
            </td>
        </tr>
        <tr>
            <form method="POST" action="{{ route('signup') }}" >
            @csrf
            <td class="label-td" colspan="2">
                <label for="name" class="form-label">Name: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td">
                <input type="text" name="fname" class="input-text" placeholder="First Name" required>
            </td>
            <td class="label-td">
                <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="address" class="form-label">Address: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="text" name="address" class="input-text" placeholder="Address" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="dob" class="form-label">Date of Birth: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="date" name="dob" class="input-text" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="email" class="form-label">Email: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="email" name="email" class="input-text" placeholder="Email" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="password" class="form-label">Password: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="password" name="password" class="input-text" placeholder="Password" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="tel" class="form-label">Phone Number: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="tel" name="tel" class="input-text" placeholder="Phone Number" required>
            </td>
        </tr>
        <tr>
            <td>
                <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
            </td>
            <td>
                <input type="submit" value="Next" class="login-btn btn-primary btn">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
                <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                <a href="{{ route('login') }}" class="hover-link1 non-style-link" style="color: black;">Login</a>
                <br><br><br>
            </td>
        </tr>
            </form>
        </tr>
    </table>
</div>
</center>
</body>
</html>
