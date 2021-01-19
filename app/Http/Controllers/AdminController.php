<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Province;
use App\Municipal;
use App\Barangay;
use App\Logs;
use App\Establishment_type;
use App\Establishment;
use Carbon\Carbon;
use Auth;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Exports\ActivitiesExport;
use App\Imports\ActivitiesImport;
use App\Imports\ActivityImport1;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
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
       
        $decrypt = new EncryptionController;
        $user = auth()->user();
        $first_nameAdmin =  $decrypt->decrypt($user->first_name);
        $role = auth()->user()->role;
        $newJson = '';
        $estabLishment = Establishment::all();
        $citizens = User::where('role',2)
                        ->get();
        

        $clients = User::where('role','<>',0)
                        ->get();
        $newArray = array();
        foreach ($clients as $client) {
            
            if($client->role != 0 && $client->role != 1){
                $decrypted_firstname = $this->decryptValue($client->first_name);
               
                $decrypted_last_name = $this->decryptValue($client->last_name);
                 array_push($newArray, array('first_name' => $decrypted_firstname, 'last_name' => $decrypted_last_name, 'qrcode'=> $client->qrcode ));
            }
        }
        return view('admin.index',compact('clients','newArray','user','role','citizens','estabLishment','first_nameAdmin'));
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
        $now = date('Y-m-d');
        return Excel::download(new ActivitiesExport, 'citizens_'.$now.'.xlsx');
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


     public function userModule_index()
     {
        $decrypt = new EncryptionController;
        $user = auth()->user();
        $first_nameAdmin =  $decrypt->decrypt($user->first_name);
        $role = auth()->user()->role;
        $newJson = '';

        $clients = User::with('barangay','municipal','province')
                        ->where('role',2)
                        ->get();
        $newArray = array();
        foreach ($clients as $client) {
            
            if($client->role != 0 && $client->role != 1){
                $decrypted_firstname = $decrypt->decrypt($client->first_name);
               
                $decrypted_last_name = $decrypt->decrypt($client->last_name);
                 array_push($newArray, array(
                     'first_name'   => $decrypted_firstname, 
                     'last_name'    => $decrypted_last_name, 
                     'qrcode'       => $client->qrcode,
                     'age'          =>  Carbon::parse($client->birthday)->age ,
                     'gender'       => $client->sex,
                     'barangay'      =>  $client->barangay['brgyDesc'],
                     'municipal'      =>  $client->municipal['citymunDesc'],
                     'province'      =>  $client->province['provDesc'],
                ));
            }
        }
        return view('admin.user.index',compact('clients','newArray','user','role','first_nameAdmin'));
     }

     public function establishment_index()
     {
        $decrypt = new EncryptionController;
        $user = auth()->user();
        $first_nameAdmin =  $decrypt->decrypt($user->first_name);
        $users = DB::table('establishments')
                        ->join('barangays','establishments.brgyCode','=','barangays.brgyCode')
                        ->join('municipals','establishments.citymunCode','=','municipals.citymunCode')
                        ->join('provinces','establishments.provCode','=','provinces.provCode')
                        ->get();
         return view('admin.admin_establishment.index',compact('first_nameAdmin','users'));
     }

     //report generate
     public function report()
     {
        $decrypt = new EncryptionController;
        $user = auth()->user();
        $first_nameAdmin =  $decrypt->decrypt($user->first_name); 

        return view('admin.report',compact('first_nameAdmin'));
     }

     //auto complete  user input in report view
     public function getUser(Request $request){
        $decrypt = new EncryptionController;

        $search = $request->search;
        $searchType = $request->searchType;
        if($search == ''){
           $users = User::orderby('first_name','asc')->select('id','first_name','last_name')->limit(5)->get();
        }else{

            if($search == ''){
                $users = User::orderby('qrcode','asc')->select('id','qrcode')->limit(5)->get();
             }else{
                $users = User::orderby('qrcode','asc')
                             ->select('id','qrcode')
                             ->where('qrcode', 'like', '%' .$search . '%')
                             ->limit(5)->get();
             }
       
             $response = array();
             foreach($users as $user){
                $response[] = array("value"=>$user->id,"barcode" => $user->qrcode,"label"=>$user->qrcode);
             }

           $users = User::orderby('first_name','asc')
                        ->select('id','first_name','last_name','qrcode')
                        ->where('first_name', 'like', '%' .$search . '%')
                        ->where('role',2)
                        ->where('last_name', 'like', '%' .$search . '%')
                        ->limit(5)->get();
        }
  
        $response = array();
        foreach($users as $user){
           $response[] = array("value"=>$user->id,"qrcode"=>$user->qrcode,"label"=>$decrypt->decrypt($user->first_name).' '.$decrypt->decrypt($user->last_name));

        }
        return response()->json($response);
     }

     //generate Report

     public function generateReport(Request $request)
     {
        
         $data = [
             'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the'
         ];
        

        $logs = Logs::where('barcode', $request->qrcode)
                    ->whereBetween('time_in',[$request->from." 00:00:00", $request->to." 23:59:59"])

                    ->get();
        foreach ($logs as $log) {
            $datetime = $log->created_at->format('Y-m-d H:i:s');
            $timestamp = strtotime($datetime);
            $timeBefore = $timestamp - ($request->before_arrival * 60 * 60);
            $timeAfter = $timestamp + ($request->after_arrival * 60 * 60);
            $datetimeBefore = date("Y-m-d H:i:s", $timeBefore);
            $datetimeAfter = date("Y-m-d H:i:s", $timeAfter);
            // dd($datetimeBefore.' & '.$datetimeAfter);
            $count = DB::table('logs')
                    ->where('terminal_id', $log->terminal_id)
                    ->whereBetween('time_in',[$datetimeBefore, $datetimeAfter])
                    ->get();
            $establishment_visit = DB::table('establishments')
                                    ->join('terminals','establishments.id', '=', 'terminals.establishment_id')
                                    ->join('barangays','establishments.brgyCode', '=', 'barangays.brgyCode')
                                    ->join('municipals','establishments.citymunCode', '=', 'municipals.citymunCode')
                                    ->select('establishments.*','municipals.citymunDesc','barangays.brgyDesc')
                                    ->where('terminals.id',$log->terminal_id)
                                    ->first();

            array_push($data,[
                'establishment' => $establishment_visit->establishment_name,
                'date'          => $establishment_visit->created_at,
                'visitorsCount' => $count->count(),
                'municipal'     => $establishment_visit->citymunDesc,
                'barangay'      => $establishment_visit->brgyDesc,  
                'before'        => $datetimeBefore,
                'after'         => $datetimeAfter,
            ]);
            
            // Establishment Visit

            
            
        }

     }

     //decrypt value

     protected function decryptValue($myString)
     {
         try {
             //code...
             $result = Crypt::decryptString($myString);
            
         } catch (DecryptException $e) {
             $result = $myString;
         }
         return $result;

         try {
             //code...
         } catch (\Throwable $th) {
             //throw $th;
         }
     }

     
}
