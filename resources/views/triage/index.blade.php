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
        <div class="row">
            <div class="col-md-4" style="background-color:rgba(241, 236, 215, .8)">
                <!-- left side content                 -->
            </div>
            <div class="col-md-4 text-center p-5">
                <div class="col-md-12 d-flex justify-content-center">
                    {!! QrCode::size('200')->color(68, 41, 0)->margin(1)->generate(Auth::user()->qrcode) !!}
                </div>
                <span class="font-weight-bold">{{Auth::user()->qrcode}}</span>
            </div>
        </div>
    </div>
    
   
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>

<!-- Modal -->


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