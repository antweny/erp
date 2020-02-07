<?php

namespace App;

use Illuminate\Support\Str;

class EventCategory extends BaseModel
{
    /* -----------------------------------------
       * The attributes that are mass assignable.
       * -----------------------------------------*/
    protected $fillable = ['name','desc'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'event_categories';


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
        $this->attributes['name'] = ucwords($value);
        $this->attributes['slug'] = Str::slug($value,'-');
    }

    /* -------------------
     *   Other Functions
     * -------------------*/
    /*
     * Get Name and ID
     */
    static function get_name_and_id()
    {
        $data = EventCategory::select('id','name')->get();
        return $data;
    }
}
