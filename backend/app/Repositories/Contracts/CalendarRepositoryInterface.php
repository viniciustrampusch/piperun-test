<?php

namespace App\Repositories\Contracts;

interface CalendarRepositoryInterface
{
    public function create($data);
    public function delete($id);
    public function findAll($page, $startAt, $endAt);
    public function findById($id);
    public function findByUserId($id, $data);
    public function moderate($id, $status);
    public function update($id, $data);
}
