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
        
            @if($message1 = Session::get('successful'))
            <div class="col-md-12 alert alert-success" role="alert" id="successAdd">
                {{ $message1 }}
            </div>
            @endif

            <div class="col-md-7 bg-choco border text-warning">
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
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_import"><i class="fas fa-file-import    "></i> Import</button>
                            <a class="btn btn-warning btn-sm" href="{{ route('export') }}"><i class="fas fa-file-export    "></i> Export</a>
                        </div>
                        
                        <div class="col-md-8 d-flex justify-content-end">
                            <a href="" class="btn btn-warning btn-sm"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Temporary verify</a>
                        </div>
                    </div>

                    <h1>REGISTERED CITIZENS</h1>
                </div>
                <div class="alert alert-success" id="untag_alert">
                </div>
                <div class=""> 
                    <div class="row">

                        <div class="col-md-1">
                            <a href="{{route('client.create')}}" title="Add new user"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                        </div>
                       
                    </div>
                   <div class="">
                        <table id="clientTable" class="table bg-choco table-striped table-bordered dt-responsive nowrap text-warning" style="width:100%">
                            <thead class="">
                                <tr>
                                    <th>QR Code</th>
                                    <th>Name</th>
                                    <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                    <!-- <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th> -->
                                </tr>
                            </thead>
                       
                            <tbody>
                            @foreach($newArray as $client)
                                <tr>
                                    <td>{{$client['qrcode']}}</td>
                                    <td>{{$client['first_name'].' '.$client['last_name']}}</td>
                                    <td width="10"></td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        <!-- modal edit -->
                        <div class="modal fade" style="background-image: radial-gradient(#fff3c0 , #fcd538, gold)" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-warning text-primary font-weight-bolder">
                                    <form action="/admin/client" method="post" autocomplete="off">
                                        
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-circle" aria-hidden="true"></i> CLIENT INFORMATION</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;<span>
                                            </button>
                                        </div>
                                        
                                        <div class="modal-body pr-5">
                                            <div class=" container">     
                                                @csrf
                                                <div class="form-group row">
                                                    <input type="hidden" id="client_id" name="client_id">
                                                    <label for="first_name" class="col-md-12 px-0">First name</label>
                                                    <input type="text" name="first_name" class="form-control" id="firstName" >
                                                </div>
                                                <div class="form-group row">
                                                    <label for="middle_name" class="col-md-12 px-0">Middle name</label>
                                                    <input type="text" name="middle_name" class="form-control" id="middle_name" >
                                                </div>
                                                <div class="form-group row">
                                                    <label for="last_name" class="col-md-12 px-0">Last name</label>
                                                    <input type="text" name="last_name" class="form-control" id="last_name" >
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-12 px-0">
                                                        <div class="row container">
                                                            <label for="address" class="col-md-12 px-0">Address</label>
                                                            <input type="text" name="address" class="form-control" id="address" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <daiv class="form-group row">
                                                    <div class="col-md-4 px-0 ">
                                                        <div class="row container">
                                                            <label for="sex" class="col-md-12 px-0">Sex</label>
                                                            <input type="text" name="sex" class="form-control" id="sex" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 px-0 ">
                                                        <div class="row container pr-0">
                                                            <label for="contact_number" class="col-md-12 px-0">Contact #</label>
                                                            <input type="text" name="contact_number" class="form-control" id="contact_number" >
                                                        </div>
                                                    </div>
                                                </daiv>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
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
                    @if($tagErr = Session::get('errorRequired'))
                        <div class="alert alert-danger" role="alert">
                            <span><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                            {{ $tagErr }}
                        </div>
                    @endif
                </div>

            <!-- include modal for establishment registration admin/include_files/modalRegistration -->
                @include('admin.include_files.modalRegistration')
                <div class="">
                    <a href="establishment/create"><span class="fas fa-plus">ADD ESTABLISHMENT</span> </a>
                    <div class="">
                        <div class="modal fade" id="modalTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/tag" method="post" autocomplete="off">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-tag" aria-hidden="true"></i> ADD TAG <span id="office_name"></span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                        <div class="modal-body bg-info">

                                           <div class="form-group row">
                                                <label for="date" class="col-md-4 col-form-label text-md-right"></label>
                                                <div class="col-md-6">
                                                    <b>Note:</b> (<span class="text-danger">*</span>) required field.
                                                </div>
                                           </div>
                                           
                                           <div class="form-group row">
                                                <label for="date" class="col-md-4 col-form-label text-md-right"><span class="text-danger">*</span>Date</label>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="office_id" id="office_id">
                                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date">
                                                    <span class="text-danger">
                                                        @error('date'){{ $message }}@enderror
                                                    </span>
                                                </div>
                                           </div>
                                           
                                           <div class="form-group row">
                                                <label for="time_from" class="col-md-4 col-form-label text-md-right"><span class="text-danger">*</span>Time from</label>
                                                <div class="col-md-6">
                                                    <input type="time" class="form-control @error('time_from') is-invalid @enderror" name="time_from">
                                                    <span class="text-danger">
                                                        @error('time_from'){{ $message }}@enderror
                                                    </span>
                                                </div>
                                           </div>
                                           <div class="form-group row">
                                                <label for="time_to" class="col-md-4 col-form-label text-md-right"><span class="text-danger">*</span> Time to</label>
                                                <div class="col-md-6">
                                                    <input type="time" class="form-control @error('time_to') is-invalid @enderror" name="time_to">
                                                    <span class="text-danger">
                                                        @error('time_to'){{ $message }}@enderror
                                                    </span>
                                                </div>
                                           </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal tags -->
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
            order:[[1,'asc']]
        });
        $('#example1').DataTable();
        
        $(document).on('click','#client_view', function(){            
            
    
            var firstName = $(this).attr('data-firstName');
            var middleName = $(this).attr('data-middleName');
            var lastName = $(this).attr('data-lastName');
            var contactNumber = $(this).attr('data-contactNumber');
            var age = $(this).attr('data-age');
            var sex = $(this).attr('data-sex');
            var address = $(this).attr('data-address');
            var client_id = $(this).attr('data-client_id');

            $('#client_id').val(client_id);
            $('#firstName').val(firstName);
            $('#middle_name').val(middleName);
            $('#last_name').val(lastName);
            $('#address').val(address);
            $('#age').val(age);
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