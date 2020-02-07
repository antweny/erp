<?php

namespace App;

use Illuminate\Support\Str;

class Venue extends BaseModel
{
    /* -----------------------------------------
      * The attributes that are mass assignable.
      * -----------------------------------------*/
    protected $fillable = ['name', 'desc', 'city_id','district_id','mobile','email','capacity','type','contact_person','contact_person_number'];


    /* ------------------------------------------
    * Log all activities performed on the model
    * ------------------------------------------*/
    protected static $logName = 'venues';

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
    public function district()
    {
        return $this->belongsTo(District::class)->withDefault();
    }


    /* -------------------
     *   Other Functions
     * -------------------*/
    /*
     * Get Name and ID
     */
    static function get_name_and_id()
    {
        $data = Venue::select('id','name')->get();
        return $data;
    }
}
