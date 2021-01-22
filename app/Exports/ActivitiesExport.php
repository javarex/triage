<?php
namespace App\Exports;

use App\Activity;
use App\Client;
use App\User;
use Carbon\Carbon;
use \App\Http\Controllers\EncryptionController;
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
       
        $users = User::with('province','municipal','barangay')
                    ->where('role',2)->get();
        
        return $users;
    }

    public function headings(): array
    {
        return [
            'qrcode',
            'first_name',
            'middle_name',
            'last_name',
            'sex',
            'birthday',
            'address',
            'barangay',
            'municipal',
            'province',
            'username',
            'password',
        ];
    }
    public function map($user): array
    {
        $decrypt = new EncryptionController;
        return [
            $user->qrcode,
            $user->first_name,
            $user->middle_name,
            $user->last_name,
            $user->sex,
            $user->birthday,
            $user->address,
            $user->barangay_id,
            $user->municipal_id,
            $user->province_id,
            $user->username,
            $user->password,
            // Carbon::parse($user->birthday)->age,
            // $user->barangay->brgyDesc.', '.$user->municipal->citymunDesc.', '.$user->province->provDesc,
          
        ];
    }
    
}
