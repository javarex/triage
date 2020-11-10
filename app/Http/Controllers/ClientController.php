<?php

namespace App\Http\Controllers;

use App\Office;
use App\Client;
use App\User;
use App\Province;
use App\Municipal;
use App\Barangay;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;


class ClientController extends Controller
{
    
    
    public function index()
    {
       
        return view('client.index');
    }
    
   

    public function create()
    {
        

      
        //generate code
        $alphaList = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        
        $digits = sprintf('%02d',mt_rand(01, 99));
        $leters = substr(str_shuffle($alphaList),0,3);
        $code = 'DDO'.$leters.$digits;

        $flag = false;

        $provinces = Province::all();

        $users = User::where('username',$code)->first();

        return view('client.create', compact('code','provinces'));
    }
   

    public function store(Request $request)
    {
        
        $this->Validate($request, [
            'first_name'=> 'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name' => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'birthday'  => 'required',
            'address'   => 'required|string', 
            'email'     => 'required|email',
            'sex'       => 'required',
            ]);
            
       
        $code_generarated = $request->code;
        $users = User::where('qrcode',$code_generarated)->first();
        
        $userDuplication = User::where('first_name', $request->first_name)
                                    ->where('last_name', $request->last_name)
                                    ->first();
        $date = Carbon::now(); 
        if(is_null($users) && is_null($userDuplication))
        {
         
            $request['qrcode'] = $request->code;
            $request['first_name'] = ucwords($request->first_name);
            $request['middle_name'] = ucwords($request->middle_name);
            $request['last_name'] = ucwords($request->last_name);
            $request['address'] = ucwords($request->address);
            $request['password'] = bcrypt($request->code);
            $request['birthday'] = date('Y-m-d', strtotime($request->birthday));
            $user = User::create($request->all());

            if(!Auth::check()){
                Auth::login($user);
                return redirect('/triage');
            }else{
                return redirect('/admin');
            }
       
        }elseif (!(is_null($userDuplication))) {
            return back()->with('delete','Information already exist!')
                        ->withInput();
        }elseif (!(is_null($users))) {
            return back()->withInput('delete','This code is already used');
        }

    }

    public function loadMunicipals($id){
        $municipals = Municipal::where('province_id', $id)
                                ->get();
        return $municipals;
    }

    public function loadBarangays($id){
        $barangays = Barangay::where('municipal_id', $id)
                                ->get();
        return $barangays;
    }
    

}
