<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;


class ItemUnit extends BaseModel
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'item_units';
    protected static $logOnlyDirty = true;


}
