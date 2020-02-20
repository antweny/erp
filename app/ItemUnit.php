<?php

namespace App;


class ItemUnit extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc'
    ];

    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'item_units';

    /*
    * Mutator Functions
    */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

}
