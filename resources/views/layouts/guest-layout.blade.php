<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ env('APP_NAME') }} </title>
    @vite('resources/css/app.css')
    <script src="{{ asset('src/js/iziToast.min.js') }}"></script> {{-- toast notification js --}}
    <script defer src="{{ asset('src/js/login.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel ="stylesheet" href="{{ asset('src/css/iziToast.min.css') }}" /> {{-- toast notification css --}}
</head>

<body class="min-h-screen bg-center bg-cover" style="background-image: url('{{ asset('src/images/pylon-front.jpg') }}');">

    {{-- check if the route is not login.show if so it will change some tailwind classes --}}
    <div class="flex {{ Route::currentRouteName() == 'login.show' ? 'items-center justify-end' : 'flex-col items-center justify-center' }} min-h-screen bg-[#3F0A0A] bg-opacity-70">
        <div class="mx-[70px]">
            @yield('guest_content')
        </div>
    </div>

    {{-- toast notification --}}
    @if ($errors->any())

    @foreach ($errors->all() as $error)

    <script>
        iziToast.show({
            title: '',
            message: '{{ $error }}',
            position: 'topRight',
            timeout: 5000,
        });
    </script>

    @endforeach

    @endif

    @if (session()->get('status'))
        <script>
            iziToast.success({
                title: '',
                message: '{{ session()->get('status') }}',
                position: 'topRight',
                timeout: 5000,
            });
        </script>
    @endif

</body>

</html>