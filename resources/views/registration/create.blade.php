@extends('layouts.app')
@section('styless')
<style>
    .card.show {
        display: block !important
    }

    .card {
        display: none;
        background-color: #E0F7FA;
        border: 1px solid #E0F7FA;
        box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
    }

    .step-container {
        border-top: 1px solid lightgrey;
        border-bottom: 1px solid lightgrey;
        width: 99.85%;
        margin-top: 70px;
        margin-bottom: 10px
    }

    .fa-circle {
        background-color: lightgrey;
        color: #fff;
        padding: 2px 3.1555px;
        border-radius: 50%
    }

    .step-box {
        padding: 10px;
        border-left: 1px solid lightgrey;
        border-right: 1px solid lightgrey;
        background-color: #fff
    }

    .active {
        background-color: #2196F3;
        color: #fff !important;
        border-left: 1px solid #2196F3;
        border-right: 1px solid #2196F3
    }

    .active .fa-circle {
        background-color: #fff !important;
        color: #2196F3
    }

    .fa-check {
        border-radius: 50%;
        background-color: #00C853;
        color: #fff;
        padding: 3px
    }

    .step-title-0 {
        margin-bottom: 0px
    }

    .step-title {
        font-size: 13px;
        position: relative;
        margin-left: 4px
    }


    input,
    textarea,
    button {
        padding: 8px 15px 8px 15px;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        color: #2C3E50;
        background-color: #ECEFF1;
        border: 1px solid #ccc;
        font-size: 16px;
        letter-spacing: 1px
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid skyblue !important;
        outline-width: 0
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid green !important;
        outline-width: 0
    }

    textarea {
        height: 100px
    }

    button {
        width: 120px;
        letter-spacing: 2px
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }

    @media screen and (max-width: 768px) {
        .break-line {
            display: block;
            float: none;
        }
    }
