<?php

namespace App\App\Controller\Event;

use App\App\enums\HttpCode;
use App\App\Repository\EventRepository;
use App\App\Repository\NutritionistRepository;
use App\App\UseCases\Event\ListAllEventsByNutritionistUseCase;

class ListAllEventsByNutritionistController
{
	public function handle() {
		$nutritionistId = $_SESSION['user']->user->id;

		$eventRepository = new EventRepository();
		$nutritionistRepository = new NutritionistRepository();
		$listAllUseCase = new ListAllEventsByNutritionistUseCase($eventRepository, $nutritionistRepository);
		
		$data = $listAllUseCase->execute($nutritionistId);
		echo json_encode($data);
	}
}
