@extends('triage.app')

@section('content')

<div class="row">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header" style="background-color:#d7e2ea">
                <h3 class="text-primary text-center">
                    <strong><i class="fa fa-history" aria-hidden="true"></i> YOUR RECENT ACTIVITIES</strong>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-2 text-center">
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
                                    <a href="{{ route('triage.show', $client->id ) }}" title="View form" id="history_link" data-activity="{{ $client->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
    
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-body">
                <div id="history_details">
                    <table class="table table-striped table-bordered">
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
                                        <td class="text-nowrap">
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
                    <div class="d-flex justify-content-end">
                        <div class="col-md-12 row d-flex justify-content-end">
                            <div class="col-md-5 ">
                                <button class="btn btn-danger btn-block" onclick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i> BACK</button>
                            </div>
                            <div class="col-md-5 ">
                                <a href="{{ route('triage.create') }}" class="btn btn-primary btn-block"><i class="fas fa-pen-alt    "></i> FILL NEW FORM</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    function goBack() {
    window.history.back();
    }
</script>
@endsection