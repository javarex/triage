<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Province;
use App\Municipal;
use App\Barangay;
use App\Establishment_type;
use App\Exports\ActivitiesExport;
use App\Imports\ActivitiesImport;
use App\Imports\ActivityImport1;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;


class AdminController extends Controller 
{

   
    public function index()
    {
        $newJson = '';
        $user = auth()->user();
        $clients = User::where('role','<>',0)
                        ->get();
        $newArray = array();
        foreach ($clients as $client) {
            if($client->role != 0){
                try {
                    $decrypted_firstname = Crypt::decryptString($client->first_name);
                    $decrypted_last_name = Crypt::decryptString($client->last_name);
                } catch (\Throwable $th) {
                    $decrypted_firstname = $client->first_name;
                    $decrypted_last_name = $client->last_name;
                }
                 array_push($newArray, array('first_name' => $decrypted_firstname, 'last_name' => $decrypted_last_name, 'qrcode'=> $client->qrcode ));
            }
        }
        return view('admin.index',compact('clients','newArray','user'));
    }

    public function create()
    { 
        $user = auth()->user();
        $establishment_type = Establishment_type::orderBy('type', 'asc')->get();
        $provinces = Province::orderBy('provDesc', 'asc')->get();
        $municipals = Municipal::orderBy('citymunDesc', 'asc')->get();
        $barangays = Barangay::orderBy('brgyDesc', 'asc')->get();
        return view('admin.create', compact('provinces','establishment_type','municipals','barangays','user'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'establishment_name' => 'required'
        ]);
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
     public function show ()
     {
         return view('establishment.index');
     }
}
