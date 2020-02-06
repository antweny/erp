<?php

namespace App;

use Illuminate\Support\Str;

class EducationLevel extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name','desc'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'education_levels';


    /* -------------------
     * Route model binding
     * -------------------*/
    public function getRouteKeyName ()
    {
        return 'slug';
    }

    /* ---------------------
    * Mutator Functions
    * ----------------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
        $this->attributes['slug'] = Str::slug($value,'-');
    }

    /* ---------------------
     *  Model Relationships
     * ---------------------*/
    public function individual()
    {
        return $this->hasMany(Individual::class);
    }
}
