@extends('layouts.appAdmin')

@section('styles')
<style>
    thead{
        border-top: 5px solid transparent;
    }
    .table-logs > td {
        white-space: nowrap;
    }
    @media only screen and (max-width: 600px) {
        .table-logs> td{
           white-space: normal;
        }
    }
</style>
@endsection

@section('content')
    <div>
        <div class="d-flex justify-content-center">
            <div class="col-xl-9">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="font-weight-bolder">Logs</h3>
                    </div>
                    <div class="card-body">
                        <table class="table dt-responsive" id="logs_table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Establishment</th>
                                    <th>Terminal</th>
                                    <th>Address</th>
                                    <th>Contact No</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $('#logs_table').DataTable({
        processing: true,
        'language':{
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner-border text-choco "></div>'
        },
        serverSide:true,
        ajax:{
            "url": '/logs/get_user',
            "dataType": "json",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}"}
        },
        columns:[
            {data:'name'},
            {data:'establishment'},
            {data:'terminal'},
            {data:'address'},
            {data:'contact_no'},
            {data:'date'},
            {data:'time'},
        ]
    });
</script>
@endsection