<?php
#on inclue le fichier request2
require_once 'momo_resquest.php';

class momo_apikey{
    
    public function key($uuid)
    {
        $request = new HTTP_Request2();
        $request->setUrl("https://sandbox.momodeveloper.mtn.com/v1_0/apiuser/$uuid/apikey");
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
        'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
        "X-Reference-Id" => "$uuid",
        "Ocp-Apim-Subscription-Key" => "ec18a73ab931416eb1159b5ce4dbfa89"
        ));
        try {
        $response = $request->send();
        if ($response->getStatus() == 201) {
            // echo $response->getBody();
            $rps = $response->getBody();
            $apikey_obj = json_decode($rps);
            $lakey = $apikey_obj->{ "apiKey" };
            echo $lakey;
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