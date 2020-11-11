<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free-5.14.0/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    
    
</head>

<style>
    .loader-wrapper {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-color: #242f3f;
    display:flex;
    justify-content: center;
    align-items: center;
    }
    .loader {
    display: inline-block;
    width: 30px;
    height: 30px;
    position: relative;                      
    border: 4px solid #Fff;
    animation: loader 2s infinite ease;
    }
    .loader-inner {
    vertical-align: top;
    display: inline-block;
    width: 100%;
    background-color: #fff;
    animation: loader-inner 2s infinite ease-in;
    }
    @keyframes loader {
    0% { transform: rotate(0deg);}
    25% { transform: rotate(180deg);}
    50% { transform: rotate(180deg);}
    75% { transform: rotate(360deg);}
    100% { transform: rotate(360deg);}
    }
    @keyframes loader-inner {
    0% { height: 0%;}
    25% { height: 0%;}
    50% { height: 100%;}
    75% { height: 100%;}
    100% { height: 0%;}
    }
    body {
    background-image: url("/images/img.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<body style="background-color: #ecf527">
    <main class="container py-5" >
        @yield('content')
        <div class="loader-wrapper">
            <span class="loader"><span class="loader-inner"></span></span>
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

</body>
</html>
<script>
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });
</script>
    @yield('scripts')
