@extends('layouts.appOffice')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/officeLog1" method="post" autocomplete="off">
                
            @csrf
                <div class="row pl-5">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card shadow card-primary">
                            <div class="card-header" style="background-color:gold; color:red"><h3>TRIAGE SCREENING FORM</h3></div>
                            
                            <div class="card-body">

                            <div class="form-group row">
                                <label for="venue" class="col-md-3 col-form-label text-md-right">{{ __('Activity') }}</label>
                                
                                <div class="col-md-8">
                                <!-- activity -->
                                    <input type="text" name="activity" class="form-control @error('activity') is-invalid @enderror" value="{{ old('activity') }}" autofocus>
                                <!-- office_id -->
                                    <input type="hidden" name="office_id" id="" value="{{ Auth::user()->office_id }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                
                                <div class="col-md-8">
                                    <input type="hidden" name="client_id" value="{{ $client->client->id }}">
                                    {{dd($client->client->id)}}
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $client->client->first_name.' '.$client->client->last_name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-3 col-form-label text-md-right">{{ __('Date') }}</label>
                                
                                <div class="col-md-8">
                                    <input type="text" name="date" class="form-control @error('name') is-invalid @enderror" value="{{ now()->format('m/d/Y') }}" readonly>
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
                                <tr>
                                    <td colspan="3" class="font-weight-bold bg-primary text-light">A. SINTOMAS</td>
                                </tr>
                                <tr>
                                    <td>FEVER nga 38 pataas
                                    </td>
                                    <td><input type="radio" name="answer1" value="yes" {{ old('answer1') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer1" value="no" {{ old('answer1') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>
                                <tr>
                                    <td>Ubo ug sip-on</td>
                                    <td><input type="radio" name="answer2" value="yes" {{ old('answer2') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer2" value="no" {{ old('answer2') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>
                                <tr>
                                    <td>Naglisod ug ginhawa</td>
                                    <td><input type="radio" name="answer3" value="yes" {{ old('answer3') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer3" value="no" {{ old('answer3') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <!-- Category B -->
                                <tr>
                                    <td colspan="3" class="font-weight-bold bg-primary text-light">B. TRAVEL HISTORY <span class="font-weight-normal">(for the last14 days)</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        Within DAVAO de ORO
                                        <div class="form-group location1">
                                            <input type="text" class="form-control" id="location1" placeholder="Specify location" name="location1">
                                        </div>
                                    </td>
                                    <td><input type="radio" name="answer4" id="yes_4" value="yes" {{ old('answer4') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer4" id="no_4" value="no" {{ old('answer4') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td id="td5">
                                        Outside DAVAO de ORO
                                        <div class="form-group location2">
                                            <input type="text" class="form-control" id="location2" placeholder="Specify location" name="location2">
                                        </div>
                                    </td>
                                    <td><input type="radio" name="answer5" id="yes_5" value="yes" {{ old('answer5') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer5" id="no_5" value="no" {{ old('answer5') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <!-- Category C. -->
                                <tr>
                                    <td colspan="3" class="font-weight-bold bg-primary text-light">C. EXPOSURE HISTORY <span class="font-weight-normal">(for the last14 days)</span></td>
                                </tr>

                                <tr>
                                    <td>Kapamilya nga nag positive sa Covid Test</td>
                                    <td><input type="radio" name="answer6" id="yes_6" value="yes" {{ old('answer6') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer6" id="no_6" value="no" {{ old('answer6') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Kapamilya nga nag Home Quarantine</td>
                                    <td><input type="radio" name="answer7" id="yes_7" value="yes" {{ old('answer7') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer7" id="no_7" value="no" {{ old('answer7') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Kapamilya nga returning OFW</td>
                                    <td><input type="radio" name="answer8" id="yes_8" value="yes" {{ old('answer8') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer8" id="no_8" value="no" {{ old('answer8') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Kapamilya nga locally stranded sa Luzon, Visayas ug Mindanao</td>
                                    <td><input type="radio" name="answer9" id="yes_9" value="yes" {{ old('answer9') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer9" id="no_9" value="no" {{ old('answer9') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Nag bantay ug COVID patient</td>
                                    <td><input type="radio" name="answer10" id="yes_10" value="yes" {{ old('answer10') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer10" id="no_10" value="no" {{ old('answer10') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Nag trabaho ug nagpuyo duol sa COVID patient.</td>
                                    <td><input type="radio" name="answer11" id="yes_11" value="yes" {{ old('answer11') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer11" id="no_11" value="no" {{ old('answer11') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Nagpuyo sa isa ka balay uban ang COVID patient.</td>
                                    <td><input type="radio" name="answer12" id="yes_12" value="yes" {{ old('answer12') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer12" id="no_12" value="no" {{ old('answer12') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Nagpuyo sa isa ka balay uban ang COVID patient.</td>
                                    <td><input type="radio" name="answer13" id="yes_13" value="yes" {{ old('answer13') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer13" id="no_13" value="no" {{ old('answer13') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>

                                <tr>
                                    <td>Nagsabay ug outing, kasal, birthday party, family gathering kauban ang COVID patient.</td>
                                    <td><input type="radio" name="answer14" id="yes_14" value="yes" {{ old('answer14') == 'yes' ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="answer14" id="no_14" value="no" {{ old('answer14') == 'no' ? 'checked' : '' }} checked></td>
                                </tr>
                            </tbody>
                        </table> 
                        
                        <div class="row pb-3">
                            <div class="col-md-2"></div>
                            <div class="col-md-5 pt-1">
                                <button class="btn btn-danger btn-block" name="triage" value="cancel">CANCEL</button>
                            </div>
                            <div class="col-md-5 pt-1">
                                <button class="btn btn-primary btn-block" name="triage" value="submit">SUBMIT</button>
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
    $(document).ready(function(){
        var a = 0;
        var b = 0;
        var location1 = $('.location1');
        var location2 = $('.location2');

        location1.hide();
        location2.hide();

        $('#yes_4').click(function(){
            if($(this).is(':checked') && a == 0){
                location1.fadeIn();
                a++;
            }
        })
        $('#no_4').click(function(){
            if($(this).is(':checked') && a != 0){
                location1.fadeOut();
                a=0;
            }
        })
        $('#yes_5').click(function(){
            if($(this).is(':checked') && b == 0){
                location2.fadeIn();
                b++;
            }
        })
        $('#no_5').click(function(){
            if($(this).is(':checked') && b != 0){
                location2.fadeOut();
                b=0;
            }
        })
    })
</script>
@endsection

