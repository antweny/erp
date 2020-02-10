<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends BaseModel
{
    /* -----------------------------------------
      * The attributes that are mass assignable.
      * -----------------------------------------*/
    protected $fillable = ['individual_id','organization_id','ward_id','event_id','date','participant_level','participant_role_id','group_id'];

    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'participants';


    /* ------------------
     *  Accessor functions
     * ------------------*/
    public function getParticipantLevelAttribute($value)
    {
        switch ($value)
        {
            case 'I':
                return 'International';
                break;
            case 'L':
                return 'Local';
                break;
            default:
                return null;
                break;
        }

    }


    /* ---------------------
     *  MODEL RELATIONSHIPS
     * ---------------------*/
    public function individual()
    {
        return $this->belongsTo(Individual::class)->select('id','full_name','gender','age_group')->withDefault();
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class)->select('id','name','acronym')->withDefault();
    }
    public function event()
    {
        return $this->belongsTo(Event::class)->select('id','name')->withDefault();
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class)->select('id','name')->withDefault();
    }
    public function participant_role()
    {
        return $this->belongsTo(ParticipantRole::class)->withDefault();
    }
    public function group()
    {
        return $this->belongsTo(Group::class)->withDefault();
    }



    /*
     * Format the data to display
     */
    public function format()
    {

        return [
        'id' => $this->id,
        'individual' => $this->individual->full_name,
        'sex' => $this->individual->sex,
        'age_group' => $this->individual->age_Group,
        'event' => $this->event->name,
        'organization' => $this->organization->organization_name,
        'group' => $this->group->name,
        'role' => $this->participant_role->name,
        'level' => $this->participant_level,
        'date' => get_day_month_and_year($this->date),
        'ward' => $this->ward->name
    ];

    }


}
