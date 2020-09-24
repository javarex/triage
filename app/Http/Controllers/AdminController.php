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
                        ->paginate(10);
        $offices = Office::all();
                   
        return view('admin.index', compact('clients','offices'));
    }
}
