<?php

namespace App\App\Controller\Nutritionist;

use App\App\Repository\NutritionistRepository;
use App\App\UseCases\Nutritionist\AuthenticateNutritionistUseCase;
use App\App\Errors\InvalidCredentialsError;

class AuthenticateNutritionistController {
	public function handle()
	{
		try {
			$user = json_decode(file_get_contents("php://input"));
			$nutritionistsRepository = new NutritionistRepository();
			$authenticateNutritionististUseCase = new AuthenticateNutritionistUseCase($nutritionistsRepository, "nutritionists");

			$token = $authenticateNutritionististUseCase->execute($user);

			echo json_encode($token);
		} catch (InvalidCredentialsError $err) {
			$statusCode = $err->getCode();
			$message = $err->getMessage();

			http_response_code($statusCode);
			echo json_encode([
					"message" => $message,
			]);
		}
	}
}
