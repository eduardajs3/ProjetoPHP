<?php

namespace App\App\UseCases\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\NutritionistRepository;

class UpdateNutritionistUseCase {
    private $nutritionist;
		private $repository;

	public function __construct(NutritionistModel $model) {
		$this->nutritionist = $model;
		$this->repository = new NutritionistRepository();
	}

    public function execute($id, $nutritionistBody) {
        $this->nutritionist->setId($id);
				$this->nutritionist->setName($nutritionistBody->name);
				$this->nutritionist->setEmail($nutritionistBody->email);
				$this->nutritionist->setAvatar($nutritionistBody->avatar);
				$this->nutritionist->setCnpj($nutritionistBody->cnpj);

        $nutritionistExists = $this->repository->getNutritionistById($id);

        if (!$nutritionistExists) {
            throw new ResourceNotFoundError();
        } else {
            $this->repository->updateNutritionist($this->nutritionist);
        }
    }
}