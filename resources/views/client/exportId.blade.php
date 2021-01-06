<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Export ID</title>

    <style>
        .id-card{
            width:270px;
            height:auto;
            border:solid black 1px;
            
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
/* 
        @media only screen and (max-width: 767px)
        {
            body{
                margin:0;
                padding:10px;
                font-family: 'Trebuchet MS', sans-serif;
            }
        } */
       
    </style>
</head>
<body>
    @include('client.navbar')
    <div class="container">
        <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-4">
                <a href="#" id="printme" class="link" onClick=printForm() style="color: blue;">
                    <span>
                       <i class="fa fa-print" aria-hidden="true"></i> Print ID
                    </span>
                </a>
            </div>
            <div class="col-md-12 d-flex justify-content-center" id="printDiv">
                
                <div class="id-card" >
                    <div class="id-body">
                       <div class="">
                           <div class="logo"><img src="{{ asset('image/ddo.png') }}" class="img-fluid" width="60" alt=""></div>
                           <div class="header1">
                                <div class="">Republic of the Philippines</div>
                                <div>PROVINCE OF DAVAO DE ORO</div>
                           </div>
                       </div>
                       <div class="col-md-12">
                            <div class="header2 text-center">Covid-19 Contact Tracing System(CCTS Card)</div>
                       </div>
                       <div class="col-md-12">
                           <div class="info-client mt-4">
                                {{ $Users_name }}
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="info-client2" style="font-weight:normal">
                                {{ $address }}
                           </div>
                       </div>

                    
                    </div>
                
                </div>
                    <div class="id-body-right">
                        <div style=" display:inline-block;text-align:center; ">
                            {!! QrCode::size('94')->color(68, 41, 0)->margin(0)->generate($user->qrcode) !!}
                            <div class="qrcode_text">{{$user->qrcode}}</div>
                            <div style="color:grey;font-size:20pt; padding-top:20px; border-top:solid black 1px; height:1in;width:1in">
                                1x1
                            </div>
                        </div>
                    </div>
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