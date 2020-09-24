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
        return view('office.create', compact('offices'));
    }

    public function store(Request $request)
    {
        $flag = False;
        $errorMessage = "";
        $validatedData = $request->validate([
            'name'    => 'required',
            'division'  => 'required',
            'username'  => 'required',
            'password'  =>  'required',
        ]);
        

        $office = Office::where('name', $request->name)->first();
        $check_username = User::where('username', $request->username)->first();

        //check duplication

        if(is_null($office))
        {
            if(!(is_null($check_username)))
            {
                $errorMessage = "Username already exist!";
                $flag = True;
            }
        }
        else
        {
            $flag = True;
            $errorMessage = "Office already exist!";
        }
        
        if($flag)
        {
            return redirect()->back()
                    ->withInput()->with('registerError',$errorMessage);
        }

        else
        {
            $request['first_name'] = $request->name;
            $request['middle_name'] = $request->name;
            $request['last_name'] = $request->name;
            $request['type'] = 'office';
            $request['password'] = bcrypt($request->password);
            $user = User::create($request->all());
            $user_id = $user->id;
            $request['user_id'] = $user_id; 
            $office_insert = Office::create($request->all());
            ?>
            <script>
                alert('New office added successfully!')
            </script>
            <?php
            return redirect('/admin');
        }

    }

    
}
