<?php

// Verify that SOAP extension is enabled
if (!extension_loaded('soap')) {
  die('SOAP extension not enabled. Please check your PHP configuration.');
}

class MySoapServer {
  public function displayString($bh) {
    $data = array('bh' => $bh, 'timestamp' => time());
    $json = json_encode($data);
    file_put_contents('boarding_houses.json', $json . "\n", FILE_APPEND);
    return $bh;
  }
}

$options = array(
  'uri' => 'http://example.com/soap',
  'location' => 'http://localhost:8081/iboard_server/server.php'
);

$server = new SoapServer(null, $options);
$server->setClass('MySoapServer');
$server->handle();

?>
