
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
                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"  autofocus>
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
                <select name="suffix" id="suffix" class="form-control">
                    <option value="" {{ old('sex') == '' ? 'selected' : '' }}>Select Suffix</option>
                    <option value="Jr." {{ old('sex') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                    <option value="Sr." {{ old('sex') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                    <option value="I" {{ old('sex') == 'I' ? 'selected' : '' }}>I</option>
                    <option value="II" {{ old('sex') == 'II' ? 'selected' : '' }}>II</option>
                    <option value="III" {{ old('sex') == 'III' ? 'selected' : '' }}>III</option>
                    <option value="IV" {{ old('sex') == 'IV' ? 'selected' : '' }}>IV</option>
                    <option value="V" {{ old('sex') == 'V' ? 'selected' : '' }}>V</option>
                    <option value="VI" {{ old('sex') == 'VI' ? 'selected' : '' }}>VI</option>
                    <option value="VII" {{ old('sex') == 'VII' ? 'selected' : '' }}>VII</option>
                </select>
                @error('suffix')
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
                <select name="sex" id="sex" class="form-control" name="sex" value="{{ old('sex') }}" autocomplete="sex" >
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
                    <select name="province" class="form-control" id="province"  style="width:100%">
                        <option value=""></option>
                        @foreach($provinces as $province => $key)
                        <option value="{{$key->id}}" data-provCode="{{$key->provCode}}" {{ old('provCode') == $key->provCode ? 'selected' : '' }}>{{$key->provDesc}}</option>
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
                    <select name="municipality" class="form-control" disabled id="municipality"  style="width:100%">
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
                    <select name="barangay" class="form-control"  disabled id="barangay"  style="width:100%">
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
                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="e.g. 1" >
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
            <!-- <div class="col-md-12 form-group">

                <div class="col-md-12">
                    <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Valid Identification Card (IC)') }} <small class="text-danger font-weight-bold">(Max file size of 2MB)</small></span>
                </div>
            
                <div class="col-md-12">
                    <input class="form-control-file" name="valid_id" id="valid_id" type="file" accept="image/*;capture=camera" >
                    @error('valid_id')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            
            </div>  -->
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
                    <input type="checkbox" id="agree"> <label for="agree">I have read and agree the</label> <a href="#" data-toggle="modal" data-target="#privacyNotice">Privacy Notice.</a>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-12">
                    <button type="submit" id="submitForm" class="btn btn-choco btn-block" disabled>
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