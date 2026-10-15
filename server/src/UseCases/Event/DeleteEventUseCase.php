<?php
namespace App\App\UseCases\Event;

use App\App\enums\HttpCode;
use App\App\Repository\EventRepository;
use App\App\Errors\ResourceNotFoundError;

class DeleteEventUseCase{
	private EventRepository $eventRepository;

	public function __construct(EventRepository $eventRepository){
		$this->eventRepository = $eventRepository;
	}

	public function execute($id) {
    $eventExists = $this->eventRepository->getEventById($id);

		if(!$eventExists){
			throw new ResourceNotFoundError();
		}
		
		return $this->eventRepository->deleteEvent($id);
	}
}