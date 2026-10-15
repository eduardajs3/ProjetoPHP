<?php

namespace App\App\Model;

class MealPlainModel {
	private $id;
	private $patient;
	private $nutricionist;
	private $title;
	private $evaluation;
	private $plateImage;
	private $postDate;
	private $satietyLevel;
	private $mealDate;
	private $hungerLevel;
	private $comment;


	public function getId(){
			return $this->id;
	}
	public function setId($id){
			$this->id = $id;
	}


	public function getPatient(){
			return $this->patient;
	}
	public function setPatient($patient){
			$this->patient = $patient;
	}


	public function getNutricionist(){
			return $this->nutricionist;
	}
	public function setNutricionist($nutricionist){
			$this->nutricionist = $nutricionist;
	}


	public function getTitle(){
			return $this->title;
	}
	public function setTitle($title){
			$this->title = $title;
	}


	public function getEvaluation(){
			return $this->evaluation;
	}
	public function setEvaluation($evaluation){
			$this->evaluation = $evaluation;
	}

	public function getplateImage(){
		return $this->plateImage;
	}

	public function setPlateImage($plateImage){
		$this->plateImage = $plateImage;
	}

	public function getPostDate(){
		return $this->postDate;
	}

	public function setPostDate($postDate){
		$this->postDate = $postDate;
	}

	public function getSatietyLevel(){
		return $this->satietyLevel;
	}

	public function setSatietyLevel($satietyLevel){
		$this->satietyLevel = $satietyLevel;
	}

	public function getMealDate() {
		return $this->mealDate;
	}

	public function setMealDate($mealDate){
		$this->mealDate = $mealDate;
	}

	public function getHungerLevel() {
		return $this->hungerLevel;
	}

	public function setHungerLevel($hungerLevel){
		$this->hungerLevel = $hungerLevel;
	}

	public function getComment() {
		return $this->comment;
	}

	public function setComment($comment){
		$this->comment = $comment;
	}
}