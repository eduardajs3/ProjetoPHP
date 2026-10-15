<?php

namespace App\App\Repository;

use App\App\Commons\CrudCommon\Builder\ConcretBuilder;
use App\App\Commons\CrudCommon\Operations\CreateOperation;
use App\App\Commons\CrudCommon\Operations\DeleteOperation;
use App\App\Commons\CrudCommon\Operations\ListOperation;
use App\App\Commons\CrudCommon\Operations\UpdateOperation;
use App\App\Model\EventModel;
use App\App\Database\Database;
use DateTime;
use Ramsey\Uuid\Nonstandard\Uuid;
use PDO;
use PDOException;

class EventRepository
{
	private ConcretBuilder $builder;
	private $conn;

	private $table = "events";

	public function __construct()
	{
		$this->conn = Database::getInstance();
		$this->builder = new ConcretBuilder($this->table);
	}

	public function findAllByNutritionistId($nutritionistId)
	{
		$query = "SELECT id, name, status, start_date, end_date, created_at FROM $this->table WHERE $this->table.nutritionist_id == :nutritionistId;";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":nutritionistId", $nutritionistId);
			$stmt->execute();
			$date = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $date;
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function createEvent(EventModel $eventModel)
	{
		$createOperation = new CreateOperation();
		$createOperation->setBuilder($this->builder);
		$event = [
			"id" => Uuid::uuid4(),
			"name" => $eventModel->getName(),
			"status" => $eventModel->getStatus(),
			"start_date" => $eventModel->getStartDate(),
			"end_date" => $eventModel->getEndDate(),
			// "created_at" => (new DateTime())->format(DateTime::ISO8601_EXPANDED),
			"nutritionist_id" => $eventModel->getNutritionistId()
		];

		return $createOperation->createOperation($event);
	}

	public function getEventById($id)
	{
		$query = "SELECT * FROM $this->table WHERE $this->table.id == :id LIMIT 1;";

		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $id);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function getEventByName($name)
	{
		$query = "SELECT * FROM $this->table WHERE $this->table.name == :name LIMIT 1;";

		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":name", $name);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function findEventByDateAndTime($dateTime)
	{
		$query = "SELECT * FROM $this->table WHERE $this->table.start_date = :start_date";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":start_date", $dateTime);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function updateEvent($id, EventModel $eventModel)
	{
		$updateOperation = new UpdateOperation();
		$updateOperation->setBuilder($this->builder);
		$event = [
			"name" => $eventModel->getName(),
			"status" => $eventModel->getStatus(),
			"start_date" => $eventModel->getStartDate(),
			"end_date" => $eventModel->getEndDate(),
		];
		return $updateOperation->update($id, $event, "Evento atualizado com sucesso", "Erro ao atualizar evento");
	}

	public function deleteEvent($id)
	{
		$deleteOperation = new DeleteOperation();
		$deleteOperation->setBuilder($this->builder);

		return $deleteOperation->delete($id, "Evento deletado com sucesso", "Erro ao deletar evento");
	}
}
