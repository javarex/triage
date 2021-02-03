@extends('layouts.app') 
@section('styles')

@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="col-md-12 pt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-12"  id="divID">
                    <!-- left side content                 -->
                    <div class=" px-0">
                        <div class="card-body shadow d-flex justify-content-center pb-3 text-light" style="background-color:#603C03;border-radius:7px">
                            @include('triage.includes.card')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- right section -->
    <div class="col-md-7">
        <ul class="nav nav-pills nav-fill font-weight-bolder mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active text-choco" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Where you're logged in</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-choco" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Where you're logged out</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <strong>&#183;</strong>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">profie</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>
    </div>
</div>
@endsection