<?php

namespace App\App\Repository;

use App\App\Model\AttendeeModel;
use App\App\Database\Database;
use Ramsey\Uuid\Nonstandard\Uuid;
use PDO;
use PDOException;

class AttendeeRepository {
  private $conn;
  private $table = "attendees";

  public function __construct() {
    $this->conn = Database::getInstance();
  }

  public function insertAttendee(AttendeeModel $attendee) {
    $id = Uuid::uuid4();
    $patientId = $attendee->getPatientId();
    $hostId = $attendee->getHostId();
    $meetingId = $attendee->getMeetingId();
    
    $query = "INSERT INTO $this->table (id, patient_id, host_id, meeting_id)
              VALUES (:id, :patientId, :hostId, :meetingId)
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":patientId", $patientId);
    $stmt->bindParam(":hostId", $hostId);
    $stmt->bindParam(":meetingId", $meetingId);
    
    $stmt->execute();
  }

  public function findMany($meetingId) {
    $query = "SELECT patients.id, name, avatar 
              FROM 
                $this->table
              LEFT JOIN
                patients
              ON 
                $this->table.patient_id = patients.id
              WHERE 
                $this->table.meeting_id = :meetingId;
    ";

    $stmt = $this->conn->prepare($query);
			$stmt->bindParam(":meetingId", $meetingId);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }
}