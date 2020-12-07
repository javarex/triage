<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DdO QR</title>
    <!-- Fonts -->
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet"> 
   
    <link href="{{ asset('css/pageLoader.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>
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

    <main class="container py-5">
        @yield('content')
    </main>
    

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/pageLoader.js') }}"></script>

   
    
    @yield('scripts')
</body>
</html>
