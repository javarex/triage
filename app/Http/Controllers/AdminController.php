<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function loginForm()
    {
        return view('admin.loginForm');
    }

    
    
    public function index()
    {
        $user_id = Auth::user()->id;
        $clients = Client::with('user','office')
                        ->orderBy('first_name', 'asc')
                        ->get();
        $offices = User::with('office')
                        ->where('type','office')
                        ->get();
        return view('admin.index', compact('clients','offices'));
    }

    public function updateClient(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        $client->update($request->all());
        $user = User::findOrFail($client->user_id);
        $user->update($request->all());
        return redirect('admin')->with('success_update',$client->first_name.' '.$client->last_name.' Saved changes!');
    }
}
