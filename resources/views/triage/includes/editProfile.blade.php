<!-- Modal -->
<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form  method="post" id="profile_edit">
    @csrf
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body ">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h1>
                                    <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                </h1>
                            </div>
                            <div class="col-md-8 m-auto">
                                <div class="row">
                                    <div class="col-1 col-md-1 px-1"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <div class="col-11 col-md-11">
                                        <h3>{{$Users_name}}</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1 col-md-1 px-1"><i class="fas fa-map-marker-alt    "></i></div>
                                    <div class="col-11 col-md-11">
                                        {{$address}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1 col-md-1 px-1"><i class="fas fa-birthday-cake    "></i></div>
                                    <div class="col-11 col-md-11">
                                        {{date('F d, Y', strtotime($user->birthday))}}
                                    </div>
                                </div>
                                @if(auth()->user()->contact_number)
                                <div class="row">
                                    <div class="col-1 col-md-1 px-1"><i class="fas fa-mobile-alt    "></i></div>
                                    <div class="col-11 col-md-11">
                                        {{ auth()->user()->contact_number }}
                                    </div>
                                </div>
                                @endif

                                @if(auth()->user()->email)
                                <div class="row">
                                    <div class="col-1 col-md-1 px-1">@</div>
                                    <div class="col-11 col-md-11">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-1 col-md-1 px-1"></div>
                                    <div class="col-11 col-md-11 d-flex justify-content-start">
                                        <button type="button" id="button_editInfo" class="btn btn-success"><i class="fas fa-edit    "></i> Edit Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" id="profile_form">
                <div class="col-md-12 form-group">                          
                    <div class="col-md-12">
                        <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Province') }}</span>
                    </div>
                    <!-- Province -->
                    <div class="col-md-12">
                        <select name="province_id" class="form-control" id="province"  style="width:100%">
                            <option value=""></option>
                            
                            @foreach($provinces as $province => $key)
                            <option value="{{$key->id}}" data-provCode="{{$key->provCode}}" {{ old('province_id', $key->id) == auth()->user()->province_id ? "selected" : "" }}>{{$key->provDesc}}</option>
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
                        <select name="municipal" class="form-control municipal_class" id="municipal"  style="width:100%" >
                            <option value="{{auth()->user()->municipal_id}}" data-munCode="{{$userAdd->municipal->citymunCode}}" {{ old('municipal', $userAdd->municipal->id) == auth()->user()->municipal_id ? "selected" : "" }}>{{$userAdd->municipal->citymunDesc}}</option>
                        </select>
                        @error('municipal')
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
                        <select name="barangay" class="form-control"  id="barangay"  style="width:100%">
                            <option value="{{auth()->user()->barangay_id}}" {{ old('barangay', $userAdd->barangay->id) == auth()->user()->barangay_id ? "selected" : "" }}>{{$userAdd->barangay->brgyDesc}}</option>
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
                        <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('Birthday') }}</span>
                    </div>
                
                    <div class="col-md-12">
                        <input type="text" name="birthday" class="form-control" id="birthday"  style="width:100%" value="{{ old('birthday', auth()->user()->birthday) }}">
                        @error('birthday')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                
                </div>
                <div class="col-md-12 form-group">
                        
                    <div class="col-md-12">
                        <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('Contact Number') }}</span>
                    </div>
                
                    <div class="col-md-12">
                        <input type="text" name="contact_number" class="form-control" id="contact_number"  style="width:100%" value="{{ old('contact_number', auth()->user()->contact_number) }}">
                        @error('contact_number')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                
                </div>
                <div class="col-md-12 form-group">
                        
                    <div class="col-md-12">
                        <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('Email Address') }}</span>
                    </div>
                
                    <div class="col-md-12">
                        <input type="email" name="email" class="form-control" id="email"  style="width:100%" value="{{ old('email', auth()->user()->email) }}">
                        @error('email')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                
                </div>
            </div>
        </div>
        <hr>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveProfileEdit" >Save</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal security setup-->
<div class="modal fade" id="securitySetup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form method="post" id="saveSecurityForm">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-lock    "></i> Security setup</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12 form-group">
                
                <div class="col-md-12">
                    <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('username') }}</span>
                </div>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="username" value="{{old('username') ?? auth()->user()->username }}" required>
                    @error('username')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 form-group">
                
                <div class="col-md-12">
                    <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('Password') }}</span>
                </div>

                <div class="col-md-12">
                    <input type="password" class="form-control" name="password" id="password" required>
                    @error('password')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 form-group">
                
                <div class="col-md-12">
                </div>
                <div class="col-md-12">
                    <span class="font-weight-normal "><small class="text-danger font-weight-bold">*</small>{{ __('Confirm Password') }}</span>
                    <span id="match"></span>
                </div>

                <div class="col-md-12">
                    <input type="password" class="form-control" name="password_confirmation" id="password2" required>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveSecurity" >Save</button>
      </div>
    </div>
    </form>
  </div>
</div>
