<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Office;
use App\User;
use App\Client;
use Auth;

class RegistrationController extends Controller
{
    public function create()
    {
        $offices = Office::orderBy('name', 'asc')
                        ->get();
        //generate code
        $alphaList = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        
        $digits = sprintf('%02d',mt_rand(01, 99));
        $leters = substr(str_shuffle($alphaList),0,2);
        $code = 'DDO_'.$leters.$digits;

        $flag = false;

        $users = User::where('username',$code)->first();
        return view('registration.create', compact('offices','code'));
    }
    public function store(Request $request)
    {  
        $this->Validate($request, [
            'first_name'=> 'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name' => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'address'   => 'required',
            'contact_number'     => 'required|regex:/(09)[0-9]{9}/',
            ]);
            
        $code_generarated = $request->code;
        $users = User::where('username',$code_generarated)->first();
            
        $userDuplication = User::where('first_name', $request->first_name)
                                ->where('last_name', $request->last_name)
                                ->first();
        if(is_null($users) && is_null($userDuplication))
        {
            $ext = $request->user_pic->getClientOriginalExtension();
         
            Storage::makeDirectory($request->first_name.'_'.$request->last_name);

            $request->file('user_pic')->storeAs($request->first_name.'_'.$request->last_name, 'face.'.$ext);
            $request->file('user_pic_id')->storeAs($request->first_name.'_'.$request->last_name, 'valid_id.'.$ext);
            $request->file('user_with_id')->storeAs($request->first_name.'_'.$request->last_name, 'holding_id.'.$ext);

            $request['username'] = $request->code;
            $request['password'] = bcrypt('admin');
            $request['first_name'] = ucwords($request->first_name);
            $request['middle_name'] = ucwords($request->middle_name);
            $request['last_name'] = ucwords($request->last_name);
            $request['address'] = ucwords($request->address);
            $request['status'] = '1';
            $request['tag'] = '0';
            $request['birthday'] = date('Y-m-d', strtotime($request->birthday));
            $user = User::create($request->all());
            
            
            
            $userLogin = $user->where('id', $user->id)->first();
            $authUser = Auth::user();
            if(is_null($authUser)){
                Auth::login($userLogin);
                return redirect('/triage');
            }else{
                return redirect('/admin');
            }
            

        }elseif (!(is_null($userDuplication))) {
            return back()->withErrors(['existErr','Information already exist!'])
                        ->withInput();
        }elseif (!(is_null($users))) {
            return back()->withErrors(['codeErr','This code is already used']);
        }
    }

    public function checkName(Request $request)
    {
        return User::where('first_name', $request->first_name)
                    ->where('last_name', $request->last_name)
                    ->first();     
        
    }

    public function validateNames(Request $request)
    {
       
        $validator = $request->validate([
            'first_name'=> 'required|alpha',
            'last_name'=> 'required|alpha',
            'address'=> 'required',
            'birthday'=> 'required',
            'sex'=> 'required',
        ]);

        if(!$validator){
            return Response::json([
                'success' => false,
                'errors' => $validator
        
            ], 400); // 400 being the HTTP code for an invalid request.
        }else{
            return Response::json(['success' => true], 200);
        }
        

       
    }
}