</style>
@endsection
@section('content')
<div class="container-fluid px-1 py-5 mx-auto">
    <form action="{{route('registration.store')}}" autocomplete="off" method="post" runat="server" id="registration_form" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-9 col-md-10">
                <div class="card b-0 rounded-0 show">
                    <div class="row justify-content-center mx-auto step-container">
                        <div class="col-md-3 col-4 step-box active">
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">PERSONAL INFORMATION</span></h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">ACCOUNT SETUP</span></h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">USER IDENTIFICATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <h4 class="heading"></h4>
                        <div class="row d-flex justify-content-center">
                        <h4 class="heading"><i class="fa fa-info-circle" aria-hidden="true"></i> PERSONAL INFORMATION</h4>
                            <div class="col-md-12 ">
                                <div class="row">
                                    <div class="col-md-1 mr-4"></div>
                                    <div class="col-xl-7 col-lg-8 col-10 list text-left" id="display_error"> <label class="text-danger mb-3">* Required</label></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1 mr-4"></div>
                                    <div class="col-md-3">
                                        <label for="first_name" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>First Name</label>

                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  placeholder="Enter First Name">


                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="middle_name" class="font-weight-bold d-flex justify-content-left">Middle Name</label>
                                        <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}"  placeholder="Enter Middle Name">

                                        @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="last_name" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>Last Name</label>
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  placeholder="Enter Last Name" >

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                
                                <div class="form-group row">
                                    <div class="col-md-1 mr-4"></div>
                                    <div class="col-md-3">
                                        <label for="address" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>Address</label>
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  placeholder="Purok, Brgy, Municpality, Province">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="birthday" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>Birthday</label>
                                        <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}"  placeholder="Date of birth">

                                        @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="sex" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>Sex</label>
                                        <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror">
                                            <option value=""></option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @error('sex')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                            </div>
                        </div> <button name="next" type="button" id="next1" class="btn btn-success rounded-0 mb-5 next">Next</button>
                    </div>
                </div>
                <div class="card b-0 rounded-0">
                    <div class="row justify-content-center mx-auto step-container">
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">PERSONAL INFORMATION</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box active">
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">ACCOUNT SETUP</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">USER IDENTIFICATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 justify-content-center text-center">
                        <h4 class="heading"><i class="fas fa-user-cog    "></i> SETTING UP YOUR ACCOUNT</h4>
                        <div class="row justify-content-center mb-4">
                            <div class="col-xl-7 col-lg-8 col-10 list text-left"> <label class="text-danger mb-3">* Required</label>
                                
                                <div class="form-group "> 
                                    <label class="form-control-label">*Contact Number </label> 
                                    <input type="text" id="contact_number" name="contact_number" maxlength="11" placeholder="11-digits" class="form-control" onblur="validate2(6)" value="{{ old('contact_number') }}">
                                    <div class="text-danger">
                                        @error('contact_number')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group "> 
                                    <label class="form-control-label">*Email Address </label> 
                                    <input type="text" id="email" name="email" placeholder="example@example.com" class="form-control" onblur="validate2(7)" value="{{ old('email') }}"> 
                                    <div class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group "> <label class="form-control-label">*Account type (Guest/Establishment)</label>
                                    <select name="role" id="role" class="form-control" onblur="validate2(8)" required>
                                        <option value=""></option>
                                        <option value="1">Establishment</option>
                                        <option value="2">Guest</option>
                                    </select> 
                                </div>

                                <div class="form-group user_type_group"> <label class="form-control-label">*Name of establishment</label>
                                    <input type="text" id="establishment" name="establishment" class="form-control" value="{{ old('establishment') }}"> 
                                </div>
                                
                            </div>
                        </div> 
                        <button type="button" class="btn btn-success rounded-0 mb-5 prev">Back</button> 
                        <button type="button" id="next2" class="btn btn-success rounded-0 mb-5 next" onclick="validate2(0)">Next</button>
                    </div>
                </div>

                <div class="card b-0 rounded-0">
                    <div class="row justify-content-center mx-auto step-container">
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">PERSONAL INFORMATION</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">ACCOUNT SETUP</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box active">
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">USER IDENTIFICATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 justify-content-center text-center">
                        <h4 class="heading text-uppercase"><i class="fa fa-paperclip" aria-hidden="true"></i> Attachments</h4>
                        <div class="row justify-content-center mb-4">
                            <div class="col-xl-7 col-lg-8 col-10 list text-left"> <label class="text-danger mb-3">* Required</label>
                                
                                <div class="form-group row"> 
                                    <label class="form-control-label col-md-12">*User face </label> 
                                    <div class="pl-5 col-md-3" id="icon_face" style="cursor:pointer">
                                        <i class="fa fa-camera-retro" aria-hidden="true"></i> Click me!
                                    </div>
                                    <div class="col-md-5">
                                        <img id="user_face" src="#" alt="" class="img-fluid">
                                    </div>
                                    <input type="file" id="user_pic" name="user_pic" accept="image/*;capture=camera" class="form-control" style="display:none;" value="{{ old('user_pic') }}"> 
                                </div> 

                                <div class="form-group row"> 
                                    <label class="form-control-label col-md-12">*User ID </label> 
                                    <div class="pl-5 col-md-3" id="icon_id" style="cursor:pointer">
                                        <i class="fa fa-camera-retro" aria-hidden="true"></i> Click me!
                                    </div>
                                    <div class="col-md-5">
                                        <img id="user_id_pic" src="#" alt="" class="img-fluid">
                                    </div>
                                    <input type="file" id="user_pic_id" name="user_pic_id" accept="image/*;capture=camera" class="form-control" style="display:none;" value="{{ old('user_id') }}"> 
                                </div> 

                                <div class="form-group row"> 
                                    <label class="form-control-label col-md-12">*User holding ID </label> 
                                    <div class="pl-5 col-md-3" id="icon_userWithID" style="cursor:pointer">
                                        <i class="fa fa-camera-retro" aria-hidden="true"></i> Click me!
                                    </div>
                                    <div class="col-md-5">
                                        <img id="user_with_id_pic" src="#" alt="" class="img-fluid">
                                    </div>
                                    <input type="file" id="user_with_id" name="user_with_id" accept="image/*;capture=camera" class="form-control" style="display:none;" value="{{ old('user_with_id') }}"> 
                                </div> 

                            </div>
                        </div> 
                        <button type="button" class="btn btn-success rounded-0 mb-5 prev">Back</button> 
                        <button type="button" id="next3" class="btn btn-success rounded-0 mb-5 next" onclick="validate2(0)">Next</button>
                    </div>
                </div>
                <div class="card b-0 rounded-0">
                    <div class="row justify-content-center mx-auto step-container">
                    <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">PERSONAL INFORMATION</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">ACCOUNT SETUP</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">USER IDENTIFICATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 justify-content-center text-center">
                        <h4 class="heading">Registration Summary</h4>
                        <div class="form-group row"> 
                            <label class="form-control-label col-md-12">Triage Code </label> 
                            <div class="pl-5 col-md-3">
                                <h2 class="font-weight-bold">{{ $code }}</h2>
                            </div>
                            <input type="hidden" class="form-control" value="{{ $code }}" name="code">
                        </div> 


                        <div class="row d-flex justify-content-center">
                            <div class="mb-4">
                                <h6 class="confirm">Verify all entered details and press confirm</h6>
                            </div>
                        </div> 
                        
                        <button type="button" class="btn btn-success rounded-0 mb-5 prev">Back</button>
                        <button id="next4" class="btn btn-success rounded-0 mb-5 next">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('scripts')
<script>
</script>
@endsection