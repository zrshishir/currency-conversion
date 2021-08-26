<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\User\IdentificationUser;
use App\Http\Balance\AvailableBalance;
use App\Http\Balance\SentBalance;
use App\Helper\ResponseHelper;
use App\Helper\CurrencyRateHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Http\Transaction\DataTransaction;


class CurrencyConversionController extends Controller
{
    private $userObj;
    private $helping;
    private $balanceObj;
    private $sentBalanceObj;
    private $currencyRateObj;
    private $dataTransactionObj;

    public function __construct(){
        $this->userObj = new IdentificationUser();
        $this->balanceObj = new AvailableBalance();
        $this->currencyRateObj = new CurrencyRateHelper();
        $this->sentBalanceObj = new SentBalance();
        $this->helping = new ResponseHelper();
        $this->dataTransactionObj = new DataTransaction();
    }

    public function convertCurrency(Request $request):JsonResponse{
        $data['sender'] = $this->userObj->checkUser(Auth::user()->id);
        $data['receiver_id'] = $request->receiver_id;
        $data['amount'] = $request->amount;

        //checking receiver
        $receiver = $this->userObj->checkUser($data['receiver_id']);
        if(empty($receiver)){
            return response()->json($this->helping->responseProcess(1, 403, "Invalid receiver ID.", $this->dataTransactionObj->dataTransaction($data['sender']->id)));
        }

        //checking balance availability
        $checkBalance = $this->balanceObj->checkBalance($data['sender']->id, $data['amount']);
        if(! $checkBalance){
            return response()->json($this->helping->responseProcess(1, 403, "You have no enough balance to transfer. Please, credit your balance.", $this->dataTransactionObj->dataTransaction($data['sender']->id)));
        }

        //taking currency conversion rate
        $currencyRates = $this->currencyRateObj->getCurrencyRate();
        if(empty($currencyRates)){
            return response()->json($this->helping->responseProcess(1, 500, "API connection Error. Please, check your api credentials.", $this->dataTransactionObj->dataTransaction($data['sender']->id)));
        }
        if(empty($currencyRates->base) && $currencyRates->error){
            return response()->json($this->helping->responseProcess(1, 403, $currencyRates->description, $this->dataTransactionObj->dataTransaction($data['sender']->id)));
        }

        //making a transaction and update wallet
        $rate = $currencyRates->rates->EUR;
        $baseCurrency = $currencyRates->base;
//        $baseCurrency = 'USD';
//        $rate = .851725;
        $bug = $this->sentBalanceObj->sendingBalance($data['sender'], $receiver, $rate, $data['amount'], $baseCurrency);
        if($bug == 0){
            $details = $this->mailData($data, $receiver, $rate, $baseCurrency);
            //Confirmation email send to receiver email.
            Mail::to($receiver->email)->send(new SendMail($details));
            $responseData = $this->helping->responseProcess(0, 200, "Your have successfully converted and sent the currency.", $this->dataTransactionObj->dataTransaction($data['sender']->id));
            return response()->json($responseData);
        } elseif($bug == 1062){
            $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", $this->dataTransactionObj->dataTransaction($data['sender']->id));
            return response()->json($responseData);
        }else{
            $responseData = $this->helping->responseProcess(1, 1062, "Something went wrong.", $this->dataTransactionObj->dataTransaction($data['sender']->id));
            return response()->json($responseData);
        }

    }

    private function mailData($data, $receiver, $rate, $baseCurrency): Array {
        return [
                'sender_name' => $data['sender']->name,
                'sender_email' => $data['sender']->email,
                'receiver_name'  => $receiver->name,
                'receiver_email'  => $receiver->email,
                'currency'  => $receiver->currency,
                'amount' => ($receiver->currency == $baseCurrency) ? $data['amount'] * $rate : $data['amount'] / $rate,
            ];
    }
}
