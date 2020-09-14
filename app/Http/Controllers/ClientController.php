<?php

namespace App\Http\Controllers;

use App\Office;
use App\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{
    public function index()
    {

        return view('client.index');
    }

    public function create()
    {
        $offices = Office::get();
        $code = "triage".str_pad(mt_rand(1,99999), 5, '0', STR_PAD_LEFT);
        return view('client.create', compact('offices','code'));
    }

    public function store(Request $request)
    {
            $this->Validate($request, [
            'first_name' => ['required', 'string', 'alpha', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $request['username'] = $request->code;
        $request['password'] = bcrypt('0');
        $request['type'] = 'client';
        $user = User::create($request->all());
        $request['user_id'] = $user->id;
        $client = Client::create($request->all());
            

        return redirect('/triage');
    }
}
