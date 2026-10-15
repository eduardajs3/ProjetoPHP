<?php

namespace App\App\Controller\Meeting;

use App\App\enums\HttpCode;
use App\App\Repository\MeetingRepository;

use App\App\UseCases\Meeting\ListMeetingsAndAttendeesUseCase;

class ListMeetingsAndAttendeesController
{
	public function handle()
	{
		$meetingRepository = new MeetingRepository();
		$listAllMeetingUseCase  = new ListMeetingsAndAttendeesUseCase($meetingRepository);

		$data = $listAllMeetingUseCase->execute();

		echo json_encode($data);
	}
}
