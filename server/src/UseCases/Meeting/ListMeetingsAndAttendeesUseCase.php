<?php

namespace App\App\UseCases\Meeting;

use App\App\enums\HttpCode;
use App\App\Repository\MeetingRepository;
use App\App\Model\MeetingModel;

class ListMeetingsAndAttendeesUseCase
{
	private MeetingRepository $meetingRepository;

	public function __construct(MeetingRepository $meetingRepository)
	{
		$this->meetingRepository = $meetingRepository;
	}

	public function execute()
	{
		$meetingsAndAttendees = $this->meetingRepository->listMeetingsAndAttendees();

		return $meetingsAndAttendees;
	}
}
