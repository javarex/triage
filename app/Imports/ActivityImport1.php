<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\User;
use App\Activity;
use App\Client;

class ActivityImport1 implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $idClient = 0;
       foreach ($collection as $key => $row) 
        {
            
            $users = User::where('username', $row['username'])->first();
            
            if(!empty($users))
            {
                $clients = Client::where('user_id', $users->id)->first();
            
                Activity::create([
                    'client_id'     => $clients->id,
                    'activity'      => strval( $row["activity"]),
                    'office_id'     => 49,
                    'approve'       => 1,
                    'tag_id'        => 0,
                    'time_in'       => date('H:i:s', strtotime($row["current_time"])),
                    'time_out'      => '09:00:00',
                    
                ]);
               
            } 
            
        }
    }
}
