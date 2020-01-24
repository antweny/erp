<?php

namespace App;

use App\Traits\Uuids;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends SpatiePermission
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
    protected static $logName = 'permissions';
    protected static $logOnlyDirty = true;
}
