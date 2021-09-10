<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Log;
use \App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use DB;

class LogController extends Controller
{
    public function __construct(Log $model)
    {
        $this->model = $model;
    }
    
    public function index()
    {
        // $fullname = strtoupper('Leorene Vargas');
        // $hashed_fullname = crypt($fullname,'$1$hNoLa02$');
        // $totalRecords = DB::select('select count(*) as allcount from logs where barcode is  not null');
        // $totalRecords1 = $this->model->select('count(*) as allcount')->whereNotNull('barcode')->count();
        

        // $records = DB::table('logs')
        //                 ->select(
        //                 'users.*',
        //                 'logs.*',
        //                 'municipals.citymunDesc',
        //                 'barangays.brgyDesc',
        //                 'provinces.provDesc'
        //                 )
        //                 ->leftjoin('users',function($join) {
        //                     $join->on('logs.barcode','=', 'users.qrcode');
        //                     $join->on('logs.barcode','=', 'users.qredit');
        //                 })
        //                 ->leftjoin('municipals','users.municipal_id', 'municipals.id')
        //                 ->leftjoin('barangays','users.barangay_id','barangays.id')
        //                 ->leftjoin('provinces','users.province_id','provinces.id')
        //                 ->leftJoin('terminals','logs.terminal_id','terminals.id')
        //                 ->leftJoin('establishments','terminals.establishment_id','establishments.id')
        //                 ->distinct()
        //                 ->orderby('logs.id','desc')
        //                 ->get();
        // dd($records);
        return view('log.index');
    }

    public function get_user(Request $request)
    {
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

        $totalRecords = DB::select('select count(*) as allcount from logs where barcode is  not null');
        $totalRecords =  $totalRecords[0]->allcount;
        $totalRecordswithFilter = $totalRecords;
        $records = DB::table('logs')
                        ->select(
                            'users.*',
                            'logs.id',
                            'logs.barcode',
                            'logs.terminal_id',
                            'logs.time_in',
                            'logs.time_out',
                            'logs.type',
                            'municipals.citymunDesc',
                            'barangays.brgyDesc',
                            'provinces.provDesc',
                            'terminals.description',
                            'establishments.establishment_name'
                        )
                        ->leftjoin('users','logs.barcode', 'users.qrcode')
                        ->leftjoin('municipals','users.municipal_id', 'municipals.id')
                        ->leftjoin('barangays','users.barangay_id','barangays.id')
                        ->leftjoin('provinces','users.province_id','provinces.id')
                        ->leftJoin('terminals','logs.terminal_id','terminals.id')
                        ->leftJoin('establishments','terminals.establishment_id','establishments.id')
                        ->distinct();
                        
        
        if ($searchValue) {
            $records = $records->where('users.hash', 'like', '%' . $hashed_fullname . '%');
        }
        $records = $records
                    ->orderby('logs.id','desc')
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();

        $data_arr = array();

        foreach($records as $record){
            if (!$record->first_name) {
                continue;
            }
            $dt = Carbon::parse($record->time_in);
            $qrcode = $record->qrcode;
            $name = $decrypt->decrypt($record->first_name).' '.$decrypt->decrypt($record->last_name);
            $email = $record->email;
            $data_arr[] = array(
                'name' => $name,
                'establishment' => $record->establishment_name,
                'terminal' => $record->description,
                'address' => $record->citymunDesc,
                'contact_no' => $record->contact_number,
                'date' => date('j-n-Y',strtotime($record->time_in)),
                'time' => date('g:i a',strtotime($record->time_in))
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
}
