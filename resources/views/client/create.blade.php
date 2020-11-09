@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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

                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <h2>Personal information</h2>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('First name') }}</span>
                                            </div>
                                        
                                            <div class="col-md-12">
                                                <input type="hidden" name="role" value="2" >
                                                <input type="hidden" name="code" value="{{$code}}" >
                                                <input id="first_name" type="text" required class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  autofocus>
                                            </div>
                                        
                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                        
                                            <div class="col-md-12">
                                                <span class="font-weight-normal">{{ __('Middle name') }}</span>
                                            </div>
                                        
                                            <div class="col-md-12">
                                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autofocus>
                                            </div>
                                        
                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                        
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Last name') }}</span>
                                            </div>
                                        
                                            <div class="col-md-12">
                                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" >
                                            </div>
                                        
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Sex') }}</span>
                                            </div>
                                            <div class="col-md-12">
                                                <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ old('sex') }}" autocomplete="sex" required>
                                                    <option value=""></option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                            <!-- <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Purok, Barangay, Municipality"> -->
                                        
                                            @error('sex')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Birthday') }}</span>
                                            </div>
                                            <div class="col-md-12">
                                                <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" >
                                            </div>
                                            <!-- <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Purok, Barangay, Municipality"> -->
                                        
                                            @error('birthday')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-12">
                                                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Address') }}</span>
                                            </div>
                                            <div class="col-md-12">
                                                <input id="address" type="text" class="form-control @error('last_name') is-invalid @enderror" name="address" value="{{ old('address') }}" >
                                            </div>
                                        
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            
                            <!-- diri -->
                            <div class="col-md-6 border border-secondary border-right-0 border-top-0 border-bottom-0 border-left-2 ">
                                <div class="col-md-12">
                                    <h2>Account Setup</h2>
                                </div>

                                <div class="col-md-12 form-group">
                                        
                                    <div class="col-md-12">
                                        <span class="font-weight-normal">{{ __('Contact number') }}</span>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <input id="contact_number" type="text" placeholder="e.g. 09080564755" maxlength="11" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" >
                                    </div>
                                
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                   
                                <div class="col-md-12 form-group">
                                        
                                    <div class="col-md-12">
                                        <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Email address') }}</span>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
                                        <!-- <div class="alert alert-warning" role="alert">
                                            Note: Please input a valid email address. The QR code will be sent to your email.
                                        </div> -->
                                    </div>
                                
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                   
                                <div class="col-md-12 form-group">
                                        
                                    <div class="col-md-12">
                                        <span for="" class="">{{ __('QR code')}}</span>
                                    </div>
                                
                                    <div class="col-md-12 ">
                                        <div class=" mt-1 p-0 text-center">
                                            <div class="d-flex justify-content-center">
                                                {!! QrCode::size('200')->color(68, 41, 0)->margin(0)->generate($code) !!}
                                                <br>
                                            </div>
                                                <span>{{$code}}</span>
                                                <input type="hidden" name="password" id="" value="{{$code}}">
                                        </div>
                                    </div>
                                
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
        $(document).ready(function() {
            //birthday script
            $( "#birthday" ).datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1930:2020"
            });
            //birthday script

        })
    </script>
@endsection