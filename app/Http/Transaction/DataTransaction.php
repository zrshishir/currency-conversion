<?php

namespace App\Http\Transaction;

use App\Http\Repository\TransactionRepository;

class DataTransaction
{
    private $transactionRepo;
    
    public function __construct(){
        $this->transactionRepo = new TransactionRepository();        
    }
    
    public function dataTransaction($senderId){
        return $this->transactionRepo->transactionRepository($senderId);
    }
}