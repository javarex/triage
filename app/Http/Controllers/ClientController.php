<?php

namespace App\Http\Controllers;

use App\Office;
use App\Client;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ClientController extends Controller
{
    public function index()
    {

        return view('client.index');
    }

    public function create()
    {
        $offices = Office::get();
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
            'first_name'=> ['required', 'string', 'alpha', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age'       => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string', 'max:255'],
        ]);

        $code_generarated = $request->code;
        $users = User::where('username',$code_generarated)->first();
        
        if(is_null($users))
        {
            $request['username'] = $request->code;
            $request['password'] = bcrypt('0');
            $request['type'] = 'client';
            $user = User::create($request->all());
            $request['user_id'] = $user->id;
            $client = Client::create($request->all());
            return redirect('/triage');
            

        }else{
            return back()->with('delete','This code is already used');
        }

    }
}
