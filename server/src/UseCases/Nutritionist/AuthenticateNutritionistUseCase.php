<?php

namespace App\App\UseCases\Nutritionist;

use App\App\JWt\TokenManager;
use App\App\Repository\NutritionistRepository;
use App\App\Errors\InvalidCredentialsError;

class AuthenticateNutritionistUseCase {
	private NutritionistRepository $nutritionistRepository;
	private $tokenManager;

	public function __construct(NutritionistRepository $nutritionistRepository, $table)
	{
		$this->nutritionistRepository = $nutritionistRepository;
		$this->tokenManager = new TokenManager();
	}

	public function execute($nutritionist)
	{
		$user = $this->nutritionistRepository->getNutritionistByEmail($nutritionist->email);

		$passwordMatch = password_verify($nutritionist->password, $user['password']);

		if (!$user || !$passwordMatch) {
			throw new InvalidCredentialsError();
		} else {
			$accessToken = $this->tokenManager->createToken($user);
			
			return [
				"token" => $accessToken,
			];
		}
	}
}
