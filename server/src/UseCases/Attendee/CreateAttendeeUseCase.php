<?php

namespace App\App\UseCases\Attendee;

use App\App\Errors\ResourceNotFoundError;
use App\App\Model\AttendeeModel;
use App\App\Repository\AttendeeRepository;
use App\App\Repository\MeetingRepository;

class CreateAttendeeUseCase {
  private AttendeeModel $attendee;
  private AttendeeRepository $repository;
  private MeetingRepository $meetingRepository;
  
  public function __construct(AttendeeModel $attendee, AttendeeRepository $repository, MeetingRepository $meetingRepository) {
    $this->attendee = $attendee;
    $this->repository = $repository;
    $this->meetingRepository = $meetingRepository;
  }

  public function execute($meetingId, $attendeeBody) {
    // $meetingExists = $this->meetingRepository->findMeetingById($meetingId);

    // if (!$meetingExists) {
    //   throw new ResourceNotFoundError();
    // }

    $this->attendee->setPatientId($attendeeBody->patientId);
    $this->attendee->setHostId($attendeeBody->hostId);
    $this->attendee->setMeetingId($meetingId);

    $this->repository->insertAttendee($this->attendee);
  }
}