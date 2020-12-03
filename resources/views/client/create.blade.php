@extends('layouts.app')

@section('styles')

    <style>
        .divider{
            border-right: solid #b8b5ab 1px;
            border-bottom:none;
            width: 100%;
        }
        @media only screen and (max-width: 767px)
        {
            .divider{
                border-right:none;
                border-bottom:solid #b8b5ab 1px;
                margin-bottom:10px;
                width: 100%;
            } 
        }
    </style>

@endsection
@section('content')
<div class="">
    <div class="row justify-content-center ">
        <div class="col-md-12 d-flex justify-content-center">
            <img src="{{ asset('image/ddoqr.png') }}" class="img-fluid pb-1" width="100" height="100">
        </div>

        <div class="col-md-12 d-flex justify-content-center">
            <h1 class="text-choco"> <i class="fas fa-qrcode    "></i> Davao de Oro Tracking System</h1>
        </div>
        
        <div class="col-md-10">
            <div class="bg-primary">
                <div class="card font-weight-bold text-choco shadow" style="background-color:#ffe56c">
                    <form method="POST" action="{{ route('client.store') }}" autocomplete="off" enctype="multipart/form-data" id="register">
                        @csrf

                        @if($message = Session::get('delete'))
                                                
                            <div class="text-danger text-center ">
                                <h3> <i class="fas fa-engine-warning    "></i>{{ $message }}</h3>
                            </div>
                        
                        @endif
                        <div class="row">
                            <div class="col-md-4 card-body divider">
                                <div class="col-md-12">
                                    <h4>Personal Information</h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('First name') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="role" value="2" >
                                        <input type="hidden" name="code" value="{{$code}}" >
                                        <input id="first_name" type="text" required class="form-control" name="first_name" value="{{ old('first_name') }}"  autofocus>
                                    @error('first_name')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-12 form-group">
                                    <div class="col-md-12">
                                        <span class="font-weight-normal">{{ __('Middle name') }}</span>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" autofocus>
                                    </div>
                                </div>
                            
                                <!-- last name  -->
                                <div class="col-md-12 form-group">
                            
                                    <div class="col-md-12">
                                        <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Last name') }}</span>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" >
                                        @error('last_name')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                
                                </div>
                                <!-- last name /  -->
                            
                                <!-- extension  -->
                                <div class="col-md-12 form-group">
                            
                                    <div class="col-md-12">
                                        <span class="font-weight-normal">{{ __('Extension name') }}</span>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <input id="suffix" type="text" class="form-control" name="suffix" value="{{ old('suffix') }}" placeholder="ex. Jr., Sr., I, II etc... (Optional)">
                                        @error('extension_name')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- extension /  -->
                            
                                <!-- sex  -->
                                <div class="col-md-12 form-group">
                                    <div class="col-md-12">
                                        <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Sex') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="sex" id="sex" class="form-control" name="sex" value="{{ old('sex') }}" autocomplete="sex" required>
                                            <option value=""></option>
                                            <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('sex')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                    <!-- <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Purok, Barangay, Municipality"> -->
                                
                                </div>
                                <!-- sex /  -->
                            
                                <!-- birthday  -->
                                <div class="col-md-12 form-group">
                                    <div class="col-md-12">
                                        <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Birthday') }} <sub>MM/DD/YY</sub></span>
                                    </div>
                                    <div class="col-md-12">
                                        <input id="birthday" type="text" class="form-control" name="birthday" value="{{ old('birthday') }}" placeholder="e.g. 01/13/2020">
                                        @error('birthday')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                    <!-- <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Purok, Barangay, Municipality"> -->
                                
                                </div>
                                <!-- birthday /  -->
                            </div>
                            
                            <!-- personal info  -->
                            
                            <div class="col-md-4 card-body divider">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Contact Information</h3>
                                    </div>

                                    <div class="col-md-12 form-group">
                                                            
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Province') }}</span>
                                        </div>

                                        <div class="col-md-12">
                                            <select name="provDesc" class="form-control" id="province" required style="width:100%">
                                                <option value=""></option>
                                                @foreach($provinces as $province => $key)
                                                <option value="{{$key->provDesc}}" data-provCode="{{$key->provCode}}" {{ old('provDesc') == $key->provDesc ? 'selected' : '' }}>{{$key->provDesc}}</option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- Municipality -->
                                    <div class="col-md-12 form-group">
                                        
                                        <div class="col-md-12">
                                            <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('Municipality') }}</span>
                                        </div>
                    
                                        <div class="col-md-12">
                                            <select name="citymunDesc" class="form-control" disabled id="municipality" required style="width:100%">
                                                <option value="" ></option>
                                            </select>
                                            @error('municipality')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                    
                                    </div>

                                    <!-- Barangay -->
                                    <div class="col-md-12 form-group">
                                            
                                        <div class="col-md-12">
                                            <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('Barangay') }}</span>
                                        </div>
                    
                                        <div class="col-md-12">
                                            <select name="brgyDesc" class="form-control"  disabled id="barangay" required style="width:100%">
                                                <option value=""></option>
                                            </select>
                                            @error('barangay')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- purok -->
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Purok') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="e.g. 1" required>
                                            @error('address')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- contact number  -->

                                    <div class="col-md-12 form-group">

                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Contact number') }}</span>
                                        </div>

                                        <div class="col-md-12">
                                            <input id="contact_number" type="text" maxlength="11" placeholder="09123456789" class="form-control" name="contact_number" value="{{ old('contact_number') }}" >
                                        </div>

                                        @error('contact_number')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>

                                    <!-- email address   -->

                                    <div class="col-md-12 form-group">
                            
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold"></small>{{ __('Email address') }}</span>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" >
                                            <!-- <div class="alert alert-warning" role="alert">
                                                Note: Please input a valid email address. The QR code will be sent to your email.
                                            </div> -->
                                            @error('email')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    
                                    </div>

                                    <!-- valid id  -->
                                    <div class="col-md-12 form-group">
                        
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Valid Identification Card (IC)') }} <small class="text-danger font-weight-bold">(Max file size of 2MB)</small></span>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <input class="form-control-file" name="valid_id" id="valid_id" type="file" accept="image/*;capture=camera" required>
                                            @error('valid_id')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4 card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Account Setup</h3>
                                    </div>

                                    <!-- username -->
                                    <div class="col-md-12 form-group">
                            
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Username') }}</span>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <input id="username" class="form-control" type="text" name="username" value="{{ old('username') }}" >
                                            @error('username')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    
                                    </div>

                                    <!-- password  -->

                                    <div class="col-md-12 form-group">
                            
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Password') }}</span>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password">
                                            @error('password')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    
                                    </div>

                                    <!-- confirm -->

                                    <div class="col-md-12 form-group">
                            
                                        <div class="col-md-12" id="">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold" id="confirm_password">*</small>{{ __('Confirm password') }}</span>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <input id="password2" type="password"  class="form-control" name="password_confirmation" >
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <button type="submit" id="submitForm" class="btn btn-choco btn-block">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                {{ __('Sign up') }}
                                            </button>
                                            <a href="/" class="btn btn-danger btn-block">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                {{ __('Cancel') }}
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
    
       


       

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //birthday script
            $( "#birthday" ).datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1930:2020"
            });
            //birthday script

            // if ($('#province').val() != '') {
            //     $('#municipality').removeAttr('disabled');
            //     loadMunicipals($('#province').val());
            // }

            $(document).on('change','#province', function(){
                var provCode = $(this).find(':selected').attr('data-provCode');
                if($(this).val() != ''){
                    $('#municipality').removeAttr('disabled');
                    
                    loadMunicipals(provCode);
                }else{
                    loadMunicipals(0);
                    $('#municipality').attr('disabled', true);
                }
            });

            //on change municipal 

            $(document).on('change','#municipality', function (){
                var munCode = $(this).find(':selected').attr('data-munCode');
                if($(this).val() != ''){
                    $('#barangay').removeAttr('disabled');
                    loadBarangays(munCode);
                }else{
                    $('#barangay').attr('disabled', true);
                    loadBarangays(0);
                }
            });

            $(document).on('keyup','#password2', function(){
                if($(this).val() == $('#password').val() && $(this).val() !== '')
                {
                    $('#confirm_password').html('<i class="fa fa-check text-success"></i>')
                }else{
                    $('#confirm_password').html('<small class="text-danger font-weight-bold">*</small>')
                }
            })
            // $('#submitForm').click(function(){
            //     var first_name = $('#first_name').val();
            //     var last_name = $('#last_name').val();
            //     var suffix = $('#suffix').val();
            //     var sex = $('#sex').val();
            //     var birthday = $('#birthday').val();
            //     var province = $('#province').val();
            //     var municipality = $('#municipality').val();
            //     var barangay = $('#barangay').val();
            //     var address = $('#address').val();
            //     var valid_id = $('#valid_id').val();
            //     var username = $('#username').val();
            //     var password = $('#password').val();

            //     validateInputs(first_name, last_name, suffix, sex, birthday, province, municipality, barangay, address,valid_id, username, password);

            // });

            
            
            // select2 scripts

            // loadProvince();
            $('#province').select2();
            $('#municipality').select2();
            $('#barangay').select2();

           
        })

        // function to load Province

        function loadProvince()
        {
            var output = '<option></option>';
            $.ajax({
                url: '/load/province',
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        output += '<option value="'+value.provDesc+'"  data-provCode="'+value.provCode+'">'+value.provDesc+'</option>';
                       
                    });

                    $('#province').html(output);
                }
            })
        }

         // function to load municipality

         function loadMunicipals(id)
        {
            var output = '<option></option>';
            $.ajax({
                url: '/load/municipal/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        output += '<option value="'+value.citymunDesc+'"  data-munCode="'+value.citymunCode+'">'+value.citymunDesc+'</option>';
                       
                    });
                    $('#municipality').html(output);
                }
            })
        }
        // function to load Barangay

        function loadBarangays(id)
        {
            var output = '<option></option>';
            $.ajax({
                url: '/load/barangay/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        output += '<option value="'+value.brgyDesc+'">'+value.brgyDesc+'</option>';
                    });
                    $('#barangay').html(output);
                }
            })
        }
    </script>
@endsection