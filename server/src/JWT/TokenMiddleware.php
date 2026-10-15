<?php

namespace App\App\JWt;

use App\App\enums\HttpCode;
use App\App\JWt\TokenManager;

class TokenMiddleware
{
	private $tokenManager;
	public function __construct()
	{
		$this->tokenManager = new TokenManager();
	}
	public function handle($request, $next)
	{
		$validToken = $this->tokenManager->validateToken();

		if (!is_object($validToken)) {
			throw new \Exception("Essa rota não é permitida: 'usuário desconhecido'", HttpCode::BAD_REQUEST);
		}

		http_response_code(HttpCode::OK);
		echo call_user_func($next, $request);
	}
}
