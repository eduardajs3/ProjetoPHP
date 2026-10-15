<?php
namespace App\App\Repository;

use App\App\Commons\CrudCommon\Builder\ConcretBuilder;
use App\App\Commons\CrudCommon\Operations\CreateOperation;
use App\App\Commons\CrudCommon\Operations\DeleteOperation;
use App\App\Commons\CrudCommon\Operations\GetByIdOperation;
use App\App\Commons\CrudCommon\Operations\ListOperation;
use App\App\Commons\CrudCommon\Operations\UpdateOperation;
use App\App\Database\Database;
use App\App\Model\NutritionistModel;
use Ramsey\Uuid\Uuid;
use PDO;
use PDOException;

class NutritionistRepository
{
	private $conn;
	private $concretBuilder;
	private $table = "nutritionists";
	public function __construct()
	{
		$this->conn = Database::getInstance();
		$this->concretBuilder = new ConcretBuilder($this->table);
	}


	public function insertNutritionist(NutritionistModel $nutritionist)
	{
		$createOperation = new CreateOperation();
		$createOperation->setBuilder($this->concretBuilder);
		$user = [
			"id" => Uuid::uuid4(),
			"name" => $nutritionist->getName(),
			"email" => $nutritionist->getEmail(),
			"password" => $nutritionist->getPassword(),
			"avatar" => $nutritionist->getAvatar(),
			"CNPJ" => $nutritionist->getCnpj(),
			"is_email_verified" => 0,
		];

		return $createOperation->createOperation($user);
	}

	public function getAllNutritionists()
	{
		$listOperation = new ListOperation();
		$listOperation->setBuilder($this->concretBuilder);
		return $listOperation->listAll(['id', 'name', 'email', 'avatar'], true, "Dados encontrados com sucesso", "erro ao buscar dados");
	}

	public function getNutritionistById($id) {
		$query = "SELECT * FROM $this->table WHERE id = :id";

		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $id);
			$stmt->execute();
	
			return $stmt->fetch(PDO::FETCH_ASSOC);

		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function getNutritionistByEmail($email)
	{
		$query = "SELECT * FROM $this->table WHERE $this->table.email = :email";
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":email", $email);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $th) {
			return $th->getMessage();
		}
	}

	public function updateNutritionist($nutritionist)
	{
		$updateOperation = new UpdateOperation();
		$updateOperation->setBuilder($this->concretBuilder);
		$user = [
			"id" => $nutritionist->getId(),
			"name" => $nutritionist->getName(),
			"email" => $nutritionist->getEmail(),
			"avatar" => $nutritionist->getAvatar(),
			"CNPJ" => $nutritionist->getCnpj()
		];

		return $updateOperation->update($user['id'], $user, 'Nutricionista atualizado(a) com sucesso', 'Erro ao atualizar nutricionista');
	}

	public function updateNutritionistAvatar($id, $avatar) {
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

	public function deleteNutritionist($id)
	{
		$deleteOperation = new DeleteOperation();
		$deleteOperation->setBuilder($this->concretBuilder);

		return $deleteOperation->delete($id, "Nutricionista $id deletado com sucesso", "Erro ao deletar nutricionista $id");
	}

	public function confirmEmail($id)
	{
		$updateOperation = new UpdateOperation();
		$updateOperation->setBuilder($this->concretBuilder);
		$user = [
			"id" => $id,
			"is_email_verified" => 1
		];

		return $updateOperation->update($id, $user, "Email confimed successfully", "Something went wrong!");
	}
}