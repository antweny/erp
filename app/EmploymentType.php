<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmploymentType extends BaseModel
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
    protected static $logName = 'employment_types';


    /* -----------------
   * Mutator Functions
   * -----------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
        $this->attributes['slug'] = Str::slug($value,'-');
    }
}
