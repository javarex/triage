<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use App\Exports\ActivitiesExport;
use App\Imports\ActivitiesImport;
use App\Imports\ActivityImport1;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class AdminController extends Controller 
{

   
    public function index()
    {
        $user_id = Auth::user()->id;
        $clients = Client::with('user','office')
                        ->orderBy('first_name', 'asc')
                        ->get();
        $offices = User::with('office')
                        ->where('type','office')
                        ->get();
        return view('admin.index', compact('clients','offices'));
    }

    public function updateClient(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        $client->update($request->all());
        $user = User::findOrFail($client->user_id);
        $user->update($request->all());
        return redirect('admin')->with('success_update',$client->first_name.' '.$client->last_name.' Saved changes!');
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
        
        Excel::import(new ActivityImport1, $request->file('file'));
        
        return back()->with('success_import','All is well!');
    }
}
