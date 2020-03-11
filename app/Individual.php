<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Individual extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['full_name', 'age_group', 'mobile', 'gender', 'address', 'email', 'occupation', 'education_level_id',
        'city_id', 'district_id', 'ward_id'];


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

    /* -------------------
     *   Other Functions
     * -------------------*/

    /*
     * Get Name and ID
     */
    static function get_name_and_id()
    {
        $individual = Individual::select('id', 'full_name')->get();
        return $individual;
    }

    /*
     * Get Name and ID
     */
    //Check if resource exist get ID if not create and get ID
    public function get_id($data)
    {
        if ($data != null) {
            $model = $this->firstOrCreate(['full_name' => $data]);
            return $model->id;
        }
        return null;
    }

    /*
     * Format the data to display
     */
    public function format()
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'age_group' => $this->age_Group,
            'district' => $this->district->name,
            'occupation' => $this->occupation,
            'education' => $this->education_level->name,
            'mobile' => $this->mobile,
        ];

    }
}
