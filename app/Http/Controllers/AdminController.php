<?php

namespace App\Http\Controllers;

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
        return view('admin.index');
    }
}
