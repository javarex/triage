<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export ID</title>

    <style>
        .id-card{
            width:400px;
            height:2in;
            border:solid black 1px;
        }
        .id-body{
            width:270px;
            height:100%;
            border-right:solid black 1px;
           
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
    
    </style>
</head>
<body style="margin-left:30%">
    <div class="id-card">
        <div class="id-body">
           <div class="logo"><img src="{{ asset('image/ddo.png') }}" width="75" height="75" alt=""></div>
           <div class="header1">
                <div class="">Republic of the Philippines</div>
                <div>PROVINCE OF DAVAO DE ORO</div>
           </div>
           <div class="header2">Covid-19 Contact Tracing System(CCTS Card)</div>
        </div>
    </div>
</body>
</html>