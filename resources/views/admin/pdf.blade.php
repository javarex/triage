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
                   {{$content}}
                </tr>
            </tbody>
       </table>
    </div>
@endsection
