<?php
namespace App\App\Database;

return [
   "current" => 'sqlite',
   "database" => [
     'sqlite' => [
        "path" => '../../dev'
     ],
     'mysql' => [
        'host' => getenv('DB_HOST'),
        'user' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASS'),
        'port' => getenv('DB_PORT')
     ],
     'oracle'=>[
      'host'=>getenv('DB_HOST'),
      'user'=>getenv('DB_USERNAME'),
      'password'=>getenv('DB_PASS'),
      'port'=>getenv('DB_PORT')
     ],
     'postgres'=>[
      'host'=>getenv('DB_HOST'),
      'user'=>getenv('DB_USERNAME'),
      'password'=>getenv('DB_PASS'),
      'port'=>getenv('DB_PORT')
     ]
   ]
];