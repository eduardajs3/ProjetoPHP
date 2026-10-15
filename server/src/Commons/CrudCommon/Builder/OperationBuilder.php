<?php

namespace App\App\Commons\CrudCommon\Builder;

interface OperationBuilder
{
    public function createBindParam($model);
    public function transformEntity($entity);
    public function create(array $model);
    public function update(string $id, $model);
    public function delete(string $id);
    public function getAll(array $fields, bool $haveFields);
    public function getById(string $id);
}
