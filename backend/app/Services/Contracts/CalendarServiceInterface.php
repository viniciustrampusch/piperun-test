<?php

namespace App\Services\Contracts;

interface CalendarServiceInterface
{
    public function create($data);
    public function findAll($data);
    public function findById($id);
}
