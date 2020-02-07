<?php

namespace App;

use Illuminate\Support\Str;

class Organization extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name','acronym','founded','registered','organization_category_id','operation_level','city_id',
        'district_id','ward_id','contact_person','contact_person_number','address','website','email','mobile','phone','objectives'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'organizations';


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

    /* ------------------
    * Accessor  Functions
    * ------------------*/
    public function getOrganizationNameAttribute()
    {
        if($this->acronym != null) {
            return $this->name.' ('.$this->acronym.')';
        }
        else{
            return $this->name;
        }
    }

    public function getOpLevelAttribute() {
        switch ($this->operation_level)
        {
            case 'CL':
                return 'Community';
                break;
            case 'DL':
                return 'District';
                break;
            case 'REL':
                return 'Region';
                break;
            case 'NL':
                return 'National';
                break;
            case 'RL':
                return 'Regional';
                break;
            case 'IL':
                return 'International';
                break;
            default:
                return '';
                break;
        }
    }

    /* ---------------------
    *  MODEL RELATIONSHIPS
    * ---------------------*/
    public function organization_category()
    {
        return $this->belongsTo(OrganizationCategory::class)->withDefault();
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


    /* -------------------
     *   Other Functions
     * -------------------*/

    /*
     * Get Name and ID
     */
    static function get_name_and_id()
    {
        $organization = Organization::select('id','name','acronym')->get();

        return $organization;
    }





}
