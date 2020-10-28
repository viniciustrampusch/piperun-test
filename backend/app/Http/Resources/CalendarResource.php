<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CalendarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status->name,
            'start_at' => [
                'date' => (new Carbon($this->start_at))->format('Y-m-d'),
                'time' => (new Carbon($this->start_at))->format('H:i:s')
            ],
            'end_at' => [
                'date' => (new Carbon($this->end_at))->format('Y-m-d'),
                'time' => (new Carbon($this->end_at))->format('H:i:s')
            ],
            'runtime' => (new Carbon($this->start_at))->diffInMinutes(new Carbon($this->end_at)),
            'description' => $this->description,
            'requester' => [
                'id' => $this->requester ? $this->requester->id : null,
                'name' => $this->requester ? $this->requester->name : $this->customer_name,
                'email' => $this->requester ? $this->requester->email : $this->customer_email
            ],
            'requested' => [
                'id' => $this->requested->id,
                'name' => $this->requested->name,
                'email' => $this->requested->email
            ]
        ];
    }
}
