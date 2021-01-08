@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="row ">
        <div class="col-md-4"></div>
            <div class="col-md-4 p-2 d-flex justify-content-center " style="background-color:#FFED97;" id="divID">
                <!-- left side content                 -->
                <div class="card  px-0">
                    <div class="card-body pb-0 text-light" style="background-color:#603C03;">
                        <div class="row text-center">
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
                                    <label class="col-md-2 col-2 text-md-right font-weight-bold px-1">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                
                                    <div class="col-md-8 col-8 px-1"> 
                                        {{$Users_name}}
                                    </div>
                                </div>  
                                <!-- birthday       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-birthday-cake    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                    
                                        {{date('F d, Y', strtotime($user->birthday))}}
                                        <b> ({{$years}} Years old)</b>
                                    </div>
                                </div>        
                                <!-- Address       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-map-marker-alt    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                        {{ $address }}
                                    </div>
                                </div>   
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class=""></i></label>
                                    
                                    <div class="col-md-8 px-1"> 

                                    <span class="badge badge-primary">
                                        <!-- <a href="#" class="font-weight-bolder text-light" data-toggle="modal" data-target="#idPrint"> -->
                                        <a href="exportId" class="font-weight-bolder text-light" target="_blank">
                                            <i class="fa fa-print" aria-hidden="true"></i> Print ID
                                        </a> 
                                    </span>
                                    |
                                    <span class="badge badge-success">
                                        <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->color(68, 41, 0)->generate( Auth::user()->qrcode )) !!}" class="font-weight-bolder text-light" id="print_qr" download="DdO_QRCode"><i class="fa fa-fw fa-save" aria-hidden="true"></i>Save qrcode</a>
                                    </span>
                                        <!-- <a href="#" id="printme" class="link" onclick="javascript:printDiv('divID')" style="color: blue;">
                                            <span>
                                                Print ID
                                            </span>
                                        </a> -->
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
