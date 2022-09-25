<?php
#on inclue le fichier request2
require_once 'momo_resquest.php';
require_once 'momo_uuid.php';
$u = new momo_uuid();
$valU = $u->genere();
// echo $valU;

class momo_apiuser{
    function user($uuid){

        $request = new HTTP_Request2();
        $request->setUrl('https://sandbox.momodeveloper.mtn.com/v1_0/apiuser');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
        'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
        "Content-Type" => "application/json",
        "Ocp-Apim-Subscription-Key" => "ec18a73ab931416eb1159b5ce4dbfa89",
        "X-Reference-Id" => "$uuid"
        ));
        $request->setBody('{"providerCallbackHost": "localhost"}');
        try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            
            echo $response->getBody();
            // return true;
        }
        else {
            // return false;
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