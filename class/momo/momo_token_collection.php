<?php
#on inclue le fichier request2
require_once 'momo_resquest.php';
class momo_token_collection{
  function token($uuid, $apikey){
    $u = (string)$uuid;
    $k = (string)$apikey;
    $b64 = base64_encode("$u:$k");
    $request = new HTTP_Request2();
    $request->setUrl('https://sandbox.momodeveloper.mtn.com/collection/token/');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
      'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
      "Authorization" => "Basic $b64",
      "Ocp-Apim-Subscription-Key" => "8e22d37f288e43119ad9eb32809bc60c"
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
// $m = new GlobalMomo_token_collection();
// $u = "6d654e41-31f4-45c2-86f2-1140e7ee9eaa";
// $k = "3bf37d65a7a3415aa0b2ab506bcf2154";
// $t = $m->token($u, $k);
?>

