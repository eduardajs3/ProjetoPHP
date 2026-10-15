<?php

namespace App\App\Controller\Nutritionist;
use App\App\Repository\NutritionistRepository;
use App\App\UseCases\Nutritionist\ConfirmNutritionistAccountUseCase;
use App\App\Errors\ResourceNotFoundError;

class ConfirmNutritionistAccountController {
  public function handle($params) {
    $id = $params['id'];

    try {
      $repository = new NutritionistRepository();

      $usecase = new ConfirmNutritionistAccountUseCase($repository);

      $result = $usecase->execute($id);

      $url = $_ENV['CLIENT_URL'];

      // redirecting user to client side
      header("Location: $url");

    } catch (ResourceNotFoundError $err) {
      $statusCode = $err->getCode();
			$message = $err->getMessage();

			http_response_code($statusCode);
			echo json_encode([
					"message" => $message,
			]);
    }
  }
}