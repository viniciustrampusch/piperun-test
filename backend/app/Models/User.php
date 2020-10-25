<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function role() : HasOne
    {
        return $this->hasOne(Role::class);
    }

    public function calendars() : HasMany
    {
        return $this->hasMany(Calendar::class, 'requested_id');
    }
}
