<?php
namespace App\App\Commons\CrudCommon\Operations;
use App\App\Commons\CrudCommon\Builder\OperationBuilder;
use App\App\Commons\ResponseCommons\Responses;

class DeleteOperation
{
	private OperationBuilder $builder;

	public function setBuilder(OperationBuilder $buider)
	{
		$this->builder = $buider;
	}

	public function delete($id, $successMsg, $errorMsg)
	{
		if ($this->builder !== null) {
			$response = new Responses();
			$delete = $this->builder->delete($id);

			return $response->response($delete, $successMsg, $errorMsg);
		}

		return null;
	}
}