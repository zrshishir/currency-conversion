<?php

namespace App\Http\Balance;

use App\Http\Repository\AvailableBalanceRepository;

class AvailableBalance
{
    private $balanceRepo;

    public function __construct(){
        $this->balanceRepo = new AvailableBalanceRepository();
    }

    public function checkBalance($senderId, $amount) {
        return $this->balanceRepo->checkAvailableBalance($senderId, $amount);
    }
}
