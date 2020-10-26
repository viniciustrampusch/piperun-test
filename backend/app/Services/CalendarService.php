<?php

namespace App\Services;

use App\Repositories\Contracts\CalendarRepositoryInterface;
use App\Repositories\Contracts\CalendarStatusRepositoryInterface;
use App\Services\Contracts\CalendarServiceInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\CalendarMail;
use Carbon\Carbon;

class CalendarService implements CalendarServiceInterface
{
    protected $userRepository;
    protected $calendarStatusRepository;

    public function __construct(CalendarRepositoryInterface $userRepository, CalendarStatusRepositoryInterface $calendarStatusRepository)
    {
        $this->userRepository = $userRepository;
        $this->calendarStatusRepository = $calendarStatusRepository;
    }

    public function findAll($data)
    {
        $data = $this->removeMinutes($data);
        return $this->userRepository->findAll($data['page'] ?? 1, $data['start_at'] ?? null, $data['end_at'] ?? null);
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create($data)
    {
        $data['start_at'] .= ' ' . $data['start_at_time'];
        $data['end_at'] .= ' ' . $data['end_at_time'];
        $data['status_id'] = $this->calendarStatusRepository->getStatusBySlug('pending')->id;
        
        $data = $this->removeMinutes($data);
        
        $calendar = $this->userRepository->create($data);
        
        Mail::to($calendar->requested->email)->send(new CalendarMail());

        return $calendar;
    }

    public function moderate($id, $data)
    {
        return $this->userRepository->moderate($id, $data['status_id']);
    }

    public function update($id, $data)
    {
        $data = $this->removeMinutes($data);
        return $this->userRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    private function removeMinutes($data)
    {
        if (isset($data['start_at'])) {
            $data['start_at'] = new Carbon($data['start_at']);
            $data['start_at'] = $data['start_at']->minute(0)->second(0);
        }

        if (isset($data['end_at'])) {
            $data['end_at'] = new Carbon($data['end_at']);
            $data['end_at'] = $data['end_at']->minute(0)->second(0);
        }

        return $data;
    }
}
