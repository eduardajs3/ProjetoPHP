<?php
namespace App\App\UseCases\Event;

use App\App\Repository\EventRepository;

class GetEventByIdUseCase{
	private EventRepository $eventRepository;

	public function __construct(EventRepository $eventRepository){
		$this->eventRepository = $eventRepository;
	}

	public function execute($id){
		$dataExists = $this->eventRepository->getEventById($id);
		if(!$dataExists){
			return "O evento não existe";
		}

		return $dataExists;
	}
}