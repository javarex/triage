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
                <div id="qrcontainer">
                    <div class="col-md-3" id="">
                        <div class="flip-card bg-light ">
                            <div class="flip-card-inner mt-1">
                                <div class="flip-card-front">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($terminal->qrcode, 'QRCODE',8,8,array(1,1,1), true) }}">
                                    {{ ucwords($terminal->description ) }}
                                </div>
                                <div class="flip-card-back">
                                    <h1>{{ ucwords($terminal->description ) }}</h1>
                                    <p>
                                        <a href="#" alt="barcode" class="btn btn-sm btn-primary text-light" id="print_qr" download="{{$terminal->description}}.png"><i class="fa fa-fw fa-save"aria-hidden="true"></i>Save QR</a>
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

        var formEdit_id = '';
        $(document).ready(function() {

            $(document).on('click', '.terminal', function() {
                // var terminal_qr = "http://ddoqr.dvodeoro.ph/" + $(this).attr('data-qr');
                // $("#qr").attr('src',"data:image/png;base64," + "{!! DNS2D::getBarcodePNG(" + terminal_qr + ",'QRCODE',10,10,array(1,1,1), true) !!}")
            })


            $('#terminal_info').on('hidden.bs.modal', function () {
                 location.reload();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $(document).on('click','#terminalEdit_btn', function () {
                formEdit_id = $(this).attr('data-terminal_id');
            });
           $(document).on('click','#submit_editTerminal', function (){
               var terminalNumber = $('#terminalNumber').val();
               var terminal_Description = $('#terminal_Description').val();
               var terminal_Description = $('#terminal_id').val();
               editTerminal(form_editTerminal,formEdit_id);
           })

            // for qr code terminal 

           html2canvas(document.querySelector("#qrcontainer")).then(canvas => {
                var href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                $('#print_terminal_qr').attr('href', href)
            });

            // end qrcode terminal
        })

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