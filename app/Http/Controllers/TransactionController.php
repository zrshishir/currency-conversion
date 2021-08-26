<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Helper\ResponseHelper;
use App\Http\Transaction\DataTransaction;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    private $dataTranObj;
    private $helping;

    public function __construct(){
        $this->dataTranObj = new DataTransaction();
        $this->helping = new ResponseHelper();
    }

    public function index(){
        $userId = Auth::user()->id;
        return response()->json($this->helping->indexData($this->dataTranObj->dataTransaction($userId), "Transaction histories."));
    }
}
