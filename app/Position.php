<?php

namespace App;


class Position extends BaseModel
{
    /* -----------------------------------------
    * The attributes that are mass assignable.
    * -----------------------------------------*/
    protected $fillable = ['organization_id','individual_id','title_id','start_date','end_date','desc','city_id','district_id','ward_id'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'positions';


    /*
     *
     */
    public function getStatusAttribute ()
    {
        switch ($this->end_date) {
            case '':
                return '<span class="status  bg-success text-white">active</span>';
                break;
            default:
                return $this->end_date;
                break;
        }
    }

    public function getDojAttribute ()
    {
        switch ($this->start_date) {
            case '':
                return '<span class="status  bg-danger text-white">NOT SET</span>';
                break;
            default:
                return get_day_month_and_year($this->start_date);
                break;
        }
    }



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
    public function title()
    {
        return $this->belongsTo(Title::class)->withDefault();
    }


}
