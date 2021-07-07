<div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="/admin/client" method="post">
      @csrf

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

            <div class="container">
                <div class="form-group row">
                    <label for="firstName" class="col-md-4 col-form-label text-md-right">First name</label>
                    
                    <div class="col-md-6">
                        <input id="firstName" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autofocus>
                        <input id="client_id" type="hidden"  name="client_id">

                        @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middleName" class="col-md-4 col-form-label text-md-right">Middle name</label>
                    
                    <div class="col-md-6">
                        <input id="middleName" type="text" class="form-control @error('first_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autofocus>

                        @error('middleName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lastName" class="col-md-4 col-form-label text-md-right">Last name</label>
                    
                    <div class="col-md-6">
                        <input id="lastName" type="text" class="form-control @error('first_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autofocus>

                        @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- birthday -->

                <div class="form-group row">
                    <label for="birthday" class="col-md-4 col-form-label text-md-right">Birthday</label>
                    
                    <div class="col-md-6">
                        <input id="birthday" type="date" class="form-control @error('first_name') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" autofocus>

                        @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- birthday -->
                <div class="form-group row">
                    <label for="qrcode" class="col-md-4 col-form-label text-md-right">Qrcode</label>
                    
                    <div class="col-md-6">
                        <input id="qrcode" type="text" class="form-control @error('qrcode') is-invalid @enderror" name="qrcode" value="{{ old('qrcode') }}" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                    
                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autofocus>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
            </div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>