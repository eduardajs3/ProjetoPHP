<?php

namespace App\App\Model;

// simple add

class MedicalRecordsModel {
	private $id;
	private $patient;
	private $nutritionist;
	private $content;
	private $doc_orientation;
	private $doc_mealPlain;
	private $doc_recipe;


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

	public function getNutritionist(){
		return $this->nutritionist;
	}

	public function setNutritionist($nutritionist){
		$this->nutritionist = $nutritionist;
	}
	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->contend = $content;
	}

	public function getDoc_Orientation(){
		return $this->doc_orientation;
	}

	public function setDoc_Orientation($doc_orientation){
		$this->doc_orientation = $doc_orientation;
	}
	public function getDoc_MealPlain(){
		return $this->doc_mealPlain;
	}

	public function setDoc_MealPlain($doc_mealPlain){
		$this->doc_mealPlain = $doc_mealPlain;
	}

	public function getDoc_Recipe(){
		return $this->doc_recipe;
	}

	public function setDoc_Recipe($doc_recipe){
		$this->doc_recipe = $doc_recipe;
	}
}
