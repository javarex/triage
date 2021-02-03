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
                        @include('triage.includes.card')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('triage.includes.edit_qr')

@endsection

@section('scripts')
    <script>
    var flag = false;
    var flag1 = false;
        $(document).ready(function(event){
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
            
          

            $('#saveProfileEdit').click(function(){
                Swal.fire({
                    title: 'Do you want to save the changes?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        if(flag1){
                            Swal.fire('Saved!', '', 'success')
                            $('#profile').modal('hide');
                            $('#profile_edit').submit();
                        }else{
                            $('#profile_edit').submit();
                        }
                    } 
                })
            })
            $('#saveSecurity').click(function(){
                Swal.fire({
                    title: 'Do you want to save the changes?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        if(flag){
                            Swal.fire('Saved!', '', 'success')
                            $('#securitySetup').modal('hide');
                            $('#saveSecurityForm').submit();
                        }else{
                            
                            $('#saveSecurityForm').submit();

                        }
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
                            flag = true;
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
                           flag1=true
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

           $('#birthday').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:2020',
            minDate: new Date(1900, 10 - 1, 25),
            maxDate: '+30Y',
            inline: true
           })
            
           $(document).on('change','#province', function(){
                var provCode = $(this).find(':selected').attr('data-provCode');
                if($(this).val() != ''){
                    $('#municipal').removeAttr('disabled');
                    loadMunicipals(provCode);
                    $('#municipal').html('<option></option>');
                    $('#barangay').html('<option></option>');
                }
                console.log(provCode)
            });

            //on change municipal 

            $(document).on('change','#municipal', function (){
                
                var munCode = $(this).find(':selected').attr('data-munCode');
                if($(this).val() != ''){
                    loadBarangays(munCode);
                     $('#barangay').html('<option></option>');
                }
                
            });
                
           $('#municipal').select2({}).on("select2:open  ", function(e) {
                var provCode = $('#province').find(':selected').attr('data-provCode');
                loadMunicipals(provCode);
            });
         
           $('#barangay').select2({}).on("select2:open  ", function(e) {
                var municipalCode = $('#municipal').find(':selected').attr('data-citymunCode');
                loadBarangays(municipalCode);
            });

            $('#province').select2();
            loadMunicipals($('#province').find(':selected').attr('data-provCode'));
            loadBarangays($('#municipal').find(':selected').attr('data-citymunCode'));

            $('#profile_form').hide();
            $(document).on('click','#button_editInfo', function(){
                $('#profile_form').fadeIn();
            })
        })

        // functions goes here
       

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
            var output;
            $.ajax({
                url: '/load/municipal/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        if($('#municipal option').length < data.length && $('#municipal option').length >= 1 ){
                            if(value.id != $('#municipal').val()){
                                output += '<option value="'+value.id+'"  data-munCode="'+value.citymunCode+'">'+value.citymunDesc+'</option>';
                            }
                        }
                    });
                    
                    $('#municipal').append(output);

                    
                }
            })
        }
        // function to load Barangay

        function loadBarangays(id)
        {
            var output;
            $.ajax({
                url: '/load/barangay/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $.each( data, function( key, value ) {
                        if ($('#barangay option').length < data.length && $('#barangay option').length >= 1 ) {
                            if(value.id != $('#barangay').val()){
                                output += '<option value="'+value.id+'" data-brgyCode="'+value.brgyCode+'">'+value.brgyDesc+'</option>';
                            }
                        }
                    });
                    $('#barangay').append(output);
                }
            })
        }

        function testing()
        {
            console.log('1123')
        }  

    </script>
@endsection 