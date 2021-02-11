<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Export ID</title>

    <style>
        
        .id-card{
            background-image:url("{{ asset('image/ccts_portrait1.png') }}");
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /* Resize the background image to cover the entire container */
            width:286px;
            height:384px;
            border:solid black 1px;
            
        }
        .btn-choco{
            background-color:#442900;color:azure;border-color:azure;
        }
        .text-choco{
            color:#442900;}.bg-choco{background-color:#442900;
        }
        .bg-choco{
            background-color:#442900!important
        }

        /* @media only screen and (max-width: 767px)
        {
            .id-card{
                background-image:url("{{ asset('image/ccts_portrait.png') }}");
                background-position: center; /* Center the image */
                background-repeat: no-repeat; /* Do not repeat the image */
                background-size: cover; /* Resize the background image to cover the entire container */
                width:315px;
                height:380px;
                border:solid black 1px;
                
            }
        } */

        @media print{
            .id-card{
                -webkit-print-color-adjust: exact;
            }
        }
        .id-body{
            width:270px;
            height:100%;
            border-right:solid black 1px;
            display:inline-block;
        }
        .id-body-right{
            width:99px;
            display:inline-block;
            border:solid black 1px;
            padding:1px;
        }
        .id-header{
            border-bottom:solid black 1px;
            width:auto;
        }
        .logo{
            
            display:inline-block;
        }
        .header1{
            width:80px;
            display:inline-block;
            font-size:9pt;
            white-space:nowrap;
            font-weight:bolder;
        }
        .header2{
            font-size:8pt;
            white-space:nowrap;
            font-weight:bolder;
            text-align:center;
            display:inline-block;
        }

        .info-client{
            font-size:13pt;
            white-space:nowrap;
            font-weight:bolder;
            text-align:center;
            display:inline-block;
        }
        .info-client2{
            font-size:10pt;
            font-weight:bolder;
            /* text-align:center; */
            font-family: Tahoma, sans-serif;
            display:inline-block;
        }
        div{
            margin: 0;
        }
        .qrcode_text{
            font-weight:normal; 
            font-size:7pt; 
            background-color:gold;
        }

        
       
    </style>
</head>
<body>
    @include('client.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-3 d-flex justify-content-center" >
                <div class="id-card" id="capture">
                    
                    <div style="text-align:center; margin-top:232px; white-space: nowrap; font-size:13pt; font-weight:bolder; color:#442900">
                        {{ $Users_name }}
                    </div>
                    <div style="text-align:center; white-space: nowrap; font-size:9pt; color:#442900">
                    {{$address}}
                    </div>
                    <div style="margin-left:178px;">
                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($user->qrcode, 'QRCODE',4,4,array(1,1,1), true) }}"
                            class="bg-light p-2" alt="barcode" />
                    </div>
                </div>
                <!-- <span style="margin-left:199px">names</span>
                <img src="{{ asset('image/ccts_id.png') }}" height="192" width="384"  alt=""> -->
            </div>
        </div>
    </div>

    
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('js/print.js') }}"></script> -->
    <script src="{{ asset('js/html2Canvas.min.js') }}"></script>
    <script>

        function captureScreen() {
            html2canvas(document.querySelector("#capture")).then(canvas => {
                canvas.scrollTo(0,0);
                var a = document.createElement('a');
                // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                a.download = 'DdO_CCTS_ID.png';
                a.click();
            });
            
        }
        function printForm() {
            printJS({
                printable: 'printDiv',
                type: 'html',
                targetStyles: ['*'],
                
            })
        }
        
    </script>
</body>
</html>