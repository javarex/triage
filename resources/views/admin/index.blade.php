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
        @if($message = Session::get('userAdded'))
        <div class="alert alert-success" role="alert">
            {{$message}}
        </div>
        @endif
        <div class="col-md-4">
            <div class="card bg-deGatas text-center">
                <div class=" text-choco">
                    <span style="font-size:50pt; font-weight:bolder">
                        {{ $citizens->count() }}
                    </span><br>
                    <span style="font-size:20pt">Registered Citizens</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card bg-deGatas text-center">
                <div class=" text-choco">
                    <span style="font-size:50pt; font-weight:bolder">
                    {{ $estabLishment->count() }}
                    </span><br>
                    <span style="font-size:20pt">Registered Establishment</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card bg-deGatas text-center">
                <div class=" text-choco">
                    <span style="font-size:50pt; font-weight:bolder">
                    {{ $clients->count() }}
                    </span><br>
                    <span style="font-size:20pt">Total Users</span>
                </div>
            </div>
        </div>
    </div>
@endsection
