<?php

namespace App\App\Controller\Meeting;

use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\EventRepository;
use App\App\Repository\MeetingRepository;
use App\App\UseCases\Event\UpdateMeetingUseCase;

class UpdateMeetingController
{
	public function handle($id)
	{
		try {
			$body = json_decode(file_get_contents("php.//input"));

			$meetingRepository = new MeetingRepository();
			$eventRepository = new EventRepository();
			$updateMeetingUseCase = new UpdateMeetingUseCase($meetingRepository, $eventRepository);

			$updateMeetingUseCase->execute($id, $body);

			http_response_code(201);
			echo json_encode(['message' => 'Event update succesfully']);
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
