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

       for ($i = 0; $i < 1000; $i++) {

           $rand = Str::random(10);
           $token = Str::random(10);

            array_push($userData,[
                'username' => $rand,
                'email' => $rand . '@gmail.com',
                'password' => $password,
                'verified' => 0,
                'role' => 2,
                'remember_token' => $token,
            ]);
        }

        $chunk1 = array_chunk($userData, 100);

        foreach ($chunk1 as $c) {
            DB::table('users')->insert($c);
        }


    }
}
