<?php

namespace App\App\UseCases\Meeting;

use App\App\Model\MeetingModel;
use App\App\Repository\MeetingRepository;
use App\App\Repository\EventRepository;
use App\App\Repository\NutritionistRepository;

use App\App\enums\EventStatusEnum;
use App\App\enums\HttpCode;
use App\App\Errors\UnauthorizedError;
use App\App\Errors\ResourceNotFoundError;

class CreateMeetingUseCase {
	private MeetingModel $meetting;
	private MeetingRepository $repository;
	private EventRepository $eventRepository;
	private NutritionistRepository $nutritionistRepository;

	public function __construct(MeetingModel $meeting, MeetingRepository $repository, EventRepository $eventRepository, NutritionistRepository $nutritionistRepository) {
		$this->meeting = $meeting;
		$this->repository = $repository;
		$this->eventRepository = $eventRepository;
		$this->nutritionistRepository = $nutritionistRepository;
	}

	public function execute($nutritionistId, $eventId) {
		$nutritionist = $this->nutritionistRepository->getNutritionistById($nutritionistId);

		if (!$nutritionist) {
			throw new UnauthorizedError();
		}

		$event = $this->eventRepository->getEventById($eventId);

		if (!$event) {
			throw new ResourceNotFoundError();
		}

		$this->meeting->setEventId($eventId);

		$result = $this->repository->createMeeting($this->meeting);

		return $result;
	}
}
