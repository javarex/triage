<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title></title>
 <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

 <style>
    
    #citizen {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #citizen td, #citizen th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #citizen tr:nth-child(even){background-color: #f2f2f2;}

    #citizen tr:hover {background-color: #ddd;}

    #citizen th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #242423;
    color: white;
    }
   
    @page { margin: 80px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    
 </style>
</head>
<body class="" >
    <header class="header">
        <h1 style="margin-bottom:-10px">Establishment visit of {{$data['citizen']}}</h1>
        <h3>From: <u>{{ date('F d, Y', strtotime($data['from'])) }}</u> | To: <u>{{date('F d, Y', strtotime($data['to']))  }}</u></h3>
    </header>
    <table id="citizen" class="table" style="width:100%; border: solid black 1px">
        <thead>
            <tr>
                <th>Terminal</th>
                <th>Establishment</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td style="">{{$log->description}}</td>
                    <td style="">{{$log->establishment_name}}</td>
                    <td style="">{{$log->time_in}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    
</body>
</html>