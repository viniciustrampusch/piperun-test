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

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        if ($this->validateDateByRequested($data) === true) {
            throw new InvalidDateException('Data de início/fim inválida');
        }
        
        return $this->model->create($data);
    }

    private function validateDateByRequested($data, $id = null)
    {
        $query = $this->model::where('requested_id', $data['requested_id'])
                             ->where(static function ($where) use ($data) {
                                 $where->whereBetween('start_at', [$data['start_at'], $data['end_at']])
                                       ->orWhereBetween('end_at', [$data['start_at'], $data['end_at']]);
                             });

        if ($id) {
            $query->where('id', '<>', $id);
        }

        return $query->count() > 0;
    }
}
