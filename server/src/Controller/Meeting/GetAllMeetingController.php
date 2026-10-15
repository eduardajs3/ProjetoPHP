<?php

namespace App\App\Controller\Meeting;

use App\App\enums\HttpCode;
use App\App\Repository\MeetingRepository;
use App\App\Repository\AttendeeRepository;

use App\App\UseCases\Meeting\ListAllMeetingUseCase;

class GetAllMeetingController
{
	public function handle($params)
	{
		$nutritionistId = $params['nutritionistId'];

		$meetingRepository = new MeetingRepository();
		$attendeeRepository = new AttendeeRepository();
		$listAllMeetingUseCase  = new ListAllMeetingUseCase($meetingRepository, $attendeeRepository);

		$execution = $listAllMeetingUseCase->execute($nutritionistId);
		http_response_code(HttpCode::OK);

		echo json_encode($execution);
	}
}
