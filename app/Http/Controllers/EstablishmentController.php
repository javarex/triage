<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Province;
use App\Municipal;
use App\Barangay;
use Validator;
use Illuminate\Support\Facades\Response;
use App\Establishment_type;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    public function index()
    {
        return view('establishment.index');
    }

    public function create()
    {
        $user = auth()->user();
        $establishment_type = Establishment_type::orderBy('type', 'asc')->get();
        $provinces = Province::orderBy('provDesc', 'asc')->get();
        $municipals = Municipal::orderBy('citymunDesc', 'asc')->get();
        $barangays = Barangay::orderBy('brgyDesc', 'asc')->get();

        return view('establishment.create', compact('provinces','establishment_type','municipals','barangays','user'));
    }

    public function store(Request $request)
    {
            
     
        $validator = Validator::make($request->all(),[
            'establishment_name'    =>  'required',
            'establishment_type'    =>  'required',
            'province'              =>  'required',
            'municipal'             =>  'required',
            'barangay'              =>  'required',
            'agency_head'           =>  'required',
            'first_name'            =>  'required',
            'last_name'             =>  'required',
            'username'              =>  'required',
            'password'              =>  'required|confirmed',
        ]);
        $request['provCode'] = $request->province;
        $request['citymunCode'] = $request->municipal;
        $request['brgyCode'] = $request->barangay;
        $check = Post::create($input);
        if($validator->passes()){

            return response()->json(['success' => 'Addedd new record']);
        }
        
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
