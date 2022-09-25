<?php
#on inclue le fichier request2
require_once 'momo_resquest.php';
    // echo "Code base 64 = ".$b64."<br>";
class momo_token{
  function token($uuid, $apikey){

    $b64 = base64_encode("$uuid:$apikey");
    $request = new HTTP_Request2();
    $request->setUrl('https://sandbox.momodeveloper.mtn.com/disbursement/token/');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
      'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
      "Authorization" => "Basic $b64",
      "Ocp-Apim-Subscription-Key" => "57f78938a7e547f2850917e8484f0d5e"
    ));
    try {
      $response = $request->send();
      if ($response->getStatus() == 200) {
        // echo $response->getBody();
        $rps = $response->getBody();
        $token_obj = json_decode($rps);
        $letoken = $token_obj->{ "access_token" };
        echo $letoken;
        // $ztoken = $letoken;
        // echo "Le Token = <br>". $token_obj->{ "access_token" }."Le Token type  = <br>". $token_obj->{ "token_type" }."Expire le  = <br>". $token_obj->{ "expires_in" };
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

