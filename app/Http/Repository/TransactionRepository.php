<?php


namespace App\Http\Repository;

use App\Models\Transaction;
use App\Models\User;

class TransactionRepository
{
    public function transactionRepository($userId): Array{
        $transactions = Transaction::with('sender', 'receiver')
                            ->where('sender', $userId)
                            ->get();
        
        $users = User::where('id', '!=', $userId)
                        ->get();
        
        return ['transactions' => $transactions, 'users' => $users];
    }
}