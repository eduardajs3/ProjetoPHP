<?php

namespace App\App\Controller\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\UseCases\Nutritionist\UpdateNutritionistUseCase;
use App\App\Errors\ResourceNotFoundError;

class UpdateNutritionistController {
    public function handle($params) {
        try {
            $id = $params['id'];
            $body = json_decode(file_get_contents("php://input"));

            $nutritionist = new NutritionistModel();
            $updateNutritionistUseCase = new UpdateNutritionistUseCase($nutritionist);

            $updateNutritionistUseCase->execute($id, $body);

            http_response_code(201);
            echo json_encode(["message" => "Nutritionist updated succesfully"]);

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