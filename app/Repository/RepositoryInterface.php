<?php
namespace App\Repository;

interface RepositoryInterface
{
    public function find($id);
    public function findAll();
}
