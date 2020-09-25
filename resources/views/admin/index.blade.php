@extends('layouts.appAdmin')


@section('styless')

    <style>
        div.ex1 {
        height: 300px;
        overflow: scroll;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="header text-secondary">
                    <h1>Employee and Guest users</h1>
                </div>
                <div class="table-responsive">
                    <a href="{{route('client.create')}}" title="Add new user"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                   <div class="ex1">
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
                                @if($client->user['type'] != 'admin')
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
                   </div>
                        {{ $clients->links() }}
                </div>
            </div>

            <div class="col-md-5">
                <div class="header text-secondary">
                    <h1>Registered Offices</h1>
                </div>

                <div class="table-responsive">
                    <a href="{{ route('office.create') }}"><span class="fas fa-plus    ">ADD OFFICE</span> </a>
                    <div class="ex1">
                        <table class="table table-bordered table-striped table-light">
                            <thead class="table-primary">
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                            @foreach($offices as $office)
                                <tr>
                                    <td >{{ $office->office['name'] }}</td>
                                    <td width="30%" class="text-center">{{ $office->username }}</td>
                                    @if( is_null($office->status))
                                        <td width="30">
                                            <form action="{{ route('office.update',$office->id ) }}" method="post">
                                                @csrf

                                                @method('PATCH')
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="badge badge-primary">
                                                    Click to approve
                                                </button>
                                            </form>
                                        </td>
                                    @else
                                        <td width="30">
                                            <span class="badge badge-primary">Approved</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection