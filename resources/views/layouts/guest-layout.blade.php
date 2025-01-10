<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ env('APP_NAME') }} </title>
    @vite('resources/css/app.css')
    <script defer src="{{ asset('src/js/login.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body class="min-h-screen bg-center bg-cover" style="background-image: url('{{ asset('src/images/pylon-front.jpg') }}');">

    <div class="flex items-center justify-end min-h-screen bg-[#3F0A0A] bg-opacity-70">
        <div class=" mx-[70px]">
            @yield('guest_content')
        </div>

    </div>

</body>

</html>
