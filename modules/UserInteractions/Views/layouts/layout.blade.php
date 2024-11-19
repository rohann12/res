<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/scroll.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer1.css') }}">
    {{-- <script src="{{asset('css/tailwind.js') }}"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('/images/resilient_logo.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        body {
            font-family: 'poppins';
        }

        .custom-padding {
            padding: 10px 50px;
        }

        nav ul li a {
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
        }

        nav ul li a:hover {
            color: #f29400;
        }

        nav ul li a.active {
            color: #f29400;
        }
    </style>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/fs-elliot-pro" rel="stylesheet">

    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        li,
        span,
        div {
            font-family: 'FS Elliot Pro', sans-serif;
        }

        .appointment-section {
            background-color: #01A6DE;
        }

        .container_page {
            width: 100%;
            height: 10vh;
            background: lavenderblush;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination {
            display: flex;
            background: #fff;
            align-items: center;
            color: #383838;
            padding: 10px 40px;
            border-radius: 6px;
        }

        .project_no {
            margin: 20px 30px;
        }

        .project_no li {
            display: inline-block;
            margin: 0 5px;
            width: 38px;
            height: 31px;
            border-radius: 50% / 80%;
            text-align: center;
            font-size: 16px;
            font-weight: 500;
            line-height: 38px;
            cursor: pointer;
        }

        .project_no li.active {
            background-color: #f29400;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body>
    @include('UserInteractions::layouts.navbar')
    <main>
        @yield('content') <!-- This is where the page-specific content will go -->
    </main>
    </div>

    @include('UserInteractions::layouts.footer')


</body>

</html>
