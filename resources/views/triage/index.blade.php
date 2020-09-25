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



<div class="row px-5">
    <div class="col-md-4 m-auto">
        <div class="card shadow ">
            <div class="card-header" style="background-color:#d7e2ea">
                <h3 class="text-primary text-center">
                    <strong><i class="fa fa-history" aria-hidden="true"></i> YOUR RECENT ACTIVITIES</strong>
                </h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('triage.create') }}" class="btn btn-primary"><i class="fas fa-pen-alt    "></i> FILL NEW FORM</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th><i class="fas fa-cog    "></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $new_string = "" ?>
                        @forelse($client_logs as $client)
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
                                    <a href="{{ route('triage.show', $client->id ) }}" id="history_link" title="View form" data-activity="{{ $client->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @empty
                            <span><?php $new_string = "No Data available" ?></span>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $new_string }}
                {{ $client_logs->links() }}
            </div>
            
        </div>
    
    </div>
    
    <div class="col-md-8 bg-light rounded-left shadow-lg">
        <img src="{{ asset('vendor/img/stop_covid.png') }}" width="100%" heigth="auto" alt="">
    </div>
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>


@endsection