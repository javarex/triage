<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_type = Auth::user()->type;
        if($user_type == 'admin')
        {
            return redirect('/admin');
        }elseif($user_type == 'office'){
            return redirect('/officeLog');
        }
    }
}
