<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;


class BaseModel extends Model
{
    use Uuids;
    use LogsActivity;

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
    protected static $logOnlyDirty = true;




}
