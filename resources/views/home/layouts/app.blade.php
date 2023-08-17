<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">

</head>

<body>
    <div class="wrapper">
        {{-- nav  --}}
        @include('home.pages.index')

        <!-- @yield('content') -->

        {{-- footer --}}
        <!-- @include('inc.footer') -->


        <script src="{{ asset('home/js/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('home/js/jquery-3.6.0.min.js') }}"></script>

    </div>
</body>

</html>