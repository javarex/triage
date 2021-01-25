@extends('layouts.appLogin')

@section('styles')
<style>
    .content {
        color: #fff !important;
    }
</style>
@endsection

@section('content')
<!-- end page loader -->
<div class="container pt-5">
    <div class="row ">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{ asset('image/triage1.png')}}" class="image-fluid" width="160" alt="Logo">
                    </div>
                </div>
                <div class="form_container text-center content">
                    <div class="alert alert-success" role="alert">
                        Successfully Logged in the terminal
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2><b> {{ $terminal_qrcode }} </b></h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Name: {{ $fullname }}</h3>
                            <h3>Date: {{ $date }}</h3>
                        </div>
                    </div>

                    
                </div>

                <!-- <div class="mt-4">
                        <div class="d-flex justify-content-center links text-light">
                            Don't have an account? <a href="client/create" class="ml-2">Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center links text-light">
                            How to register? <a href="{{asset('files/citizenReg.pdf')}}" class="ml-2" target="_blank">Click here</a>
                        </div>
                    </div> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function chooseMenu(menu) {
        if (menu == 'establishment') {
            window.location.href = "/establishment/create";
        } else if (menu == 'citizen') {
            window.location.href = "/client/create";
        }
    }
</script>
@endsection