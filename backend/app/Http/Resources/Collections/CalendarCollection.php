<?php

namespace App\Http\Resources\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\CalendarResource;

class CalendarCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return CalendarResource::collection($this->collection);
    }
}
