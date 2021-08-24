<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("wallets")->insert([
            [
                'user_id' => 1,
                'balance' => 5000,
                'total_conversion' => 0,
            ],
            [
                'user_id' => 2,
                'balance' => 5000,
                'total_conversion' => 0,
            ],
        ]);
    }
}
