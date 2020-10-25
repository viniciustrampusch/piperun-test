<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CalendarRepositoryInterface;
use App\Models\Calendar;
use App\Exceptions\InvalidDateException;

class CalendarRepository implements CalendarRepositoryInterface
{
    protected $model;

    public function __construct(Calendar $model)
    {
        $this->model = $model;
    }

    public function findAll($page, $startAt, $endAt)
    {
        $query = $this->model->newQuery();
        
        if ($startAt) {
            $query->whereDate('start_at', '>=', $startAt);
        }

        if ($endAt) {
            $query->whereDate('end_at', '<=', $endAt);
        }

        return $query->orderBy('start_at', 'desc')->paginate(15);
    }
}
