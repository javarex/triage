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
        $this->middleware('admin');
    }

    //for admin create office
    public function create()
    {
        $offices = Office::where('used',0)
                            ->orderBy('name', 'asc')
                            ->get();
        return view('office.create', compact('offices'));
    }

    public function store(Request $request)
    {
        $office_id = Office::where('id',$request->office_id)
                            ->first();
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
            $request['first_name'] = $office_id->name;
            $request['middle_name'] = '';
            $request['last_name'] = '';
            $request['office_id'] = $request->office_id;
            $request['password'] = bcrypt($request->password);
            $request['used'] = 1;
            $user = User::create($request->all());
            $user_id = $user->id;

            $office = Office::findOrFail($request->office_id);
            $office->update($request->all());

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
