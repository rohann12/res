<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="icon" href="{{ asset('/images/resilient_logo.png') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">

    <title>Login Form</title>
    <style>
        body {
            font-family: 'poppins';
        }

        .form-container {
            background-image: url('{{asset("images/verification.png")}}');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
        }

        @media (max-width: 1028px) {
            .form-container {
                background-image: url('{{ asset('images/smallVerification.svg') }}');
                background-size: cover;
                height: 100vh;
                width: 100%;
            }
           
        }
    </style>
</head>

<body>
    <div class="form-container w-screen h-screen">

        <div>
            @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif
            @if (session()->has('error'))
            <div>{{ session('error') }}</div>
            @endif
            @if (session()->has('success'))
            <div>{{ session('success') }}</div>
            @endif
        </div>
        <div
            class="flex flex-col justify-center absolute lg:right-48 right-0 top-24 md:mt-5 mt-12 px-10
             w-full md:w-full lg:w-1/4 h-1/2  z-10">

            @yield('content')

        </div>
    </div>
</body>

</html>