<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DdO QR</title>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ asset('vendor/fontawesome-free-5.14.0/css/all.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/pageLoader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet"> -->

    @yield('styles')
</head>

<body style="background-image: radial-gradient(#fff3c0 , #fcd538, gold)">
    <!-- for page loader -->
    <div class="o-page-loader">
        <div class="o-page-loader--content">
            <div class="o-page-loader--spinner"></div>
            <div class="o-page-loader--message">
                <span>Loading...</span>
            </div>
        </div>
    </div>

    @if(auth()->user())
        @if(auth()->user()->role == 0)
            @include('layouts.navbar.navbar_admin')
        @elseif(auth()->user()->role == 1)
            @include('layouts.navbar.navbar_establishment')
        @endif
    @endif

    <main class="container py-3">
        @yield('content')
    </main>
    

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('js/jquery.steps.min.js') }}"></script> -->
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script src="{{ asset('js/pageLoader.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script> -->
    
    @yield('scripts')
</body>
</html>
