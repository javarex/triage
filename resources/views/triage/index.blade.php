@extends('layouts.app')

@section('styles')
<style>
    #qrcode {
        background: #fff;
        color: #000;
    }

    #qr_container {
        background-color: #603C03;
        border-radius: 5px
    }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 pt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-10 col-md-4" id="divID">
                <!-- left side content                 -->
                <div class=" px-0">
                    <div class="card-body shadow d-flex justify-content-center pb-3 text-light" id="qr_container">
                        <div class="row text-center">
                            <div class="col-md-8 offset-md-2 text-center" id="qrcode">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($user->qrcode, 'QRCODE',10,10,array(1,1,1), true) }}"
                                            class="bg-light img-fluid p-2" alt="barcode" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span style="font-size:16px" data-toggle="modal" data-target="#editQrsaaa"
                                            title="Edit QR Code">
                                            <span class="font-weight-bold" id="qrcode_value"
                                                style="cursor:pointer">{{$user->qrcode}}</span>
                                        </span>
                                    </div>
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
                                <div class="row pt-1">
                                    <div class="col-12 px-1 text-center">
                                        <a href="exportId" class=" btn btn-sm btn-primary font-weight-bolder text-light"
                                            target="_blank">
                                            <i class="fa fa-print" aria-hidden="true"></i> Print ID
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary" id="print_qr"><i
                                                class="fa fa-fw fa-save" aria-hidden="true"></i>Save QR</a>
                                    </div>
                                </div>
                                @if(is_null($user->qredit))
                                <div class="row pt-1  ">
                                    <div class="col-12 col-md-12 px-1 text-center">
                                        OR
                                    </div>
                                    <div class="col-12 col-md-12 px-1 text-center">
                                        <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#qr_edit"><i class="fas fa-edit    "></i> Edit QRcode</a>
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
    <a href="data:image/jpeg;base64,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"
        class="btn btn-sm btn-primary" id="print_qr" download="qrcode.jpeg"><i class="fa fa-fw fa-save"
            aria-hidden="true"></i>Save QR</a>
</div>
<div class="appe"></div>
@include('triage.includes.edit_qr')

@endsection

@section('scripts')
<script src="{{ asset('js/html2canvas.min.js') }}"></script>
<script>
    //saving the qr code
    $(async function () {
var vp = document.getElementById("viewport").getAttribute("content");

document.getElementById("viewport").setAttribute("content", "width=800");

        await html2canvas($("#qrcode")[0], {
        windowWidth: '1280px'
        } ).then(canvas => {
            $('#print_qr').attr( 'href', canvas.toDataURL("image/jpeg")).attr('download','qrcode.jpeg')
             $('.appe').append(canvas)
        }).then(function () {
        document.getElementById("viewport").setAttribute("content", vp);
        });
    })

</script>
@endsection
