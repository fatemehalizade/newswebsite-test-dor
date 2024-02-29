<?php

namespace App\Repositories;

interface InterfaceBaseRepository
{
    public function getAll();

    public function query();

    public function findById($id);

    public function insertData($data);

    public function updateItem($identity, $data);

    public function deleteData($identity);

    public function searchByColumn($column, $value);
}
