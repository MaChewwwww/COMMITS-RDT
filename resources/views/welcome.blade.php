<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRMS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <!-- Your content here -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white text-lg font-bold">
                <a href="{{ url('/') }}">MyApp</a>
            </div>
            <div class="space-x-4">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-white">Home</a>
                <a href="{{ url('/about') }}" class="text-gray-300 hover:text-white">About</a>
                <a href="{{ url('/contact') }}" class="text-gray-300 hover:text-white">Contact</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
</body>
</html>