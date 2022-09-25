<?php

use momo_distribution as GlobalMomo_distribution;

require_once 'momo_resquest.php';
class momo_distribution{
    function paye($token, $uuid, $smm, $num, $msg_obj, $msg_ctn){
        $request = new HTTP_Request2();
        $request->setUrl('https://sandbox.momodeveloper.mtn.com/disbursement/v1_0/deposit');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
        'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
        "Authorization" => "Bearer $token",
        "X-Reference-Id" => "$uuid",
        'X-Target-Environment' => 'sandbox',
        'Content-Type' => 'application/json',
        'Ocp-Apim-Subscription-Key' => '57f78938a7e547f2850917e8484f0d5e'
        ));
        $request->setBody("{'amount': '$smm', 'currency': 'EUR', 'externalId': '1234', 'payee': { 'partyIdType': 'MSISDN', 'partyId': '$num' }, 'payerMessage': '$msg_obj', 'payeeNote': '$msg_ctn'}");
        try {
        $response = $request->send();
        // var_dump($response);
        if ($response->getStatus() == 202) {
            // echo $response->getBody();
            $statut = "1";
            return $statut;
        }
        else {
            $statut = "2";
            return $statut;
            // echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
            // $response->getReasonPhrase();
        }
        }
        catch(HTTP_Request2_Exception $e) {
        echo 'Error: ' . $e->getMessage();
        }

    }
}