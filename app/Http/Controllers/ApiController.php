<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    public function transmit(Request $request) {

        $data = $request->all();

        foreach($data as $r) {
           
            DB::table('logs')->insert([
                'barcode' => $r['barcode'],
                'time_in' => $r['time_in'],
            ]);
        }

        return "Success";

    }

    public function download() {
        
        $page = Input::get('page');
        $startPage = Input::get('startPage');

        $limit = 10000;
        $offset = (($limit) * $page) - ($limit);
        if ($page == 1) {
            $offset = 0;
        }

        $data = DB::table('users')
            ->leftJoin('municipals', 'users.municipal_id', '=', 'municipals.id')
            ->select('users.id','username', 'first_name', 'middle_name', 'last_name', 'qrcode', 'birthday', 'sex', 'municipals.citymunDesc as municipal');
        
        if ($startPage > 0) {
            $data->where('users.id', '>', $startPage);
        }

        $data = $data->limit($limit)->offset($offset)->get()->toArray();

        return response()->json($data);
    }

    public function total_records() {

        $startPage = Input::get('startPage');

        $data = DB::table('users')
            ->select('users.id');

        if ($startPage > 0) {
            $data->where('users.id', '>', $startPage);
        }

        $data = $data->count();

        $pages = round($data / 10000);

        return response()->json([
                'total' => $data,
                'pages' => $pages
            ]);
    }
}
