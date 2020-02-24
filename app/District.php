<?php

namespace App;

use Illuminate\Support\Str;

class District extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name', 'desc', 'city_id'];

    /* ------------------------------------------
   * Log all activities performed on the model
   * ------------------------------------------*/
    protected static $logName = 'districts';


    /* --------------------
     * Route model binding
     * --------------------*/
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /* ------------------
     * Mutator Functions
     * ------------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }


    /* ---------------------
     *  Model Relationships
     * ---------------------*/
    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }
    public function ward()
    {
        return $this->hasMany(Ward::class);
    }


}
