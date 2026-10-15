<?php

namespace App\App\Commons\CrudCommon\Operations;

use App\App\Commons\CrudCommon\Builder\ConcretBuilder;
use App\App\Commons\ResponseCommons\Responses;

class GetByIdOperation{
	private ConcretBuilder $builder;

	public function setBuilder(ConcretBuilder $builder){
		$this->builder = $builder;
	}

	public function getById($id, $successMessage, $errorMessage){
		$response = new Responses();
		if($this->builder !== null){
		  $data = $this->builder->getById($id);
			var_dump($data);
      return $response->response($data, $successMessage, $errorMessage);
		}

		return null;
	}
}