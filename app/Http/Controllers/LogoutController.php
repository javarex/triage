<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout_user()
    {
        Auth::logout();
        return redirect('/');
        // if (Auth::user()->type != 0 && !(is_null(Auth::user()->email))) {
        //     DB::table('users')
        //             ->where('id', Auth::user()->id)
        //             ->update(['email_verified_at' => NULL]);

        //     Auth::logout();
        //     return redirect('/');
        // }else{
        //     Auth::logout();
        //     return redirect('/');
        // }

    }
}
