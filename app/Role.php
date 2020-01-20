<?php

namespace App;

use App\Traits\Uuids;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    use Uuids;

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'id' => 'string'
    ];
}
