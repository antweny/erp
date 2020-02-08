<?php

namespace App;


class GenderSeriesParticipant extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['individual_id','organization_id','ward_id','gender_series_id'];

    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'gender_series_participants';


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

    public function gender_series()
    {
        return $this->belongsTo(GenderSeries::class)->withDefault();
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class)->withDefault();
    }


}
