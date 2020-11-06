@extends('layouts.app')
@section('styless')
<style>
    .card.show {
        display: block !important
    }

    .card {
        display: none;
        background-color: #E0F7FA;
        border: 1px solid #E0F7FA;
        box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
    }

    .step-container {
        border-top: 1px solid lightgrey;
        border-bottom: 1px solid lightgrey;
        width: 99.85%;
        margin-top: 70px;
        margin-bottom: 10px
    }

    .fa-circle {
        background-color: lightgrey;
        color: #fff;
        padding: 2px 3.1555px;
        border-radius: 50%
    }

    .step-box {
        padding: 10px;
        border-left: 1px solid lightgrey;
        border-right: 1px solid lightgrey;
        background-color: #fff
    }

    .active {
        background-color: #2196F3;
        color: #fff !important;
        border-left: 1px solid #2196F3;
        border-right: 1px solid #2196F3
    }

    .active .fa-circle {
        background-color: #fff !important;
        color: #2196F3
    }

    .fa-check {
        border-radius: 50%;
        background-color: #00C853;
        color: #fff;
        padding: 3px
    }

    .step-title-0 {
        margin-bottom: 0px
    }

    .step-title {
        font-size: 13px;
        position: relative;
        margin-left: 4px
    }


    input,
    textarea,
    button {
        padding: 8px 15px 8px 15px;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        color: #2C3E50;
        background-color: #ECEFF1;
        border: 1px solid #ccc;
        font-size: 16px;
        letter-spacing: 1px
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid skyblue !important;
        outline-width: 0
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid green !important;
        outline-width: 0
    }

    textarea {
        height: 100px
    }

    button {
        width: 120px;
        letter-spacing: 2px
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }

    @media screen and (max-width: 768px) {
        .break-line {
            display: block;
            float: none;
        }
    }
</style>
@endsection
@section('content')
<div class="container-fluid px-1 py-5 mx-auto">
    
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection