<?php

namespace App;

use Illuminate\Support\Str;

class ParticipantRole extends BaseModel
{
    /* -----------------------------------------
       * The attributes that are mass assignable.
       * -----------------------------------------*/
    protected $fillable = ['name','desc'];

    //protected $table = 'individual_groups';


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'participant_roles';

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

    /* ---------------------
     *  Model Relationships
     * ---------------------*/






}
