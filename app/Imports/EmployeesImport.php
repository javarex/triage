<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \App\Http\Controllers\EncryptionController;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Client;
use Carbon\Carbon;

class EmployeesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        

        $encrypt = new EncryptionController;
        foreach ($collection as $key => $row) 
        {
            for (;;) { 
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
            $fullname = strtoupper($row['first_name'].' '.$row['last_name']);
            $hashed_fullname = crypt($fullname,'$1$hNoLa02$');
            $duplicate = User::where('hash',$hashed_fullname)->first();
            
            if (is_null($row['province_code']) || is_null($row['barangay_code']) || is_null($row['municipality_code'])) {
                continue;
            }else{
                $address = DB::table('barangays')
                            ->join('provinces','barangays.provCode','=','provinces.provCode')
                            ->join('municipals','barangays.citymunCode','=','municipals.citymunCode')
                            ->select(
                                'provinces.id AS province_id',
                                'provinces.provCode',
                                'provinces.provDesc',
                                'municipals.id AS municipal_id',
                                'municipals.citymunCode',
                                'municipals.citymunDesc',
                                'barangays.id AS barangay_id',
                                'barangays.brgyDesc',
                                'barangays.brgyCode'
                                )
                            ->where('provinces.provDesc','like','%'.$row['province_name'].'%')
                            ->where('municipals.citymunDesc','like','%'.$row['municipality_name'].'%')
                            ->where('barangays.brgyDesc','like','%'.$row['barangay_name'].'%')
                            ->first();

                if (!$duplicate) {
                    $first_name = ucwords(mb_strtolower($row['first_name']));
                    $middle_name = ucwords(mb_strtolower($row['middle_name']));
                    $last_name = ucwords(mb_strtolower($row['last_name']));
                    if($address){
                        $newUser = User::create([
                            'qrcode'            =>  $code,
                            'first_name'        =>  $encrypt->encrypt($first_name),
                            'middle_name'       =>  $middle_name,
                            'last_name'         =>  $encrypt->encrypt($last_name),
                            'hash'              =>  $hashed_fullname,
                            'sex'               =>  $row['sex'],
                            'birthday'          =>  $row['birthday'],
                            'province_id'       =>  $address->province_id,
                            'municipal_id'      =>  $address->municipal_id,
                            'barangay_id'       =>  $address->barangay_id,
                            'username'          =>  $last_name.$row['empl_id'],
                            'password'          =>  bcrypt("temppass".$row['empl_id']),
                            'role'              =>  2,
                            'verified'          =>  0,
                           
                        ]);
                    }
                }
            }
  
        //     $users = User::where('first_name', $row['ffirst'])
        //                 ->where('last_name', $row['flast'])
        //                 ->first();
        //     if (!empty($users)) {
        //         //set email verify
        //         $verifyEmail = User::findOrFail($users->id);
        //         $verifyEmail->update(['email_verified_at' => Carbon::now()]);  
        //     }else{
        //         //create new record 

               

        //         // Client::create([
        //         //     'user_id'           =>  $newUser->id,
        //         //     'first_name'        =>  $newUser->first_name,
        //         //     'middle_name'       =>  $newUser->middle_name,
        //         //     'last_name'         =>  $newUser->last_name,
        //         //     'age'               =>  'N/A',
        //         //     'sex'               =>  'N/A',
        //         //     'address'           =>  'N/A',
        //         //     'contact_number'    =>  'N/A',
        //         //     'office_id'         =>  50,

        //         // ]);
        //     }
            
        }
    }

    //generate terminal qrcode
    public function random_stringGenerate()
    {
        $alphaList = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        
        $digits = sprintf('%02d',mt_rand(01, 99));
        $leters = substr(str_shuffle($alphaList),0,3);
        $code = 'DDO'.$leters.$digits;
        
        return $code;
    }

}
