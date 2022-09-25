<?php
#on inclue le fichier request2
require_once 'momo_resquest.php';
class momo_token_distribution{
  function token($uuid, $apikey){
    $u = (string)$uuid;
    $k = (string)$apikey;
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
        $rps = $response->getBody();
        $token_obj = json_decode($rps);
        $statut = $token_obj->{ "access_token" };
        return $statut;
      }
      else {
        $statut = "2";
        return $statut;
      }
    }
    catch(HTTP_Request2_Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }

  }
}

?>

