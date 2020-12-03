@extends('layouts.appEstab')

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
                    <h1 class="text-choco">
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
                            <a href="#" class="btn btn-success btn-sm" title="View or Edit this terminal"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Delete this terminal"><i class="fa fa-fw fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="add_establishmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="/addTerminal" method="post" autocomplete="off" id="form_addTerminal">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Terminal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="printProfile">
                        <div class="row container">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" class="form-control-mod" name="number" placeholder="Terminal Number" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control-mod" name="description" placeholder="Terminal Description" required>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  class="btn btn-choco" id="submit_addTerminal">Save</button>                
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           
        })
    </script>
@endsection