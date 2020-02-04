<?php

namespace App;


class Country extends BaseModel
{
    /* -----------------------------------------
   * The attributes that are mass assignable.
   * -----------------------------------------*/
    protected $fillable = ['name','desc','code'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'countries';


    /* -------------------
     * Route model binding
     * -------------------*/
    public function getRouteKeyName ()
    {
        return 'slug';
    }


    /* -----------------
    * Mutator Functions
    * -----------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
        $this->attributes['slug'] = Str::slug($value,'-');
    }



    /* ------------------
     *   Other Functions
     * ------------------*/
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
