@extends('layouts.appAdmin')


@section('styles')

    <style>
        div.ex1 {
        height: 300px;
        overflow: scroll;
        }
        .card-text{
            font-size:50pt;
        }
        
    </style>
@endsection

@section('content')
    <div class="row d-flex justify-content-center mt-5 vh-100 ">
       <table>
            <thead>
                <tr>
                    <th>Establishment</th>
                    <th>Address</th>
                    <th>Visitors</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    @foreach($data as $newData)
                        <td>{{$newData['establishment']}}</td>
                        <td>{{$newData['date']}}</td>
                        <td>{{$newData['visitorsCount']}}</td>
                    @endforeach
                </tr>
            </tbody>
       </table>
    </div>
@endsection
