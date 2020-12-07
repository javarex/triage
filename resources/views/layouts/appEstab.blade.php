<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DdO QR</title>
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
        <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
        @yield('styles')
    </head>
    <body style="height:100vh">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#442900;">
                <div class="container-fluid">
                    <a class="navbar-brand pr-5" href="{{ url('/triage') }}">
                        <!-- {{ config('app.name', 'Laravel') }} -->
                        <img src="{{ asset('image/triage_h.png') }}" class="img-fluid pb-1" title="PLGU - DAVAO DE ORO" width="80" >
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color:white;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> 

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <!-- <ul class="navbar-nav mr-auto">
                            <li class="nav-item "> 
                                <a href="#" class="nav-link text-warning">
                                    <i class="fa fa-user" aria-hidden="true"></i> User
                                </a>
                            </li>
                            <li class="nav-item "> 
                                <a href="establishment" class="nav-link text-warning">
                                    <i class="fa fa-building" aria-hidden="true"></i> Establishment
                                </a>
                            </li>
                        </ul> -->

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li> <i class="fas fa-pen-alt    "></i>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#ECC633"> 
                                    {{ Auth::user()->first_name }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#adminEdit">
                                        <i class="fas fa-user-edit    "></i> Edit Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off" aria-hidden="true"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Modal -->
            <div class="modal fade" id="adminEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-edit  fa-3x   "></i> USER EDIT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/updateEstablishment/{{ auth()->user()->id }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    Name
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? Auth::user()->first_name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">
                                    Username
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="username" id="usernameEdit" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') ?? Auth::user()->username }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    Password
                                </label>
                                <div class="col-md-6">
                                    <input type="password" name="password" id="passwordEdit" class="form-control @error('password') is-invalid @enderror">
                                </div>
                            </div>
                        </div>

                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- End modal -->
            <main class="container py-4">
                @yield('content')
            </main>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/notify.min.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
        @yield('scripts')

    </body>
</html>
