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
use Illuminate\Support\Facades\Crypt;

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

        $provinces = Province::orderBy('provDesc', 'asc')->get();
        $list_of_provinces = "";

        $users = User::where('username',$code)->first();
        return view('client.create', compact('code','provinces'));
    }
   

    public function store(Request $request)
    {
        $duplicatedName = true;

        

        $date = Carbon::now(); 
        $directory = date('m-d-Y', strtotime($date));
        $this->validate($request, [
            'first_name'        => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name'         => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'birthday'          => 'required',
            'address'           => 'required|string',
            'username'          => 'required',
            'sex'               => 'required',
            'password'          => 'required|confirmed',
            'valid_id'          => 'required|mimes:jpeg,bmp,png|max:2000', 
            ]);
            
       
        $code_generarated = $request->code;
        $users = User::where('qrcode',$code_generarated)->first();
        
        $allUsers = User::all();
        
        foreach ($allUsers as $value) {
            $tempFirstName = Crypt::decryptString($value->first_name);
            $tempLastName = Crypt::decryptString($value->last_name);
            if(strcasecmp($request->first_name, $tempFirstName) == 0 && strcasecmp($request->last_name, $tempLastName) == 0 && strcasecmp($value->suffix, $request->suffix) == 0)
            {
                $duplicatedName = false;
                break;
            }
        }
        if(is_null($users) && $duplicatedName)
        {
            $fileName =  $request->file('valid_id');
            $file = $fileName->getClientOriginalName();
            $file_name = $request->first_name.'-'.$request->last_name.'.'.$fileName->getClientOriginalExtension();
            $request->valid_id->storeAs($directory, $file_name);
            $data['qrcode'] = $request->code;
            $data['username'] = $request->username;
            $data['sex'] = $request->sex;
            $data['email'] = $request->email;
            $data['province_id'] = $request->province_id;
            $data['barangay_id'] = $request->barangay_id;
            $data['municipal_id'] = $request->municipal_id;
            $data['role'] = $request->role;
            $data['verified'] = 0;
            $data['suffix'] = $request->suffix;
            $data['contact_number'] = $request->contact_number;
            $data['first_name'] = Crypt::encryptString(ucwords($request->first_name));
            $data['middle_name'] = Crypt::encryptString(ucwords($request->middle_name));
            $data['last_name'] = Crypt::encryptString(ucwords($request->last_name));
            $data['address'] = ucwords($request->address);
            $data['password'] = bcrypt($request->password);
            $data['birthday'] = date('Y-m-d', strtotime($request->birthday));
            $data['valid_id'] = $file_name;
            $user = User::create($data);

            if(!Auth::check()){
                Auth::login($user);
                return redirect('/triage');
            }else{
                return redirect('/admin');
            }
       
        }elseif ($duplicatedName == false ) {
            return back()->with('delete','Information already exist!')
                        ->withInput();
        }elseif (!(is_null($users))) {
            return back()->withInput('delete','This code is already used');
        }

    }

    public function loadMunicipals($id){
        $municipals = Municipal::where('provCode', $id)
                                ->orderBy('citymunDesc', 'asc')
                                ->get();
        return $municipals;
    }

    public function loadBarangays($bid){
        $barangays = Barangay::where('citymunCode', $bid)
                            ->orderBy('brgyDesc', 'asc')
                                ->get();
        return $barangays;
    }
    
    public function loadProvince()
    {
        $province = Province::orderBy('provDesc', 'asc')->get();
        return $province;
    }

}
