<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "calendar";

    protected $fillable = [
        'status_id',
        'start_at',
        'end_at',
        'description',
        'customer_name',
        'customer_email',
        'requester_id',
        'requested_id',
    ];

    public function status() : HasOne
    {
        return $this->hasOne(CalendarStatus::class, 'id', 'status_id');
    }

    public function requester() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'requester_id');
    }

    public function requested() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'requested_id');
    }
}
