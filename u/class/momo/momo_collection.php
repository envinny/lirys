<?php
#on inclue le fichier request2
require_once 'momo_resquest.php';
class momo_collection{
    function paye($token, $uuid, $smm, $num, $msg_obj, $msg_ctn){
        
        $request = new HTTP_Request2();
        $request->setUrl('https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
        'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
        "Authorization" => "Bearer $token",
        "X-Reference-Id" => "$uuid",
        "X-Target-Environment" => "sandbox",
        "Content-Type" => "application/json",
        "Ocp-Apim-Subscription-Key" => "8e22d37f288e43119ad9eb32809bc60c"
        ));
        $request->setBody('{
        \n  "amount": "'.$smm.'",
        \n  "currency": "EUR",
        \n  "externalId": "1234",
        \n  "payer": {
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