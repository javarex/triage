<?php

namespace App\Http\Controllers;

use App\Office;
use App\User;
use Auth;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_type = Auth::user()->type;
        if($user_type != 'office')
        {
            Auth::logout();
            return redirect('login');
        }
        return redirect('/officelog/create');
    }

    //for admin create office
    public function create()
    {
        $offices = Office::all();
        return view('office.create', compact('offices'));
    }

    public function store(Request $request)
    {
        $flag = False;
        $errorMessage = "";
        $validatedData = $request->validate([
            'office_id'    => 'required',
            'username'  => 'required',
            'password'  =>  'required',
        ]);
        

  
        $check_username = User::where('username', $request->username)->first();

        //check duplication

        
        if(!(is_null($check_username)))
        {
            $errorMessage = "Username already exist!";
            $flag = True;
        }
    
        if($flag)
        {
            return redirect()->back()
                    ->withInput()->with('registerError',$errorMessage);
        }

        else
        {
            $request['type'] = 'office';
            $request['first_name'] = '';
            $request['middle_name'] = '';
            $request['last_name'] = '';
            $request['office_id'] = $request->office_id;
            $request['password'] = bcrypt($request->password);
            $user = User::create($request->all());
            $user_id = $user->id;

            return redirect('/admin')->with('success','New office added!');
        }

    }

    public function update(Request $request, $id)
    {
        $office = User::findOrFail($id);
        $office->update($request->all());
        return back();
    }

    
}
