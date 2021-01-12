@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <style>
        .divider{
            border-right: solid #b8b5ab 1px;
            border-bottom:none;
            width: 100%;
        }
        @media only screen and (max-width: 767px)
        {
            .divider{
                border-right:none;
                border-bottom:solid #b8b5ab 1px;
                margin-bottom:10px;
                width: 100%;
            } 
        }
    </style>
@endsection

@section('content')
<div class="">
    <div class="row justify-content-center ">
        <div class="col-12 col-md-12 d-flex justify-content-center">
            <img src="{{ asset('image/triage_h.png') }}" class="pb-2" width="200" >
        </div>

        <div class="col-md-10">
            <div class="bg-primary">
                <div class="card font-weight-bold text-choco shadow" style="background-color:#ffe56c">
                    <form method="POST" action="{{ route('client.store') }}" role="form" autocomplete="off" enctype="multipart/form-data" id="register">
                       @include('client.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('client.privacyNotice')
@endsection

@section('scripts')
    <script src="{{ asset('js/notify.min.js') }}"></script> 
    <script src="{{ asset('js/select2.min.js') }}"></script>
    
    <script>
        var agree = false;
        $(document).ready(function() {

            $(document).on('click','#agree', function(){
                if($(this).prop('checked') == true){
                    $('#submitForm').removeAttr('disabled');
                    $('#submitForm').removeClass('btn-disabled');
                    $('#submitForm').addClass('btn-choco');
                }else{
                    $('#submitForm').attr('disabled', true);
                }
            });
            //birthday script
            $( "#birthday" ).datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1930:2020"
            });
            //birthday script

            // if ($('#province').val() != '') {
            //     $('#municipality').removeAttr('disabled');
            //     loadMunicipals($('#province').val());
            // }



            $(document).on('change','#province', function(){
                var provCode = $(this).find(':selected').attr('data-provCode');
                if($(this).val() != ''){
                    $('#municipality').removeAttr('disabled');
                    
                    loadMunicipals(provCode);
                }else{
                    loadMunicipals(0);
                    $('#municipality').attr('disabled', true);
                }
            });

            //on change municipal 

            $(document).on('change','#municipality', function (){
                var munCode = $(this).find(':selected').attr('data-munCode');
                if($(this).val() != ''){
                    $('#barangay').removeAttr('disabled');
                    loadBarangays(munCode);
                }else{
                    $('#barangay').attr('disabled', true);
                    loadBarangays(0);
                }
            });

            $(document).on('keyup','#password2', function(){
                if($(this).val() == $('#password').val() && $(this).val() !== '')
                {
                    $('#confirm_password').html('<i class="fa fa-check text-success"></i>')
                }else{
                    $('#confirm_password').html('<small class="text-danger font-weight-bold">*</small>')
                }
            })
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#register').submit(function(e){
               
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url:  '/validateInputs',
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

            
            
            // select2 scripts

            // loadProvince();
            $('#province').select2();
            $('#municipality').select2();
            $('#barangay').select2();

           
        })

        // function to load Province

        function loadProvince()
        {
            var output = '<option></option>';
            $.ajax({
                url: '/load/province',
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        output += '<option value="'+value.provDesc+'"  data-provCode="'+value.provCode+'">'+value.provDesc+'</option>';
                       
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
                    $('#municipality').html(output);
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