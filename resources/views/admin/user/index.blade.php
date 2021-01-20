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
    <div class="row d-flex justify-content-center">

            @if($message1 = Session::get('successful'))
            <div class="col-md-12 alert alert-success" role="alert" id="successAdd">
                {{ $message1 }}
            </div>
            @endif
            @if($message = Session::get('userAdded'))
            <div class="col-md-9 alert alert-success" role="alert">
                {{$message}}
            </div>
            @endif
            
            <div class="col-12 col-md-10 bg-choco border text-warning">
                @error('file')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                @if($message1 = Session::get('success_update'))
                <div class="col-md-12 px-0">
                    <div class="alert alert-success"  role="alert">
                        {{ $message1 }}
                    </div>
                </div>
                @endif
                @if($message2 = Session::get('success_import'))
                <div class="col-md-12 px-0">
                    <div class="alert alert-success"  role="alert">
                        {{ $message2 }}
                    </div>
                </div>
                @endif
                
                <!-- Start modal for import -->
                
                <div class="modal fade" id="modal_import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary" id="exampleModalLabel">Select File</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <form enctype="multipart/form-data" method="post" action="{{ url('/import') }}">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="file" name="file"  class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Upload">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                    <!-- End modal for import -->
                <div class="header pt-2">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_import"><i class="fas fa-file-import    "></i> Import</button> -->
                            <a class="btn btn-warning btn-sm" href="{{ route('export') }}"><i class="fas fa-file-export    "></i> Export Data</a>
                        </div>
                        
                        <div class="col-md-8 d-flex justify-content-end">
                            <!-- <a href="" class="btn btn-warning btn-sm"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Temporary verify</a> -->
                        </div>
                    </div>

                    <h1>REGISTERED CITIZENS</h1>
                </div>

                <!-- <div class="alert alert-success" id="untag_alert">
                </div> -->
                
                <div class=""> 
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{route('client.create')}}" title="Add new user"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <table id="clientTable" class="table bg-choco table-striped table-bordered dt-responsive nowrap text-warning" style="width:100%">
                        <thead class="">
                            <tr>
                                <th>QR Code</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Barangay</th>
                                <th>Municipal</th>
                                <th>Province</th>
                                <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                <!-- <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($newArray as $client)
                            <tr>
                                <td>{{$client['qrcode']}}</td>
                                <td>{{$client['first_name'].' '.$client['last_name']}}</td>
                                <td width="20">{{$client['age']}}</td>
                                <td width="30">{{$client['gender']}}</td>
                                <td> {{ $client['barangay'] }} </td>
                                <td> {{ $client['municipal'] }} </td>
                                <td> {{ $client['province'] }} </td>
                                <td>
                                    <a href="#" id="client_view" data-toggle="modal" data-target="#edit_user" 
                                    data-client_id="{{ $client['id'] }}"
                                    data-firstName="{{ $client['first_name'] }}"
                                    data-middleName="{{ $client['middle_name'] }}"
                                    data-lastName="{{ $client['last_name'] }}"
                                    data-birthday="{{ $client['birthday'] }}"
                                    >
                                        <i class="fas fa-edit    "></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        
                        </tbody>
                    </table>
                    {{ $clients->links() }}
                    <p class="d-flex justify-content-end">Showing {{ $clients->firstItem() }} to {{ $clients->lastItem() }}of total {{$clients->total()}} entries</p>
                </div>
            </div>

            
        </div>
    </div>

    @include('admin.user.editUser')
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        $('#untag_alert').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // untag person

        function untag(id)
        {
            $.ajax({
            url: 'untag',
            type: 'post',
            data: {
                _token:'{{ csrf_token() }}',
                id:id
            },
            success: function(data){
                $('#untag_alert').html(data).show();
            }
        })
        }

        $('#clientTable').DataTable({
            order:[[1,'asc']],
            "bPaginate": false,
            "bInfo": false,
        });
        $('#example1').DataTable();
        
        $(document).on('click','#client_view', function(){            
            
    
            var firstName = $(this).attr('data-firstName');
            var middleName = $(this).attr('data-middleName');
            var lastName = $(this).attr('data-lastName');
            var contactNumber = $(this).attr('data-contactNumber');
            var birthday = $(this).attr('data-birthday');
            var sex = $(this).attr('data-sex');
            var address = $(this).attr('data-address');
            var client_id = $(this).attr('data-client_id');

            $('#client_id').val(client_id);
            $('#firstName').val(firstName);
            $('#middleName').val(middleName);
            $('#lastName').val(lastName);
            $('#address').val(address);
            $('#birthday').val(birthday);
            $('#sex').val(sex);
            $('#contact_number').val(contactNumber);
            // $('#firstNameModal').html(firstName+' '+middleName+' '+lastName+' '+contactNumber);
            

        })
        $(document).on('click','#tags', function(){
            $('#office_name').html('<b>'+$(this).attr('data-officeName')+'</b>');
            $('#office_id').val($(this).attr('data-office_id'));
        })

        $(document).on('click','#untag', function(){
            var userId = $(this).attr('data-userId');
            // console.log($(this).attr('data-userId'));
            var _confirmation = confirm("Are you sure to confirm the selected user?");
            if(_confirmation == true)
            {
                untag(userId);
            }
        })
    })
</script>
@endsection