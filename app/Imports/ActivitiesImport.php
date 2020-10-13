<?php

namespace App\Imports;

use App\Activity;
use App\user;
use App\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class ActivitiesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        $client_id = User::with('client')
                            ->where('username', $row['username'])->first();
        $id_of_client =  $client_id->client->id;
        return new Activity([
            'client_id'     => $id_of_client,
            'activity'      => $row['activity'],
            'office_id'     => 49,
            'approve'       => 1,
            'tag_id'        => 0,
            'time_in'       => date('H:i:s', strtotime($row['current_time'])),
            'time_out'      => '09:00:00',

        ]);
    }
}
