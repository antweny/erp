<?php

namespace App;
use Illuminate\Support\Str;


class Street extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name', 'desc', 'ward_id'];


    /* ------------------------------------------
    * Log all activities performed on the model
    * ------------------------------------------*/
    protected static $logName = 'streets';


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
        $this->attributes['name'] = ucwords(strtolower($value));
        $this->attributes['slug'] = Str::slug($value, '-');
    }


    /* ---------------------
     *  Model Relationships
     * ---------------------*/
    public function ward()
    {
        return $this->belongsTo(Ward::class)->withDefault();
    }
}
