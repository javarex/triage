<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Criteria;
use App\Client;
use App\User;
use App\Province;
use App\Municipal;
use App\Barangay;
use App\Triage_form;
use App\Office;
use App\Activity;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class TriageController extends Controller
{
    public function index()
    {
        // $tempname = "RAYMART ITANONG";
        // dd(crypt($tempname,'$1$hNoLa02$'));
        $provinces =   $province = Province::where('id','<>',0)
                        ->orderBy('provDesc', 'asc')
                        ->get();
        $decrypt = new EncryptionController;

        $user = auth()->user();

        $dateOfBirth = $user->birthday;
        $years = Carbon::parse($dateOfBirth)->age;
        $date = $user->created_at;
        $data = $this->data();

    
        $userAdd =  User::with('barangay','municipal','province')
                    ->where('id',auth()->user()->id)
                    ->first();
        $brgy = strtolower($userAdd->barangay->brgyDesc);
        $province = strtolower($userAdd->province->provDesc);
        $municipals = strtolower($userAdd->municipal->citymunDesc);
        $address = ucwords($brgy.', '.$municipals.', '.$province);
    
        if (auth()->user()->province_id != 0 || auth()->user()->municipal_id != 0 || auth()->user()->barangay_id != 0) {
            $flag = true;
        }else{
            $flag = false;
        }

        // $directory = date('m-d-Y', strtotime($date));
        $first_name = $decrypt->decrypt($user->first_name);
        $last_name = $decrypt->decrypt($user->last_name);
        $middle_name =$user->middle_name;
        if($user->suffix){
            $Users_name = $first_name.' '.$last_name.' '.$user->suffix;
        }else{
            $Users_name = $first_name.' '.$last_name;
        }
        $data = $this->data();

        return view('triage.index',compact('flag','userAdd','data','user','provinces','years','address','Users_name','first_name','municipals','barangays'));
    }

    public function create()
    {
        $user_id = auth()->user()->id;
        $client_id = User::where('id',$user_id)
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

        $user_id = auth()->user()->id;
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

    public function exportId()
    {
        $decrypt = new EncryptionController;
        $user = auth()->user();

        $dateOfBirth = $user->birthday;
        $years = Carbon::parse($dateOfBirth)->age;
        $date = $user->created_at;
        $userAdd = User::with('barangay','municipal','province')->where('id', $user->id)->first();

        $brgy = strtolower($userAdd->barangay->brgyDesc);
        $province = strtolower($userAdd->province->provDesc);
        $municipal = strtolower($userAdd->municipal->citymunDesc);
        $address = ucwords($brgy.', '.$municipal.', '.$province);
        $directory = date('m-d-Y', strtotime($date));
        $first_name = $decrypt->decrypt($user->first_name);
        $last_name = $decrypt->decrypt($user->last_name);

        $middle_name =$user->middle_name;
        if($user->suffix){
            $Users_name = $first_name.' '.$last_name.' '.$user->suffix;
        }else{
            $Users_name = $first_name.' '.$last_name;
        }

        return view('client.exportId', compact('user','first_name','years','directory','address','Users_name','first_name'));
    }

    public function update(Request $request, $id)
    {

        foreach($request->triage_id as $key => $triage_id){
            $triage = Triage_form::find($triage_id);
            $triage->update(['answer' => $request->input('answer'.$triage_id)]);
        }
        return redirect()->back();

    }

    public function qrEdit(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $request['qrcode'] = $request->new_qrcode;
        $user->update($request->all());
       return redirect('/triage')->with('success','QR code successfully change!');
    }

    public function updateSecurity(Request $request)
    {
        if ($request->username == auth()->user()->username) {
            $validator = $request->validate([
                'password'  => 'required|confirmed',
            ]);
        }else{
            $validator = $request->validate([
                'username'  => 'required|unique:users',
                'password'  => 'required|confirmed',
            ]);
        }

        if($validator){
            $user = User::findOrFail(auth()->user()->id);
            $user->update([
                'username'  => $request->username,
                'password'  => bcrypt($request->password)
            ]);
        }else{
            return response()->json(['error'=>$validator->errors()->all() ]);
        }
    }

    public function profile_edit(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $validator = $request->validate([
            'province_id'       => 'required',
            'municipal'         => 'required',
            'barangay'          => 'required',
            'birthday'          => 'required',
        ]);
        if ($validator) {
            # code...
            $user->update([
                'province_id'       => $request->province_id,
                'municipal_id'      => $request->municipal,
                'barangay_id'       => $request->barangay,
                'contact_number'    => $request->contact_number,
                'email'             => $request->email,
                'birthday'          => date('Y-m-d', strtotime($request->birthday)),
            ]);
        }else{
            return response()->json(['error'=>$validator->errors()->all() ]);
        }
    }

    //history controller group

    public function view_history()
    {
        $data = $this->data();
        $user = auth()->user();
        $provinces = $this->getProvinces();
        $userAdd =  User::with('barangay','municipal','province')
                        ->where('id',auth()->user()->id)
                        ->first();

        $years = Carbon::parse($user->birthday)->age;
    if (auth()->user()->province_id != 0 || auth()->user()->municipal_id != 0 || auth()->user()->barangay_id != 0) {
        $flag = true;
    }else{
        $flag = false;
    }
       return view('triage.history',compact('data','provinces','userAdd','flag','user','years'));
    }


    protected function decryptValue($myString)
    {
        try {
            //code...
            $result = Crypt::decryptString($myString);

        } catch (DecryptException $e) {
            $result = $myString;
        }
        return $result;
    }

    protected function data()
    {
        $user =  User::with('barangay','municipal','province')
                    ->where('id',auth()->user()->id)
                    ->first();
        $decrypt = new EncryptionController;
        $first_name = $decrypt->decrypt($user->first_name);
        $last_name = $decrypt->decrypt($user->last_name);
        $middle_name =$user->middle_name;
        
       $data_array = array(
           'first_name' => $first_name,
           'middle_name'  => $middle_name,
           'last_name'  => $last_name,
           'barangay'   => $user->barangay->brgyDesc,
           'municipal'   => $user->municipal->citimunDesc,
           'province'   => $user->province->provDesc,
           'birthday'   => $user->birthday,
       ); 

       return $data_array = (Object)$data_array;
    }

    public function getProvinces()
    {
        return Province::where('id','<>',0)
                ->orderBy('provDesc', 'asc')
                ->get();
    }

}
