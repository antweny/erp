<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class ItemCategory extends BaseModel
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
    protected static $logName = 'item_categories';
    protected static $logOnlyDirty = true;
}
