<?php

namespace App;

use Illuminate\Support\Str;

class Field extends BaseModel
{
    /* -----------------------------------------
      * The attributes that are mass assignable.
      * -----------------------------------------*/
    protected $fillable = ['name','desc','sector_id'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'fields';


    /* --------------------
     * Route model binding
     * --------------------*/
    public function getRouteKeyName ()
    {
        return 'slug';
    }

    /* ------------------
     * Mutator Functions
     * ------------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
        $this->attributes['slug'] = Str::slug($value,'-');
    }


    /* ---------------------
     *  Model Relationships
     * ---------------------*/
    public function sector()
    {
        return $this->belongsTo(Sector::class)->withDefault();
    }
}
