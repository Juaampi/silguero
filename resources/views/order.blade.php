<?php

require_once '../vendor/autoload.php';
include('../vendor/rmccue/requests/library/Requests.php');
Requests::register_autoloader();
MercadoPago\SDK::setAccessToken("TEST-997859865585449-062421-23b68fe2a8fb9a9647715b67c79ce110-216363986");
$preference = new MercadoPago\Preference();

$headers = array(
    'accept' => 'application/json',
    'content-type' => 'application/json'    

);
$options = array("site_id" => "MLA");
$response = Requests::get('https://api.mercadopago.com/users/test_user?access_token=TEST-997859865585449-062421-23b68fe2a8fb9a9647715b67c79ce110-216363986', $headers, $options);
var_dump($response->status_code);

