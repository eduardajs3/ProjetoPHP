<?php

namespace App\App\Model;

use App\App\Database\Database;

class NotificationModel {
  private $id;
  private $type;
  private $message;
  private $read;
  private $conn;
	private $table = 'notifications';

  public function __construct() {
		$this->conn = Database::getInstance();
		$this->concretBuilder = new ConcretBuilder($this->table);
	}

  public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

  public function getType() {
		return $this->type;
	}

  public function setType($type) {
		$this->type = $type;
		return $this;
	}

  public function getMessage() {
		return $this->message;
	}

  public function setMessage($message) {
		$this->message = $message;
		return $this;
	}

  public function getRead() {
		return $this->read;
	}

  public function setRead($read) {
		$this->read = $read;
		return $this;
	}

}