<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Auth;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    private $helping;
    public function __construct(){
        $this->helping = new ResponseHelper();
    }

    public function logout(Request $request): JsonResponse
    {
        $loggedInChecked = Auth::check();
        if(! $loggedInChecked){
            return route('unauth');
        }
        $request->user()->token()->revoke();
        $responseData = $this->helping->logout("Successfully logged out");
        return response()->json($responseData);
    }
}
