<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DdO QR</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free-5.14.0/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pageLoader.css') }}" rel="stylesheet">
    
    
</head>

<body style="background-image: radial-gradient(#fff3c0 , #fcd538, gold)">

    <main class="container py-5 pageloaderr" >
        @yield('content')
    </main>
    

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script src="{{ asset('js/pageLoader.js') }}"></script>

</body>
</html>
    @yield('scripts')
