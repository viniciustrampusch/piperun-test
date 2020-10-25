<?php

namespace App\Services;

use App\Repositories\Contracts\CalendarRepositoryInterface;
use App\Services\Contracts\CalendarServiceInterface;
use Carbon\Carbon;

class CalendarService implements CalendarServiceInterface
{
    protected $userRepository;

    public function __construct(CalendarRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
