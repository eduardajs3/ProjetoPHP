<?php

namespace App\App\Controller\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\UseCases\Nutritionist\ListAllNutritionistsUseCase;

class ListAllNutritionistsController {
    public function handle() {
        $listAllNutritionistsUseCase = new ListAllNutritionistsUseCase();

        $result = $listAllNutritionistsUseCase->execute();

        http_response_code(200);
        echo $result;
    }
}