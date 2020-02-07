<?php

namespace App;

use Illuminate\Support\Str;

class Event extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name','event_category_id','venue_id','employee_id','start_date','end_date','objectives'];

    /* --------------------
     * Route model binding
     * --------------------*/
    public function getRouteKeyName ()
    {
        return 'slug';
    }

    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'events';


    /* ------------------
     *  Mutator functions
     * ------------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    /* ------------------
     *  Accessor functions
     * ------------------*/
    public function getEventStatusAttribute()
    {

        if ($this->start_date < date('Y-m-d')  && $this->end_date < date('Y-m-d'))
        {
            return '<span class="status bg-success">Completed</span>';
        }
        elseif ($this->start_date < date('Y-m-d')  && $this->end_date > date('Y-m-d')) {
            return '<span class="status bg-warning">Ongoing</span>';
        }
        elseif ($this->start_date > date('Y-m-d') && $this->end_date > date('Y-m-d')){
            return '<span class="status bg-danger text-white">Upcoming</span>';
        }
        elseif ($this->start_date == date('Y-m-d') && $this->end_date == date('Y-m-d')){
            return '<span class="status bg-warning">Ongoing</span>';
        }
        else {
            return null;
        }

    }
    public function getStatusAttribute()
    {
        if ($this->start_date < date('Y-m-d')  && $this->end_date < date('Y-m-d'))
        {
            return "completed";
        }
        elseif ($this->start_date < date('Y-m-d')  && $this->end_date > date('Y-m-d')) {
            return "ongoing";
        }
        elseif ($this->start_date > date('Y-m-d') && $this->end_date > date('Y-m-d')){
            return "upcoming";
        }
        elseif ($this->start_date == date('Y-m-d') && $this->end_date == date('Y-m-d')){
            return "ongoing";
        }
        else {
            return null;
        }

    }


    /* ---------------------
    *  MODEL RELATIONSHIPS
    * ---------------------*/
    public function venue()
    {
        return $this->belongsTo(Venue::class)->withDefault();
    }

    //All Events have coordinator
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }

    //Every event belongs to a category
    public function event_category()
    {
        return $this->belongsTo(EventCategory::class)->withDefault();
    }

    //Event can be Organized by many organization
    public function organization()
    {
        return $this->belongsToMany(Organization::class,'organisers');
    }

    //Event has many facilitators
    public function individual()
    {
        return $this->belongsToMany(Individual::class,'facilitators');
    }







}
