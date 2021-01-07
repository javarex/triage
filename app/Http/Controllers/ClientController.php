<?php

namespace App\Http\Controllers;

use App\User;
use App\Province;
use App\Municipal;
use App\Barangay;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        $encrypt = new EncryptionController;

        $validator = $request->validate([
            'first_name'            => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name'             => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'sex'                   => 'required',
            'birthday'              => 'required',
            'address'               => 'required',
            'province'              => 'required',
            'municipality'          => 'required',
            'barangay'              => 'required',
            'username'              => 'required|unique:users',
            'password'              => 'required|confirmed',
        ]);
        
        $duplicateUser = DB::table('users')
                            ->where('first_name', $encrypt->encrypt(ucwords($request->first_name)))
                            ->where('last_name', $encrypt->encrypt(ucwords($request->last_name)))
                            ->where('suffix', $request->suffix)
                            ->first();
       
        if(!$duplicateUser){
            if($validator ){

                // $fileName =  $request->file('valid_id');
                // $file = $fileName->getClientOriginalName();
                // $ext = $fileName->getClientOriginalExtension();
                // $file_name = $request->first_name.'-'.$request->last_name.'.'.$fileName->getClientOriginalExtension();
        
                // $fileName->storeAs($request->first_name.'_'.$request->last_name, $file_name.'.'.$ext);
                // Image::load($fileName)
                // ->optimize()
                // ->quality(50)
                // ->save();

                $request['qrcode'] = $request->code;
                $request['province_id'] = $request->province;
                $request['barangay_id'] = $request->barangay;
                $request['municipal_id'] = $request->municipality;
                $request['verified'] = 0;
                $request['first_name'] = $encrypt->encrypt(ucwords($request->first_name)); //255
                $request['middle_name'] = ucwords($request->middle_name);
                $request['last_name'] = $encrypt->encrypt(ucwords($request->last_name)); //255 length
                $request['address'] = ucwords($request->address);
                $request['password'] = bcrypt($request->password);
                $request['birthday'] = date('Y-m-d', strtotime($request->birthday));
                $user = User::create($request->all());


                if (!auth()->check()) {
                    auth()->login($user);
                }
                return response()->json(['success'=> 'Successfully added!']);
            }else{
                return response()->json(['error'=>$validator->errors()->all() ]);
            }
        }else{
            return response()->json(['error'=> 'Record already exist']);
        }
    }

}
