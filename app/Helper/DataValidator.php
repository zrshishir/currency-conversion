<?php


namespace App\Helper;


use http\Env\Request;
use Illuminate\Http\JsonResponse;
use Validator;


class DataValidator
{
    private $helping = "";

    public function __construct(){
        $this->helping = new ResponseHelper();
    }

    public function dataValidErrorMsg($validator) {
        return response()->json('data valid');
        if($validator->fails()){
            $errors = $validator->errors();
            $errorMsg = "";
            foreach ($errors->all() as $msg) {
                $errorMsg .= $msg;
            }
            return $errorMsg;
        }
        return false;
    }
}
