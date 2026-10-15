<?php

namespace App\App\Controller\Meeting;

use App\App\enums\HttpCode;
use App\App\Model\MeetingModel;
use App\App\Repository\EventRepository;
use App\App\Repository\MeetingRepository;
use App\App\Repository\NutritionistRepository;
use App\App\UseCases\Meeting\CreateMeetingUseCase;
use App\App\Commons\Validations\ValidateRequestBody;

use App\App\Erros\UnauthorizedError;
use App\App\Erros\ResourceNotFoundError;

class CreateMeetingController {
	public function handle() {
		$body = json_decode(file_get_contents("php://input"));

		$object = new ValidateRequestBody();

		$requiredFields = ['nutritionistId', 'eventId'];
		$isBodyValid = $object->parse($body, $requiredFields);
 
		if (!$isBodyValid['valid']) {
			http_response_code(400);
			echo json_encode(['error' => $isBodyValid['error']]);
			exit();
		}

		try {
			$meetingRepository = new MeetingRepository();
			$eventRepository = new EventRepository();
			$meetingModel = new MeetingModel();
			$nutritionistRepository = new NutritionistRepository();

			$createMeetingUseCase = new CreateMeetingUseCase(
				$meetingModel,
				$meetingRepository,
				$eventRepository,
				$nutritionistRepository
			);

			$result = $createMeetingUseCase->execute($body->nutritionistId, $body->eventId);

			echo json_encode($result);
		} catch (\Throwable $th) {
			http_response_code($th->getCode());
			echo json_encode([
				"message" => $th->getMessage()
			]);
		}
	}
}
