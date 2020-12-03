@extends('layouts.appAdmin')
@section('styles')
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
            <img src="{{ asset('image/ddoqr.png') }}" class="img-fluid pb-1" width="100" height="100">
        </div>

        <div class="col-md-12 d-flex justify-content-center">
            <h1 class="text-choco"> <i class="fas fa-qrcode    "></i> Davao de Oro Tracking System</h1>
        </div>
        
        <div class="col-md-10">
            <div class="bg-choco">
                <div class="card font-weight-bold text-choco shadow " style="background-color:#ffe56c">
                    <form method="POST" action="{{ route('admin.store') }}" autocomplete="off" enctype="multipart/form-data" id="register">
                        @csrf

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
                                            <select name="type" id="establishment_type"  class="form-control" required style="width:100%">
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
                                            <select name="municipal" id="municipal" class="form-control" required style="width:100%;">
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
                                            <select name="barangay" id="barangay" class="form-control" required disabled style="width:100%" >
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
                                        <h5 class="">Contact Information</h5>
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
                                            <span class="font-weight-normal">{{ __('Contact Person') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Fullname" name="contact_person">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <span class="font-weight-normal">{{ __('Contact Number') }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" maxlenght="11" name="contact_number" class="form-control" placeholder="0912XXXXXXX">
                                        </div>
                                    </div>

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
        $(document).ready(function(){
            $('#establishment_type').select2();
            $('#province').select2({
                placeholder: 'Select Province'
            });
            var provinceValue = $('#province').val();
            var municipalValue = $('#municipal').val();
            

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
            })
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