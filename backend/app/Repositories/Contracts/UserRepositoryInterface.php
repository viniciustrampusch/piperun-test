<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function findAll($page, $term);
    public function findById(int $id);
}
