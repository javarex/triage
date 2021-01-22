@extends('layouts.app')

@section('styles')
<style>
#qrcontainer{
    background: #fff;
    color: #000;
}
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 pt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-10 col-md-4"  id="divID">
                <!-- left side content                 -->
                <div class=" px-0">
                    <div class="card-body shadow d-flex justify-content-center pb-3 text-light" style="background-color:#603C03;border-radius:7px">
                        <div class="row text-center justify-content-center">
                            
                            <div id="qrcontainer">
                                <div class="col-12 text-center">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($user->qrcode, 'QRCODE',10,10,array(1,1,1), true) }}" class="bg-light p-2"
                                        id="qr" class="img-fluid" alt="barcode" />
                                </div>
                                
                                <div class="col-md-12">
                                    <span style="font-size:16px" data-toggle="modal" data-target="#editQrsaaa" title="Edit QR Code">
                                        <span class="font-weight-bold" id="qrcode_value" style="cursor:pointer">{{$user->qrcode}}</span> 
                                    </span>
                                </div>
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
                                            <i class="fa fa-id-card" aria-hidden="true"></i> Export ID
                                        </a> 
                                        <!-- <a href="data:image/png;base64,{{ DNS2D::getBarcodePNG($user->qrcode, 'QRCODE',10,10,array(1,1,1)) }}"
                                            alt="barcode"
                                            class="btn btn-sm btn-primary text-light" id="print_qr"
                                            download="DdO_QRCode"><i class="fa fa-fw fa-save"
                                                aria-hidden="true"></i>Save QR</a>  -->
                                                 <a href="#"
                                                     alt="barcode" class="btn btn-sm btn-primary text-light"
                                                     id="print_qr" download="DdO_QRCode.png"><i class="fa fa-fw fa-save"
                                                         aria-hidden="true"></i>Save QR</a>
                                    </div>
                                </div>   
                                @if(is_null($user->qredit))
                                <div class="row pt-1  ">
                                    <div class="col-12 col-md-12 px-1 text-center"> 
                                       OR
                                    </div>
                                    <div class="col-12 col-md-12 px-1 text-center"> 
                                       <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#qr_edit"><i class="fas fa-edit    "></i> Edit QRcode</a>
                                    </div>
                                </div>
                                @endif   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('triage.includes.edit_qr')

@endsection

@section('scripts')
 <script src="{{ asset('js/html2Canvas.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            html2canvas(document.querySelector("#qrcontainer")).then(canvas => {
                var href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                $('#print_qr').attr('href', href)
            });
        })
    </script>
@endsection 