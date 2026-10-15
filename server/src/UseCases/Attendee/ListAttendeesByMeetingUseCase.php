<?php

namespace App\App\UseCases\Attendee;

use App\App\Repository\AttendeeRepository;
use App\App\Repository\MeetingRepository;
use App\App\Errors\ResourceNotFoundError;

class ListAttendeesByMeetingUseCase {
  private AttendeeRepository $repository;
  private MeetingRepository $meetingRepository;

  public function __construct(AttendeeRepository $repository, MeetingRepository $meetingRepository) {
    $this->repository = $repository;
    $this->meetingRepository = $meetingRepository;
  }

  public function execute($meetingId) {
    $attendees = $this->repository->findMany($meetingId);

    return $attendees;
  }
}