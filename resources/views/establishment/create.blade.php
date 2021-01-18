@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <style>
        .divider{
            border-right: solid #b8b5ab 1px;
            border-bottom:none;
           
        }
        @media only screen and (max-width: 767px)
        {
            .divider{
                background-color:#ffe56c;
                border-right:none;
                border-bottom:solid #b8b5ab 1px;
            } 
            .divider2{
                background-color:#ffe56c;
                border-right:none;
                border-bottom:solid #b8b5ab 1px;
            } 
            
        }
    </style>
@endsection
@section('content')
<div class="">
    <div class="row justify-content-center ">
        <div class="col-md-12 d-flex justify-content-center">
            <img src="{{ asset('image/triage_g.png') }}" class="img-fluid pb-2" width="200" >
        </div>
        <div class="col-md-10">
            <div class="bg-primary">
                <div class="card font-weight-bold text-choco shadow " style="background-color:#ffe56c">
                    <form method="POST" action="/establishment" autocomplete="off" id="register">
                        @csrf

                        <input type="hidden" name="terminal_qr" value="{{ $code }}">

                        @if($message = Session::get('delete'))
                                                
                            <div class="text-danger text-center ">
                                <h3> <i class="fas fa-engine-warning    "></i>{{ $message }}</h3>
                            </div>
                        
                        @endif
                        <div class="row">
                            <div class="col-md-4 card-body divider">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="">Establishment Information</h5>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Establishment  Name') }}</span>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <input id="establishment" type="text" class="form-control" name="establishment_name" value="{{ old('name') }}" >
                                            @error('establishment_name')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Establishment Type') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" name="role" value="1">
                                            <select name="establishment_type" id="establishment_type"  class="form-control" required style="width:100%">
                                                <option value=""></option>
                                                @foreach($establishment_type as $type => $key)
                                                    <option value="{{ $key->id }}"> {{ $key->type }} </option>
                                                @endforeach
                                            </select>
                                        @error('first_name')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ __('Province') }}</span>
                                        </div>

                                        <div class="col-md-12">
                                            <select name="province" id="province" class="form-control" required style="width:100%">
                                                <option value=""></option>
                                                @foreach($provinces as $province => $key)
                                                    <option value="{{ $key->provCode }}" data-provCode="{{ $key->provCode }}" {{ old('province') == $key->provCode ? 'selected' : '' }}> {{ $key->provDesc }} </option>
                                                @endforeach
                                            </select>
                                        @error('province')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{__('Municipal')}}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <select name="municipal" id="municipal" class="form-control" style="width:100%;">
                                                <option value=""></option>
                                            </select>
                                            @error('municipal')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small> {{_('Barangay') }} </span>
                                        </div>
                                        <div class="col-md-12">
                                            <select name="barangay" id="barangay" class="form-control" required style="width:100%" >
                                                <option value=""></option>
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal"><small class="text-danger font-weight-bold">*</small>{{ _('Agency Head')}}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="agency_head" id="agency_head" value="{{ old('agency_head') }}" placeholder="e.g. John M. Doe Jr.">
                                            @error('agency_head')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- Contact info  -->
                            
                            <div class="col-md-4 card-body divider">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="">Establishment Administrator</h5>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('First Name') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="first_name">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Middle Name') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="middle_name">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Last Name') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="last_name">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Company Email Address')}}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="email" class="form-control" placeholder="e.g company@email.com">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Mobile Number') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" maxlenght="11" name="mobile_number" class="form-control" placeholder="0912XXXXXXX">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Telephone Number') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" maxlenght="11" name="telephone_number" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 card-body divider2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="">Account Setup</h5>
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

                                    <div class="col-md-12"><label for="">Others</label></div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Coordinate Longitude') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="coordinate_longitude">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Coordinate Latitude') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="coordinate_latitude">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <button type="button" id="submitForm" class="btn btn-choco btn-block">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                {{ __('Sign up') }}
                                            </button>
                                            @if( auth()->user() )
                                           <a href="/establishment" class="btn btn-danger btn-block">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                {{ __('Cancel') }}
                                            </a> 
                                            @else
                                            <a href="/" class="btn btn-danger btn-block">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                {{ __('Cancel') }}
                                            </a>     
                                           @endif
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
    <script src="{{ asset('js/notify.min.js') }}"></script> 
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        
        $(document).ready(function(){
            
            $(document).on('keyup','#password2', function(){
                if($(this).val() == $('#password').val() && $(this).val() !== '')
                {
                    $('#confirm_password').html('<i class="fa fa-check text-success"></i>')
                }else{
                    $('#confirm_password').html('<small class="text-danger font-weight-bold">*</small>')
                }
            })

            $('#establishment_type').select2();
            $('#province').select2({
                placeholder: 'Select Province'
            });
            

            $(document).on('change','#province', function(){
                var provCode = $(this).find(':selected').attr('data-provCode');
                loadMunicipals(provCode);
                $('#municipal').select2({
                    placeholder: 'Select Municipal'
                });
                if($(this).val() != ""){
                    $('#municipal').removeAttr('disabled');
                }else{
                    $('#municipal').attr('disabled', true);
                }
            })

            $(document).on('change','#municipal', function(){
                

                var municipalCode = $(this).find(':selected').attr('data-municipalCode');

                loadBarangays(municipalCode);

                $('#barangay').select2({
                    placeholder: 'Select Barangay'
                });
                if($(this).val() != ''){
                    $('#barangay').attr('disabled',false);
                }else{
                    $('#barangay').attr('disabled',true);
                    
                }
            });

            $('#submitForm').click(function(e){
                var output='';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var token = $('input[name=_token]').val();
                var data = $('#register').serialize();
                
                $.ajax({
                    type:'POST',
                    url:'/establishmentValidate',
                    data:data,
                    success:function(data){
                        if($.isEmptyObject(data.error)){
                            $('#register').submit();
                        }else{
                            $.each(data, function(key, value) {
                                $.notify(value[0], 'error');
                            })
                        }
                    }
                });
                
            });
        })

        function loadMunicipals(id){
            var output = '<option></option>';
            $.ajax({
                url:"/load/municipal/"+id,
                type:"get",
                success:function(data){
                    $.each(data, function(key, value){
                        output+= "\n<option value='"+value.citymunCode+"' data-municipalCode='"+value.citymunCode+"' {{ old ('municipal') == "+value.citymunCode+" ? 'selected' : '' }}>"+value.citymunDesc+"</option>";
                        // output += '<option value="'+value.citymunCode+'"  data-municipalCode="'+value.citymunCode+'" {{ old("municipal") =='+value.citymunCode+'? "selected" : "" }}>'+value.citymunDesc+'</option>\n';
                    })
                    $('#municipal').html(output);
                }
            })
        }

        function loadBarangays(id){
            var output = '<option></option>';
            $.ajax({
                url:"/load/barangay/"+id,
                type:"get",
                success:function(data){
                    // {{ old('municipal') == $key->citymunCode ? 'selected' : '' }}
                    $.each(data, function(key, value){
                        output += '<option value="'+value.brgyCode+'"  data-brgyCode="'+value.brgyCode+'" {{ old("barangay") =='+value.brgyCode+'? "selected" : "" }}>'+value.brgyDesc+'</option>';
                    })
                    $('#barangay').html(output);
                }
            })
        }
    </script>
@endsection