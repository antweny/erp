<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\Uuids;

class User extends Authenticatable
{
    use Notifiable;
    use Uuids;
    use HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.y
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

    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'users';
    protected static $logOnlyDirty = true;



    /* ----------------
     * CLASS ACCESSOR
     * ----------------*/
    public function getRegisteredAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, y');
    }
}
