@extends('triage.app')

@section('content')

<div class="row mt-2">
    <div class="col-md-7">
        <div class="card shadow" style="background-image: linear-gradient(to bottom,#fff3c0 , #fcd538);">
            <div class="card-header">
                <h3 class="text-primary text-center">
                    <strong><i class="fa fa-history" aria-hidden="true"></i> YOUR RECENT ACTIVITIES</strong>
                </h3>
            </div>
            <div class="card-body">
                <div >
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-warning bg-primary" style="width:100%">
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
                        <?php $new_string = "" ?>
                        @forelse($client_logs as $client)
                    
                            <tr>
                                <td>
                                {{ $client->activity }}
                                </td>
                                <td>
                                    {{ $client->office->name ?? $client->venue }}
                                </td>
                                <td>
                                    {{ $client->created_at->format('m/d/Y') }}
                                </td>

                                <td>
                                    {{ date('h:i a', strtotime($client->created_at))}}
                                </td>
                                <td>
                                    @if($client->id == $url_activity)
                                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                    @else
                                        <a href="{{ route('triage.show', $client->id ) }}" title="View form" id="history_link" class="text-warning" data-activity="{{ $client->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @endif
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
    <!-- right side -->
    
    <div class="col-md-5">
        <div class="card shadow">
            <div class="">
                <div id="history_details" class="">
                    <table class="table table-light table-hover table-bordered table-responsive bg-primary text-warning">
                        <thead>
                            <tr>
                                <th>CRITERIA</th>
                                <th>ANSWER</th>
                            </tr>

                            <tbody>
                                @foreach($triages as $triage)

                                @if( $triage->criteria['id'] == 1 )
                                    <tr>
                                        <td colspan="3" class="font-weight-bold bg-primary text-light">A. SINTOMAS</td>
                                    </tr>

                                @elseif( $triage->criteria['id'] == 4 )
                                    <tr>
                                        <td colspan="3" class="font-weight-bold bg-primary text-light">B. TRAVEL HISTORY</td>
                                    </tr>
                                @elseif( $triage->criteria['id'] == 6 )
                                    <tr>
                                        <td colspan="3" class="font-weight-bold bg-primary text-light">C. EXPOSURE HISTORY</td>
                                    </tr>
                                @endif
                                    <tr>
                                        <td>{{ $triage->criteria['question']}}</td>
                                        <td class="text-nowrap text-center" width="20%">
                                            {{ $triage->answer}}

                                            @if(!(is_null($triage->location)))
                                                <b>({{ $triage->location }})</b>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                    <div class="">
                        <div class="">
                            <div class="col-md-12 ">
                                <button class="btn btn-danger btn-block" onclick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i> BACK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('triage.include')


@endsection

@section('scripts')
<script>
    function goBack() {
    window.history.back();
    }
    $(document).ready(function(){
        $('#example').DataTable({
            "bSort" : false
        });
    })
</script>
@endsection