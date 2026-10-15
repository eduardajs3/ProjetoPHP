<?php

namespace App\App\Model;

use App\App\Database\Database;
use PDO;
use Ramsey\Uuid\Uuid;

class PatientModel extends UserModel
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $avatar;
	private $cpf;
	private $birthDate;
	private $conn;
	private $isEmailVerified;
	private $nutritionistId;

	private $table = 'patients';

	public function __construct() {
		$this->conn = Database::getInstance();
	}

	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function setPassword($password)
	{
		$this->password = password_hash($password, PASSWORD_DEFAULT);
		return $this;
	}

	public function getAvatar() {
		return $this->avatar;
	}

	public function setAvatar($avatar) {
		$this->avatar = $avatar;
		return $this;
	}

	public function getCpf()
	{
			return $this->cpf;
	}
	public function setCpf($cpf)
	{
			$this->cpf = $cpf;
			return $this;
	}
	public function getBirthDate()
	{
			return $this->birthDate;
	}
	public function setBirthDate($birthDate)
	{
			$this->birthDate = $birthDate;
			return $this;
	}
	public function getIsEmailVerified()
	{
			return $this->isEmailVerified;
	}
	public function setIsEmailVerified($isEmailVerified)
	{
			$this->isEmailVerified = $isEmailVerified;
			return $this;
	}

	public function getNutritionistId()
	{
			return $this->nutritionistId;
	}
	public function setNutritionistId($nutritionistId)
	{
			$this->nutritionistId = $nutritionistId;
			return $this;
	}
}
