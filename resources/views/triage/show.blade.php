@extends('triage.app')

@section('content')

<div class="col-md-6 shadow pt-2">
        <div class="">
            <div class="card p-3">
                <div class="row text-left">
                    <div class="col-md-6">
                        <b>DATE : {{ $activity->created_at->format('m/d/Y') }}</b>
                    </div>
                    <div class="col-md-6">
                        <b>FORM NUMBER : {{ sprintf('%04d',$get_form_number->form_number) }}</b>
                    </div>
                </div>
                <div class="row text-left">
                    <div class="col-md-6">
                        <b>ACTIVITY : {{ $activity->activity }}</b>
                    </div>
                    <div class="col-md-6">
                        <b>VENUE : {{ $activity->venue }}</b>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-bordered ">
                <thead>
                    <tr>
                    <th>CRITERIA</th>
                    <th>ANSWER</th>
                    </tr>
                </thead>
                
                <tbody>

                <!-- Category A. -->
                    
                    
                    @foreach( $clients as $client )

                    @if( $client->criteria['id'] == 1 )
                    <tr>
                        <td colspan="3" class="font-weight-bold bg-primary text-light">A. SINTOMAS</td>
                    </tr>

                    @elseif( $client->criteria['id'] == 4 )
                    <tr>
                        <td colspan="3" class="font-weight-bold bg-primary text-light">B. TRAVEL HISTORY</td>
                    </tr>
                    @elseif( $client->criteria['id'] == 6 )
                    <tr>
                        <td colspan="3" class="font-weight-bold bg-primary text-light">C. EXPOSURE HISTORY</td>
                    </tr>
                    @endif
                    <tr>
                        <td>{{ $client->criteria['question'] }}</td>
                        <td class="text-center font-weight-bold">
                            @if(is_null($client->location))
                                {{ $client->answer }}
                            @else
                                {{ $client->location }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table> 

            <div class="row pb-3">
                <div class="col-md-8"></div>
                <div class="col-md-4"><button class="btn btn-primary btn-block">EXIT    </button></div>
            </div>

                
        <!-- Edit part -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('triage.update', $activity->client_id ) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <table class="table table-hover table-bordered ">
                            <thead>
                                <tr>
                                <th>CRITERIA</th>
                                <th>YES</th>
                                <th>NO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $clients as $client )
                                <tr>
                                    <td>{{ $client->criteria['id'].' '.$client->criteria['question'] }}</td>
                                    <td>
                                        <input type="hidden" value="{{$client->id }}" name="triage_id[]">
                                        <input type="radio" name="answer{{ $client->id }}" value="yes" {{ $client->answer == 'yes' ? 'checked' : ''  }}>
                                    </td>
                                    <td>
                                        <input type="radio" name="answer{{ $client->id }}" value="no" {{ $client->answer == 'no' ? 'checked' : ''  }}>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                        <div class="modal-body">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">SAVE</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        <!-- End edit part -->

        </div>
    </div>

</div>
@endsection