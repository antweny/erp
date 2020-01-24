<?php

namespace App;

use App\Traits\Uuids;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends SpatieRole
{

    use Uuids;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'guard_name', 'desc',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'id' => 'string'
    ];

    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'roles';
    protected static $logOnlyDirty = true;
}
