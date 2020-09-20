@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('client.store')}}" autocomplete="off" class="form1">
                        @csrf

                        <div class="form-group row">
                            <label for="triage_code" class="col-md-4 col-form-label text-md-right">{{ __('Triage code')}}</label>

                            <div class="col-md-6">
                                <div class="alert alert-info mt-1 p-1 ">
                                    <div class="d-flex justify-content-center">
                                        <h3><strong>
                                        
                                            {{ $code }}
                                            @if($message = Session::get('delete'))
                                                
                                                <div class="text-danger">
                                                    ({{ $message }})
                                                </div>
                                            
                                            @endif
                                        
                                        </strong></h3>
                                    </div>
                                    <div class="text-danger d-flex justify-content-center">Note: Remember your triage login code.</div>
                                </div>
                                <input type="hidden" class="form-control" value="{{ $code }}" name="code">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle name') }}</label>

                            <div class="col-md-6">
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Purok, Barangay, Municipality">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact number')}}</label>

                            <div class="col-md-6">
                                <input type="text" maxlength="11" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex')}}</label>
                                
                            <div class="col-md-6">
                                <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ old('sex') }}" autocomplete="sex" required>
                                    <option value=""></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('User type')}}</label>

                            <div class="col-md-6">
                                <select name="type" id="user_type" class="form-control">
                                    <option value=""></option>
                                    <option value="guest">Guest</option>
                                    <option value="employee">Employee</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row user_type_group">
                            <label for="office" class="col-md-4 col-form-label text-md-right misc_label">Office</label>

                            <div class="col-md-6" id="misc_input">
                               <select class="form-control" name="office" id="office">
                                    <option value=""></option>
                                    @foreach( $offices as $office )
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>


                        <!-- <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
            $('.user_type_group').hide();
            $('#user_type').change(function()
            {
                if($(this).val() == 'employee')
                {
                    $('.user_type_group').fadeIn(600);
                    $('#office').attr('required', true);

                }else{
                    $('.user_type_group').fadeOut(600);
                    $('#office').removeAttr('required');
                    $('#office').val('');
                }
                return false;
            })
        })
    </script>
@endsection