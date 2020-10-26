<?php

namespace App\Repositories\Contracts;

interface CalendarStatusRepositoryInterface
{
    public function getStatusBySlug($slug);
}
