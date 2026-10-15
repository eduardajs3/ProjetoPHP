<?php

namespace App\App\Controller\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\UseCases\Nutritionist\GetSpecificNutritionistByIdUseCase;
use App\App\Errors\ResourceNotFoundError;

class GetSpecificNutritionistByIdController {
    public function handle($params) {
        try {
            $id = $params['id'];

            $nutritionist = new NutritionistModel();
            $getSpecificNutritionistByIdUseCase = new GetSpecificNutritionistByIdUseCase($nutritionist);

            $result = $getSpecificNutritionistByIdUseCase->execute($id);

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