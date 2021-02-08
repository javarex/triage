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
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;


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
        $encrypt = new EncryptionController;
        
        $user = User::findOrFail($request->client_id);
        $request['birthday'] = date('Y-m-d', strtotime($request->birthday));
        $request['first_name'] = $encrypt->encrypt(ucwords($request->first_name)); //255
        $request['middle_name'] = ucwords($request->middle_name);
        $request['last_name'] = $encrypt->encrypt(ucwords($request->last_name)); //255 length
        $request['password']    = bcrypt($request->password);
        $user->update($request->all());
        return redirect('userModule')->with('success_update',$encrypt->decrypt($request->first_name).' '.$encrypt->decrypt($user->last_name).' information successfully changed!');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->update();
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
         $clients = [];
         $data = User::where('role', 2)
                    ->paginate(10); 
        foreach ($data as $value) {
            array_push($clients,[
                "id"        => $value->id,
                "name"      => $decrypt->decrypt($value->first_name).' '.$decrypt->decrypt($value->last_name),
                "first_name"=> $decrypt->decrypt($value->first_name),
                "last_name" => $decrypt->decrypt($value->last_name),
                "middle_name"=> $value->middle_name,
                "qrcode"    => $value->qrcode,
                "birthday"    => $value->birthday,
                "age"       => Carbon::parse($value->birthday)->age,
                "gender"    =>  $value->sex, 
            ]);
        }
        json_encode($clients);
        return view('admin.user.index',compact('clients','data'));
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
        $full_name = crypt(strtoupper($search),'$1$hNoLa02$');
        if($search == ''){
            $users = User::orderby('id','asc')->select('id','qrcode')->limit(5)->get();
        }else{
           
            $users = User::orderby('first_name','asc')
                        ->select('id','first_name','last_name','qrcode','suffix')
                        ->where('role',2)
                        ->where('hash', 'like', '%' .$full_name . '%')
                        ->limit(5)->get();
         }
   
      
        $response = array();
        foreach($users as $user){
           $response[] = array("value"=>$user->id,"qrcode"=>$user->qrcode,"label"=>$decrypt->decrypt($user->first_name).' '.$decrypt->decrypt($user->last_name).' '.$user->suffix);

        }
        return response()->json($response);
     }

     //edit user

     public function edit_user(Request $request)
     {
        
     }

     //generate Report

     public function generateReport(Request $request)
     {
        $fullname = strtoupper($request->search_input);
        $hashed_fullname = crypt($fullname,'$1$hNoLa02$');
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

            dd($data);
            
            // Establishment Visit

            
            
        }

     }

     // sample pdf print 

     public function printPDF(Request $request)
    {
     
        $from = $request->from;
        $to = $request->to;
        $data = [
            'title'     => 'CCTS Report',
            'citizen'   => $request->search_input,
            'content'   => 'sample',
            'from'      => $from,
            'to'      => $to,
              ];


        $logs = DB::table('logs')
                    ->select(
                            'terminals.description',
                            'logs.time_in',
                            'establishments.establishment_name'
                            )
                    ->join('terminals','logs.terminal_id','terminals.id')
                    ->join('establishments','terminals.establishment_id','establishments.id')
                    ->where('barcode',$request->barcode)
                    ->whereBetween(\DB::raw('DATE(time_in)'), [$from, $to])
                    ->get();
        
        $pdf = PDF::loadView('admin.pdf_view', array('data' => $data, 'logs' => $logs) )->setPaper('a4');  
        return $pdf->stream('medium.pdf');
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


    // DataTables search

    public function searchUser(Request $request){
    
        $decrypt = new EncryptionController;
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
   
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
        $fullname = strtoupper($searchValue);
        $hashed_fullname = crypt($fullname,'$1$hNoLa02$');
        // Total records
        $totalRecords = User::select('count(*) as allcount')
                        ->where('role', 2)
                        ->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')
                        ->where('role', 2)
                        ->count();
   
        // Fetch records
        if($searchValue)
        {
            $records = User::orderBy('id','asc')
                        ->where('users.hash', 'like', '%' . $hashed_fullname . '%')
                        ->orWhere('users.qrcode', 'like', '%' . $searchValue . '%')
                        ->orWhere('users.username', 'like', '%' . $searchValue . '%')
                        ->where('role', 2)
                        ->select('users.*')
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();
        }else{
            $records = User::orderBy('id','asc')
                        ->where('users.hash', 'like', '%' . $hashed_fullname . '%')
                        ->orWhere('users.qrcode', 'like', '%' . $searchValue . '%')
                        ->where('users.username', 'like', '%' . $searchValue . '%')
                        ->where('role', 2)
                        ->select('users.*')
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();
        }
        $data_arr = array();
        
        foreach($records as $record){
           $qrcode = $record->qrcode;
           $name = $decrypt->decrypt($record->first_name).' '.$decrypt->decrypt($record->last_name);
           $email = $record->email;
   
           $data_arr[] = array(
            "qrcode"    => $qrcode,
            "name"      => $name,
            "age"       => Carbon::parse($record->birthday)->age ,
            "gender"    => $record->sex,
            "option"    => "<a href='#' data-id='".$record->id."' data-name='".$name."' class='deleteUser'><i class='fa fa-fw fa-trash'></i></a>
            <a href='#' id='client_view' data-toggle='modal' data-target='#edit_user' 
                            data-client_id='".$record->id."'
                            data-username='".$record->username."'
                            data-firstName='".$decrypt->decrypt($record->first_name)."'
                            data-middleName='".$record->middle_name."'
                            data-lastName='".$decrypt->decrypt($record->last_name)."'
                            data-birthday='".$record->birthday."'
                            >
                                <i class='fas fa-edit' ></i>
                            </a>",
           );
        }
     
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );
   
        echo json_encode($response);
        exit;
      }
     

      // delete user record
      public function deleteUser(Request $request)
      {
        $user = User::find($request->id);
        $user->delete();
      }

      // update user 
      public function userHash()
      {
        $users = User::where('role',2)
                    ->get();

        foreach($users as $user)
        {
            
            $decrypt = new EncryptionController;
            
            $fetch_user = User::findOrFail($user->id);
            if(!$fetch_user->suffix){
                $fullname = strtoupper($decrypt->decrypt($user->first_name).' '.$decrypt->decrypt($user->last_name));
            }else{
                $fullname = strtoupper($decrypt->decrypt($user->first_name).' '.$decrypt->decrypt($user->last_name).' '.$user->suffix);
            }
            $hashed_fullname = crypt($fullname,'$1$hNoLa02$');
            $fetch_user->update([
                'hash' => $hashed_fullname
            ]);
            
        }
      }

      // update duplicates qr
      public function updateQRuser()
      {
          $newUser = User::where('qrcode','DDOXUP83')  
                    ->get();

        foreach ($newUser as $user) {
            for(;;){
                $code = $this->random_stringGenerate();
                $findTerminal = User::where('qrcode',$code)
                                ->first();
                
                if($findTerminal)
                {
                    continue;
                }
                else{
                    break;
                }
            }
            $userUpdate = User::findOrFail($user->id);
            $user->update([
                'qrcode' => $code,
                'qredit' => NULL
            ]);
        }
        return redirect('/');
      }

      public function random_stringGenerate()
    {
        $alphaList = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        
        $digits = sprintf('%02d',mt_rand(01, 99));
        $leters = substr(str_shuffle($alphaList),0,3);
        $code = 'DDO'.$leters.$digits;
        
        return $code;
    }

    function array_to_obj($array, &$obj)
    {
        foreach ($array as $key => $value)
        {
        if (is_array($value))
        {
        $obj->$key = new stdClass();
        array_to_obj($value, $obj->$key);
        }
        else
        {
            $obj->$key = $value;
        }
        }
    return $obj;
    }

    function arrayToObject($array)
    {
    $object= new stdClass();
    return array_to_obj($array,$object);
    }
}
