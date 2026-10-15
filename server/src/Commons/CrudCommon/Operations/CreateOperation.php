<?php
namespace App\App\Commons\CrudCommon\Operations;

use App\App\Commons\ResponseCommons\Responses;
use App\App\Commons\CrudCommon\Builder\OperationBuilder;

class CreateOperation
{
    private OperationBuilder $builder;
    public function setBuilder($builder)
    {
        $this->builder = $builder;
    }

    public function createOperation($model){
			$response = new Responses();
        if($this->builder !== null){
          $data = $this->builder->create($model);
          return $data;
        }

        return null;
    }
}