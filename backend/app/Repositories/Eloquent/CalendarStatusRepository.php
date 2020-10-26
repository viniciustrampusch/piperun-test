<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CalendarStatusRepositoryInterface;
use App\Models\CalendarStatus;

class CalendarStatusRepository implements CalendarStatusRepositoryInterface
{
    protected $model;

    public function __construct(CalendarStatus $model)
    {
        $this->model = $model;
    }

    public function getStatusBySlug($slug)
    {
        return $this->model::firstWhere('slug', $slug);
    }
}
