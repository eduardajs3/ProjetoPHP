<?php

namespace App\App\UseCases\Event;

use App\App\enums\EventStatusEnum;
use App\App\enums\HttpCode;
use App\App\Model\EventModel;
use App\App\Model\NutritionistModel;
use App\App\Repository\EventRepository;
use App\App\Repository\NutritionistRepository;
use DateTime;

class CreateEventUseCase {
	private EventModel $event;

	private NutritionistRepository $nutrionistRepository;
	private EventRepository $repository;

	public function __construct(EventModel $eventModel, EventRepository $eventRepository,  NutritionistRepository $nutrionistRepository) {
		$this->event = $eventModel;
		$this->repository = $eventRepository;
		$this->nutrionistRepository = $nutrionistRepository;
	}

	public function execute($eventBody, $nutritionistId) {
		// name, status, start_date, endDate, nutritionist_id

		$this->event->setName($eventBody->name);
		$this->event->setStatus($eventBody->status);
		$this->event->setStartDate($eventBody->startDate);
		$this->event->setEndDate($eventBody->endDate);
		$this->event->setNutritionistId($nutritionistId);

		$this->repository->createEvent($this->event);
	}
}
