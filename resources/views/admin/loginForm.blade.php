@extends('layouts.appAdmin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header bg-info text-light font-weight-bolder">
                        Login
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username')}}</label>
                                
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                
                                <div class="col-md-8">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 text-md-right"></label>

                                <div class="col-md-8">
                                    <button class="btn btn-link btn-lg"><i class="fas fa-sign-in-alt    ">Login </i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection