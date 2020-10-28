<?php

namespace App\Services;

use App\Repositories\Contracts\CalendarRepositoryInterface;
use App\Repositories\Contracts\CalendarStatusRepositoryInterface;
use App\Services\Contracts\CalendarServiceInterface;
use App\Traits\MailWarning;

class CalendarService implements CalendarServiceInterface
{
    use MailWarning;

    protected $userRepository;
    protected $calendarStatusRepository;

    public function __construct(CalendarRepositoryInterface $userRepository, CalendarStatusRepositoryInterface $calendarStatusRepository)
    {
        $this->userRepository = $userRepository;
        $this->calendarStatusRepository = $calendarStatusRepository;
    }

    public function findAll($data)
    {
        return $this->userRepository->findAll($data['page'] ?? 1, $data['start_at'] ?? null, $data['end_at'] ?? null);
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function findByUserId($id, $data)
    {
        return $this->userRepository->findByUserId($id, $data);
    }

    public function create($data)
    {
        $data['start_at'] .= ' ' . $data['start_at_time'];
        $data['end_at'] .= ' ' . $data['end_at_time'];
        $data['status_id'] = $this->calendarStatusRepository->getStatusBySlug('pending')->id;
        
        $calendar = $this->userRepository->create($data);
        
        $this->sendMail($calendar->requested->email);

        return $calendar;
    }

    public function moderate($id, $data)
    {
        $data['status_id'] = $this->calendarStatusRepository->getStatusBySlug($data['slug'])->id;

        return $this->userRepository->moderate($id, $data['status_id']);
    }

    public function update($id, $data)
    {
        $data['start_at'] .= ' ' . $data['start_at_time'];
        $data['end_at'] .= ' ' . $data['end_at_time'];

        return $this->userRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
