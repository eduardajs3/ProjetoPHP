<?php

namespace App\App\Controller\Event;

use App\App\Repository\EventRepository;
use App\App\UseCases\Event\GetEventByIdUseCase;

class GetOneEventByIdController
{
	public function handle($id)
	{
		try {
			$eventRepository = new EventRepository();
			$getEventByIdUseCase = new GetEventByIdUseCase($eventRepository);
			echo json_encode([
				"msg" => "Eventos encontrados com sucesso",
				"data" => $getEventByIdUseCase->execute($id)
			]);
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}
}
