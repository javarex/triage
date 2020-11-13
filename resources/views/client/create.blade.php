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
<div class="container pt-0">
    <div class="row justify-content-center ">
        <div class="col-md-12 d-flex justify-content-center">
            <img src="{{ asset('image/ddoqr.png') }}" class="img-fluid pb-1" width="100" height="100">
        </div>
        <div class="col-md-10">
            <div class="bg-primary">
                <div class="card-body font-weight-bold text-primary bg-light shadow">
                    <form method="POST" action="{{ route('client.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        @if($message = Session::get('delete'))
                                                
                            <div class="text-danger text-center ">
                                <h3>{{ $message }}</h3>
                            </div>
                        
                        @endif 
                        <div class="tab-content " id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <!-- diri -->
                                <div class="row">
                                    <div class="col-md-4 card card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Personal Information</h4>
                                            </div>
                                            <div class="col-md-12 form-group">
                                            
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
                                            
                                            
                                            <div class="col-md-12 form-group">
                                                <div class="col-md-12">
                                                    <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Sex') }}</span>
                                                </div>
                                                <div class="col-md-12">
                                                    <select name="sex" id="sex" class="form-control" name="sex" value="{{ old('sex') }}" autocomplete="sex" required>
                                                        <option value=""></option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    @error('sex')
                                                        <small class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                                <!-- <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Purok, Barangay, Municipality"> -->
                                            
                                            </div>
                                            
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
                                        </div>
                                    </div>
                                
                                <!-- diri -->

                                <div class="col-md-4 card">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Contact Information</h3>
                                    </div>
                                        <!-- Province -->
                                        <div class="col-md-12 form-group">
                                                                                    
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Province') }}</span>
                                            </div>

                                            <div class="col-md-12">
                                                <select name="province_id" class="form-control" id="province" required>
                                                    <option value=""></option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{$province->id}}" id="province_select" data-provCode="{{$province->provCode}}">{{$province->provDesc}}</option>
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
                                                <select name="municipal_id" class="form-control" disabled id="municipality" required>
                                                    <option value=""></option>
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
                                                <select name="barangay_id" class="form-control @error('barangay') is-invalid @enderror" disabled id="barangay" required>
                                                    <option value=""></option>
                                                </select>
                                                @error('barangay')
                                                    <small class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Purok') }}</span>
                                            </div>
                                            <div class="col-md-12">
                                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="" required>
                                                @error('address')
                                                    <small class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>

                                        </div>


                                        <div class="col-md-12 form-group">

                                            <div class="col-md-12">
                                                <span class="font-weight-normal">{{ __('Contact number') }}</span>
                                            </div>

                                            <div class="col-md-12">
                                                <input id="contact_number" type="text" maxlength="11" placeholder="09123456789" required class="form-control" name="contact_number" value="{{ old('contact_number') }}" >
                                            </div>

                                            @error('contact_number')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>  

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

                                        <div class="col-md-12 form-group">
                                                
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Valid ID') }}</span>
                                            </div>
                                        
                                            <div class="col-md-12">
                                                <input class="form-control-file" name="valid_id" type="file" accept="image/*;capture=camera">
                                                @error('valid_id')
                                                    <small class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>
                                        
                                        </div>     
                                    </div> 
                                    
                                </div>

                                    <div class="col-md-4 card">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="">Account Setup</h3>
                                            </div>
                                            
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
                                                    <button type="submit" id="next" class="btn btn-primary btn-block">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        {{ __('Sign up') }}
                                                    </button>
                                                    <button type="button" onclick="goBack()" class="btn btn-danger btn-block">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        {{ __('Cancel') }}
                                                    </button>    
                                                </div>
                                            </div>
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
    
        function goBack() {
            window.history.back();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                        output += '<option value="'+value.id+'"  data-munCode="'+value.citymunCode+'">'+value.citymunDesc+'</option>';
                        console.log( key + ": " + value.citymunDesc );
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
                        output += '<option value="'+value.id+'">'+value.brgyDesc+'</option>';
                    });
                    $('#barangay').html(output);
                }
            })
        }

        $(document).ready(function() {
            //birthday script
            $( "#birthday" ).datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1930:2020"
            });
            //birthday script

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
            
        })
    </script>
@endsection