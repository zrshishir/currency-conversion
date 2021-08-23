<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
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
                'user_id' => 1,
                'balance' => 5000,
            ],
            [
                'user_id' => 2,
                'balance' => 5000,
            ],
        ]);
    }
}
