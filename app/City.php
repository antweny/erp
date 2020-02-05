<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class City extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * ----------------------------------------- */
    protected $fillable = ['name','desc','country_id'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'cities';


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
    //All Cities belong to a spesific country
    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    //Cities has many Districts
    public function district()
    {
        return $this->hasMany(District::class);
    }


    /* -------------------
     *   Other Functions
     * -------------------*/

    //Check if resource exist get ID if not create and get ID
    public function get_id($data)
    {
        if ($data != null) {
            $model = $this->firstOrCreate(['name'=>$data]);
            return $model->id;
        }
        return null;
    }
}
