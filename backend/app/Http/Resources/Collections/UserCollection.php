<?php

namespace App\Http\Resources\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\UserResource;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return UserResource::collection($this->collection);
    }
}