<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Http\JsonResponse;
use App\Helper\DataValidator;
use Validator;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    private $helping = "";

    public function __construct(){
        $this->helping = new ResponseHelper();
    }

    public function login(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $errorMsg = "";
            foreach ($errors->all() as $msg) {
                $errorMsg .= $msg;
            }
            $responseData = $this->helping->validatingErrors($errorMsg);
            return response()->json($responseData);
        }

        $user = User::where('email', $request->email)->first();

        if(! $user){
            $responseData = $this->helping->invalidLogin("User does not exist. Please Sign Up.");
            return response()->json($responseData);
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user['api_token'] = $success['token'];
            $user['token_type'] = "Bearer";

            $responseData = $this->helping->loggedIn([
                'users' => $user
            ]);

            return response()->json($responseData);
        }
        else{
            $responseData = $this->helping->invalidLogin("Incorrect Password.");
            return response()->json($responseData);
        }
    }
}
