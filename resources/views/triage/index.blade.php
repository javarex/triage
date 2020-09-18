@extends('triage.app')

@section('content')

<div class="row px-5">
    <div class="col-md-7 bg-light rounded-left shadow-lg">

    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header" style="background-color:#d7e2ea">
                <h3 class="text-primary text-center">
                    <strong><i class="fa fa-history" aria-hidden="true"></i> HISTORY</strong>
                </h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('triage.create') }}" class="btn btn-primary"><i class="fas fa-pen-alt    "></i> FILL NEW FORM</a>
                </div>
                <table class="table table-striped table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Venue</th>
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
                                {{ $client->venue }}
                            </td>
                            <td>
                                <a href="{{ route('triage.show', $client->id ) }}" id="history_link" data-activity="{{ $client->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @empty
                        <span><?php $new_string = "No Data available" ?></span>
                    @endforelse
                    </tbody>
                </table>
                {{ $new_string }}
                {{ $client_logs->links() }}
            </div>
            
        </div>
    
    </div>
    <!-- right side -->
    
    
</div>


@endsection