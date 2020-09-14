<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\Client;
use App\User;
use App\Triage_form;
use App\Activity;
use Auth;
use Carbon;
use Illuminate\Http\Request;

class TriageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        $questions = Criteria::all();
        $triage = Triage_form::all();

        
        if($triage->isEmpty()){
            $form_number = "0001";
        }else{
            $get_form_number = Triage_form::select('form_number')->latest('form_number')->first();
            $number = $get_form_number->form_number+1;
            $form_number = sprintf('%04d',$number);
        }
        

        
        return view('triage.index', compact('questions','triage','form_number'));
    }

    public function store(Request $request)
    {   
        $this->Validate($request, [
            'activity'  => 'required|regex:/^[\pL\s\-]+$/u',
            'venue'     => 'required|regex:/^[\pL\s\-]+$/u',
        ]);
        // $data = $request->input(); 
        $triage = new Triage_form;
        $array_answer = array();
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
                'form_number'   => $request->form_number,
                'criteria_id'   => $i+1,
                'answer'        => $answer_name,
                'location'      => $location,
            ];
        }

        Triage_form::insert($output);

        $request['client_id'] = $request->client_id;
        $request['activity'] = $request->activity;
        $request['venue'] = $request->venue;
        Activity::create($request->all());
        return redirect('triage/show');
    }

    public function show()
    {
        
        $activity = Activity::with('client')
                            ->latest('created_at')
                            ->first();

        $get_form_number = Triage_form::with('client','criteria')
                            ->latest('form_number')
                            ->first();

        $clients = Triage_form::with('client','criteria')
                            ->where('form_number',$get_form_number->form_number)
                            ->get();

        // dd($clients);
       
        return view('triage.show', compact('clients', 'activity', 'get_form_number'));
    }

    public function update(Request $request, $id)
    {

        foreach($request->triage_id as $key => $triage_id){
            $triage = Triage_form::find($triage_id);
            $triage->update(['answer' => $request->input('answer'.$triage_id)]);
        }
        return redirect()->back();
        
    }

}
