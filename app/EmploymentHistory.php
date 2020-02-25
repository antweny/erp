<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id', 'designation_id', 'employment_type_id','start_date','end_date'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'employment_histories';



    /* ---------------------
   *  MODEL RELATIONSHIPS
   * ---------------------*/
    //All Events have coordinator
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }

    //Every event belongs to a category
    public function designation()
    {
        return $this->belongsTo(Designation::class)->withDefault();
    }

    //Event can be Organized by many organization
    public function employment_type()
    {
        return $this->belongsTo(EmploymentType::class);
    }
}
