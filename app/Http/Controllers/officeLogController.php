<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Office;
use App\User;
use App\Client;
use App\Activity;
use App\Triage_form;
use Auth;

use Illuminate\Http\Request;

class officeLogController extends Controller
{
    public function create(Request $request)
    {
        
        $username = $request->clientid;
        if($username != ''){
            $scannedUser = User::where('id', $request->clientid)
                            ->first();
                            
            $username = $scannedUser->username;
        }
        
        $user_id = Auth::user()->id;
        $office = User:: with('office')
                        ->where('id',$user_id)
                        ->first();
        $clients = Activity::with('Office','client')
                            ->where('office_id',$office->office_id)
                            ->get();

        return view('office.office_log.create', compact('clients','office','username'));
    }

    public function store(Request $request)
    {
        $users = Auth::user();
        $users_id = $users->id;
        $office_id = $users->office_id;
        $validatedData = $request->validate([
            'username' => 'required',
            'activity' => 'required',
        ]);
        $office = Office::where('id', $users->office_id)
                        ->first();
        
        if($request->submit == "1")
        {
            $fetched_user = User::where('username', $request->username)
                                ->first();
            if(!(is_null($fetched_user)) && ($fetched_user->type != "office" && $fetched_user->type != "admin"))
            {
                $username = $request->username;
                $activity = $request->activity;
                $client = Client::where('user_id',$fetched_user->id)
                                    ->first();
                $request['client_id'] = $client->id; 
                $request['office_id'] = $users->office_id;
                $storedActivity = Activity::create($request->all());
                
                return redirect('/officeLog/'.$storedActivity->id);
            }else{
                $username = NULL;
                return redirect()->back()
                                ->with('username',"invalid username!")
                                ->withInput();
            }
        }
        else
        {
            $current_date = Carbon::now();
            $fetched_user = User::with('client')
                                ->where('username', $request->username)
                                ->first();
            $triages = Triage_form::with('client')
                                ->where('client_id', $fetched_user->client->id)
                                ->whereDate('created_at', $current_date)
                                ->get();                 
            for ($i=0; $i < count($triages); $i++) { 

                $triage = Triage_form::find($triages[$i]['id']);
                $triage->created_at = $current_date;
                $triage->save();
            }


                return redirect()->back();
        }
    }


    public function show($activity_id){
        
        $activity = Activity::with('client')
                            ->where('id', $activity_id)
                            ->first();

        return view('office.office_log.show', compact('activity'));
    }

    public function storeTriage(Request $request)
    {
        
        $request['client_id'] = $request->client_id;
        $request['activity'] = $request->activity;
        $request['venue'] = $request->venue;
        
         
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
                'activity_id'   => $request->activity,
                'criteria_id'   => $i+1,
                'answer'        => strtoupper($answer_name),
                'location'      => $location,
                'created_at'    => $current_date,
            ];
        }

        Triage_form::insert($output);

        return redirect('officeLog/create');
    }

    public function clientform()
    {
        return 'hello';
    }
}
