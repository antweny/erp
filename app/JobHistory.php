<?php

namespace App;

class JobHistory extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id', 'designation_id', 'job_type_id','start_date','end_date'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'job_histories';



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
    public function job_type()
    {
        return $this->belongsTo(JobType::class);
    }
}
