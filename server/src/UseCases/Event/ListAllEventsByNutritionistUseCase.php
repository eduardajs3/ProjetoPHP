<?php

namespace App\App\UseCases\Event;

use App\App\enums\HttpCode;
use App\App\Repository\EventRepository;
use App\App\Repository\NutritionistRepository;

class ListAllEventsByNutritionistUseCase {
	private EventRepository $eventRepository;
	private NutritionistRepository $nutrionistRepository;

	public function __construct(EventRepository $eventRepository, NutritionistRepository $nutritionistRepository){
		$this->eventRepository = $eventRepository;
		$this->nutrionistRepository = $nutritionistRepository;
	}

	public function execute($nutritionistId) {
		$data = $this->eventRepository->findAllByNutritionistId($nutritionistId);
		return $data;
	}
}
