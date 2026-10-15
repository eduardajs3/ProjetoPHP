<?php

namespace App\App\Model;

class CommentModel {
	private $id;
	private $text;
	private $commentDate;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getText(){
		return $this->text;
	}

	public function setText($text){
		$this->text = $text;
	}

	public function getCommentDate(){
		return $this->commentDate;
	}
	public function setCommentDate($commentDate){
		$this->commentDate = $commentDate;
	}
}