<?php


namespace App\Http\Repository;

use App\Models\Wallet;
use App\Models\Transaction;
use DB;


class ReportRepository
{
    public function reportRepository(){
        $mostConversion = Wallet::with('user')
                ->orderBy('total_conversion','DESC')
                ->first();
        $totalConvertedAmount = Transaction::with('sender', 'receiver')
                ->select('sender', 'receiver', DB::raw('COUNT(receiver) as total_transactions'), DB::raw('SUM(converted_amount) as amount'))
                ->groupBy('receiver')
                ->groupBy('sender')
                ->orderBy('total_transactions', 'desc')
                ->first();

        return ['most_conversion' => $mostConversion, 'total_conv_for_particular_receiver' => $totalConvertedAmount];
    }

    public function thirdHighestRepository($receiver){

        $thirdHighest = Transaction::with('sender', 'receiver')
            ->where('receiver', $receiver)
            ->orderBy('converted_amount','DESC')
            ->offset(2)
            ->limit(1)
            ->get();
        return ['third_highest_amount_for_receiver' => $thirdHighest];
    }
}
