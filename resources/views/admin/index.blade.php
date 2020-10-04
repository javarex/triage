@extends('layouts.appAdmin')


@section('styless')

    <style>
        div.ex1 {
        height: 300px;
        overflow: scroll;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 bg-light border">
                <div class="header text-secondary">
                    <h1>Employee and Guest users</h1>
                </div>
                <div class="">
                    <a href="{{route('client.create')}}" title="Add new user"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                   <div class="">
                        <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead class="">
                                <tr>
                                    <th>Triage Code</th>
                                    <th>Name</th>
                                    <th>Office</th>
                                    <th>Action</th>
                                    <!-- <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th> -->
                                </tr>
                            </thead>
                       
                            <tbody>
                            @foreach($clients as $client)
                                @if($client->user['type'] != 'admin')
                                    <tr>
                                    <td>{{ $client->user['username'] }}</td>
                                    <td>{{ $client->first_name.' '.$client->last_name }}</td>
                                    <td>
                                        @if(is_null($client->office['name'] ))
                                            {{ __('N/A') }}
                       
                                        @else
                       
                                            {{ $client->office['name'] }}
                                        @endif
                       
                                    </td>
                                    <td>
                                        <a class="" id="client_view" href="#" data-toggle="modal" data-target="#exampleModal" 
                                        data-firstName="{{ $client->first_name }}"
                                        data-middleName="{{ $client->middle_name }}"
                                        data-lastName="{{ $client->last_name }}"
                                        data-contactNumber="{{ $client->contact_number }}" title="View or edit details">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <span id="first_nameData" ></span>
                                        <span class="text-info">|</span>
                                        <a class="" href="">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <span class="text-info">|</span>
                                        <a href="">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <!-- <td class="text-center">
                                    
                                        <a class="" href="">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <span class="text-info">|</span>
                                        <a class="" href="">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <span class="text-info">|</span>
                                        <a href="">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td> -->
                                    </tr>
                                @endif

                            @endforeach
                            </tbody>
                        </table>
                        <!-- modal edit -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <input type="text" name="first_name" id="first_name">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <span id="firstNameModal"></span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal edit  -->
                   </div>
                </div>
            </div>

            <div class="col-md-5 bg-light">
                <div class="header text-secondary">
                    <h1>Registered Offices</h1>
                </div>

                <div class="">
                    <a href="{{ route('office.create') }}"><span class="fas fa-plus    ">ADD OFFICE</span> </a>
                    <div class="">
                        <table id="example1" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead class="">
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                            @foreach($offices as $office)
                                <tr>
                                    <td >{{ $office->office['name'] }}</td>
                                    <td width="30%" class="text-center">{{ $office->username }}</td>
                                    @if( is_null($office->status))
                                        <td width="30">
                                            <form action="{{ route('office.update',$office->id ) }}" method="post">
                                                @csrf

                                                @method('PATCH')
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="badge badge-primary">
                                                    Click to approve
                                                </button>
                                            </form>
                                        </td>
                                    @else
                                        <td width="30">
                                            <span class="badge badge-primary">Approved</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        $('#example').DataTable({
            order:[[1,'asc']]
        });
        $('#example1').DataTable();
        
        $(document).on('click','#client_view', function(){
            console.log($(this).attr('data-firstName'));
            var firstName = $(this).attr('data-firstName');
            var middleName = $(this).attr('data-middleName');
            var lastName = $(this).attr('data-lastName');
            var contactNumber = $(this).attr('data-contactNumber');
            
            var middleName = $(this).attr('data-middleName');
            $('#firstNameModal').html(firstName+' '+middleName+' '+lastName+' '+contactNumber);

        })
    })
</script>
@endsection