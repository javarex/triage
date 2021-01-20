<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
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
        
        foreach ($collection as $key => $row) 
        {
  
            $users = User::where('first_name', $row['ffirst'])
                        ->where('last_name', $row['flast'])
                        ->first();
            if (!empty($users)) {
                //set email verify
                $verifyEmail = User::findOrFail($users->id);
                $verifyEmail->update(['email_verified_at' => Carbon::now()]);  
            }else{
                //create new record 

                $newUser = User::create([
                    'username'          =>  $row['username'],
                    'password'          =>  bcrypt('admin'),
                    'first_name'        =>  $row['ffirst'],
                    'middle_name'       =>  $row['fmi'],
                    'last_name'         =>  $row['flast'],
                    'email_verified_at' =>  Carbon::now(),
                    'type'              =>  'employee',
                    'office_id'         =>  50,
                    'status'            =>  1,
                    'tag'               =>  0,
                ]);

                Client::create([
                    'user_id'           =>  $newUser->id,
                    'first_name'        =>  $newUser->first_name,
                    'middle_name'       =>  $newUser->middle_name,
                    'last_name'         =>  $newUser->last_name,
                    'age'               =>  'N/A',
                    'sex'               =>  'N/A',
                    'address'           =>  'N/A',
                    'contact_number'    =>  'N/A',
                    'office_id'         =>  50,

                ]);
            }
            
        }
    }
}
