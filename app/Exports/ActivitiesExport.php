<?php

namespace App\Exports;

use App\Activity;
use App\Client;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActivitiesExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = Client::with('user')->get();
        
        return $users;
    }

    public function headings(): array
    {
        return [
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'sex',
            'age',
            'address',
            'Activity',
            'Remarks'
        ];
    }
    public function map($user): array

    {
        return [
            $user->user->username,
            $user->first_name,
            $user->middle_name,
            $user->last_name,
            $user->sex,
            $user->age,
            $user->address,
          
        ];
    }
    
}
