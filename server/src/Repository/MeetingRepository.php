<?php

namespace App\App\Repository;

use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\GeneratorInterface;

use App\App\Commons\CrudCommon\Builder\ConcretBuilder;
use App\App\Commons\CrudCommon\Operations\CreateOperation;
use App\App\Commons\CrudCommon\Operations\DeleteOperation;
use App\App\Commons\CrudCommon\Operations\GetByIdOperation;
use App\App\Commons\CrudCommon\Operations\ListOperation;
use App\App\Commons\CrudCommon\Operations\UpdateOperation;
use App\App\Database\Database;
use App\App\Model\MeetingModel;
use DateTime;
use Ramsey\Uuid\Uuid;
use PDO;
use PDOException;

class MeetingRepository
{
	private $conn;
	private $table = "meetings";
	private $concretBuilder;

	public function __construct()
	{
		$this->conn = Database::getInstance();
		$this->concretBuilder = new ConcretBuilder($this->table);
	}

	public function findAllMeetings($nutriId)
	{
		$query = "SELECT $this->table.*, events.name, status, start_date, end_date
							FROM $this->table 
							JOIN events ON meetings.event_id = events.id 
							JOIN nutritionists ON events.nutritionist_id = nutritionists.id
							WHERE nutritionists.id = :nutriId;
		";
		
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":nutriId", $nutriId);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function listMeetingsAndAttendees() {
    $query = "SELECT 
                meetings.*
              FROM 
                meetings
              JOIN 
                attendees
              ON
                meetings.id = attendees.meeting_id
              ORDER BY
                meetings.id =attendees.patient_id; 
    ";
    try {
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $th) {
      return $th->getMessage();
    }
  }

	public function createMeeting(MeetingModel $meetingModel)
	{
		$nanoIdClient = new Client();

		$createMeeting = new CreateOperation();
		$createMeeting->setBuilder($this->concretBuilder);

		$meeting = [
			"id" => $nanoIdClient->generateId($size = 7),
			"event_id" => $meetingModel->getEventId(),
		];

		$createMeeting->createOperation($meeting);
		return $meeting;
	}


	public function updateMeeting($data)
	{
		$updateMeeting = new UpdateOperation();
		$updateMeeting->setBuilder($this->concretBuilder);
	}

	public function deleteMeeting($id)
	{
		$deleteOperation = new DeleteOperation();
		$deleteOperation->setBuilder($this->concretBuilder);
		return $deleteOperation->delete($id, "Reunião deletada com sucesso", "Erro ao deletar reunião");
	}

	public function findMeetingById($id)
	{
		$query = "SELECT * FROM $this->table WHERE id = :id";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $id);

			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function findMeetingByEventId($eventId)
	{
		$query = "SELECT * FROM $this->table WHERE $this->table.event_id = :event_id";
		try {
			$stmt = $this->conn->preapre($query);
			$stmt->bindParam(":event_id", $eventId);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function getMeetingByName($name)
	{
		$query = "SELECT * FROM $this->table WHERE $this->table.name == :name;";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":name", $name);

			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}
}
