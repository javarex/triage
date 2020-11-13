@extends('triage.app')


@section('content')
<!-- for page loader -->
<div class="o-page-loader">
    <div class="o-page-loader--content">
        <div class="o-page-loader--spinner"></div>
        <div class="o-page-loader--message">
            <span>Loading...</span>
        </div>
    </div>
</div>

<!-- end page loader -->


<div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-4 pt-5" style="background-color:white;">
                <!-- left side content                 -->
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="row text-center">
                            <div class="col-md-12 d-flex justify-content-center text-center ">
                            <img src="{{asset('storage/'.$directory.'/'.Auth::user()->valid_id.'')}}" alt="Image" width="100" height="100"/>
                                @if(is_null(Auth::user()->qredit))
                                    {!! QrCode::size('200')->color(68, 41, 0)->margin(0)->generate(Auth::user()->qrcode) !!}
                                @else
                                    {!! QrCode::size('200')->color(68, 41, 0)->margin(0)->generate(Auth::user()->qredit) !!}
                                @endif
                            </div>
                            <div class="col-md-12">
                                @if(is_null($user->qredit))
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editQr" title="Edit QR Code">
                                    <span class="font-weight-bold">{{Auth::user()->qrcode}}</span> <i class="fas fa-edit    "></i>
                                </a>
                                @else
                                 <span class="" id="editted_qr" style="cursor:pointer">
                                    <i class="fas fa-qrcode    "></i><span class="font-weight-bold">{{Auth::user()->qredit}}</span>
                                 </span>
                                @endif
                            </div>

                            <div class="col-md-12 container pt-4 text-left">
                                <div class="row border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fa fa-user" aria-hidden="true"></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                        {{Auth::user()->first_name.' '.Auth::user()->last_name}}
                                    </div>
                                </div>  
                                <!-- birthday       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-birthday-cake    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                    
                                        {{date('F d, Y', strtotime(Auth::user()->birthday))}}
                                        <b> ({{$years}} Years old)</b>
                                    </div>
                                </div>        
                                <!-- Address       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-map-marker-alt    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                        {{ $address }}
                                    </div>
                                </div>   
                                <!-- Contact number       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fa fa-phone" aria-hidden="true"></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                        {{ucwords(Auth::user()->contact_number)}}
                                    </div>
                                </div>   
                                <!-- Email       -->
                                <div class="row pt-1 ">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-at    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                        {{Auth::user()->email}}
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>

<!-- Modal -->
@include('triage.editQr')

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

       $('#editted_qr').click(function(){
           $.notify('You already change your QR code.','error');
       })
    })
</script>
@endsection