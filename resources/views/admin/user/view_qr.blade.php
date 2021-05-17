@extends('layouts.appAdmin')


@section('styless')


    <style>
        div.ex1 {
        height: 300px;
        overflow: scroll;
        }
        #loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            margin-left:250px;
            margin-top:250px;
        }   
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
       
    </style>
    
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">

            @if($message1 = Session::get('successful'))
            <div class="col-md-12 alert alert-success" role="alert" id="successAdd">
                {{ $message1 }}
            </div>
            @endif
            @if($message = Session::get('userAdded'))
            <div class="col-md-9 alert alert-success" role="alert">
                {{$message}}
            </div>
            @endif
            
            <div class="col-12 col-md-6 bg-choco border pb-5 text-warning">
                @error('file')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                @if($message1 = Session::get('success_update'))
                <div class="col-md-12 px-0">
                    <div class="alert alert-success"  role="alert">
                        {{ $message1 }}
                    </div>
                </div>
                @endif
                @if($message2 = Session::get('success_import'))
                <div class="col-md-12 px-0">
                    <div class="alert alert-success"  role="alert">
                        {{ $message2 }}
                    </div>
                </div>
                @endif
                

                    <!-- End modal for import -->
                <div class="header pt-2 text-center">
                    <h1>{{$users->first_name}} QRCODE</h1>
                </div>

                <!-- <div class="alert alert-success" id="untag_alert">
                </div> -->
                
                <div class="d-flex justify-content-center"> 
                    <div class="row bg-light px-0">
                        <div class="col-12 text-center px-0">
                            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($users->qrcode, 'QRCODE',10,10,array(1,1,1), true) }}" class="bg-light p-2"
                                id="qr" class="img-fluid" alt="barcode" />
                        </div>
                        <div class="col-md-12 px-0 text-center text-choco">
                            <span style="font-size:16px" data-toggle="modal" data-target="#editQrsaaa" title="Edit QR Code">
                                <span class="font-weight-bold" id="qrcode_value" style="cursor:pointer">{{$users->qrcode}}</span> 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
