<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <!-- Include your CSS links here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Navbar, header, or any other common elements -->
    
    <div class="container">
        @yield('content')
    </div>
    
    <!-- Include your JavaScript links here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
