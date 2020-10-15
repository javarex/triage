<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    protected $username = 'username';
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/triage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function authenticated(Request $request, $user)
    {
        
        $users_query = User::where('username',$request->username)
                            ->where('status','<>',NULL)
                            ->first();
       
        $userId = Auth::id();

        if(!(is_null($users_query)))
        {
            if($users_query->type == 'admin')
            {
                return redirect('/admin');
            }
            elseif($users_query->type == 'office')
            {
                return redirect('/officeLog');
            }
        
        }else{
            return redirect('/logout');
           
        }
    }

}
