<?php

namespace App\App\Repository;

use App\App\Commons\CrudCommon\Builder\ConcretBuilder;
use App\App\Commons\CrudCommon\Operations\CreateOperation;
use App\App\Commons\CrudCommon\Operations\DeleteOperation;
use App\App\Commons\CrudCommon\Operations\ListOperation;
use App\App\Commons\CrudCommon\Operations\UpdateOperation;
use App\App\Database\Database;
use Ramsey\Uuid\Uuid;
use PDO;
use PDOException;

class PatientRepository
{
	private $table = 'patients';
	private $conn;
	private $concretBuilder;

	public function __construct() {
		$this->conn = Database::getInstance();
		$this->concretBuilder = new ConcretBuilder('patients');
	}

	public function insertPatient($patient) {
		$createOperation = new CreateOperation();
		$createOperation->setBuilder($this->concretBuilder);

		$user = [
			"id" =>  Uuid::uuid4(),
			"name" => $patient->getName(),
			"email" => $patient->getEmail(),
			"password" => $patient->getPassword(),
			"avatar" => $patient->getAvatar(),
			"CPF" => $patient->getCpf(),
			"birth_date" => $patient->getBirthDate(),
			"is_email_verified" => 0,
			'nutritionist_id' => $patient->getNutritionistId(),
		];
		
		return $createOperation->createOperation($user);
	}

	public function getAllPatients($nutritionistId)
	{
		$query = "SELECT id, name, email, avatar, CPF, birth_date, is_email_verified, nutritionist_id FROM $this->table WHERE nutritionist_id = :nutritionistId";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":nutritionistId", $nutritionistId);

			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function getPatientById($id)
	{
		$query = "SELECT id, name, email, avatar, CPF, birth_date, is_email_verified FROM $this->table WHERE id = :id";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $id);

			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function getPatientByEmail($email)
	{
		$query = "SELECT * FROM $this->table WHERE email = :email LIMIT 1;";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":email", $email);

		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getPatienteByCpf($cpf)
	{
		$query = "SELECT * FROM $this->table WHERE $this->table.CPF == :CPF LIMIT 1;";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":CPF", $cpf);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function updatePatient($patient)
	{
		$updateOperation = new UpdateOperation();
		$updateOperation->setBuilder($this->concretBuilder);
		$user = [
			"id" =>  Uuid::uuid4(),
			"name" => $patient->getName(),
			"email" => $patient->getEmail(),
			"password" => $patient->getPassword(),
			"avatar" => $patient->getAvatar(),
			"CPF" => $patient->getCpf(),
			"birthDate" => $patient->getBirthDate(),
			"isEmailVerified" => 0
		];

		return $updateOperation->update($user['id'], $user, "Paciente atualizado com sucesso", "Erro ao atualizar paciente");
	}

	public function updatePatientAvatar($id, $avatar) {
		$query = "UPDATE $this->table SET avatar = :avatar WHERE id = :id";
		
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":avatar", $avatar);
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function deletePatient($id)
	{
		$delteOperation = new DeleteOperation();
		$delteOperation->setBuilder($this->concretBuilder);

		return $delteOperation->delete($id, 'Paciente deletado com sucesso', 'Erro ao deletar paciente');
	}

	public function confirmEmail($id)
	{
		$updateOperation = new UpdateOperation();
		$updateOperation->setBuilder($this->concretBuilder);
		$user = [
			"id" => $id,
			"isEmailVerified" => 1
		];

		return $updateOperation->update($id, $user, "Paciente atualizado com sucesso", "Erro ao atualizar paciente");
	}
}
