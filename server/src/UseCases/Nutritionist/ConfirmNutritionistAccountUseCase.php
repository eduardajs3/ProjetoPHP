<?php
namespace App\App\UseCases\Nutritionist;

use App\App\Repository\NutritionistRepository;
use App\App\Errors\ResourceNotFoundError;

class ConfirmNutritionistAccountUseCase {
  private NutritionistRepository $repository;

  public function __construct(NutritionistRepository $repository) {
    $this->repository = $repository;
  }

  public function execute($id) {
    $nutritionistExists = $this->repository->getNutritionistById($id);

    if (!$nutritionistExists) {
      throw new ResourceNotFoundError();
    }

    $result = $this->repository->confirmEmail($id);
    return $result;
  }
}