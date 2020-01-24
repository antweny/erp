<?php

namespace App;

use Spatie\Activitylog\Models\Activity as SpatieActivity;
use App\Traits\Uuids;

class Activity extends SpatieActivity
{
   use Uuids;

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'id' => 'string'
    ];

    /**
     * Model Relationship with Other Models
     */

    //Activity logs are performed by different admins
    public function admin()
    {
        return $this->belongsTo(Admin::class,'causer_id')->withDefault();
    }
}
