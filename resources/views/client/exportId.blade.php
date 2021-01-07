<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Export ID</title>

    <style>
        
        .id-card{
            background-image:url("{{ asset('image/ccts_portrait.png') }}");
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /* Resize the background image to cover the entire container */
            width:415px;
            height:500px;
            border:solid black 1px;
            
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
        <div class="col-md-4"></div>
            <div class="col-md-4">
            </div>
            <div class="col-md-12 mt-5 d-flex justify-content-center" >
                <div class="id-card" id="printDiv">
                    
                    <div style="text-align:center; margin-top:295px; white-space: nowrap; font-size:19pt; font-weight:bolder; color:#442900">
                        {{ $Users_name }}
                    </div>
                    <div style="text-align:center; white-space: nowrap; font-size:12pt; color:#442900">
                    {{$address}}
                    </div>
                    <div style="margin-left:270px; margin-top:10px">
                        {!! QrCode::size('120')->color(68, 41, 0, 0)->margin(0)->generate($user->qrcode) !!}
                    </div>
                </div>
                <!-- <span style="margin-left:199px">names</span>
                <img src="{{ asset('image/ccts_id.png') }}" height="192" width="384"  alt=""> -->
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/print.js') }}"></script>

    <script>
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