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
                        <div class="col-md-12 ">
                            <div class="container">
                                <div id="errorsAlert">
                                    <ul class="list-group">
                                        <li id="errorItems"></li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <h4 class="heading"><i class="fa fa-info-circle" aria-hidden="true"></i> PERSONAL INFORMATION</h4>
                            <div class="col-md-12 ">
                                <div class="row">
                                    <div class="col-md-1 mr-4"></div>
                                    <div class="col-xl-7 col-lg-8 col-10 list text-left"> <label class="text-danger mb-3">* Required</label></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1 mr-4"></div>
                                    <div class="col-md-3">
<<<<<<< HEAD
                                        <label for="first_name" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small> Name</label>
=======
                                        <label for="first_name" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>First Name</label>
>>>>>>> 77f36bc2346deee91269de706cb504f49ac2afad
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  placeholder="Enter First Name" onblur="validate(1)">

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
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  placeholder="Enter Last Name" onblur="validate(2)" >

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
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  placeholder="Purok, Brgy, Municpality, Province" onblur="validate(3)">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="birthday" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>Birthday</label>
                                        <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}"  placeholder="Date of birth" onblur="validate(4)">

                                        @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="sex" class="font-weight-bold d-flex justify-content-left"><small class="text-danger">*</small>Sex</label>
                                        <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror" onblur="validate(5)">
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
                        </div> <button name="next" type="button" id="next1" class="btn btn-success rounded-0 mb-5 next" onclick="validate(0)">Next</button>
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

                                <div class="form-group "> <label class="form-control-label">*User type (Guest/Employee)</label>
                                    <select name="role" id="user_type" class="form-control" onblur="validate2(8)" required>
                                        <option value=""></option>
                                        <option value="1">Employee (Province of Davao de Oro)</option>
                                        <option value="2">Guest</option>
                                    </select> 
                                </div>

                                <div class="form-group user_type_group"> <label class="form-control-label">*Select Office</label>
                                    <select class="form-control" name="office_id" id="office">
                                        <option value=""></option>
                                        @foreach( $offices as $office )
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                </select>
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

    var flagForNameDuplicate = false;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function check_name(first_name, last_name)
    {
        $.ajax({
            url : '/checkDuplication',
            type: 'post',
            data : {
                token: '{{  csrf_token() }}',
                first_name: first_name,
                last_name: last_name,
            },
            success: function(data){
                if(Object.keys(data).length != 0){
                    flagForNameDuplicate = false;
                }
            },
            error: function(reject){
                flagForNameDuplicate=true;
            }
        })
    }

    

    function validate(val) {
        var v1 = document.getElementById("first_name");
        var v2 = document.getElementById("last_name");
        var v3 = document.getElementById("address");
        var v4 = document.getElementById("birthday");
        var v5 = document.getElementById("sex");
        

        var flag = false;

        if(val>=1 || val==0) {
            if(v1.value == "") {
                v1.style.borderColor = "red";
                flag = false;
            }else {
                v1.style.borderColor = "green";
                flag = true;
            }
        }

        if(val>=2 || val==0) {
            if(v2.value == "") {
                v2.style.borderColor = "red";
                flag = false;
            }else {
                v2.style.borderColor = "green";
                flag = true;
            }
        }

        if(val>=3 || val==0) {
            if(v3.value == "") {
                v3.style.borderColor = "red";
                flag = false;
            }else {
                v3.style.borderColor = "green";
                flag = true;
            }
        }

        if(val>=4 || val==0) {
            if(v4.value == "") {
                v4.style.borderColor = "red";
                flag = false;
            }else {
                v4.style.borderColor = "green";
                flag = true;
            }
        }

        if(val>=5 || val==0) {
            if(v5.value == "") {
                v5.style.borderColor = "red";
                flag = false;
            }else {
                v5.style.borderColor = "green";
                flag = true;
            }
        }

        return flag;
    }
    
    function validate2(val)
    {
        var v6 = document.getElementById("contact_number");
        var v7 = document.getElementById("email");
        var v8 = document.getElementById("user_type");
        var flag = false;
        if(val>=6 || val == 0){
            if(v6.value == "") {
                v6.style.borderColor = "red";
                flag = false;
            }else {
                v6.style.borderColor = "green";
                flag = true;
            }
        }

        // if(val>=7 || val == 0){
        //     if(v7.value == "") {
        //         v7.style.borderColor = "red";
        //         flag = false;
        //     }else {
        //         v7.style.borderColor = "green";
        //         flag = true;
        //     }
        // }

        if(val>=8 || val == 0){
            if(v8.value == "") {
                v8.style.borderColor = "red";
                flag = false;
            }else {
                v8.style.borderColor = "green";
                flag = true;
            }
        }
        return flag;
    }
 


