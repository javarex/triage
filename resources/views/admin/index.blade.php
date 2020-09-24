@extends('layouts.appAdmin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="header text-secondary">
                    <h1>Employee and Guest users</h1>
                </div>
                <div class="table-responsive">
                    <a href="{{route('client.create')}}" title="Add new user"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                    <table class="table table-bordered table-striped table-light">
                        <thead class="table-primary">
                            <tr>
                                <th>Triage Code</th>
                                <th>Name</th>
                                <th>Office</th>
                                <th>Contact #</th>
                                <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
            
                        <tbody>
                        @foreach($clients as $client)
                            @if($client->user->type != 'admin')
                                <tr>
                                <td>{{ $client->user['username'] }}</td>
                                <td>{{ $client->first_name.' '.$client->last_name }}</td>
                                <td>
                                    @if(is_null($client->office['name'] ))
                                        {{ __('N/A') }}

                                    @else

                                        {{ $client->office['name'] }}
                                    @endif

                                </td>
                                <td>{{ $client['contact_number'] }}</td>
                                <td class="text-center">
                                
                                    <a class="" href="">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <span class="text-info">|</span>
                                    <a class="" href="">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <span class="text-info">|</span>
                                    <a href="">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                        {{ $clients->links() }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="header text-secondary">
                    <h1>List of offices</h1>
                </div>

                <div class="table-responsive">
                    <a href="{{ route('office.create') }}"><span class="fas fa-plus    ">ADD OFFICE</span> </a>
                    <table class="table table-bordered table-striped table-light">
                        <thead class="table-primary">
                            <tr>
                                <th>Office</th>
                                <th>Division</th>
                                <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
            
                        <tbody>
                        @foreach($offices as $office)
                            <tr>
                                <td >{{ $office->name }}</td>
                                <td>{{ __('Division name') }}</td>
                                <td class="text-center">
                                    <a class="" href="">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <span class="text-info">|</span>
                                    <a class="" href="">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <span class="text-info">|</span>
                                    <a href="">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection