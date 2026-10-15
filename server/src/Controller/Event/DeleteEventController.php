<?php
namespace App\App\Controller\Event;

use App\App\Repository\EventRepository;
use App\App\UseCases\Event\DeleteEventUseCase;
use App\App\Errors\ResourceNotFoundError;

class DeleteEventController{
	public function handle($params){
		$id = $params['id'];

		try {
			$eventRepository = new EventRepository();
			$deleteEventUseCase = new DeleteEventUseCase($eventRepository);
	
			$deleteEventUseCase->execute($id);
			http_response_code(204);

		} catch (ResourceNotFoundError $err) {
			$statusCode = $err->getCode();
			$message = $err->getMessage();

			http_response_code($statusCode);
			echo json_encode([
				"message" => $message,
			]);
		}
	}
}