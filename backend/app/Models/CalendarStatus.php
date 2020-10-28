<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarStatus extends Model
{
    use SoftDeletes;
    
    protected $table = "calendar_status";
}
