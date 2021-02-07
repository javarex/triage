@extends('layouts.appAdmin')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-warning text-left">
                <h1>Reports</h1>
            </div>
            <div class="col-md-8">
                <div class="row">
                @if($data = Session::get('data'))
                    {{$data}}
                @endif
                   <form action="{{route('citizen.printpdf')}}" method="post" autocomplete="off">

                        @csrf
                        <div class="col-md-6 card card-body bg-choco">
                            <div class="row">
                                    
                                <!-- <div class="col-md-12 text-warning">
                                    <input type="radio" class="form-control-radio" name="search_type" id="c_name" value="citizen_name"> <label for="c_name">Citizen's name</label>
                                    <input type="radio" class="form-control-radio" name="search_type" id="c_number" value="citizen_num"> <label for="c_number">Citizen's number</label>
                                </div> -->
                                <div class="col-md-12">
                                    <!-- <input type="text" name="search_input" id="search_input" class="form-control" placeholder="Please select first input type" disabled> -->

                                    <input type="text" name="search_input" id="search_input" class="form-control" placeholder="Citizen's Name">
                                    <input type="hidden" name="barcode" id="barcode" class="form-control">

                                </div>
                                <div class="col-md-12 pt-3">
                                    <label for="" class="text-warning font-weight-bolder">Period:</label>
                                </div>
                                
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="from">
                                    <label for="" class="text-warning">From</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="to">
                                    <label for="" class="text-warning">To</label>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <label for="" class="text-warning font-weight-bolder">Hours:</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" min="1" class="form-control" name="before_arrival" placeholder="number of hours">
                                    <label for="" class="text-warning">Before Arrival</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" min="1" class="form-control" name="after_arrival" placeholder="number of hours">
                                    <label for="" class="text-warning">After Arrival</label>
                                </div>
                                <div class="col-md-12 pt-2">
                                    <label for="" class="text-warning font-weight-bolder">Report type:</label>
                                </div>
                                <div class="col-md-12 text-warning">
                                    <input type="radio" name="report_type" value="estab_visit" id="establishment_visit"> <label for="establishment_visit">Establishment visit</label>
                                </div>
                                <!-- <div class="col-md-12 text-warning">
                                    <input type="radio" name="report_type" value="terminal_visit" id="terminal_visit"> <label for="terminal_visit">Terminal visit</label>
                                </div>
                                <div class="col-md-12 text-warning">
                                    <input type="radio" name="report_type" value="possible_contact" id="possible_contact"> <label for="possible_contact">Possible Contacts</label>
                                </div> -->
                                <div class="col-md-6">
                                    <button type="" class="btn btn-block login_btn">Generate PDF</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-block login_btn">Generate Excel</button>

                                </div>
                            </div>
                        </div>
                   </form>
                    
                    <div class="col-md-6">
                        <div class="row">
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
@endsection

@section('scripts')
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var searchType = 'citezen_name';
    $(document).ready(function() {
        // $('input[type=radio][name=search_type]').change(function() {
        //     $('#search_input').removeAttr('disabled');
        //     if (this.value == 'citizen_name') {
        //         $('#search_input').attr('placeholder',"E.g Juan Dela Cruz");
        //     }
        //     else{
        //         $('#search_input').attr('placeholder',"E.g DDOABC12");
        //     }
        //         searchType = $(this).val();
                
        // });

        $( "#search_input" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('user.getUser')}}",
            type: 'post',
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
               console.log(data);
            }
          });
        },
        select: function (event, ui) {
           // Set selection
           $('#search_input').val(ui.item.label); // display the selected text
           $('#barcode').val(ui.item.qrcode); // save selected id to input
           return false;
        }
      });
    })
</script>
@endsection