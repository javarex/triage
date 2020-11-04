<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use App\Exports\ActivitiesExport;
use App\Imports\ActivitiesImport;
use App\Imports\ActivityImport1;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;


class AdminController extends Controller 
{

   
    public function index()
    {
        
        $user_id = Auth::user()->id;
        $clients = User::with('office')
                        ->where('role','<>',0)
                        ->orderBy('first_name', 'asc')
                        ->get();
        return view('admin.index', compact('clients'));
    }

    public function updateClient(Request $request)
    {
        $user = User::findOrFail($request->client_id);
        $user->update($request->all());
        return redirect('admin')->with('success_update',$user->first_name.' '.$user->last_name.' information successfully changed!');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->update();
        
        $client = Client::where('user_id', $id)->first();
        $client->update(['first_name' => $request['first_name']]);
        return redirect('/');
    }

    public function export() 
    {
        return Excel::download(new ActivitiesExport, 'Credentials.csv');
    }

    public function import(Request $request) 
    {
        $this->validate($request,[
            'file'  =>  'required|mimes:xlsx,csv,txt'
        ]);
        set_time_limit(0);
        Excel::import(new EmployeesImport, $request->file('file'));
        return back()->with('success_import','All is well!');
    }
}
