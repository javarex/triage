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

    public function __construct(User $model, Province $province, EncryptionController $encrypt_decrypt)
    {
        $this->model = $model;
        $this->province = $province;
        $this->encrypt_decrypt = new $encrypt_decrypt;
    }
    public function index()
    {
        // $tempname = "RAYMART ITANONG";
        // dd(crypt($tempname,'$1$hNoLa02$'));
        $provinces = $this->province->where('id','<>',0)
                        ->orderBy('provDesc', 'asc')
                        ->get();
       

        $user = auth()->user();

        $dateOfBirth = $user->birthday;
        $years = Carbon::parse($dateOfBirth)->age;
        $date = $user->created_at;
        $data = $this->data();

        $userAdd =  $this->model->with('barangay','municipal','province')
                    ->where('id',auth()->user()->id)
                    ->first();
        // dd($userAdd);
        $brgy = strtolower($userAdd->barangay->brgyDesc);
        $province = strtolower($userAdd->province->provDesc);
        $municipals = strtolower($userAdd->municipal->citymunDesc);
        $address = ucwords($brgy.', '.$municipals.', '.$province);
    
        $flag = $this->validAddress();

        // $directory = date('m-d-Y', strtotime($date));
        $first_name = $this->encrypt_decrypt->decrypt($user->first_name);
        $last_name = $this->encrypt_decrypt->decrypt($user->last_name);
        $middle_name = $user->middle_name;
        if($middle_name)
        {
            $middle_name = $middle_name[0].'.';
        }
        if($user->suffix){
            $Users_name = $first_name.' '.$middle_name.' '.$last_name.' '.$user->suffix;
        }else{
            $Users_name = $first_name.' '.$middle_name.' '.$last_name;
        }
 

        return view('triage.index',compact('flag','userAdd','data','user','provinces','years','address','Users_name','first_name'));
    }


    public function exportId()
    {
      
        $user = auth()->user();

        $dateOfBirth = $user->birthday;
        $years = Carbon::parse($dateOfBirth)->age;
        $date = $user->created_at;
        $userAdd = $this->model->with('barangay','municipal','province')->where('id', $user->id)->first();

        $brgy = strtolower($userAdd->barangay->brgyDesc);
        $province = strtolower($userAdd->province->provDesc);
        $municipal = strtolower($userAdd->municipal->citymunDesc);
        $address = ucwords($brgy.', '.$municipal.', '.$province);
        $directory = date('m-d-Y', strtotime($date));
        $first_name = $this->encrypt_decrypt->decrypt($user->first_name);
        $last_name = $this->encrypt_decrypt->decrypt($user->last_name);

        $middle_name = $user->middle_name;
        if($middle_name)
        {
            $middle_name = $middle_name[0].'.';
        }
        if($user->suffix){
            $Users_name = $first_name.' '.$middle_name.' '.$last_name.' '.$user->suffix;
        }else{
            $Users_name = $first_name.' '.$middle_name.' '.$last_name;
        }

        return view('client.exportId', compact('user','first_name','years','directory','address','Users_name','first_name'));
    }

    public function qrEdit(Request $request)
    {
        $user = $this->model->findOrFail(auth()->user()->id);
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
            $user = $this->model->findOrFail(auth()->user()->id);
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
        $user = $this->model->findOrFail(auth()->user()->id);
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
        $userAdd =  $this->with('barangay','municipal','province')
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
        $user =  $this->model->with('barangay','municipal','province')
                    ->where('id',auth()->user()->id)
                    ->first();
        $first_name = $this->encrypt_decrypt->decrypt($user->first_name);
        $last_name = $this->encrypt_decrypt->decrypt($user->last_name);
        $middle_name =$user->middle_name;
        
       $data_array = array(
           'first_name' => $first_name,
           'middle_name'  => $middle_name,
           'last_name'  => $last_name,
           'barangay'   => strtoupper($user->barangay->brgyDesc),
           'municipal'   => strtoupper($user->municipal->citymunDesc),
           'province'   => strtoupper($user->province->provDesc),
           'birthday'   => $user->birthday,
           'suffix'   => $user->suffix,
       ); 

       return $data_array = (Object)$data_array;
    }

    public function getProvinces()
    {
        return $this->province->where('id','<>',0)
                ->orderBy('provDesc', 'asc')
                ->get();
    }

    public function validAddress()
    {
        return auth()->user()->province_id && auth()->user()->municipal_id && auth()->user()->barangay_id;
    }
  

}
