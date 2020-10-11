<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use App\Exports\ActivitiesExport;
use App\Imports\ActivitiesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
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
            'file'  =>  'required|mimes:xlsx'
        ]);
        dd('asdf');
        
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path)->get();

        if($data->count() > 0){
            foreach ($data->toArray() as $key => $value) {
                foreach ($value as $row) {
                    dd($row['id']);
                }
            }
        }
           
        return back();
    }
}
