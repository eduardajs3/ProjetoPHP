<?php

namespace App\App\UseCases\Event;

use App\App\enums\EventStatusEnum;
use App\App\enums\HttpCode;
use App\App\Model\EventModel;
use App\App\Repository\EventRepository;
use App\App\Repository\NutritionistRepository;
use App\App\Errors\ResourceNotFoundError;
use DateTime;

class UpdateEventUseCase {
	private EventModel $event;
	private EventRepository $repository;
	private NutritionistRepository $nutritionistRepository;

	public function __construct(EventModel $eventModel, EventRepository $eventRepository, NutritionistRepository $nutritionistRepository)
	{
		$this->event = $eventModel;
		$this->repository = $eventRepository;
		$this->nutritionistRepository = $nutritionistRepository;
	}

	public function execute($id, $eventBody)
	{
		$eventExists = $this->repository->getEventById($id);

		if (!$eventExists) {
			throw new ResourceNotFoundError();
		}

		$this->event->setName($eventBody->name);
		$this->event->setStatus($eventBody->status);
		$this->event->setStartDate($eventBody->startDate);
		$this->event->setEndDate($eventBody->endDate);
		$this->event->setNutritionistId($eventBody->nutritionistId);

		return $this->repository->updateEvent($id, $this->event);
	}
}
