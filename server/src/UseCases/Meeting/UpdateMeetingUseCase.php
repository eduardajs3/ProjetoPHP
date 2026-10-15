<?php

namespace App\App\UseCases\Event;

use App\App\Repository\EventRepository;
use App\App\Repository\MeetingRepository;

class UpdateMeetingUseCase
{
    private MeetingRepository $meetingRepository;
    private EventRepository $eventRepository;

    public function __construct(MeetingRepository $meetingRepository, EventRepository $eventRepository)
    {
        $this->meetingRepository = $meetingRepository;
        $this->eventRepository = $eventRepository;
    }

    public function execute($meetingId, $data)
    {
        if (!isset($meetingId) || empty($meetingId)) {
            return "O ID da reunião é obrigatório";
        }

        $meeting = $this->meetingRepository->findEventById($meetingId);

        if (!$meeting) {
            return "Reunião não encontrada";
        }

        $event = $this->eventRepository->getEventById($meeting->getEventId());

        if (!$event) {
            return "Evento relacionado à reunião não encontrado";
        }

        if (isset($data['attendees'])) {
            $meeting->setAttendees($data['attendees']);
        }

        if (isset($data['conduct'])) {
            $meeting->setConduct($data['conduct']);
        }

        $meeting->setCreatedAt(new \DateTime($event['start_at']));
        $meeting->setEndAt(new \DateTime($event['end_at']));

        $this->meetingRepository->updateMeeting($meeting);

        return "Reunião atualizada com sucesso";
    }
}
