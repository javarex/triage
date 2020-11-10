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
                                {!! QrCode::size('200')->color(68, 41, 0)->margin(0)->generate(Auth::user()->qrcode) !!}
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editQr" title="Edit QR Code">
                                    <span class="font-weight-bold">{{Auth::user()->qrcode}}</span> <i class="fas fa-edit    "></i>
                                </a>
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
                                    </div>
                                </div>        
                                <!-- Gender       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-venus-mars    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                    
                                        {{ucwords(Auth::user()->sex)}}
                                    </div>
                                </div>   
                                <!-- Address       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-map-marker-alt    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                        {{ucwords(Auth::user()->address)}}
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
                                        {{ucwords(Auth::user()->email)}}
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

       
    })
</script>
@endsection