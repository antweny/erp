<?php
/**
 * Created by PhpStorm.
 * User: antweny
 * Date: 2/27/2019
 * Time: 5:02 PM
 */

namespace App\Traits;
use Ramsey\Uuid\Uuid;

trait Uuids
{
    /**
     * Boot function from Laravel
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->{$model->getKeyName()} = Uuid::uuid4();
        });
    }
}
