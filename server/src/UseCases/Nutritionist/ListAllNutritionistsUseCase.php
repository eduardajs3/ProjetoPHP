<?php

namespace App\App\UseCases\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\Repository\NutritionistRepository;

class ListAllNutritionistsUseCase {
	private $nutritionist;

	public function __construct() {
		$this->nutritionist = new NutritionistRepository();
	}

    public function execute() {
        $nutritionists = $this->nutritionist->getAllNutritionists();

        return $nutritionists;
    }
}