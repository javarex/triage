<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function loginForm()
    {
        return view('admin.loginForm');
    }

    
    
    public function index()
    {
        $user_id = Auth::user()->id;
        $clients = Client::with('user','office')
                        ->where('type', '!=' , 'admin')
                        ->paginate(2);
        $offices = Office::all();
        // dd($clients);
        // $office = Office::with('client')
        //                 ->where('id',$clients['office_id'])
        //                 ->first();
        // dd($office);             
        return view('admin.index', compact('clients','offices'));
    }
}
