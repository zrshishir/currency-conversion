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


class CurrencyConversionController extends Controller
{
    private $userObj;
    private $helping;
    private $balanceObj;
    private $sentBalanceObj;
    private $currencyRateObj;

    public function __construct(){
        $this->userObj = new IdentificationUser();
        $this->balanceObj = new AvailableBalance();
        $this->currencyRateObj = new CurrencyRateHelper();
        $this->sentBalanceObj = new SentBalance();
        $this->helping = new ResponseHelper();
    }

    public function convertCurrency(Request $request):JsonResponse{
        $data['sender'] = $this->userObj->checkUser(Auth::user()->id);
        $data['receiver_id'] = $request->receiver_id;
        $data['amount'] = $request->amount;

        //checking receiver
        $receiver = $this->userObj->checkUser($data['receiver_id']);
        if(empty($receiver)){
            return response()->json($this->helping->invalidInput("Invalid sender ID."));
        }

        //checking balance availability
        $checkBalance = $this->balanceObj->checkBalance($data['sender']->id, $data['amount']);
        if(! $checkBalance){
            return response()->json($this->helping->invalidInput("You have no enough balance to transfer. Please, credit your balance."));
        }

        //taking currency conversion rate
//        $currencyRates = $this->currencyRateObj->getCurrencyRate();
//        if(empty($currencyRates)){
//            return response()->json($this->helping->serverError('API connection Error. Please, check your api credentials.'));
//        }
//        if(empty($currencyRates->base) && $currencyRates->error){
//            return response()->json($this->helping->invalidInput($currencyRates->description));
//        }

        //making a transaction and update wallet
//        $rate = $currencyRates->rates->EUR;
        $baseCurrency = 'USD';
        $rate = .851725;
        return response()->json($this->sentBalanceObj->sendingBalance($data['sender'], $receiver, $rate, $data['amount'], $baseCurrency));
        if($bug == 0){
            //sending confirmation email to the receiver
            $responseData = $this->helping->responseProcess(0, 200, "6 digit code has been sent to your email. Please submit the code to activate the account.", "");
            return response()->json($responseData);
        } elseif($bug == 1062){
            $responseData = $this->helping->responseProcess(1, 1062, "Data is found duplicate.", "");
            return response()->json($responseData);
        }else{
            $responseData = $this->helping->responseProcess(1, 1062, "something went wrong.", "");
            return response()->json($responseData);
        }

    }
}
