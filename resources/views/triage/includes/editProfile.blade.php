<!-- Modal -->
<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form action="qredit" method="post">
    @csrf
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body ">
        <div class="col-md-12 form-group">                          
            <div class="col-md-12">
                <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Province') }}</span>
            </div>
            <!-- Province -->
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
        <hr>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="saveProfileEdit" >Save</button>
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
                    <input type="text" class="form-control" name="username" id="username" required>
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
        <button type="submit" class="btn btn-primary" id="saveSecurity" >Save</button>
      </div>
    </div>
    </form>
  </div>
</div>
