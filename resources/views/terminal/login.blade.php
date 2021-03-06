@extends('layouts.appLogin')

@section('styles')
<style>
    .switch_label {
        margin: unset !important;
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
               
                <div class="d-flex justify-content-center form_container">
                    <form action="{{route('terminal_scan_login')}}" method="post" autocomplete="off">
                        @csrf
                           @if (session('status'))
                           <div class="row text-center">
                               <div class="col-12">
                                    <div class="alert alert-danger">
                                        {{ session('status') }}
                                    </div>
                               </div>
                           </div>
                           @endif
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username"
                                class="form-control input_user @error('username') is-invalid @enderror"
                                value="" placeholder="username">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass"
                                placeholder="password">
                        </div>

                        <label class="toggle-switchy" for="switch" data-size="sm" data-text="false">
                            <input checked type="checkbox" name="type" id="switch">
                            <span class="toggle">
                                <span class="switch"></span>
                            </span>
                            <p class="switch_label pl-3 font-weight-bold">IN</p>
                        </label> 

                        <input type="hidden" name="qr" value="{{ $terminal_qr }}">

                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" class="btn login_btn">Login</button>
                        </div>
                    </form>
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

      $(function(){
        var switch_value = true

        $("#switch").val('in') //init value

        $("#switch").on('change', function() {
            switch_value = !switch_value

            if (switch_value) {
                 $(".switch_label").text('IN')
                 $(".login_btn").text('Login')
            } else {
                  $(".switch_label").text('OUT')
                  $(".login_btn").text('Logout')
            }

            // alert($(this).val())
        })
      })
</script>
@endsection