$(document).ready(function(){

    //Validate inputs 
    function validateNames(first_name,last_name,){
        var output = '';
        $.ajax({
            url: '/validateInputs',
            type: 'post',
            data: {
                token: '{{  csrf_token() }}',
                first_name:first_name,
                last_name:last_name,
                },
            dataType: 'json',
            success: function(data){
                alert(data.success);
            },
            error: function(xhr, status, error){
                var element = document.getElementById("errorsAlert");
                var element1 = document.getElementById("errorItems");
                element.classList.add('alert','alert-danger');
                element.setAttribute('role','alert');
                element1.classList.add('list-group-item');
                

                $.each(xhr.responseJSON.errors, function (key, item) 
                {
                    output += item[0]+'<br>';
                  
                });
                $('#errorItems').html(output);

            },
        })
    }

    // for userType office

    $('.user_type_group').hide();

    $('#user_type').change(function()
    {
        if($(this).val() == '1')
        {
            $('.user_type_group').fadeIn(600);
            $('#office').attr('required', true);

        }else{
            $('.user_type_group').fadeOut(600);
            $('#office').removeAttr('required');
            $('#office').val('');
        }
        return false;
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user_face').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user_id_pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user_with_id_pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#user_pic").change(function(){
        readURL(this);
    });

    $("#user_pic_id").change(function(){
        readURL1(this);
    });

    $("#user_with_id").change(function(){
        readURL2(this);
    });
    
    $( "#birthday" ).datepicker({
        changeYear: true,
        changeMonth: true,
        yearRange: "1930:2020"
    });

    var current_fs, next_fs, previous_fs;
    var val21 = false;
    var val22 = true;
    var val23 = true;
    $(".next").click(function(){
        var str1 = "next1";
        var str2 = "next2";
        var str3 = "next3";
        var str4 = "next4";
        console.log("kini"+flagForNameDuplicate);
        validateNames($('#first_name').val(),$('#last_name').val());
        if(!str1.localeCompare($(this).attr('id')) && $('#first_name').val() != "" && $('#last_name').val() != "" && $('#address').val() != "" && $('#birthday').val() != "" && $('#sex').val() != "" && flagForNameDuplicate) {
                val21 = true;    
        }
        else {
            val21 = false;
        }

        if ($(this).attr('id') == str2) {
            if(!str2.localeCompare($(this).attr('id')) && $('#contact_number').val() != "" && $('#user_type').val() != "") {
                val21 = true;
                val22 = true;
            }
            else {
                val22 = false;
            }
        }

        if ($(this).attr('id') == str3) {
            if(!str3.localeCompare($(this).attr('id')) && $('#user_pic ').val() != "" && $('#user_id ').val() != "" && $('#user_with_id').val() != "") {
                val21 = true;
                val22 = true;
                val23 = true;
            }
            else {
                val22 = false;
            }
        }
        // if(!str3.localeCompare($(this).attr('id'))){
        //     console.log("success");
        // }
        if((val21 == true && val22 == true) || !str4.localeCompare($(this).attr('id'))) {
            current_fs = $(this).parent().parent();
            next_fs = $(this).parent().parent().next();

            $(current_fs).removeClass("show");
            $(next_fs).addClass("show");

            current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });

                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        }
    });

    $(".prev").click(function(){

        current_fs = $(this).parent().parent();
        previous_fs = $(this).parent().parent().prev();

        $(current_fs).removeClass("show");
        $(previous_fs).addClass("show");

        current_fs.animate({}, {
            step: function() {

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });

            previous_fs.css({
                'display': 'block'
            });
        }
        });
    });
    $("#icon_face").click(function () {
        $("#user_pic").trigger('click');
        
    });
    $("#icon_id").click(function () {
        $("#user_pic_id").trigger('click');
        
    });
    $("#icon_userWithID").click(function () {
        $("#user_with_id").trigger('click');
        
    });
});

</script>
@endsection