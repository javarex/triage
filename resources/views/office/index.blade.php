@extends('layouts.appClient')

@section('content')
<div class="row px-5">
    <div class="col-md-4 m-auto">
        <div class="card p-3">
            <h1>{{ Auth::user()->first_name}}</h1>
        </div>
        <div class="card shadow ">
            <div class="card-header" style="background-color:#d7e2ea">
                <h3 class="text-primary text-center">
                    <strong><i class="fa fa-history" aria-hidden="true"></i> RECENT LOGS</strong>
                </h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th><i class="fas fa-cog    "></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $new_string = "" ?>
                        
                        </tbody>
                    </table>
                </div>

            </div>
            
        </div>
    
    </div>
    
    <div class="col-md-7 row text-center rounded-left shadow-lg">
        <div class="col-md-12 pt-5">
            <h2 class="font-weight-bolder">WELCOME TO DAVAO DE ORO TRIAGE SCREENING</h2>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8 row">
            <input type="text" class="form-control" placeholder="Enter your Triage Code here">
            <input type="text" class="form-control" placeholder="Activity">
        </div>
        <div class="col-md-12 row">
        <div class=col-md-2></div>
            <div class="col-md-4 text-right"><a href="#" class="btn btn-block btn-primary" ><i class="fas fa-pen-alt    "></i> Fill new form</a></div>
            <div class="col-md-4 text-left"><a  href="#" class="btn btn-block btn-primary"><i class="fas fa-clipboard-check    "></i> Already filled a form</a></div>
        </div>
        <!-- <div class="row" >
            <div class="col-md-12">

                <button>ssa</button>
            </div>
            
        </div> -->
    </div>
    <!-- right side -->
    
    <!-- <div class="col-md-12" style='background-image:url("../public/vendor/img/stop_covid.png")'></div> -->
</div>

@endsection