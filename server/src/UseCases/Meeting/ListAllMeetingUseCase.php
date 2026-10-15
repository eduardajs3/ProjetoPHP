<?php

namespace App\App\UseCases\Meeting;

use App\App\enums\HttpCode;
use App\App\Repository\MeetingRepository;
use App\App\Repository\AttendeeRepository;
use App\App\Model\MeetingModel;

class ListAllMeetingUseCase
{
	private MeetingRepository $meetingRepository;
	private AttendeeRepository $attendeeRepository;

	public function __construct(MeetingRepository $meetingRepository, AttendeeRepository $attendeeRepository)
	{
		$this->meetingRepository = $meetingRepository;
		$this->attendeeRepository = $attendeeRepository;
	}

	public function execute($nutritionistId)
	{
		$meetings = $this->meetingRepository->findAllMeetings($nutritionistId);
		$parsedMeetings = [];

		foreach ($meetings as $meeting) {
			$obj = [
				"id" => $meeting['id'],
				"event" => [
					"id" => $meeting['event_id'],
					"name" => $meeting['name'],
				],
				"created_at" => $meeting['created_at'],
				"attendees" => $this->attendeeRepository->findMany($meeting['id']),
			];

			array_push($parsedMeetings, $obj);
		}
		

		echo json_encode($parsedMeetings);
		exit();
		


		return $meetings;
	}
}
