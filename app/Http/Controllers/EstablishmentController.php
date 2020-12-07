<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Province;
use App\Municipal;
use App\Barangay;
use App\Establishment;
use App\Terminal;
use Auth;
use Validator;
use Illuminate\Support\Facades\Response;
use App\Establishment_type;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    public function index()
    {
        $establishment = Establishment::where('user_id', auth()->user()->id)->first();
        $establishment_id = $establishment->id;
        
        $role = auth()->user()->role;
        $terminals = Terminal::with('establishment')
                                ->where('establishment_id',$establishment_id)
                                ->orderBy('number','asc')
                                ->get();
        return view('establishment.index',compact('role','terminals'));
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

    public function establishmentValidate(Request $request)
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
            'username'              =>  'required|unique:users,username',
            'password'              =>  'required|confirmed',
        ]);
        
        
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function store(Request $request)
    {
        $data_user['username'] = $request->username;
        $data_user['password'] = bcrypt($request->password);
        $data_user['role'] = 1;
        $data_user['verified'] = 0;
        $data_user['first_name'] = $request->establishment_name;
        $user = User::create($data_user);

        // Request Establishment

        $request['user_id'] = $user->id;
        $request['admin_name'] = $request->first_name.' '.$request->last_name;
        $request['provCode'] = $request->province;
        $request['citymunCode'] = $request->municipal;
        $request['brgyCode'] = $request->barangay;
        
        $establishment = Establishment::create($request->all());
        auth()->login($user);
        return redirect('establishment')->with('successful', 'New record addedd successfully!');
    }

    public function updateEstablishment(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
       
        $user->update([
            'first_name' => $request->name,
            'password'  => bcrypt($request->password)
        ]);
        $establishment = new Establishment;
        $establishment_id = $establishment->where('user_id', $user_id)->first();
        
        $establishment_update = Establishment::findOrFail($establishment_id->id);
        $establishment_update->update([
            'establishment_name' => $request->name,
        ]);
        return redirect('establishment')->with('successUpdate','Record updated successfully');
    }

    public function terminalStore(Request $request)
    {
        $establishment = Establishment::where('user_id', auth()->user()->id)->first();
        $establishment_id = $establishment->id;
        $request['establishment_id'] = $establishment_id;
        $terminal = Terminal::create($request->all());

        return redirect('/establishment')->with('addedTerminal','Terminal: '.$terminal->description.' successfully added!');
    }

    public function editTerminal(Request $request, $terminalId)
    {
        $validator = Validator::make($request->all(),[
            'number'        => 'required|numeric',
            'description'   => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()->all() ]);
        }else{
            $terminal = Terminal::findOrFail($terminalId);
            $terminal->update($request->all());
 
             return response()->json(['success' => 'Update successfully' ]);
        }
        
    }

    public function destroy($terminal_id)
    {
        
    }
}
