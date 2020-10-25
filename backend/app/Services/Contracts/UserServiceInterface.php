<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    public function login($request);
    public function findAll($data);
    public function findById(int $id);
}
