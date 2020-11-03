<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< HEAD
use Illuminate\Notifications\Notifiable;
=======
use Illuminate\Database\Eloquent\SoftDeletes;
>>>>>>> f7711e268dd57be150f37410e54311dea3f4d980

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
<<<<<<< HEAD
    use Notifiable;
=======
    use SoftDeletes;
>>>>>>> f7711e268dd57be150f37410e54311dea3f4d980

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
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function calendars() : HasMany
    {
        return $this->hasMany(Calendar::class, 'requested_id');
    }
}
