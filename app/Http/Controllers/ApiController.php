<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function transmit(Request $request) {

        $data = $request->all();

        foreach($data as $r) {
           
            DB::table('logs')->insert([
                'barcode' => $r['barcode'],
                'timeIn' => $r['timeIn'],
            ]);
        }

        return "Success";

    }

    public function download() {
        $data = DB::table('users')
            ->leftJoin('municipals', 'users.municipal_id', '=', 'municipals.id')
            ->select('users.id','username', 'first_name', 'middle_name', 'last_name', 'qrcode', 'birthday', 'sex', 'municipals.citymunDesc as municipal')
            ->limit(10000)->get()->toArray();

        return response()->json($data);
    }
}
