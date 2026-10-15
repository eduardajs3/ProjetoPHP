<?php
namespace App\App\Commons\CrudCommon\Operations;

use App\App\Commons\CrudCommon\Builder\OperationBuilder;
use App\App\Commons\ResponseCommons\Responses;
class UpdateOperation
{
	private OperationBuilder $builder;

	public function setBuilder(OperationBuilder $builder)
	{
		$this->builder = $builder;
	}

	public function update($id, $model, $successMsg, $errMesg)
	{
		if ($this->builder != null) {
			$response = new Responses();
			$updated = $this->builder->update($id, $model);
			return $response->response($updated, $successMsg, $errMesg);
		}
	}
}