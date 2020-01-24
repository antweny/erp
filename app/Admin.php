<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\Uuids;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
    use Notifiable;
    use Uuids;
    use HasRoles;
    use LogsActivity;

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

    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'admins';
    protected static $logOnlyDirty = true;


    /**
     * Class Accessor
     */

    //Get date user registered
    public function getRegisteredAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, y');
    }

    //Get Admin Name on activity log
    static function get_causer_name($id)
    {
        $admin = Admin::findOrFail($id);
        return $admin->name;
    }
}
