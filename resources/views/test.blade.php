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
    <form action="{{route('test.store')}}" autocomplete="off" method="post">
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
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title text-nowrap">CONFIRMATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <h4 class="heading"></h4>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 ">
                                
                                <div class="form-group row">
                                    <div class="col-md-1 mr-4"></div>
                                    <div class="col-md-3">
                                        <label for="first_name" class="font-weight-bold d-flex justify-content-left">First Name</label>
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  placeholder="Enter First Name" autofocus onblur="validate(1)">

                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="first_name" class="font-weight-bold d-flex justify-content-left">Middle Name</label>
                                        <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}"  placeholder="Enter Middle Name" >

                                        @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="first_name" class="font-weight-bold d-flex justify-content-left">Last Name</label>
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  placeholder="Enter Last Name" onblur="validate(2)">

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
                                        <label for="address" class="font-weight-bold d-flex justify-content-left">Address</label>
                                        <input id="address" type="text" class="form-control @error('first_name') is-invalid @enderror" name="address" value="{{ old('address') }}"  placeholder="Purok, Brgy, Municpality, Province" autofocus>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="birthday" class="font-weight-bold d-flex justify-content-left">Birthday</label>
                                        <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="middle_name" value="{{ old('birthday') }}"  placeholder="Date of birth" autofocus>

                                        @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="sex" class="font-weight-bold d-flex justify-content-left">Sex</label>
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
                        </div> <button name="next" type="button" id="next1" class="btn btn-success rounded-0 mb-5 next">NEXT</button>
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
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">CONFIRMATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 justify-content-center text-center">
                        <h4 class="heading">Feedback</h4>
                        <div class="row justify-content-center mb-4">
                            <div class="col-xl-7 col-lg-8 col-10 list text-left"> <label class="text-danger mb-3">* Required</label>
                                <div class="form-group"> <label class="form-control-label">Subject * :</label> <input type="text" id="sub" name="subject" placeholder="Subject" class="form-control" > </div>
                                <div class="form-group"> <label class="form-control-label">Message * :</label> <textarea type="textarea" id="msg" name="message" placeholder="Message" class="form-control" onblur="validate(2)"></textarea> </div>
                            </div>
                        </div> <button type="button" class="btn btn-success rounded-0 mb-5 prev">Back</button> <button type="button" id="next2" class="btn btn-success rounded-0 mb-5 next" onclick="validate(0)">Submit</button>
                    </div>
                </div>
                <div class="card b-0 rounded-0">
                    <div class="row justify-content-center mx-auto step-container">
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">PERSONAL INFORMATION</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">FEEDBACK</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box active">
                            <h6 class="step-title-0"> <span class="fa fa-circle"></span> <span class="break-line"></span> <span class="step-title">CONFIRMATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 justify-content-center text-center">
                        <h4 class="heading">Confirmation</h4>
                        <div class="row d-flex justify-content-center">
                            <div class="mb-4">
                                <h6 class="confirm">Verify all entered details and press confirm</h6>
                            </div>
                        </div> 
                        
                        <button type="button" class="btn btn-success rounded-0 mb-5 prev">Back</button>
                        <button id="next3" class="btn btn-success rounded-0 mb-5 next">Confirm</button>
                    </div>
                </div>
                <div class="card b-0 rounded-0">
                    <div class="row justify-content-center mx-auto step-container">
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">TERMS AND CONDITIONS</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">ACCOUNT SETUP</span> </h6>
                        </div>
                        <div class="col-md-3 col-4 step-box">
                            <h6 class="step-title-0"> <span class="fa fa-check"></span> <span class="break-line"></span> <span class="step-title">CONFIRMATION</span> </h6>
                        </div>
                    </div>
                    <div class="p-3 justify-content-center text-center">
                        <h3 class="heading">Thank You for your Feedback!</h3>
                        <div class="row justify-content-center">
                            <div class=""> <img src="https://i.imgur.com/4Y9xMCF.gif" class="fit-image mb-5"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function validate(val) {
        var v1 = document.getElementById("first_name");
        var v2 = document.getElementById("last_name");

        var flag = true;

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

        return flag;
    }

    $( function() {
        $( "#birthday" ).datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "1930:2020"
        });
    } );

$(document).ready(function(){

    var current_fs, next_fs, previous_fs;
    var val21 = false;
    var val22 = false;
    $(".next").click(function(){

        str1 = "next1";
        str2 = "next2";
        str3 = "next3";


        
        if(!str2.localeCompare($(this).attr('id')) && document.getElementById("sub").value != "") {
            val21 = true;
        }
        else {
            val21 = false;
        }

        if(!str2.localeCompare($(this).attr('id')) && document.getElementById("msg").value != "") {
            val22 = true;
        }
        else {
            val22 = false;
        }

        if((!str1.localeCompare($(this).attr('id')) ) || (!str2.localeCompare($(this).attr('id')) && val21 == true && val22 == true) || !str3.localeCompare($(this).attr('id'))) {
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
});

</script>
@endsection