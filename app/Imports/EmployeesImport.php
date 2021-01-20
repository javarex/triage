<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \App\Http\Controllers\EncryptionController;
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
            $newUser = User::create([
                'qrcode'            =>  $row['qrcode'],
                'first_name'        =>  $row['first_name'],
                'middle_name'       =>  $row['middle_name'],
                'last_name'         =>  $row['last_name'],
                'sex'               =>  $row['sex'],
                'birthday'          =>  $row['birthday'],
                'address'           =>  $row['address'],
                'barangay_id'       =>  $row['barangay'],
                'municipal_id'      =>  $row['municipal'],
                'province_id'       =>  $row['province'],
                'username'          =>  $row['username'],
                'password'          =>  $row['password'],
                'role'              =>  2,
               
            ]);
  
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
}
