<?php

namespace App\App\Model;

use App\App\Commons\CrudCommon\Builder\ConcretBuilder;
use App\App\Database\Database;

// use PDOException;

class NutritionistModel
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $avatar;
	private $cnpj;
	private $conn;
	private $table = 'nutritionists';
	private $concretBuilder;

	public function __construct()
	{
		$this->conn = Database::getInstance();
		$this->concretBuilder = new ConcretBuilder($this->table);
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

	public function getAvatar()
	{
		return $this->avatar;
	}

	public function setAvatar($avatar)
	{
		$this->avatar = $avatar;
		return $this;
	}

	public function getCnpj()
	{
		return $this->cnpj;
	}

	public function setCnpj($cnpj)
	{
		$this->cnpj = $cnpj;
		return $this;
	}
}