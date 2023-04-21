<?php

namespace App\Base\Repository;

interface RepositoryInterface
{
    public function getModel();

    public function all();

    public function create(array $data);

    public function update($id, array $data);

    public function deleteByIds(array $ids);

    public function show($id);

    public function findByField(array $input);

    public function findByFields(array $input);

    public function findWith(array $input, array $with);

    public function with(array $with);

}
