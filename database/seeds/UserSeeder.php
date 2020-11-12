<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [];
        $password = bcrypt('password');

       for ($i = 0; $i < 10; $i++) {

           $rand = Str::random(10);

            array_push($userData,[
                'username' => $rand,
                'email' => $rand . '@gmail.com',
                'password' => $password,
            ]);
        }

        $chunk1 = array_chunk($userData, 100);

        foreach ($chunk1 as $c) {
            DB::table('users')->insert($c);
        }


    }
}
