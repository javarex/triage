<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DdO QR</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free-5.14.0/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pageLoader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>

<!-- background-image: radial-gradient(circle, #fff3c0 , #fcd538, gold) -->
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm py-0" style="background-color:#442900;">
            <div class="container-fluid ml-0 p-0">
                <a class="navbar-brand" href="{{ url('/triage') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <img src="{{ asset('image/triage_h.png') }}" class="img-fluid pb-1" title="PLGU - DAVAO DE ORO" width="80" > 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color:white;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#ECC633">
                                {{ $first_name }}<span class="caret"></span>
                            </a>
                            
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#profile"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>

                                <!-- <a class="dropdown-item" href="{{ route('client.edit', Auth::user()->id ) }}">
                                    <i class="fas fa-pen-alt    "></i> {{ __('Edit')}}
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
        @include('triage.includes.modal_id')
        </nav>

        <main class="container pt-5" style="height:89vh">
            @yield('content')
        </main>
    </div>

    
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/notify.min.js') }}"></script>
<script src="{{ asset('js/pageLoader.js') }}"></script>
<script src="{{ asset('js/print.js') }}"></script>

@yield('scripts')
</body>
</html>