@extends('triage.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header p-1" style="background-color:#d7e2ea">
                    <h3 class="text-primary shadow text-center">
                        <strong>HISTORY</strong>
                    </h3>
                </div>
                <div class="card-body">
                    <div>
                        <a href="{{ route('triage.create') }}" class="btn btn-primary"><i class="fas fa-pen-alt    "></i> FILL NEW FORM</a>
                    </div>
                    <table class="table table-striped table-bordered">
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
                                    <a href="javascript:void(0)" id="history_link" data-activity="{{ $client->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="history_detials">
                        as
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

