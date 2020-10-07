@extends('triage.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('triage.store') }}" method="post" autocomplete="off">
                
            @csrf
                <div class="row pl-5">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card shadow card-primary">
                            <div class="card-header text-primary" style="background-color:#d7e2ea">
                                <h3>
                                    <strong><i class="fas fa-file-alt    "></i> TRIAGE SCREENING FORM</strong>
                                </h3>
                            </div>
                            
                            <div class="card-body">

                            <!-- generated Form number -->
                                <div class="form-group row ">
                                    <!-- <label for="activity" class="col-md-4 col-form-label text-md-right">{{ __('Form number') }}</label> -->
                                
                                    <div class="col-md-6">
                                    <input type="hidden" name="default_value">
                                        <input type="hidden" name="client_id" value="{{ auth::user()->client->id }}">
                                        <input type="hidden" name="tag_id" value="0">
                                        <input type="hidden" class="form-control" name="form_number" value="" readonly>
                                        <input type="hidden" name="approve" value="0">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                                
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ now()->format('m/d/Y') }}" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row ">
                                    <label for="activity" class="col-md-4 col-form-label text-md-right">{{ __('Purpose of Visit') }}</label>
                                
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('activity') is-invalid @enderror" name="activity" value="{{ old('activity') }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row venue">
                                    <label for="venue" class="col-md-4 col-form-label text-md-right"></label>
                                    
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline text-no">
                                            <input class="form-check-input" type="radio" name="venue" id="outside" value="outside">
                                            <label class="form-check-label" for="outside">Outside Capitol</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="venue" id="inside" value="inside">
                                            <label class="form-check-label" for="inside">Inside Capitol</label>
                                        </div>
                                    </div>
                                    
                                </div>

                                
                                <div class="form-group row venue">
                                    <label for="venue" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                                    
                                    <div class="col-md-6 venue_class" id="">
                                        <input type="text" class="form-control  @error('venue') is-invalid @enderror" id="venue_outside" name="venue" value="{{ old('venue_outside') }}" placeholder="Specify place">
                                        <select name='venue_inside' class='form-control venue_inside' id='office_id'>
                                            <option value=''>Select office</option>
                                            @foreach($offices as $office)
                                                <option value='{{ $office->id }}'>
                                                    {{ $office->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="">
                        <table class="table table-light table-hover table-bordered ">
                            <thead>
                                <tr>
                                <th>CRITERIA</th>
                                <th>YES</th>
                                <th>NO</th>
                                </tr>
                            </thead>
                            <tbody>

                            <!-- Category A. -->
                                @foreach($questions as $question)
                                    @if($question->id == 1)
                                        <tr>
                                            <td colspan="3" class="font-weight-bold bg-primary text-light">A. SINTOMAS <span class="font-weight-normal">({{ strtoupper('Naa ba kay gibati sa mga sumusunod')}})</span></td>
                                        </tr>
                                    @elseif($question->id == 6)
                                        <tr>tra
                                            <td colspan="3" class="font-weight-bold bg-primary text-light">B. TRAVEL HISTORY <span class="font-weight-normal">({{ strtoupper('for the past 14 days')}})</span></td>
                                        </tr>
                                    @elseif($question->id == 8)
                                        <tr>
                                            <td colspan="3" class="font-weight-bold bg-primary text-light">C. EXPOSURE HISTORY <span class="font-weight-normal">({{ strtoupper('for the past 14 days')}})</span></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            {{ $question->question}}
                                            @if($question->id == 6)
                                                <input type="text" class="form-control" id="location1" placeholder="Specify location" name="location1">
                                            @elseif($question->id == 7)
                                                <input type="text" class="form-control" id="location2" placeholder="Specify location" name="location2">
                                            @endif
                                        </td>
                                        <td><input type="radio" name="answer{{$question->id}}" id="yes_{{$question->id}}" value="yes" {{ old('answer1') == 'yes' ? 'checked' : '' }}></td>
                                        <td><input type="radio" name="answer{{$question->id}}" id="no_{{$question->id}}" value="no" {{ old('answer1') == 'no' ? 'checked' : '' }}></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                        
                        <div class="row pb-3">
                            <div class="col-md-2"></div>
                            <div class="col-md-5 ">
                                <button type="button" class="btn btn-danger btn-block" onclick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i> BACK</button>
                            </div>
                            <div class="col-md-5">
                                <button class="btn btn-primary btn-block"><i class="fa fa-check" aria-hidden="true"></i> SUBMIT</button>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            
                <!-- <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>
            
                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
            
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> -->
                
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>

    function goBack() {
        window.history.back();
    }

    $(document).ready(function(){
        
        var a = 0;
        var b = 0;
        var location1 = $('#location1');
        var location2 = $('#location2');

        
        location1.hide();
        location2.hide();

        $('#yes_6').click(function(){
            if($(this).is(':checked') && a == 0){
                location1.fadeIn();
                a++;
            }
        })
        $('#no_6').click(function(){
            if($(this).is(':checked') && a != 0){
                location1.fadeOut();
                a=0;
            }
        })
        $('#yes_7').click(function(){
            if($(this).is(':checked') && b == 0){
                location2.fadeIn();
                b++;
            }
        })
        $('#no_7').click(function(){
            if($(this).is(':checked') && b != 0){
                location2.fadeOut();
                b=0;
            }
        })


        var checkOutside = 1;
        var checkInside = 1;

        $('#outside').click(function (){
            checkInside = 1;
           if(checkOutside == 1)
           {
                $('#venue_outside').attr("required", true);
                $('#venue_outside').fadeIn();

                $('#venue_inside').attr("required", false);
               
                checkOutside++;

            }
            $('.venue_inside').fadeOut();    
        })

        $('.venue_inside').hide();
        $('#venue_outside').hide();

        $('#inside').click(function (){
            
            checkOutside = 1;

            if(checkInside == 1)
            {
                $('#venue_inside').attr("required", true);
                $('#venue_outside').attr("required", false);
                $('.venue_inside').fadeIn();
                $('#venue_outside').fadeOut();
                checkInside++;
            }
        })
    })
</script>
@endsection

