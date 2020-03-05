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
    public function district()
    {
        return $this->belongsTo(District::class)->withDefault();
    }
    public function street()
    {
        return $this->hasMany(Street::class);
    }

    /*
    * Get record id
    */
    public function getID($data)
    {
        if ($data != null) {
            $model = $this->firstOrCreate(['name'=>$data]);
            return $model->id;
        }
        return null;
    }


}
