<?php

namespace App\App\Commons\CrudCommon\Builder;

use App\App\Database\Database;
use App\App\Commons\CrudCommon\Builder\OperationBuilder;
use PDO;
use PDOException;

class ConcretBuilder implements OperationBuilder
{
	private $conn;
	public $table;
	public function __construct($table)
	{
		$this->conn = Database::getInstance();
		$this->table = $table;
	}

	public function transformEntity($entity)
	{
		$keys = [];
		$values = [];
		$keys = array_keys($entity);
		$values = array_values($entity);

		return [$keys, $values];
	}


	public function createBindParam($model)
	{
		list($chaves, $valores) = $this->transformEntity($model);
	}

	public function getById($id)
	{
		$query = "SELECT * FROM $this->table WHERE id = :id";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			return $data;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function create($model)
	{
		$placeholders = [];
		list($keys, $values) = $this->transformEntity($model);

		foreach ($keys as $k) {
			$placeholders[] = ":$k";
		}

		$query = "INSERT INTO $this->table (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $placeholders) . ")";

		try {
			$stmt = $this->conn->prepare($query);

			foreach ($keys as $key => $chave) {
				$stmt->bindValue(":$chave", $values[$key]);
			}

			$stmt->execute();
			$id = $this->conn->lastInsertId();
			$data = $this->getById($id);

			return $data;
		} catch (PDOException $e) {
			return $e;
		}
	}
	public function update($id, $model)
	{
		$verifyItem = $this->getById($id);
		if (!$verifyItem) {
			return "o id $id não foi encontrado";
		}

		$setClause = [];
		list($keys, $values) = $this->transformEntity($model);

		foreach ($keys as $k) {
			$setClause[] = "$k = :$k";
		}

		$setClauseStr = implode(", ", $setClause);
		$query = "UPDATE $this->table SET $setClauseStr WHERE id = :id;";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindValue(":id", $id);
			foreach ($keys as $key => $chave) {
				$stmt->bindValue(":$chave", $values[$key]);
			}

			$stmt->execute();

			$updated = $this->getById($id);
			return $updated;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}


	public function delete($id)
	{
		$item = $this->getById($id);

		if (empty($item) || !$item) {
			return "Error: Item with ID $id not found.";
		}

		$query = "DELETE FROM $this->table WHERE id = :id";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindValue(":id", $id);
			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function getAll($fields, $haveFields)
	{
		$stmt = "";
		if ($haveFields) {
			$options = implode(",", $fields);
			$query = "SELECT $options FROM $this->table;";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$query = "SELECT * FROM $this->table;";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
}
