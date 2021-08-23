<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert([
            [
                'name'  =>  'User A',
                'email' =>  'zrshishir@gmail.com',
                'email_verified_at' => Now(),
                'password' => '123456',
                'currency' => 'USD',
            ],
            [
                'name'  =>  'User B',
                'email' =>  'ziaur.rahman@devnetlimited.com',
                'email_verified_at' => Now(),
                'password' => '123456',
                'currency' => 'EUR',
            ],

        ]);
    }
}
