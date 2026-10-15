<?php
namespace App\App\Controller\Attendee;

use App\App\Commons\Validations\ValidateRequestBody;
use App\App\Model\AttendeeModel;
use App\App\Repository\AttendeeRepository;
use App\App\Repository\MeetingRepository;
use App\App\UseCases\Attendee\CreateAttendeeUseCase;

class CreateAttendeeController {
  public function handle($params) {
    $meetingId = $params['meetingId'];

		$body = json_decode(file_get_contents("php://input"));

		$object = new ValidateRequestBody();

		$requiredFiles = ['patientId', 'hostId'];
		$isBodyValid = $object->parse($body, $requiredFiles);
 
		if (!$isBodyValid['valid']) {
			http_response_code(400);
			echo json_encode(['error' => $isBodyValid['error']]);
			exit();
		}

    try {
      $attendeeModel = new AttendeeModel();
      $attendeeRepository = new AttendeeRepository();
      $meetingRepository = new MeetingRepository();

      $execution = new CreateAttendeeUseCase($attendeeModel, $attendeeRepository, $meetingRepository);
      $execution->execute($meetingId, $body);

      http_response_code(201);
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }

  }
}
