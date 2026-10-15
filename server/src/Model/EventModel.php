<?php

namespace App\App\Model;

class EventModel {
	private $id;
	private $name;
	private $status;
	private $startDate;
	private $endDate;
	private $nutrionistId;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function setStartDate($startDate) {
		$this->startDate = $startDate;
	}

	public function getEndDate(){
		return $this->endDate;
	}

	public function setEndDate($endDate){
	  $this->endDate = $endDate;
	}

	public function getNutritionistId() {
		return $this->nutrionistId;
	}

	public function setNutritionistId($nutrionistId) {
		$this->nutrionistId = $nutrionistId;
	}
}