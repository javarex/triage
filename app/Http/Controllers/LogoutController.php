<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;

class LogoutController extends Controller
{
    public function logout_user()
    {
        if (Auth::user()->type != 'admin') {
            DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['email_verified_at' => NULL]);

            Auth::logout();
            return redirect('/');
        }
        
    }
}
