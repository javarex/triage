@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
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
<script src="{{ asset('js/notify.min.js') }}"></script> 
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/html2Canvas.min.js') }}"></script>
<script src="{{ asset('js/swal.min.js') }}"></script>
    <script>
    var flag = false;
        $(document).ready(function(){
            html2canvas(document.querySelector("#qrcontainer")).then(canvas => {
                var href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                $('#print_qr').attr('href', href)
            });

            $(document).on('keyup','#password,#password2', function(){
                $('#match').removeClass().html('');
                if($('#password').val() === $('#password2').val())
                {
                    flag=true;
                    $('#match').addClass('badge badge-success').html('Password match');
                }else{
                    flag=false;
                }
            })
            
            $(document).on('change','#province', function(){
                var provCode = $(this).find(':selected').attr('data-provCode');
                if($(this).val() != ''){
                    $('#municipal').removeAttr('disabled');
                    
                    loadMunicipals(provCode);
                }else{
                    loadMunicipals(0);
                    $('#municipal').attr('disabled', true);
                }
            });

            //on change municipal 
            $(document).on('click','#municipal',function(){
                var provinceCode = provCode = $('#province').find(':selected').attr('data-provCode');
                loadMunicipals(provinceCode);
            })
            $(document).on('change','#municipal', function (){
                var provinceCode = provCode = $('#province').find(':selected').attr('data-provCode');
                loadMunicipals(provinceCode);
                var munCode = $(this).find(':selected').attr('data-munCode');
                if($(this).val() != ''){
                    $('#barangay').removeAttr('disabled');
                    loadBarangays(munCode);
                }else{
                    $('#barangay').attr('disabled', true);
                    loadBarangays(0);
                }
            });

            $('#saveProfileEdit').click(function(){
                Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Save`,
                    denyButtonText: `Don't save`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success')
                        $('#profile').modal('hide');
                        $('#profile_edit').submit();
                    } else if (result.isDenied) {
                        $('#profile').modal('hide');
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            })
            $('#saveSecurity').click(function(){
                Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Save`,
                    denyButtonText: `Don't save`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success')
                        $('#securitySetup').modal('hide');
                        $('#saveSecurityForm').submit();
                    } else if (result.isDenied) {
                        $('#securitySetup').modal('hide');
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            })
            

            $('#saveSecurityForm').submit(function(e){
            
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url:  '/updateSecurity',
                type: 'POST',              
                data: formData,
                cache       : false,
                contentType : false,
                processData : false,
                success: function(result)
                {
                    if($.isEmptyObject(result.error)){
                        window.location.href = "/";
                    }else{
                        $.each(result, function(key, value) {
                            $.notify(value, 'error');
                        })
                    }
                },
                error: function(xhr, status, error)
                {
                    $.each(xhr.responseJSON.errors, function (key, item) 
                    {
                        $.notify(item[0], 'error');
                        return false;
                    });
                },
            });

        });
        

            $('#profile_edit').submit(function(e){
               
               e.preventDefault();
               var formData = new FormData(this);
               $.ajax({
                   url:  '/profile_edit',
                   type: 'POST',              
                   data: formData,
                   cache       : false,
                   contentType : false,
                   processData : false,
                   success: function(result)
                   {
                       if($.isEmptyObject(result.error)){
                           window.location.href = "/";
                       }else{
                           $.each(result, function(key, value) {
                               $.notify(value, 'error');
                           })
                       }
                   },
                   error: function(xhr, status, error)
                   {
                       $.each(xhr.responseJSON.errors, function (key, item) 
                       {
                          $.notify(item[0], 'error');
                          return false;
                       });
                   },
               });

           });
           

           $('#province').select2();
            $('#municipal').select2();
            $('#barangay').select2();
        })

        // functions goes here
        function filterData()
        {
            alert('hehehe')
        }

        function loadProvince()
        {
            var output = '<option></option>';
            $.ajax({
                url: '/load/province',
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        output += '<option value="'+value.id+'"  data-provCode="'+value.provCode+'">'+value.provDesc+'</option>';
                       
                    });

                    $('#province').html(output);
                }
            })
        }

         // function to load municipality

         function loadMunicipals(id)
        {
            var output = '<option></option>';
            $.ajax({
                url: '/load/municipal/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        output += '<option value="'+value.id+'"  data-munCode="'+value.citymunCode+'">'+value.citymunDesc+'</option>';
                       
                    });
                    $('#municipal').html(output);
                }
            })
        }
        // function to load Barangay

        function loadBarangays(id)
        {
            var output = '<option></option>';
            $.ajax({
                url: '/load/barangay/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        output += '<option value="'+value.id+'">'+value.brgyDesc+'</option>';
                    });
                    $('#barangay').html(output);
                }
            })
        }

    </script>
@endsection 