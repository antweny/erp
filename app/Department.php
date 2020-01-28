<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class Department extends BaseModel
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc', 'sort',
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'departments';
    protected static $logOnlyDirty = true;
}
