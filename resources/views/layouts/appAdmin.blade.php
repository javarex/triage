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
        <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
       
        @yield('styles')
    </head>
    <body >
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#442900;">
                <div class="container-fluid">
                    <a class="navbar-brand pr-5" href="{{ url('/triage') }}">
                        <!-- {{ config('app.name', 'Laravel') }} -->
                        <img src="{{ asset('image/triage_h.png') }}" class="img-fluid pb-1" title="PLGU - DAVAO DE ORO" width="80">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color:white;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> 

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item "> 
                                <a href="/admin" class="nav-link-mod ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                                </svg>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item "> 
                                <a href="/userModule" class="nav-link-mod">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                </svg>
                                    Citizens
                                </a>
                            </li>
                            <!-- <li class="nav-item "> 
                                <a href="/adminEstab" class="nav-link-mod">
                                    <i class="fa fa-city" aria-hidden="true"></i> Establishment
                                </a>
                            </li> -->
                            <!-- <li class="nav-item "> 
                                <a href="/ccts_reports" class="nav-link-mod">
                                    <i class="fa fa-file-alt" aria-hidden="true"></i> Reports
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="/logs" class="nav-link-mod">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                </svg>
                                Logs
                                </a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link-mod" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li> <i class="fas fa-pen-alt    "></i>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link-mod" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link-mod dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#ECC633"> 
                                    {{ auth()->user()->first_name }}<span class="caret"></span>
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
                    <form action="{{route('admin.update', Auth::user()->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">
                                    First name
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') ?? Auth::user()->first_name }}">
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
        @if (\Request::is('ccts_reports'))
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        @endif
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
        @yield('scripts')

    </body>
</html>
