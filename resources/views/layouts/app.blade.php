<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add CSS files or links to stylesheets here -->
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <!-- Navbar -->

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>

</body>
</html>