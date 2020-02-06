<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Individual extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['full_name','age_group','mobile','gender','address','email','occupation','education_level_id',
        'city_id','district_id','ward_id'];


    /*
    * Log all activities performed on the model
    */
    protected static $logName = 'individuals';


    /*
    * Mutator Functions
    */
    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = ucwords(strtolower($value));
    }


    /*
     * Accessor Functions
     */
    public function getSexAttribute()
    {
        switch ($this->gender)
        {
            case 'M':
                return 'Male';
                break;
            case 'F':
                return 'Female';
                break;
            default:
                return null;
                break;
        }
    }


    /* ---------------------
    *  MODEL RELATIONSHIPS
    * ---------------------*/
    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
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
    public function street()
    {
        return $this->belongsTo(Street::class)->withDefault();
    }
    public function education_level()
    {
        return $this->belongsTo(EducationLevel::class)->withDefault();
    }
}
