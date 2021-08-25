<?php


namespace App\Http\Balance;

use App\Http\Repository\UpdateBalanceRepository;

class SentBalance
{
    private $updateBalanceRepo;

    public function __construct(){
        $this->updateBalanceRepo = new UpdateBalanceRepository();
    }

    public function sendingBalance($sender, $receiver, $rate, $amount, $baseCurrency){
        if($sender->currency == $baseCurrency){
            $convertedAmount = $amount * $rate;
        }else{
            $convertedAmount = $amount / $rate;
        }
        return $this->updateBalanceRepo->updateBalanceRepository($sender, $receiver, $amount, $rate, $convertedAmount);
    }
}
