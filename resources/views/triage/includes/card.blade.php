<div class="row text-center justify-content-center">
                            
    <div id="qrcontainer">
    @if($flag)
        <div class="col-12 text-center">
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($user->qrcode, 'QRCODE',10,10,array(1,1,1), true) }}" class="bg-light p-2"
                id="qr" class="img-fluid" alt="barcode" />
        </div>
        
        <div class="col-md-12">
            <span style="font-size:16px" data-toggle="modal" data-target="#editQrsaaa" title="Edit QR Code">
                <span class="font-weight-bold" id="qrcode_value" style="cursor:pointer">{{$user->qrcode}}</span> 
            </span>
        </div>
    @else
    <div class="alert alert-info" role="alert">
        <strong>Please complete your profile to get your qr code. </strong>
        <br>
        <div class="text-left">
            1. Click account name on upper right. <br>
            2. Account setting->Update profile. <br>
            3. Click edit profile button. <br>
            4. Fill in form and save. <br>
        </div>
    </div>
    @endif
    </div>
    
    <div class="col-md-12 container pt-4 text-left">
        <div class="row">
            <div class="col-1 col-md-1 px-1"><i class="fa fa-user" aria-hidden="true"></i></div>
            
            <div class="col-11 col-md-11 px-1">
                {{ $Users_name }}
            </div>
        </div>  
        <!-- birthday       -->
        <div class="row pt-1  ">
            <div class="col-1 col-md-1 px-1"><i class="fas fa-birthday-cake    "></i></div>
            
            <div class="col-11 col-md-11 px-1"> 
            
                {{date('F d, Y', strtotime($data->birthday))}}
                <b> ({{$years}} Years old)</b>
            </div>
        </div>        
        <!-- Address       -->
        <div class="row pt-1  ">
            <div class="col-1 col-md-1 px-1"><i class="fas fa-map-marker-alt    "></i></div>
            
            <div class="col-11 col-md-11 px-1"> 
                {{ $data->barangay.', '.$data->municipal.', '.$data->province }}
            </div>
        </div>   
        @if($flag)
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
        @endif
    </div>
</div>