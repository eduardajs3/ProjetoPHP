<?php

namespace App\App\JWt;

use App\App\enums\HttpCode;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class TokenManager
{

	private $config;
	private $key;
	private $payload;
	private $alg;

	public function __construct()
	{
		$this->config = require __DIR__ . '/Config.php';
		$this->payload = $this->config['payload'];
		$this->alg = $this->config['algorithm'];
		$this->key = $this->config['secret_key'];
	}

	public function createToken($user)
	{

		if (isset($user->email, $user->name)) {
			return "Os campos estão vazios";
		}

		$this->payload['user'] = [
			"id" => $user['id'],
			"name" => $user['name'],
			"email" => $user['email'],
			"avatar" => $user['avatar'],
		];
		try {
			$jwt = JWT::encode($this->payload, $this->key, $this->alg);
			return $jwt;
		} catch (Exception $th) {
			return $th;
		}
	}
	public function validateToken()
	{
		$headers = getallheaders();
		$authorization = $headers['Authorization'];

		if (!isset($authorization)) {
			http_response_code(HttpCode::USER_ERROR);
			return false;
		}

		$jwt = explode(" ", $headers["Authorization"]);

		if (count($jwt) !== 2 || $jwt[0] !== "bearer") {
			http_response_code(401);
			return json_encode([
				"error" => "Formato do token inválido."
			]);
		}

		try {
			$decoded = JWT::decode($jwt[1], new Key($this->key, $this->alg));
			return $decoded;
		} catch (Exception $e) {
			http_response_code(HttpCode::USER_ERROR);
			return json_encode([
				"error" => "Falha ao validar o token.",
				"message" => $e->getMessage()
			]);
		}
	}
}
