<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\Uuids;
use Illuminate\Support\Carbon;

class Admin extends Authenticatable
{
    use Notifiable;
    use Uuids;
    use HasRoles;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'string'
    ];


    /* ----------------
     * CLASS ACCESSOR
     * ----------------*/
    public function getRegisteredAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, y');
    }
}
