@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            
        </div>
        <div class="col-md-8">
            @if($addedTerminal = Session::get('addedTerminal'))     
                <div class="alert alert-success">
                    {{$addedTerminal}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-5">
                    <h1 class="text-light">
                        <i class="fa fa-fw fa-home"></i>TERMINALS
                    </h1>
                </div>
                <div class="col-md-7 d-flex justify-content-end mb-1">
                    <button type="button" class="btn btn-choco" data-toggle="modal" data-target="#add_establishmentModal"><i class="fa fa-fw fa-plus"></i> Add Terminal</button>
                </div>
            </div>
            <table class="table bg-choco text-warning table-striped table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Terminal Number</th>
                        <th>Terminal Discription</th>
                        <th class="text-center"><i class="fa fa-fw fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($terminals as $terminal)
                    <tr>
                        <td>{{$terminal->number}}</td>
                        <td>{{$terminal->description}}</td>
                        <td  class="text-center w-25">
                            <a href="#" class="btn btn-success btn-sm" data-terminal_id="{{$terminal->id}}" id="terminalEdit_btn" title="View or Edit this terminal" data-toggle="modal" data-target="#editTerminal"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" data-terminal_id="{{$terminal->id}}" title="Delete this terminal"><i class="fa fa-fw fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('establishment.includes.modals')
@endsection

@section('scripts')
    <script>
        var formEdit_id = '';
        $(document).ready(function() {
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