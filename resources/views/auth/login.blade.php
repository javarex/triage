@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-md-6 ">
            <img src="{{ asset('image/triagez.png')}}" class="img-fluid" alt="">
        </div>
        <div class="col-md-6 p-5">
            <div class="">
                <div class="font-weight-bold">
                    <form method="POST" action="{{ route('login') }}">
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

                       
                        
                        <div class="form-group row d-flex justify-content-center">
                                @if (Route::has('password.request'))
                                <a class="" href="/admin/login">
                                    {{ __('Login as office') }}
                                </a>
                                <span class="mx-2"> | </span>
                                <a class="text-right" href="{{ route('registration.create') }}">
                                    {{ __('Register') }}
                                </a>
                                @endif
                            </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
