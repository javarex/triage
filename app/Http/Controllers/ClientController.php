<?php

namespace App\Http\Controllers;

use App\Office;
use App\Client;
use App\User;
use Auth;
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
        

        $offices = Office::orderBy('name', 'asc')
                        ->get();
        //generate code
        $alphaList = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        
        $digits = sprintf('%02d',mt_rand(01, 99));
        $leters = substr(str_shuffle($alphaList),0,2);
        $code = $leters.$digits;

        $flag = false;

        $users = User::where('username',$code)->first();

        return view('client.create', compact('offices','code'));
    }
   

    public function store(Request $request)
    {
        
        $this->Validate($request, [
            'first_name'=> 'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name' => 'required|regex:/^[a-z0-9 .\-]+$/i',
            'age'       => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string', 'max:255'],
        ]);

        $code_generarated = $request->code;
        $users = User::where('username',$code_generarated)->first();
        
        if(is_null($users))
        {
            $request['username'] = $request->code;
            $request['password'] = bcrypt('admin');
            $request['first_name'] = ucwords($request->first_name);
            $request['middle_name'] = ucwords($request->middle_name);
            $request['last_name'] = ucwords($request->last_name);
            $request['address'] = ucwords($request->address);
            $request['status'] = '1';
            $user = User::create($request->all());
            $request['user_id'] = $user->id;
            $client = Client::create($request->all());
            $userLogin = $user->where('id', $client->user_id)->first();
            $authUser = Auth::user();
            if(is_null($authUser)){
                Auth::login($userLogin);
                return redirect('/triage');
            }else{
                return redirect('/admin');
            }
            

        }else{
            return back()->with('delete','This code is already used');
        }

    }
}
