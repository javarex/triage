@extends('layouts.app')

@section('content')
<!-- for page loader -->
<div class="o-page-loader">
    <div class="o-page-loader--content">
        <div class="o-page-loader--spinner"></div>
        <div class="o-page-loader--message">
            <span>Loading...</span>
        </div>
    </div>
</div>

<!-- end page loader -->
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-6 ">
                <img src="{{ asset('image/triagez.png')}}" class="img-fluid" alt="">
            </div>
            
            <div class="col-md-6 p-5">
                <div class="">
                    <div class="font-weight-bold">
                        <form action="{{ route('login') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-group row">                                
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password (Please use QR code value)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <button class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt    ">Login </i></button>    
                                </div>
                                <div class="col-md-8 mt-1">
                                    <a href="/" class="btn btn-danger btn-block"><i class="fas fa-arrow-left">Back </i></a>
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
        </div>
    </div>

@endsection

