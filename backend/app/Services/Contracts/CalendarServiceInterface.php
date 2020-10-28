<?php

namespace App\Services\Contracts;

interface CalendarServiceInterface
{
    public function create($data);
    public function delete($id);
    public function findAll($data);
    public function findById($id);
    public function findByUserId($id, $data);
    public function moderate($id, $data);
    public function update($id, $data);
}
