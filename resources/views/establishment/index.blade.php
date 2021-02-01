@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="row">
        
        <div class="col-md-8">
            @if($addedTerminal = Session::get('addedTerminal'))     
                <div class="alert alert-success">
                    {{$addedTerminal}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-4 text-nowrap">
                    <h1 class="text-light font-weight-bolder">
                        <i class="fa fa-fw fa-home"></i>TERMINALS
                    </h1>
                </div>
                <div class="col-md-12 d-flex justify-content-start mb-1 ml-2">
                    <button type="button" class="btn btn-choco" data-toggle="modal" data-target="#add_establishmentModal"><i class="fa fa-fw fa-plus"></i> Add Terminal</button>
                </div>
            </div>
            
            
        </div>
        <div class="col-md-12">
           <div class="row">
            @foreach($terminals as $terminal)
                <div id="">
                    <div class="col-md-3" id="">
                        <div class="flip-card ">
                            <div class="flip-card-inner">
                                <div class="flip-card-front bg-light p-2" id="qrcontainer_{{$terminal->id}}">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($terminal->qrcode, 'QRCODE',8,8,array(1,1,1), true) }}">
                                    {{ ucwords($terminal->description ) }}
                                </div>
                                <div class="flip-card-back">
                                    <h1>{{ ucwords($terminal->description ) }}</h1>
                                    <p>
                                        <a href="#" alt="barcode" class="btn btn-sm btn-primary text-light" data-filename="{{$terminal->description}}" data-terminal_id="{{$terminal->id}}" id="print_terminal_qr"><i class="fa fa-fw fa-save"aria-hidden="true"></i>Save QR</a>
                                    </p>
                                    <p>
                                        <a href="#" class="btn btn-sm btn-dark text-light" data-terminal="{{ $terminal->description }}" data-terminal_id="{{$terminal->id}}" id="editTerminal" data-toggle="modal" data-target="#editTerminalModal"><i class="fa fa-fw fa-save"aria-hidden="true"></i>Edit terminal</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
           </div>
        </div>
    </div>

    @include('establishment.includes.modals')
@endsection

@section('scripts')
    <script src="{{ asset('js/html2Canvas.min.js') }}"></script>    
    <script>
        
        function captureQR(element_id,filename) {
            html2canvas(document.querySelector("#"+element_id)).then(canvas => {
                canvas.scrollTo(0,0);
                var a = document.createElement('a');
                // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
                a.download = filename+'.jpg';
                a.click();
            });
            
        }

        var formEdit_id = '';
        $(document).ready(function() {
            $(document).on('click', '#print_terminal_qr', function() {
                var containerQR = "qrcontainer_"+$(this).attr('data-terminal_id');
                var file_name = $(this).attr('data-filename');
                captureQR(containerQR,file_name);
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $(document).on('click','#editTerminal', function () {
                formEdit_id = $(this).attr('data-terminal_id');
                var terminal = $(this).attr('data-terminal');
                $('#terminal_Description').val(terminal.toUpperCase())
            });

           $(document).on('click','#submit_editTerminal', function (){
               var terminalNumber = $('#terminalNumber').val();
               var terminal_Description = $('#terminal_Description').val();
               var terminal_Description = $('#terminal_id').val();
               editTerminal(form_editTerminal,formEdit_id);
           })

            // for qr code terminal 

        //    html2canvas(document.querySelector("#qrcontainer")).then(canvas => {
        //         var href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        //         $('#print_terminal_qr').attr('href', href)
        //     });

            // end qrcode terminal

            $(document).on('click','#show_estab_info', function() {
                getData();
                $('#estab_profile').modal({
                })
            })
        })

        function getData()
        {
            $.ajax({
                type:'GET',
                url:'/establishment/getData',
                success:function(data){
                    console.log(data.establishment.establishment_name)
                }
            })
        }

        function deleteTerminal(){
            $.ajax({
                type:'POST',
                url: '/deleteTerminal/'+terminal_id,
                data:form_inputs,
                dataType:'json',
                success: function(data){
                   
                }
            })
        }

        function editTerminal(form_editTerminal, terminal_id)
        {
            form_inputs = $('#form_editTerminal').serialize();
            $.ajax({
                type:'POST',
                url: '/editTerminal/'+terminal_id,
                data:form_inputs,
                dataType:'json',
                success: function(data){
                    if($.isEmptyObject(data.error)){
                        location.reload(true);
                    }else{
                        $.each(data, function(key, value) {
                            $.notify(value[0], 'error');
                        })
                    }
                }
            })
        }
    </script>
@endsection