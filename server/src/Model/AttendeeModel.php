<?php

namespace App\App\Model;

class AttendeeModel {
	private $id;
	private $patientId;
	private $hostId;
	private $meetingId;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getPatientId() {
		return $this->patientId;
	}

	public function setPatientId($patientId) {
		$this->patientId = $patientId;
	}

	public function getHostId() {
		return $this->hostId;
	}

	public function setHostId($hostId) {
		$this->hostId = $hostId;
	}

	public function getMeetingId() {
		return $this->meetingId;
	}

	public function setMeetingId($meetingId) {
		$this->meetingId = $meetingId;
	}
}
