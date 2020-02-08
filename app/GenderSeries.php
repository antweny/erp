<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenderSeries extends BaseModel
{

    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['topic','facilitator','coordinator','follow_up','date'];



    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'gender_series';


    /* ------------------
     *  Mutator functions
     * ------------------*/
    public function setTopicAttribute($value)
    {
        $this->attributes['topic'] = ucwords(strtolower($value));
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date_to_mysql($value);
    }


    /* ------------------
     *  Accessor functions
     * ------------------*/



    /* ---------------------
     *  MODEL RELATIONSHIPS
     * ---------------------*/
    public function individual()
    {
        return $this->belongsTo(Individual::class,'facilitator')->withDefault();
    }
    //Coordinator of gender series
    public function employee()
    {
        return $this->belongsTo(Employee::class,'coordinator')->withDefault();
    }


}
