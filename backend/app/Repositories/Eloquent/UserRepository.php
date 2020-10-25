<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findAll($page, $term)
    {
        return $this->model->where('name', 'like', "%{$term}%")
                           ->orWhere('email', 'like', "%{$term}%")
                           ->paginate(15);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }
}
