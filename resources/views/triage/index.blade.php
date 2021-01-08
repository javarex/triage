@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 pt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-10" id="divID">
                <!-- left side content                 -->
                <div class=" px-0">
                    <div class="card-body shadow d-flex justify-content-center pb-3 text-light" style="background-color:#603C03;border-radius:7px">
                        <div class="row pl-3 text-center">
                            <div class="col-md-12 d-flex justify-content-center text-center">
                                {!! QrCode::size('110')->color(68, 41, 0)->margin(1)->generate($user->qrcode) !!}
                            </div>
                            
                            <div class="col-md-12">
                                <span style="font-size:10px" data-toggle="modal" data-target="#editQrsaaa" title="Edit QR Code">
                                    <span class="font-weight-bold">{{$user->qrcode}}</span> 
                                </span>
                            </div>

                            <div class="col-md-12 container pt-4 text-left">
                                <div class="row">
                                    <div class="col-1 col-md-1 px-1"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    
                                    <div class="col-11 col-md-11 px-1"> 
                                        {{$Users_name}}
                                    </div>
                                </div>  
                                <!-- birthday       -->
                                <div class="row pt-1  ">
                                    <div class="col-1 col-md-1 px-1"><i class="fas fa-birthday-cake    "></i></div>
                                    
                                    <div class="col-11 col-md-11 px-1"> 
                                    
                                        {{date('F d, Y', strtotime($user->birthday))}}
                                        <b> ({{$years}} Years old)</b>
                                    </div>
                                </div>        
                                <!-- Address       -->
                                <div class="row pt-1  ">
                                    <div class="col-1 col-md-1 px-1"><i class="fas fa-map-marker-alt    "></i></div>
                                    
                                    <div class="col-11 col-md-11 px-1"> 
                                        {{ $address }}
                                    </div>
                                </div>   
                                <div class="row pt-1  ">
                                    <div class="col-12 col-md-12 px-1 text-center"> 
                                        <a href="exportId" class=" btn btn-sm btn-primary font-weight-bolder text-light" target="_blank">
                                            <i class="fa fa-print" aria-hidden="true"></i> Print ID
                                        </a> 
                                        <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->color(68, 41, 0)->generate( Auth::user()->qrcode )) !!}" class="btn btn-sm btn-primary text-light" id="print_qr" download="DdO_QRCode"><i class="fa fa-fw fa-save" aria-hidden="true"></i>Save QR</a>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
