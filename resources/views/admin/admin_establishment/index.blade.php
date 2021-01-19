@extends('layouts.appAdmin')


@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10">
                <table id="establishmentTable" class="table bg-choco table-striped table-bordered dt-responsive nowrap text-warning" style="width:100%">
                    <thead class="">
                        <tr>
                            <th>Establishment Name</th>
                            <th>Barangay</th>
                            <th>Municipal</th>
                            <th>Province</th>
                            <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                            <!-- <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th> -->
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->establishment_name }}</td>
                            <td>{{ $user->brgyDesc }}</td>
                            <td>{{ $user->citymunDesc }}</td>
                            <td>{{ $user->provDesc }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

    
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#establishmentTable').DataTable({
            order:[[1,'asc']]
        });
    })
</script>
@endsection