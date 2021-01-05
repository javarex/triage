<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export ID</title>

    <style>
        .id-card{
            width:361px;
            height:2in;
            border:solid black 1px;
            
        }
        .id-body{
            width:270px;
            height:100%;
            border-right:solid black 1px;
            display:inline-block;
        }
        .id-header{
            border-bottom:solid black 1px;
            width:auto;
        }
        .logo{
            width:80px;
            display:inline-block;
        }
        .header1{
            width:80px;
            display:inline-block;
            position:fixed;
            font-size:9pt;
            white-space:nowrap;
            padding-top:25px;
            font-weight:bolder;
        }
        .header2{
            font-size:8pt;
            white-space:nowrap;
            font-weight:bolder;
            text-align:center;
        }

        .info-client{
            font-size:13pt;
            white-space:nowrap;
            font-weight:bolder;
            text-align:center;
        }
        .info-client2{
            font-size:11pt;
            font-weight:bolder;
            text-align:center;
            font-family: Tahoma, sans-serif;
        }
        div{
            margin: 0;
        }
       
    </style>
</head>
<body style="margin-left:30% ;font-family: 'Trebuchet MS', sans-serif;">
    <div class="id-card">
        <div class="id-body">
           <div class="logo"><img src="{{ asset('image/ddo.png') }}" width="75" height="75" alt=""></div>
           <div class="header1">
                <div class="">Republic of the Philippines</div>
                <div>PROVINCE OF DAVAO DE ORO</div>
           </div>
           <div class="header2">Covid-19 Contact Tracing System(CCTS Card)</div>
           <div class="info-client" style="margin-top:20px">
                {{ $Users_name }}
           </div>
           <div class="info-client2" style="font-weight:normal">
                {{ $address }}
           </div>
        </div>

        <div style="position:fixed; display:inline-block;text-align:center; ">
            {!! QrCode::size('90')->color(68, 41, 0)->margin(0)->generate($user->qrcode) !!}
            <div style="font-weight:normal; font-size:7pt; background-color:gold">{{$user->qrcode}}</div>
            <hr>
            <div style="color:grey;font-size:20pt; padding-top:10px">
                1x1
            </div>
        </div>
        
    </div>
</body>
</html>