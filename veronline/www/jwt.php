<?php
//produção
require("./vendor/autoload.php");
use \Firebase\JWT\JWT;


$key = base64_decode("405QoXzkGjUtoaV6NBU5l4jmEAPgSLwdJxN+xodAeL0="); //Service fact sheet de teste / Communication Key:

$ContentKID = $_GET['kid'];

//$ContentKID = "33af2d36-a3d2-4f1f-be00-6ff0c33edd34";

$json = '
{
"version": 1,
"com_key_id": "61ce091c-5dee-4787-b05d-ac2200b99344",
"message": {
"type": "entitlement_message",
"version": 2,
"license": { },
"content_keys_source": {
"inline": [
{ "id": "'.$ContentKID.'" }
]
}
}
}';

$token = json_decode($json , false);

$jwt = JWT::encode($token, $key);

print_r($jwt);

?>