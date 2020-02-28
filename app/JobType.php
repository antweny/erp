<?php

namespace App;

use Illuminate\Support\Str;

class JobType extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc', 'sort',
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'job_types';


    /* -----------------
   * Mutator Functions
   * -----------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
        $this->attributes['slug'] = Str::slug($value,'-');
    }
}
