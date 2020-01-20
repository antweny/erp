<?php

namespace App;

use App\Traits\Uuids;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use Uuids;

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'id' => 'string'
    ];
}
