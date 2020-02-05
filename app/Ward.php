<?php

namespace App;


use Illuminate\Support\Str;

class Ward extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name', 'desc', 'district_id'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'wards';

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
    public function district()
    {
        return $this->belongsTo(District::class)->withDefault();
    }
    public function street()
    {
        return $this->hasMany(Street::class);
    }
}
