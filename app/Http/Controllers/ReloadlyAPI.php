<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReloadlyAPI extends Controller
{
    public function airtime_access_token(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://auth.reloadly.com/oauth/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "client_id":"0sgKahUB59EAWbJolgAgIBEgLI3w0QEs",
            "client_secret":"iWkmkTASQv-3FVqDe4Oq4H1fGGZPeR-WN7wKCRi31FDTkfQc125f4uce43QvHpx",
            "grant_type":"client_credentials",
            "audience":"https://topups.reloadly.com"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return response($response, 201);
    }

    public function giftcard_access_token(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://auth.reloadly.com/oauth/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "client_id":"0sgKahUB59EAWbJolgAgIBEgLI3w0QEs",
            "client_secret":"iWkmkTASQv-3FVqDe4Oq4H1fGGZPeR-WN7wKCRi31FDTkfQc125f4uce43QvHpx",
            "grant_type":"client_credentials",
            "audience":"https://giftcards.reloadly.com"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return response($response, 201);
    }
}
