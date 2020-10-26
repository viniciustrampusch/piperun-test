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
        // TODO: Validar se é feriado
        if ($data['start_at']->gt($data['end_at']) === true) {
            throw new InvalidDateException('Data de início/fim inválida, data/hora inicial é maior que a data/hora final');
        }

        if ($data['start_at']->isWeekend() || $data['end_at']->isWeekend()) {
            throw new InvalidDateException('Data de início/fim inválida, agendamento não pode ser realizado no final de semana');
        }
        
        if ($this->validateDateByRequested($data) === true) {
            throw new InvalidDateException('Data de início/fim inválida, já possui um agendamento neste dia');
        }
        
        return $this->model->create($data);
    }

    public function moderate($id, $status)
    {
        $calendar = $this->model->find($id);
        $calendar->status_id = $status;
        $calendar->save();

        return $calendar;
    }

    public function update($id, $data)
    {
        if ($this->validateDateByRequested($data, $id) === true) {
            throw new InvalidDateException('Data de início/fim inválida');
        }

        $calendar = $this->model->find($id);
        $calendar->update($data);

        return $calendar;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
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
