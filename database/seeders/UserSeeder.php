<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            [
                'name'  =>  'User A',
                'email' =>  'zrshishir@gmail.com',
                'email_verified_at' => Now(),
                'password' => Hash::make('123456'),
                'currency' => 'USD',
            ],
            [
                'name'  =>  'User B',
                'email' =>  'ziaur.rahman@devnetlimited.com',
                'email_verified_at' => Now(),
                'password' => Hash::make('123456'),
                'currency' => 'EUR',
            ],

        ]);
    }
}
