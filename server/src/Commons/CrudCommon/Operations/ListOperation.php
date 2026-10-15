<?php
namespace App\App\Commons\CrudCommon\Operations;
use App\App\Commons\CrudCommon\Builder\OperationBuilder;
use App\App\Commons\ResponseCommons\Responses;
class ListOperation
{
	private OperationBuilder $builder;

	public function setBuilder(OperationBuilder $builder)
	{
		$this->builder = $builder;
	}

	public function listAll($fiedls, $haveFields, $successMsg, $errorMsg)
	{
		$response = new Responses();
		if ($this->builder !== null) {
			$data = $this->builder->getAll($fiedls, $haveFields);
			return $response->response($data, $successMsg, $errorMsg);
		}

		return null;
	}
}