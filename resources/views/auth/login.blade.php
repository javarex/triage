@extends('layouts.appLogin')

@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-md-6 ">
            <img src="{{ asset('image/triagez.png')}}" class="img-fluid" alt="">
        </div>
        <div class="col-md-6 p-5">
            <div class="">
                <div class="font-weight-bold">
                    <!-- <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row pt-3 d-flex justify-content-center text-center">
                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="off" placeholder="Triage code" autofocus>
                                <input type="hidden" value="admin" name="password">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center text-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                       
                        
                    </form> -->
                        
                        <div class="col-md-8 mt-5 row d-flex justify-content-center">
                            @if (Route::has('password.request'))
                           <div class="col-md-12">
                                <a class="btn btn-choco btn-block" href="/admin/login">
                                    {{ __('Sign in') }}
                                </a>
                           </div>
                           <div class="col-md-12">
                                    <div class="dropdown">
                                        <a class="btn btn-choco btn-block dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sign Up
                                    </a>
                                    <div class="dropdown-menu" style="width:100%" aria-labelledby="dropdownMenuLink">
                                        <a href="{{ route('client.create') }}" class="dropdown-item text-choco"> <i class="fa fa-user" aria-hidden="true"></i> Register as citizen</a>
                                        <a href="/establishment/create" class="dropdown-item text-choco"> <i class="fa fa-user" aria-hidden="true"></i> Register as establishment</a>
                                    </div>
                                </div>
                           </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
