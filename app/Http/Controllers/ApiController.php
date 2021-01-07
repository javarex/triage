<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    public function transmit(Request $request) {

        $data = $request->all();

        foreach($data as $r) {
           
            DB::table('logs')->insert([
                'barcode' => $r['barcode'],
                'time_in' => $r['time_in'],
                'terminal_id' => $r['terminal_id'],
            ]);
        }

        return "Success";

    }

    public function download() {
        
        $page = Input::get('page');
        $startPage = Input::get('startPage');
        $username = Input::get('username');
        $password = Input::get('password');

        $user = DB::table('users')
            ->select('username', 'password', 'first_name', 'last_name')
            ->where('username', $username)
            ->first();

        if (!Hash::check($password, $user->password)) {
            return "You are not authorized";
        }


        $limit = 2500;
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
 
        $pages = round($data / 2500);

        return response()->json([
                'total' => $data,
                'pages' => $pages
            ]);
    }

    public function login(Request $request) {


            $username = $request->username;
            $password = $request->password;

            $user = User::with(['establishment' => function ($q) {
                $q->with(['terminal' => function ($q) {
                    $q->select('description', 'id', 'establishment_id')->get();
                }])->select('establishment_name', 'id', 'user_id')->get();
            }])
            ->select('username', 'password', 'first_name', 'last_name', 'id')
            ->where('username', $username)
            ->first();

        if (Hash::check($password, $user->password)) {
            return response()->json($user);
        }

    }
}
