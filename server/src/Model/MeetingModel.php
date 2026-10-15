<?php

namespace App\App\Model;

class MeetingModel {
	public $id;
	public $createdAt;
	public $eventId;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
	}

	public function getEventId() {
		return $this->eventId;
	}

	public function setEventId($eventId) {
		$this->eventId = $eventId;
	}
}