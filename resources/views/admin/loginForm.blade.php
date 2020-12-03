@extends('layouts.appLogin')

@section('content')
<!-- end page loader -->
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-6 ">
                <img src="{{ asset('image/triagez.png')}}" class="img-fluid" alt="">
            </div>
            
            <div class="col-md-5 p-5 card card-body" style="background-color:transparent">
                <form action="{{route('login')}}" method="post" autocomplete="off">
                    @csrf  
                    <div class="form-group row d-flex justify-content-center">                                
                        <div class="col-md-10">
                            <input type="text" class="form-control-mod @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-md-10">
                            <input type="password" class="form-control-mod @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <button class="btn btn-choco btn-block"><i class="fas fa-sign-in-alt    "> </i> Login</button>    
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10 mt-1">
                            <a href="/" class="btn btn-danger btn-block"><i class="fas fa-arrow-left"></i> Back </a>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-md-4 text-md-right"></label>

                        <div class="col-md-8">
                            <button class="btn btn-link btn-lg"><i class="fas fa-sign-in-alt    ">Login </i></button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

@endsection

