<?php
namespace App\App\Controller\Event;

use App\App\Model\EventModel;
use App\App\Repository\EventRepository;
use App\App\Repository\NutritionistRepository;
use App\App\UseCases\Event\UpdateEventUseCase;
use App\App\Errors\ResourceNotFoundError;
use App\App\Commons\Validations\ValidateRequestBody;

class UpdateEventController{
  public function handle($params){
		$body = json_decode(file_get_contents("php://input"));
		$id = $params['id'];

		$object = new ValidateRequestBody();

		$requiredFiles = ['name', 'status', 'startDate', 'endDate'];
		$isBodyValid = $object->parse($body, $requiredFiles);
 
		if (!$isBodyValid['valid']) {
			http_response_code(400);
			echo json_encode(['error' => $isBodyValid['error']]);
			exit();
		}

		try {
			$eventModel = new EventModel();
			$eventRepository = new EventRepository();
			$nutritionistRepository = new NutritionistRepository();
			
			$createEventUseCase = new UpdateEventUseCase($eventModel, $eventRepository, $nutritionistRepository);
			echo $createEventUseCase->execute($id, $body);

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