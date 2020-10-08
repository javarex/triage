<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Criteria;
use App\Client;
use App\User;
use App\Triage_form;
use App\Office;
use App\Activity;
use Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

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
        $client_logs = Activity::with('client','office')
                                ->where('client_id',$client_id->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
        return view('triage.index', compact('client_logs','client_id'));
    }

    public function create()
    {  
        $user_id = Auth::user()->id;
        $client_id = Client::where('user_id',$user_id)
                            ->first();
        $questions = Criteria::all();
        $triage = Triage_form::all();
        $offices = Office::orderBy('name', 'asc')
                            ->get();

        
        return view('triage.create', compact('questions','triage','offices','client_id'));
    }

    public function store(Request $request)
    {   
        $this->Validate($request, [
            'activity'  => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'answer5' => 'required',
            'answer6' => 'required',
            'answer7' => 'required',
            'answer8' => 'required',
            'answer9' => 'required',
            'answer10' => 'required',
            'answer11' => 'required',
            'answer12' => 'required',
            'answer13' => 'required',
            'answer14' => 'required',
        ]);
        
        if(is_null($request->venue)){
            $request['venue'] = NULL;
        }
        if(!(is_null($request->venue_inside))){
            $request['office_id'] = $request->venue_inside;
        }
        $request['client_id'] = $request->client_id;
        
        $request['venue'] = $request->venue;
        $data = Activity::create($request->all());
        
        
        // $data = $request->input(); 
        $triage = new Triage_form;
        $array_answer = array();
        $current_date = Carbon::now();
        for ($i=0; $i < 13; $i++) { 
            $location = $request->default_value;
            $answer_name = $request['answer'.strval($i+1)];
            if($i == 5 && $answer_name == "yes"){
                $location = $request->input('location1');
            }else if($i == 6 && $answer_name == "yes"){
                $location = $request->input('location2');
            }
            $output[$i] = [
                'client_id'     => $request->client_id,
                'activity_id'   => $data->id,
                'criteria_id'   => $i+1,
                'answer'        => strtoupper($answer_name),
                'location'      => $location,
                'created_at'    => now(),
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
        $client_logs = Activity::with('client','office')
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
        $url_activity = $activity_id;
        // dd($clients);
       
        return view('triage.show', compact('triages', 'activity', 'client_logs','url_activity','client_id'));
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