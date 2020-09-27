@extends('layouts.appClient')

@section('content')
<div class="row px-5">
    <div class="col-md-5 m-auto">
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
                    
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th><i class="fas fa-users    "></i></th>
                                <th>Activity</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th><i class="fas fa-cog    "></i></th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($clients as $client)
                                <tr>
                                    <td>{{ $client->client->first_name.' '.$client->client->last_name }}</td>
                                    <td>{{ $client->activity }}</td>
                                    <td>{{ $client->venue }}</td>
                                    <td>{{ $client->created_at->format('m/d/Y') }}</td>
                                    <td>
                                        <a href="" title="details">
                                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
            
        </div>
    
    </div>
    
    <div class="col-md-7 text-center rounded-left shadow-lg">
       <div class="container">
            <div class="pt-5 pb-2">
                <h3 class="font-weight-bolder">WELCOME TO DAVAO DE ORO TRIAGE SCREENING</h3>
            </div>

            <form action="{{ route('officeLog.store') }}" method="post" autocomplete="off">

                @csrf            
                
                <div class="form-group row">
                    <label for="username" class="col-md-3 col-form-label text-md-right"></label>

                    <div class="col-md-6">
                        <input type="hidden" name="approve" value="1">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Enter your Triage Code here" autofocus>
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
                    <label for="activity" class="col-md-3 col-form-label text-md-right"></label>

                    <div class="col-md-6">
                        <input type="text" name="activity" class="form-control @error('activity') is-invalid @enderror" value="{{ old('activity') }}" placeholder="Activity">
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
                    <div class="col-md-3"></div>

                    <div class="col-md-3 text-right">
                        <button name="submit" class="btn btn-block btn-sm btn-primary" value="1"><i class="fas fa-pen-alt    "></i> Fill new form</button>
                    </div>

                    <div class="col-md-3 text-right">
                        <button name="submit" class="btn btn-block btn-sm btn-primary" value="2"><i class="fas fa-clipboard-check    "></i> Use existing form</button>
                    </div>

                </div>

            </form>
       </div>
    </div>
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>

@endsection

@section('scripts')
    <script>

        function get_new_nonApprove(){
            $.ajax({
                m
            });
        }
        $(document).ready(function() {
            
        })
    </script>
@endsection