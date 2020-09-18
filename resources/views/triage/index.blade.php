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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Venue</th>
                                <th><i class="fas fa-cog    "></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($client_logs as $client)
                            <tr>
                                <td>
                                {{ $client->activity }}
                                </td>
                                <td>
                                    {{ $client->venue }}
                                </td>
                                <td>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @empty
                            <span>No record available</span>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $client_logs->links() }}
                </div>
               
            </div>
        </div>
    </div>

@endsection