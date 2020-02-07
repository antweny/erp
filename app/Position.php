<?php

namespace App;


class Position extends BaseModel
{
    /* -----------------------------------------
    * The attributes that are mass assignable.
    * -----------------------------------------*/
    protected $fillable = ['organization_id','individual_id','start_date','end_date','desc','city_id','district_id','ward_id'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'positions';





    /* ---------------------
    *  MODEL RELATIONSHIPS
    * ---------------------*/
    public function individual()
    {
        return $this->belongsTo(Individual::class)->withDefault();
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class)->withDefault();
    }
    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }
    public function district()
    {
        return $this->belongsTo(District::class)->withDefault();
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class)->withDefault();
    }


}
