<?php
namespace App\App\Controller\Event;

use App\App\Model\EventModel;
use App\App\Repository\EventRepository;
use App\App\Repository\NutritionistRepository;
use App\App\UseCases\Event\CreateEventUseCase;
use App\App\Commons\Validations\ValidateRequestBody;

class CreateEventController{
  public function handle(){
		$body = json_decode(file_get_contents("php://input"));

		$object = new ValidateRequestBody();

		$requiredFiles = ['name', 'status', 'startDate', 'endDate'];
		$isBodyValid = $object->parse($body, $requiredFiles);
 
		if (!$isBodyValid['valid']) {
			http_response_code(400);
			echo json_encode(['error' => $isBodyValid['error']]);
			exit();
		}
		
		try {
			$nutritionistId = $_SESSION['user']->user->id;

			$eventModel = new EventModel();
			$eventRepository = new EventRepository();
			$nutritionistRepository = new NutritionistRepository();

			$createEventUseCase = new CreateEventUseCase($eventModel, $eventRepository, $nutritionistRepository);
			$createEventUseCase->execute($body, $nutritionistId);

			http_response_code(201);
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}
}