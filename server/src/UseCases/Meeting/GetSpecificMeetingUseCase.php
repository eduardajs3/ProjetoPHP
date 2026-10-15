<?php

namespace App\App\UseCases\Event;

use App\App\Repository\MeetingRepository;

class GetSpecificMeetingUseCase
{
    private MeetingRepository $meetingRepository;

    public function __construct(MeetingRepository $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    public function execute($meetingId)
    {
        if (!isset($meetingId) || empty($meetingId)) {
            return "O ID da reunião é obrigatório";
        }

        $meeting = $this->meetingRepository->findEventById($meetingId);

        if (!$meeting) {
            return "Reunião não encontrada";
        }

        return [
            'id' => $meeting->getId(),
            'attendees' => $meeting->getAttendees(),
            'createdAt' => $meeting->getCreatedAt()->format('d-m-Y'),
            'endAt' => $meeting->getEndAt() ? $meeting->getEndAt()->format('d-m-Y') : null,
            'eventId' => $meeting->getEventId(),
            'conduct' => $meeting->getConduct(),
        ];
    }
}
