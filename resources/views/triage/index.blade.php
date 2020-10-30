@extends('triage.app')

@section('styless')
    <style>
        img {
            display: block;
            max-width: 100%;
            height: auto;
        }
        
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility:hidden;
            }
            #printSection, #printSection * {
                visibility:visible;
            }
            #printSection {
                position:absolute;
                left:0;
                top:0;
            }
        }


    </style>
@endsection

@section('content')



<div class="row pt-2">
    <div class="col-md-12">
        <div class="card shadow ">
            <div class="card-header" style="background-image: linear-gradient(to bottom,#fff3c0 , #fcd538);">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-primary text-center">
                            <strong><i class="fa fa-history" aria-hidden="true"></i> YOUR RECENT ACTIVITIES</strong>
                        </h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @if(Auth::user()->tag)
                            <div class="col-md-8">
                                <div class="alert alert-danger" role="alert">
                                    <b>Notice: You cannot fill a new form because you are being tagged by the system!</b>
                                </div>
                            </div>
                            <div class="col-md-4 m-auto">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('triage.create') }}" class="btn btn-sm btn-primary disabled" ><i class="fas fa-pen-alt    "></i> FILL NEW FORM</a>
                                </div>
                            </div>
                            @else
                            <div class="col-md-8">
                                
                            </div>
                            <div class="col-md-4 m-auto">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('triage.create') }}" class="btn btn-sm btn-primary" ><i class="fas fa-pen-alt    "></i> FILL NEW FORM</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body"  style="background-image: linear-gradient(to bottom,#fff3c0 , #fcd538);">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%; background-color:#442900; color:#fcd538">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        @foreach($client_logs as $client)
                        {{ dd( $client_logs )}}
                            @if($client->tag_id != 0)
                            
                            <tr class="bg-danger">
                            @else 
                            <tr>
                            @endif
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
                                    {{ date('h:i a', strtotime($client->created_at))}}
                                </td>
                                <td>
                                    <a href="{{ route('triage.show', $client->id ) }}" id="history_link" title="View form" data-activity="{{ $client->id }}" class="text-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              
                
            </div>
            
        </div>
    
    </div>
    
   
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>

<!-- Modal -->
@include('triage.include')


@endsection

@section('scripts')
<script>
    
    function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
    $(document).ready(function (){
        $('#example').DataTable({
            "bSort" : false
        });

        $(document).on('click','#print', function (){
            printElement($('#printProfile'));
        })

       
    })
</script>
@endsection