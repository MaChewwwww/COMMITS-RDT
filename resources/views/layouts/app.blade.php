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

        <!-- Notification Messages -->
        @if (session('success'))
            <div id="session-alert" class="p-4 mb-4 text-green-800 bg-green-200 rounded-lg" style="transition: opacity 0.5s;">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div id="session-alert" class="p-4 mb-4 text-red-800 bg-red-200 rounded-lg" style="transition: opacity 0.5s;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>

    <!-- Add this script to hide the alert after 5 seconds -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('session-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    // Optionally, remove the element from the DOM after the fade-out
                    setTimeout(() => { alert.remove(); }, 500); // 500ms matches the CSS transition duration
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        });
    </script>
</body>
</html>