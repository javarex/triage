<nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#442900;">
    <div class="container-fluid">
        <a class="navbar-brand pr-5" href="{{ url('/triage') }}">
            <!-- {{ config('app.name', 'Laravel') }} -->
            <img src="{{ asset('image/triage_g.png') }}" class="img-fluid pb-1" title="PLGU - DAVAO DE ORO" width="80">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color:white;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> 

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item "> 
                    <a href="triage" class="nav-link text-warning">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                
                <li class="nav-item "> 
                    <a class="nav-link text-warning">
                        |
                    </a>
                </li>
                <li class="nav-item "> 
                    <a href="#" onclick="captureScreen()" class="nav-link text-warning">
                        <i class="fas fa-file-export    "></i> Export
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
                        {{ $first_name }}<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#adminEdit">
                            <i class="fas fa-user-edit    "></i> Edit Profile
                        </a> -->
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