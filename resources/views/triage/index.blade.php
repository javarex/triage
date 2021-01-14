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
                                <div class="row pt-1  ">
                                    <div class="col-12 col-md-12 px-1 text-center">
                                        <a href="exportId" class=" btn btn-sm btn-primary font-weight-bolder text-light"
                                            target="_blank">
                                            <i class="fa fa-print" aria-hidden="true"></i> Print ID
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary text-light" onclick="downloadqr()"><i
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
</div>
@include('triage.includes.edit_qr')

@endsection

@section('scripts')
<script src="{{ asset('js/html2canvas.min.js') }}"></script>
<script>
    function downloadqr() {
        html2canvas(document.querySelector("#qrcode")).then(canvas => {
            canvas.scrollTo(0, 0);
            var a = document.createElement('a');
            a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg",
                "image/octet-stream");
            a.download = 'qrcode.jpg';
            a.click();
        });
    }

</script>
@endsection
