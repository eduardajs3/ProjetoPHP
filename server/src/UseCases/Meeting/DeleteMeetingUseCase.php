<?php

namespace App\App\UseCases\Meeting;
use App\App\Repository\MeetingRepository;
use App\App\Errors\ResourceNotFoundError;

class DeleteMeetingUseCase {
    private MeetingRepository $meetingRepository;

    public function __construct(MeetingRepository $meetingRepository) {
        $this->meetingRepository = $meetingRepository;
    }

    public function execute($id) {
        $meetingExists = $this->meetingRepository->findMeetingById($id);

        if (!$meetingExists) {
            throw new ResourceNotFoundError();
        }

        $this->meetingRepository->deleteMeeting($id);
    }
}
