<?php

namespace App\App\Repository;

use App\App\Database\Database;
use PDO;
use PDOException;

class NotificationRepository {
  private $conn;
	private $table = "notifications";
	
  public function __construct() {
		$this->conn = Database::getInstance();
	}

	public function getAllNotifications() {
		$query = "SELECT * FROM $this->table";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getNotificationById($id)
	{
		$query = "SELECT * FROM $this->table WHERE id = :id";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

  public function updateNotificationRead($id) {
    $read = 1;

    $query = "UPDATE $this->table SET read = :read WHERE id = :id";
		
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":read", $read);
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
  }
}