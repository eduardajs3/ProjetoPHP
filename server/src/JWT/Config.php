<?php
namespace Token\App\JWT;
return [
    "payload" => [
        "iss" => "http://localhost:8080",
        "aud" => "",
        "iat" => time(),
        "nfb" => time(),
        "exp" => time() + 10800
    ],
    "secret_key" => "540e0fdd739c03c63d6b042425f4c777",
    "algorithm" => "HS256"
];	