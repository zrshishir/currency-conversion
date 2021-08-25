<?php


namespace App\Helper;

class CurrencyRateHelper
{
    public function getCurrencyRate(){
        $apiUrl = config('currency_rate.api_url');
        $appId = config('currency_rate.app_id');

        return $this->apiRequest($apiUrl, $appId);
    }

    private function apiRequest($apiUrl, $appId){
        try {
            $ch = curl_init();//open a connection
            curl_setopt($ch, CURLOPT_URL,$apiUrl . "?app_id=" . $appId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $result = json_decode($response);
            curl_close($ch); // Close the connection
            return $result;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
}
