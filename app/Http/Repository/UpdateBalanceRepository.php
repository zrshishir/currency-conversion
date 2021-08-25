<?php


namespace App\Http\Repository;

use App\Models\Wallet;
use App\Models\Transaction;
use DB;

class UpdateBalanceRepository
{
    public function updateBalanceRepository($sender, $receiver, $amount, $rate, $convertedAmount){
        try {
            DB::beginTransaction();

            $makeTransaction = new Transaction([
                'sender' => $sender->id,
                'amount' => $amount,
                'rate'   => $rate,
                'converted_amount' => $convertedAmount,
                'receiver' => $receiver->id
            ]);

            $makeTransaction->save();

            //update sender wallet
            Wallet::where('user_id', $sender->id)
                    ->update([
                        'balance' => $sender->balance->balance - $amount,
                        'total_conversion' => $sender->balance->total_conversion + $amount
                    ]);

            //update receiver wallet
            Wallet::where('user_id', $receiver->id)
                    ->update([
                        'balance' => $receiver->balance->balance + $amount
                    ]);


            DB::commit();
            $bug = 0;
        } catch (Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1];
        }
        return $bug;
    }
}
