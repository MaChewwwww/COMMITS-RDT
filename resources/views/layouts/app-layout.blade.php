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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Custom styles for error modals -->
    <style>
        /* Transitions and animations */
        .transform {
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }
        
        /* Error modal with improved animations */
        #date-error-modal-container {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        /* Scale effects */
        .scale-100 {
            transform: scale(1);
        }
        
        .scale-95 {
            transform: scale(0.95);
        }
        
        .scale-102 {
            transform: scale(1.02);
        }
        
        /* Fix message animation */
        #error-fix-message {
            transition: opacity 0.5s ease;
        }
        
        /* Countdown animation */
        #error-modal-countdown {
            display: inline-block;
            min-width: 1em;
            text-align: center;
            transition: all 0.2s ease;
        }
    </style>
</head>

<body>
    <div class="antialiased bg-gray-50">

        @php
            $currentRoute = Route::currentRouteName(); // Get the current route name
        @endphp

        {{-- NAVBAR - HEADER --}}
        <x-navbar />

        {{-- SIDEBAR --}}
        {{-- to use different sidebar for profile page --}}
        @if (!in_array($currentRoute, ['profile.accountSettings', 'profile.helpAndSupport']))
            <x-sidebar />
        @endif

        <!-- Notification Messages -->
        @if (session('success'))
            <div id="session-alert" class="fixed z-50 tw-p-4 tw-mb-4 tw-text-green-800 tw-bg-green-200 tw-rounded-lg"
                style="transition: opacity 0.5s;">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div id="session-alert" class="fixed z-50 tw-p-4 tw-mb-4 tw-text-red-800 tw-bg-red-200 tw-rounded-lg"
                style="transition: opacity 0.5s;">
                {{ session('error') }}
            </div>
        @endif
        
        {{-- check if the route is profile page if not it will add margin left --}}
        <main class="h-auto p-4 pt-20 {{ in_array($currentRoute, ['profile.accountSettings', 'profile.helpAndSupport']) ? '' : 'md:ml-64' }}">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/date-validation.js') }}"></script>
    @yield('scripts')
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
