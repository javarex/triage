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



<div class="row ">
    <div class="col-md-6">
        <div class="card shadow ">
            <div class="card-header" style="background-color:#d7e2ea">
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
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
                            @if($client->tag_id != 0)
                            
                            <tr class="table-danger">
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
                                    <a href="{{ route('triage.show', $client->id ) }}" id="history_link" title="View form" data-activity="{{ $client->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              
                
            </div>
            
        </div>
    
    </div>
    
    <div class="col-md-6 bg-light rounded-left shadow-lg p-0">
        <img src="{{ asset('vendor/img/stop_covid.png') }}" width="100%" height="100%" alt="">
    </div>
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>

<!-- Modal -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="printProfile">
        <div class="row container">
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <span style="cursor:pointer" title="Scan me!">{!! QrCode::size('200')->generate(Auth::user()->username) !!}</span>
               
            </div>
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <h1>{{ Auth::user()->first_name.' '.Auth::user()->last_name}}</h1>>
            </div>
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <label for=""><i class="fas fa-mobile-alt    "></i> Contact #: {{ $client_id->contact_number }}</label>
            </div>
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <label for=""><i class="fas fa-map-marker-alt    "></i> Address: {{ $client_id->address }}</label>
            </div>
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate( Auth::user()->username )) !!}" class="btn btn-primary" id="print_qr" download="triage_QRCode"><i class="fa fa-fw fa-save" aria-hidden="true"></i>Save</a>
       
      </div>
    </div>
  </div>
</div>


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