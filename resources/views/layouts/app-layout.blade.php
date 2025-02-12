<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('src/css/styles.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="antialiased bg-gray-50">

        {{-- NAVBAR - HEADER --}}
        <x-navbar />

        {{-- SIDEBAR --}}
        <x-sidebar />

        <!-- Notification Messages -->
        @if (session('success'))
            <div id="session-alert" class="tw-p-4 tw-mb-4 tw-text-green-800 tw-bg-green-200 tw-rounded-lg"
                style="transition: opacity 0.5s;">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div id="session-alert" class="tw-p-4 tw-mb-4 tw-text-red-800 tw-bg-red-200 tw-rounded-lg"
                style="transition: opacity 0.5s;">
                {{ session('error') }}
            </div>
        @endif

        <main class="p-4 md:ml-64 h-auto pt-20">
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
                    setTimeout(() => {
                        alert.remove();
                    }, 500); // 500ms matches the CSS transition duration
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        });
    </script>
</body>

</html>
