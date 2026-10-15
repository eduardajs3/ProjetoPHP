<?php
namespace App\App\Controller\Attendee;

use App\App\Repository\AttendeeRepository;
use App\App\Repository\MeetingRepository;
use App\App\Errors\ResourceNotFoundError;
use App\App\UseCases\Attendee\ListAttendeesByMeetingUseCase;

class ListAttendeesByMeetingController {
  public function handle($params) {
    $meetingId = $params['meetingId'];

    try {
      $attendeeRepository = new AttendeeRepository();
      $meetingRepository = new MeetingRepository();

      $execution = new ListAttendeesByMeetingUseCase($attendeeRepository, $meetingRepository);
      $data = $execution->execute($meetingId);

      echo json_encode($data);

    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }
}