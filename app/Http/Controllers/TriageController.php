<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Criteria;
use App\Client;
use App\User;
use App\Triage_form;
use App\Activity;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TriageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $client_id = Client::where('user_id',$user_id)
                            ->first();
        $client_logs = Activity::with('client')
                                ->where('client_id',$client_id->id)
                                ->paginate(10);
        return view('triage.index', compact('client_logs'));
    }

    public function create()
    {  
        $questions = Criteria::all();
        $triage = Triage_form::all();

        
        // if($triage->isEmpty()){
        //     $form_number = "0001";
        // }else{
        //     $get_form_number = Triage_form::select('form_number')->latest('form_number')->first();
        //     $number = $get_form_number->form_number+1;
        //     $form_number = sprintf('%04d',$number);
        // }
        

        
        return view('triage.create', compact('questions','triage','form_number'));
    }

    public function store(Request $request)
    {   
        $this->Validate($request, [
            'activity'  => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'venue'     => 'required|regex:/^[a-z0-9 .\-]+$/i',
        ]);
        $request['client_id'] = $request->client_id;
        $request['activity'] = $request->activity;
        $request['venue'] = $request->venue;
        $data = Activity::create($request->all());
        
        
        // $data = $request->input(); 
        $triage = new Triage_form;
        $array_answer = array();
        $current_date = Carbon::now();
        for ($i=0; $i < 13; $i++) { 
            $location = $request->default_value;
            $answer_name = $request['answer'.strval($i+1)];
            if($i == 3 && $answer_name == "yes"){
                $location = $request->input('location1');
            }else if($i == 4 && $answer_name == "yes"){
                $location = $request->input('location2');
            }
            $output[$i] = [
                'client_id'     => $request->client_id,
                'activity_id'   => $data->id,
                'criteria_id'   => $i+1,
                'answer'        => strtoupper($answer_name),
                'location'      => $location,
                'created_at'    => $current_date,
            ];
        }

        Triage_form::insert($output);

        return redirect('triage');
    }

    public function show($activity_id)
    {
        
        $user_id = Auth::user()->id;
        $client_id = Client::where('user_id',$user_id)
        ->first();
        $client_logs = Activity::with('client')
                        ->where('client_id',$client_id->id)
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        //get venue and activities
        $activity = Activity::with('client')
                            ->where('id',$activity_id)
                            ->first();
        
        
        $date_of_activity = $activity->created_at;
        $triages = Triage_form::with('client','criteria')
                            ->whereDate('created_at',$date_of_activity->format('Y-m-d'))
                            ->where('activity_id',$activity_id)
                            ->get();

        // dd($clients);
       
        return view('triage.show', compact('triages', 'activity', 'client_logs'));
    }

    public function update(Request $request, $id)
    {

        foreach($request->triage_id as $key => $triage_id){
            $triage = Triage_form::find($triage_id);
            $triage->update(['answer' => $request->input('answer'.$triage_id)]);
        }
        return redirect()->back();
        
    }

    // function load_history(Request $request, $activity_id)
    // {
    //     $activity = Activity::where('id',$activity_id);

    //     return Response::json($activity);
    // }

}
// regex:/^[\pL\s\-]+$/u