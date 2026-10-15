<?php

namespace App\App\Controller\Nutritionist;
use App\App\Repository\NutritionistRepository;
use App\App\UseCases\Nutritionist\UploadNutritionistAvatarUseCase;
use App\App\Errors\ResourceNotFoundError;

use Aws\Exception\AwsException;

class UploadNutritionistAvatarController {
  public function handle($params) {
    try {
      $id = $params['id'];
      $file = $_FILES['image'];

      $nutritionistRepository = new NutritionistRepository();
      $uploadNutritionistUseCase = new UploadNutritionistAvatarUseCase($nutritionistRepository);

      $result = $uploadNutritionistUseCase->execute($id, $file);

      echo json_encode($result);
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