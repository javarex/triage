@extends('layouts.appClient')

@section('styles')
<style>
    input[type=text] {
    text-align: center;
    background-color:transparent;
    border:none;
    border-bottom:solid #808a92 1px; 
    border-radius:1px
    }
    input[type=text]:focus{
 
        background-color:transparent;

    }

    ::-webkit-input-placeholder {
    text-align: center;
    }

    :-moz-placeholder {
    text-align: center;
    }
</style>
@endsection

@section('content')
<div class="modal fade" id="adminEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> User's info</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" >
            
            <div class="modal-body d-flex justify-content-center">

              
                <div class="text-center">
                    <span style="cursor:pointer" title="Scan me!">{!! QrCode::size('200')->color(68, 41, 0)->generate(Auth::user()->username) !!}</span>
                    <p>{{Auth::user()->username}}</p>
                </div>

                
                
              
            </div>

                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="row" >
    <div class="col-md-12 m-auto" style="">  
        <div class="card p-3 text-secondary" style="background-image: linear-gradient(to bottom,#fff3c0 , #fcd538);">
            <form action="{{ route('officeLog.create') }}" method="get">
                <div class="row container">
                    <div class="col-md-9">
                        <h1 class="font-weight-bold text-primary">{{ strtoupper(Auth::user()->first_name)}}</h1>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username')}}" placeholder="Enter triage code" maxlength="4" name="clientId">
                            <div class="input-group-append">
                                <button class="btn btn-link text-primary pl-0" title="Fill Triage Form"><i class="far fa-arrow-alt-circle-right fa-2x"></i></button>
                            </div>
                        </div>
                        
                        @if($message = Session::get('usernameErr'))
                            <span class="text-danger">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}
                            </span>
                        @endif
                    
                    </div>
                </div>
            </form>
        </div>
        <div class="card shadow bg-primary text-warning">
            <div class="card-header">
                <div class="col-md-12">
                    <h3 class="text-center">
                
                        <strong><i class="fa fa-history" aria-hidden="true"></i> RECENT LOGS</strong>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-warning"><i class="fas fa-calendar-alt    "></i> Sort by date range</a>
                    <input type="hidden" id="office_id1" value="{{ Auth::user()->office_id }}"> 
                </div>
                <div class="table_log">
                    
                    
                </div>

            </div>
            
        </div>
    
    </div>
    
   
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
    <span id="office_id" data-office="{{ Auth::user()->id}}"></span>
</div>


    <!-- modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sort date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="row container">From</label>
                        <input type="date" id="date_from" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label   label for="" class="row container">To</label>
                        <input type="date" id="date_to" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="search_date">Save changes</button>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        // function get_new_nonApprove(){
        //     $.ajax({
        //         m
        //     });
        // }
        $(document).ready(function() {
            
            $(document).on('click','#search_date', function(){
                var from = $('#date_from').val();
                var to = $('#date_to').val();
                loadData(from, to);
                $('#exampleModal').modal('toggle');
                
            })
            var office_id = $('#office_id1').val();
            loadData('','');
            function loadData(from, to)
            {
                $.ajax({
                    url:'/loadActivity/'+office_id,
                    type: 'get',
                    data:{
                        from:from,
                        to:to
                    },
                    success: function(data){
                        console.log(data);
                        $('.table_log').html(data);
                        $('#example').DataTable({
                            "bSort" : false
                        });


                    }
                });
            }
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // decline || approve activity record

            function updateActivities(id, approve)
            {
                $.ajax({
                    url: 'officeLog/approveStatus/'+id,
                    type: 'post',
                    cache:false,
                    data: {
                        _token:'{{ csrf_token() }}',
                        id:id,
                        approve:approve
                        },
                    success: function(data)
                    {
                           loadData();
                    }
               })
            }
            // set time-out activity

            function setTimeOut(activityId)
            {
                $.ajax({
                    url: 'officeLog/setTimeOut',
                    type: 'post',
                    data: {
                        _token: '{{  csrf_token() }}',
                        id: activityId
                    },
                    success: function(data)
                    {
                        console.log(data);
                        loadData();
                    }
                })
            }

            function setTimeIn(activityId)
            {
                $.ajax({
                    url: 'officeLog/setTimeIn',
                    type: 'post',
                    data: {
                        _token: '{{  csrf_token() }}',
                        id: activityId
                    },
                    success: function(data)
                    {
                        console.log(data);
                        loadData();
                    }
                })
            }
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })
            $(document).on('click', '.approve', function(){
                console.log('ttaa');

                var _confimation = "";
                var activity_id = $(this).data('id');
                var _value = $(this).data('value');
                if(_value == 1){
                    _confimation = confirm("Click ok if you sure to approve...");
                }else if(_value == 2){
                    _confimation = confirm("Click ok if you sure want to decline the request...");
                }else{
                    _confimation = confirm("");
                }

                if(_confimation == true){
                    updateActivities(activity_id,_value);
                }

            })

            $(document).on('click','.time-out', function(){
                
                var _confirmation = confirm("Are you sure to logout this client?");
                if(_confirmation == true)
                {
                    setTimeOut($(this).attr('data-activityId'));
                }
            })

            $(document).on('click','.time-in', function(){
                
                var _confirmation = confirm("Are you sure to login this client?");
                if(_confirmation == true)
                {
                    setTimeIn($(this).attr('data-activityId'));
                }
            })
        })
    </script>
@endsection