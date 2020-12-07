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
use Spatie\Image\Image;

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
        $username = User::where('username',$request->username)->first();
        
        $allUsers = User::all();
        
        foreach ($allUsers as $value) {
            $tempFirstName = $value->first_name;
            $tempLastName = $value->last_name;
            if(strcasecmp($request->first_name, $tempFirstName) == 0 && strcasecmp($request->last_name, $tempLastName) == 0 && strcasecmp($value->suffix, $request->suffix) == 0)
            {
                $duplicatedName = false;
                break;
            }
        }
        if(is_null($users) && $duplicatedName && $username == null)
        {
            
            $fileName =  $request->file('valid_id');
            $file = $fileName->getClientOriginalName();
            $file_name = $request->first_name.'-'.$request->last_name.'.'.$fileName->getClientOriginalExtension();

            Image::load($fileName)
                ->optimize()
                ->quality(50)
                ->save();

            $request->valid_id->storeAs($directory, $file_name);
            $data['qrcode'] = $request->code;
            $data['username'] = $request->username;
            $data['sex'] = $request->sex;
            $data['email'] = $request->email;
            $data['provCode'] = $request->provCode;
            $data['brgyCode'] = $request->brgyCode;
            $data['citymunCode'] = $request->citymunCode;
            $data['role'] = $request->role;
            $data['verified'] = 0;
            $data['suffix'] = $request->suffix;
            $data['contact_number'] = $request->contact_number;
            $data['first_name'] = ucwords($request->first_name);
            $data['middle_name'] = ucwords($request->middle_name);
            $data['last_name'] = ucwords($request->last_name);
            $data['address'] = ucwords($request->address);
            $data['password'] = bcrypt($request->password);
            $data['birthday'] = date('Y-m-d', strtotime($request->birthday));
            $data['valid_id'] = $file_name;
            $user = User::create($data);

            if(!auth()->check()){
               auth()->login($user);
                return redirect('/triage');
            }else{
                return redirect('/admin');
            }
       
        }elseif ($duplicatedName == false ) {
            return back()->with('delete','Information already exist!')
                        ->withInput();
        }elseif (!(is_null($users))) {
            return back()->with('delete','This code is already used!')
                        ->withInput();
        }elseif (!(is_null($username))) {
            return back()->with('delete','Username already used!')
                        ->withInput();
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

    //validate input

    public function validateInputs(Request $request)
    {
        $duplicatedName = true;
        
        $validator = $request->validate([
            'first_name'            => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name'             => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'sex'                   => 'required',
            'birthday'              => 'required',
            'address'               => 'required',
            'province'              => 'required',
            'municipality'          => 'required',
            'barangay'              => 'required',
            'valid_id'              => 'required|mimes:jpg,jpeg,png|max:2048', 
            'username'              => 'required|unique:users',
            'password'              => 'required|confirmed',
        ]);
        $allUsers = User::all();
        
        foreach ($allUsers as $value) {
            $tempFirstName = $value->first_name;
            $tempLastName = $value->last_name;
            if(strcasecmp($request->first_name, $tempFirstName) == 0 && strcasecmp($request->last_name, $tempLastName) == 0 && strcasecmp($value->suffix, $request->suffix) == 0)
            {
                $duplicatedName = false;
                break;
            }
        }
        if($duplicatedName){
            if($validator ){
                $fileName =  $request->file('valid_id');
                $file = $fileName->getClientOriginalName();
                $file_name = $request->first_name.'-'.$request->last_name.'.'.$fileName->getClientOriginalExtension();
        
                $data['qrcode'] = $request->code;
                $data['username'] = $request->username;
                $data['sex'] = $request->sex;
                $data['email'] = $request->email;
                $data['provinces_id'] = $request->province;
                $data['barangays_id'] = $request->barangay;
                $data['municipals_id'] = $request->municipality;
                $data['role'] = $request->role;
                $data['verified'] = 0;
                $data['suffix'] = $request->suffix;
                $data['contact_number'] = $request->contact_number;
                $data['first_name'] = ucwords($request->first_name);
                $data['middle_name'] = ucwords($request->middle_name);
                $data['last_name'] = ucwords($request->last_name);
                $data['address'] = ucwords($request->address);
                $data['password'] = bcrypt($request->password);
                $data['birthday'] = date('Y-m-d', strtotime($request->birthday));
                $data['valid_id'] = $file_name;
                
                $user = User::create($data);
                auth()->login($user);
                return response()->json(['success'=> 'Successfully added!']);
            }else{
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }else{
            return response()->json(['error'=> 'Record already exist']);
        }
    }

}
