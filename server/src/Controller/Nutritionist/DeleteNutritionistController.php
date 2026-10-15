<?php

namespace App\App\Controller\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\UseCases\Nutritionist\DeleteNutritionistUseCase;
use App\App\Errors\ResourceNotFoundError;

class DeleteNutritionistController
{
	public function handle($params)
	{
		try {
			$id = $params['id'];
			$deleteNutritionistUseCase = new DeleteNutritionistUseCase();

			$deleteNutritionistUseCase->execute($id);

			http_response_code(204);
			echo json_encode(["message" => "Nutritionist deleted succesfully"]);

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
