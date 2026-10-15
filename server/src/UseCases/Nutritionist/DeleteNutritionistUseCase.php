<?php

namespace App\App\UseCases\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\NutritionistRepository;

class DeleteNutritionistUseCase {
	private $repository;

	public function __construct() {
		$this->repository = new NutritionistRepository();
	}

    public function execute($id) {
        $nutritionistExists = $this->repository->getNutritionistById($id);

        if (!$nutritionistExists) {
            throw new ResourceNotFoundError();
        } else {
            $this->repository->deleteNutritionist($id);
        }
    }
}