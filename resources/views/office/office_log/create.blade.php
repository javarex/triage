@extends('layouts.appClient')

@section('content')
<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card p-3 text-secondary">
            <h1>{{ strtoupper(Auth::user()->first_name)}}</h1>
        </div>
        <div class="card shadow ">
            <div class="card-header" style="background-color:#d7e2ea">
                <h3 class="text-primary text-center">
                    <strong><i class="fa fa-history" aria-hidden="true"></i> RECENT LOGS</strong>
                </h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <input type="hidden" id="office_id1" value="{{ Auth::user()->office_id }}"> 
                </div>
                <div class="table_log">
                    
                </div>

            </div>
            
        </div>
    
    </div>
    
    <div class="col-md-6 text-center rounded-left shadow-lg">
       <div class="container">
            <div class="pt-5 pb-2">
                <h3 class="font-weight-bolder">WELCOME TO DAVAO DE ORO TRIAGE SCREENING</h3>
            </div>

           <div class="card card-body shadow" style="border-bottom:solid 4px; border-bottom-color:#3490DC">
                <form action="{{ route('officeLog.store') }}" method="post" autocomplete="off">
               
                    @csrf            
                    
                    <div class="form-group row">
                        <label for="username" class="col-md-2 col-form-label text-md-right"></label>
               
                        <div class="col-md-8">
                            <input type="hidden" name="approve" value="1">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" style="background-color:none; border:none; border-bottom:solid #0c4676 1px; border-radius:1px " value="{{ old('username') }}" placeholder="Enter your Triage Code here" autofocus>
                        </div>
                        <div class="col-md-12">
                        @if($message = Session::get('username'))
                            <span class="text-danger">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}
                            </span>
                        @endif
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="activity" class="col-md-2 col-form-label text-md-right"></label>
               
                        <div class="col-md-8">
                            <input type="text" name="activity" class="form-control @error('activity') is-invalid @enderror" style="background-color:none; border:none; border-bottom:solid #0c4676 1px; border-radius:1px" value="{{ old('activity') }}" placeholder="Activity">
                        </div> 
                        <div class="col-md-12">
                        
                        
               
                        @error('activity')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        </div>
                    </div>
               
                    <div class="form-group row">
               
                        <div class="col-md-2"></div>
                        <div class="col-md-4 text-right">
                        <div class="col-md-2"></div>
                            <button name="submit" class="btn btn-block btn-sm btn-primary mt-1" value="1"><i class="fas fa-pen-alt    "></i> Fill new form</button>
                        </div>
              
                        <div class="col-md-4  text-right">
                            <button name="submit" class="btn btn-block btn-sm btn-primary mt-1" value="2"><i class="fas fa-clipboard-check    "></i> Use existing form</button>
                        </div>
               
                    </div>
               
                </form>
           </div>
       </div>
    </div>
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
    <span id="office_id" data-office="{{ Auth::user()->id}}"></span>
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
            
            var office_id = $('#office_id1').val();
            loadData();
            setInterval(loadData,5000);
            function loadData()
            {
                $.ajax({
                    url:'/loadActivity/'+office_id,
                    type: 'get',
                    success: function(data){
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
            function updateActivities(id, approve)
            {
                $.ajax({
                    url: 'approveStatus/'+id,
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
        })
    </script>
@endsection