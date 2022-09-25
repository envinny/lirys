<?php
#on inclue le fichier request2
require_once 'momo_resquest.php';
class momo_distribution{
    function paye($token, $uuid, $smm, $num, $msg_obj, $msg_ctn){
        $request = new HTTP_Request2();
        $request->setUrl('https://sandbox.momodeveloper.mtn.com/disbursement/v1_0/transfer');
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
        $request->setBody('{
        \n  "amount": "'.$smm.'",
        \n  "currency": "EUR",
        \n  "externalId": "1234",
        \n  "payee": {
        \n    "partyIdType": "MSISDN",
        \n    "partyId": "'.$num.'"
        \n  },
        \n  "payerMessage": "'.$msg_obj.'",
        \n  "payeeNote": "'.$msg_ctn.'"
        \n}');
        try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            echo $response->getBody();
        }
        else {
            echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
            $response->getReasonPhrase();
        }
        }
        catch(HTTP_Request2_Exception $e) {
        echo 'Error: ' . $e->getMessage();
        }
        
    }
}
?>