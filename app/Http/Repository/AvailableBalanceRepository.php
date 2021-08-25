<?php


namespace App\Http\Repository;

use App\Models\Wallet;

class AvailableBalanceRepository
{
    public function checkAvailableBalance($userId, $amount){
        $availability = Wallet::where('balance', '>', $amount)
                                    ->where('user_id', $userId)
                                    ->exists();
        return $availability;
    }
}
