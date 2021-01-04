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
        <div class="row ">
        <div class="col-md-4"></div>
            <div class="col-md-4 p-2 d-flex justify-content-center " style="background-color:#FFED97;" id="divID">
                <!-- left side content                 -->
                <div class="card  px-0">
                    <div class="card-body pb-0 text-light" style="background-color:#603C03;">
                        <div class="row text-center">
                            <div class="col-md-12 d-flex justify-content-center text-center">
                                {!! QrCode::size('110')->color(68, 41, 0)->margin(1)->generate($user->qrcode) !!}
                            </div>
                            <div class="col-md-12">
                                <span style="font-size:10px" data-toggle="modal" data-target="#editQrsaaa" title="Edit QR Code">
                                    <span class="font-weight-bold">{{$user->qrcode}}</span> 
                                </span>
                            </div>

                            <div class="col-md-12 container pt-4 text-left">
                                <div class="row border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fa fa-user" aria-hidden="true"></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                        {{$Users_name}}
                                    </div>
                                </div>  
                                <!-- birthday       -->
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-birthday-cake    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 
                                    
                                        {{date('F d, Y', strtotime($user->birthday))}}
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
                                <div class="row pt-1 border border-left-0 border-right-0 border-top-0 border-bottom-1">
                                    <label class="col-md-2 text-md-right font-weight-bold px-1"><i class="fas fa-print    "></i></label>
                                    
                                    <div class="col-md-8 px-1"> 

                                    <span class="badge badge-primary">
                                        <!-- <a href="#" class="font-weight-bolder text-light" data-toggle="modal" data-target="#idPrint"> -->
                                        <!-- <a href="exportId" class="font-weight-bolder text-light" target="_blank"> -->
                                            Print ID
                                        </a>
                                    </span>
                                        <!-- <a href="#" id="printme" class="link" onclick="javascript:printDiv('divID')" style="color: blue;">
                                            <span>
                                                Print ID
                                            </span>
                                        </a> -->
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
    
   

        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body><center></center>" + 
              divElements + "</body></html>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

             
            

          
        }

        function printForm() {
            printJS({
                printable: 'printDiv',
                type: 'html',
                targetStyles: ['*'],
                
            })
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