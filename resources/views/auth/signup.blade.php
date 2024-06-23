<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/signup.css') }}">
    <title>Sign Up</title>
</head>
<body>
<center>
<div class="container">
    <table border="0">
        <!-- Header Section -->
        <tr>
            <td colspan="2">
                <p class="header-text">Let's Get Started</p>
                <p class="sub-text">Add Your Personal Details to Continue</p>
            </td>
        </tr>
        
        <!-- Form Section -->
        <form action="{{ route('signup') }}" method="POST" onsubmit="return combineNames()">
        @csrf
        <tr>
            <td class="label-td" colspan="2">
                <label for="pname" class="form-label">Name:</label>
            </td>
        </tr>
        <tr>
            <td class="label-td">
                <input type="text" id="fname" name="fname" class="input-text" placeholder="First Name" required>
            </td>
            <td class="label-td">
                <input type="text" id="lname" name="lname" class="input-text" placeholder="Last Name" required>
            </td>
        </tr>
        <!-- Hidden Field for Combined Name -->
        <input type="hidden" id="pname" name="pname">

        <!-- Address -->
        <tr>
    <td class="label-td" colspan="2">
        <label for="paddress" class="form-label">Address:</label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="text" name="paddress" class="input-text" placeholder="Address" required>
    </td>
</tr>

<!-- Date of Birth -->
<tr>
    <td class="label-td" colspan="2">
        <label for="pdob" class="form-label">Date of Birth:</label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="date" name="pdob" class="input-text" required>
    </td>
</tr>

<!-- Email -->
<tr>
    <td class="label-td" colspan="2">
        <label for="pemail" class="form-label">Email:</label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="email" name="pemail" class="input-text" placeholder="Email" required>
    </td>
</tr>

<!-- Password -->
<tr>
    <td class="label-td" colspan="2">
        <label for="ppassword" class="form-label">Password:</label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="password" name="ppassword" class="input-text" placeholder="Password" required>
    </td>
</tr>

<!-- Confirm Password -->
<tr>
    <td class="label-td" colspan="2">
        <label for="ppassword_confirmation" class="form-label">Confirm Password:</label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="password" name="ppassword_confirmation" class="input-text" placeholder="Confirm Password" required>
    </td>
</tr>

<!-- Phone Number -->
<tr>
    <td class="label-td" colspan="2">
        <label for="ptel" class="form-label">Phone Number:</label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="tel" name="ptel" class="input-text" placeholder="Phone Number" required>
    </td>
</tr>

<!-- Usertype -->
<tr>
    <td class="label-td" colspan="2">
        <label for="usertype" class="form-label">User Type:</label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <div>
            <label>
                <input type="radio" name="usertype" value="patient" required> Patient
            </label>
            <label>
                <input type="radio" name="usertype" value="doctor" required> Doctor
            </label>
        </div>
    </td>
</tr>
        <!-- Submit and Reset Buttons -->
        <tr>
            <td>
                <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
            </td>
            <td>
                <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
            </td>
        </tr>

        <!-- Error Messages -->
        @if($errors->any())
        <tr>
            <td colspan="2">
                <div class="errors">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </td>
        </tr>
        @endif

        <!-- Login Link -->
        <tr>
            <td colspan="2">
                <br>
                <label for="" class="sub-text" style="font-weight: 280;">Already have an account? </label>
                <a href="{{ route('patient.login') }}" class="hover-link1 non-style-link" style="color: black;">Login</a>
                <br><br><br>
            </td>
        </tr>
        </form>
    </table>
</div>
</center>
<<script>
    function combineNames() {
        const fname = document.getElementById('fname').value;
        const lname = document.getElementById('lname').value;
        document.getElementById('pname').value = `${fname} ${lname}`.trim();
        return true;
    }
</script>
</body>
</html>
