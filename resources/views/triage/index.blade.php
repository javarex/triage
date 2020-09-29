@extends('triage.app')

@section('styless')
    <style>
        img {
            display: block;
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@section('content')



<div class="row ">
    <div class="col-md-5 m-auto">
        <div class="card shadow ">
            <div class="card-header" style="background-color:#d7e2ea">
                <h3 class="text-primary text-center">
                    <strong><i class="fa fa-history" aria-hidden="true"></i> YOUR RECENT ACTIVITIES</strong>
                </h3>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('triage.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-pen-alt    "></i> FILL NEW FORM</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th><i class="fas fa-cog    "></i></th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        @foreach($client_logs as $client)
                            <tr>
                                <td>
                                {{ $client->activity }}
                                </td>
                                <td>
                                    @if( is_null($client->office_id))
                                        {{ $client->venue }}
                                    @else
                                        {{ $client->office['name'] }}
                                    @endif
                                </td>
                                <td>
                                    {{ $client->created_at->format('m/d/Y')}}
                                </td>
                                <td>
                                    {{ date('h:i a', strtotime($client->created_at))}}
                                </td>
                                <td>
                                    <a href="{{ route('triage.show', $client->id ) }}" id="history_link" title="View form" data-activity="{{ $client->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              
                
            </div>
            
        </div>
    
    </div>
    
    <div class="col-md-6 bg-light rounded-left shadow-lg p-0">
        <img src="{{ asset('vendor/img/stop_covid.png') }}" width="100%" height="100%" alt="">
    </div>
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>


@endsection

@section('scripts')
        <script>
            $(document).ready(function (){
                $('#example').DataTable();
            })
        </script>
@endsection