<?php

namespace App\Repositories\Contracts;

interface CalendarRepositoryInterface
{
    public function findAll($page, $startAt, $endAt);
    public function findById($id);
}
