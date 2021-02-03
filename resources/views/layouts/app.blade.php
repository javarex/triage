<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" id="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DdO QR</title>
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/pageLoader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">

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
        @else
        
        {{--  client nav --}}
        <nav class="navbar navbar-expand-md navbar-light shadow-sm py-0" style="background-color:#442900;">
            <div class="container-fluid ml-0 p-0">
                <a class="navbar-brand" href="{{ url('/triage') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <img src="{{ asset('image/triage_g.png') }}" class="img-fluid pb-1" title="PLGU - DAVAO DE ORO"
                        width="80">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color:white;"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                style="color:#ECC633">
                                {{ $data->first_name }}<span class="caret"></span>
                            </a>


                            <div class="dropdown-menu dropdown-menu-right" id="dropdowns" aria-labelledby="navbarDropdown">
                                <a class="dropdown-toggle dropdown-item" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                    <i class="fa fa-wrench" aria-hidden="true"></i>
                                    Account Setting
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left " style="width:100%" role="menu" aria-labelledby="dropdownMenu1">
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#profile">
                                    <i class="fa fa-user-edit" aria-hidden="true"></i>Update Profile
                                            </a>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#securitySetup"><i
                                    class="fa fa-lock" aria-hidden="true"></i>Security Setup</a>
                                </ul>
                                <!-- <a href="/history?key=<?php echo base64_encode('travel_history') ?>" class=" dropdown-item" type="button" id="dropdown_trav_history">
                                    <i class="fa fa-history" aria-hidden="true"></i> History Logs
                                </a> -->
                               


                                <a class="dropdown-item" href="/logout">

                                    <i class="fa fa-power-off" aria-hidden="true"></i> {{ __('Logout') }}
                                </a>
                                    
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
            @include('triage.includes.editProfile')
        </nav>
        {{-- end client nav --}}
        @endif
    @endif
    @if (\Request::is('history'))
    <main class="container-fluid py-3">
        @yield('content')
    </main>
    @else
    <main class="container py-3">
        @yield('content')
    </main>
    @endif

    

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/pageLoader.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script> 
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/html2Canvas.min.js') }}"></script>
    <script src="{{ asset('js/swal.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
